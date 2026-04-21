#!/usr/bin/env bash

set -euo pipefail

e_start() {
    if [[ -n "${CI:-}" ]]; then
        echo "::group::$*"
    else
        echo -e "> \e[1;33m$*\e[0m"
    fi
}

e_end() {
    if [[ -n "${CI:-}" ]]; then
        echo '::endgroup::'
    else
        echo ''
    fi
}

_wp() {
    if command -v wp > /dev/null 2>&1; then
        wp "$@"
    else
        vendor/bin/wp "$@"
    fi
}

declare -A wpcf7_map

wpcf7_map['5.9']='5.6'
wpcf7_map['6.0']='5.7'
wpcf7_map['6.1']='5.7'
wpcf7_map['6.2']='5.8'
wpcf7_map['6.3']='5.9'
wpcf7_map['6.4']='5.9'
wpcf7_map['6.5']='5.9'
wpcf7_map['6.6']='6.0'
wpcf7_map['6.7']='6.1'
wpcf7_map['6.8']='6.1'
wpcf7_map['6.9']='6.1'
wpcf7_map['7.0']='6.1'

# Reduce to major.minor for map lookup
WP_VERSION=${WP_VERSION:-'5.9'}
WP_VERSION=$(echo "${WP_VERSION}" | awk -F. '{printf "%s.%s", $1, $2}')

CF7_VERSION=${wpcf7_map[${WP_VERSION}]:-'6.1'}

PUBLIC_DIR=${PUBLIC_DIR:-"$PWD/public"}
INSTALL_DIR=${INSTALL_DIR:-"$PWD/docker/volumes/wordpress"}

SITE_URL=${SITE_URL:-'http://localhost'}

if _wp core is-installed --url="${SITE_URL}" --allow-root; then
  echo "WordPress is already installed."
else
    if [[ ! -d "${INSTALL_DIR}" ]]; then
        e_start 'Download Core'
        _wp core download --version=${WP_VERSION}
        e_end
    fi

    if [[ ! -f "${INSTALL_DIR}/wp-config.php" ]]; then
        e_start 'Configure Core'
        _wp config create \
            --dbhost=${DB_HOST:-127.0.0.1:3306} --dbname=${DB_NAME:-wordpress} \
            --dbuser=${DB_USER:-sampleuser} --dbpass=${DB_PASS:-samplepass}
        e_end
    fi

    e_start 'Install Core'
    _wp core install \
        --url="${SITE_URL}" --title="${SITE_TITLE:-'WordPress Local'}" \
        --admin_user=${SITE_ADMIN_USER:-admin} \
        --admin_password=${SITE_ADMIN_PASS:-secret} \
        --admin_email=${SITE_ADMIN_EMAIL:-'admin@example.com'} \
        --skip-email --allow-root
    e_end

    e_start 'Set options'
    _wp option update permalink_structure "/%postname%/"
    _wp option update timezone_string "${SITE_TIMEZONE:-Asia/Jakarta}"
    e_end

    if [[ ! -f "$INSTALL_DIR/favicon.ico" ]]; then
        cp "$PUBLIC_DIR/favicon.ico" "$INSTALL_DIR/favicon.ico"
    fi
fi

if [[ -n "${SITE_PLUGINS:-}" ]]; then
    e_start 'Install default Plugins'
    SITE_PLUGINS=${SITE_PLUGINS:-''}
    plugins=""

    for plugin in ${SITE_PLUGINS//,/ }; do
        if _wp plugin is-installed "$plugin"; then
            echo " - $plugin is already installed."
            continue
        fi

        if [[ "$plugin" == "contact-form-7" ]]; then
            _wp plugin install contact-form-7 --version=${CF7_VERSION} --activate
            continue
        fi

        plugins="$plugins $plugin"
    done

    if [[ -n "$plugins" ]]; then
        _wp plugin install $plugins --activate
    fi
    e_end
fi

if _wp plugin is-active woocommerce; then
    e_start "Configure WooCommerce"
    _wp option update woocommerce_store_address "${WC_STORE_ADDRESS:-'Jl. Example No. 123'}"
    _wp option update woocommerce_store_city "${WC_STORE_CITY:-'Batang'}"
    _wp option update woocommerce_default_country "${WC_DEFAULT_COUNTRY:-'ID:JT'}"
    _wp option update woocommerce_currency "${WC_CURRENCY:-'IDR'}"
    _wp option update woocommerce_store_postcode "${WC_STORE_POSTCODE:-'12345'}"

    _wp option update woocommerce_weight_unit "${WC_WEIGHT_UNIT:-kg}"
    _wp option update woocommerce_dimension_unit "${WC_DIMENSION_UNIT:-cm}"
    _wp option update woocommerce_price_thousand_sep "${WC_PRICE_THOUSAND_SEP:-.}"
    _wp option update woocommerce_price_decimal_sep "${WC_PRICE_DECIMAL_SEP:-,}"
    _wp option update woocommerce_price_num_decimals "${WC_PRICE_DECIMAL_NUM:-0}"

    # Skip the onboarding profile
    _wp option update woocommerce_onboarding_profile '{"skipped":true}' --format=json

    # Mark the task list as complete
    _wp option update woocommerce_task_list_complete yes
    e_end
fi

if [[ ${MULTISITE_ENABLED:-0} -eq 1 ]]; then
    e_start "Configure multisite"

    # https://developer.wordpress.org/advanced-administration/server/web-server/httpd/#multisite
    cat "$PUBLIC_DIR/.htaccess.multisite" > "$INSTALL_DIR/.htaccess"
    echo 'Update .htaccess.'

    _wp core multisite-convert

    _wp plugin activate $plugins --network
    e_end
fi

if [[ -n "${SITE_THEMES:-}" ]]; then
    e_start 'Install default theme'
    SITE_DEFAULT_THEME=${SITE_DEFAULT_THEME:-}
    themes=""

    for theme in ${SITE_THEMES//,/ }; do
        if wp theme is-installed "$theme"; then
            echo " - $theme is already installed."
            continue
        fi

        themes="$themes $theme"
    done

    if [[ -n "$themes" ]]; then
        wp theme install $themes
    fi

    if [[ -n "$SITE_DEFAULT_THEME" ]] && ! wp theme is-installed "$SITE_DEFAULT_THEME"; then
        wp theme install $SITE_DEFAULT_THEME
    fi
    e_end
fi

e_start 'Cleanup'
if _wp plugin is-installed hello; then
    _wp plugin uninstall hello
fi
e_end

e_start 'Verify'
_wp core version --extra
echo "Site URL: ${SITE_URL}"
e_end
