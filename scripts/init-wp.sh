#!/bin/bash

set -euo pipefail
shopt -s nullglob

e_start() {
	echo '::group::'"$@"
}

e_end() {
	echo '::endgroup::'
}

e_start 'Download Core'
vendor/bin/wp core download --version=${WP_VERSION}
e_end

e_start 'Configure Core'
vendor/bin/wp config create \
  --dbhost=${DB_HOST} --dbname=${DB_NAME} \
  --dbuser=${DB_USER} --dbpass=${DB_PASS}
e_end

e_start 'Install Core'
vendor/bin/wp core install \
  --url="${SITE_URL}" --title="${SITE_TITLE}" \
  --admin_user="${SITE_ADMIN_USER}" \
  --admin_password="${SITE_ADMIN_PASS}" \
  --admin_email="${SITE_ADMIN_EMAIL}" \
  --skip-email --allow-root
e_end

e_start 'Set options'
vendor/bin/wp option update permalink_structure "/%postname%/"
vendor/bin/wp option update timezone_string "${SITE_TIMEZONE}"
e_end

e_start 'Install plugins'
vendor/bin/wp plugin install contact-form-7 --version=${CF7_VERSION}
e_end

if vendor/bin/wp plugin is-active woocommerce; then
    e_start "Initializing default WooCommerce Settings..."

    vendor/bin/wp option update woocommerce_store_address "${WC_STORE_ADDRESS}"
    vendor/bin/wp option update woocommerce_store_city "${WC_STORE_CITY}"
    vendor/bin/wp option update woocommerce_default_country "${WC_DEFAULT_COUNTRY}"
    vendor/bin/wp option update woocommerce_currency "${WC_CURRENCY}"
    vendor/bin/wp option update woocommerce_store_postcode "${WC_STORE_POSTCODE}"

    vendor/bin/wp option update woocommerce_weight_unit "${WC_WEIGHT_UNIT:-kg}"
    vendor/bin/wp option update woocommerce_dimension_unit "${WC_DIMENSION_UNIT:-cm}"
    vendor/bin/wp option update woocommerce_price_thousand_sep "${WC_PRICE_THOUSAND_SEP:-.}"
    vendor/bin/wp option update woocommerce_price_decimal_sep "${WC_PRICE_DECIMAL_SEP:-,}"
    vendor/bin/wp option update woocommerce_price_num_decimals "${WC_PRICE_DECIMAL_NUM:-,}"

    # Skip the onboarding profile
    vendor/bin/wp option update woocommerce_onboarding_profile '{"skipped":true}' --format=json

    # Mark the task list as complete
    vendor/bin/wp option update woocommerce_task_list_complete yes
    e_end
fi

if [[ ${MULTISITE_ENABLED} -eq 1 ]]; then
    e_start "Initializing multisite..."

    # https://developer.wordpress.org/advanced-administration/server/web-server/httpd/#multisite
    cat public/.htaccess.multisite > .htaccess
    echo 'Update .htaccess.'

    vendor/bin/wp core multisite-convert

    vendor/bin/wp plugin activate $plugins --network
    e_end
fi

e_start 'Verify'
vendor/bin/wp core version --extra
e_end
