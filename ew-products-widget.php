<?php
/**
 * Plugin Name: نمایش محصولات ووکامرس
 * Description: نمایش محصولات ووکامرس بر اساس دسته بندی ، قیمت ، ارزانترین ها و ...
 * Version: 1.0
 * Author: محمد اشرفی
 * Text Domain: ew-products-widget
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('EW_PRODUCTS_WIDGET_PATH', plugin_dir_path(__FILE__));
define('EW_PRODUCTS_WIDGET_INCLUDES_PATH', plugin_dir_path(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR);
define('EW_PRODUCTS_WIDGET_URL', plugin_dir_url(__FILE__));

if (file_exists(EW_PRODUCTS_WIDGET_PATH.'vendor/autoload.php')) {
    require_once EW_PRODUCTS_WIDGET_PATH.'vendor/autoload.php';
}
if (file_exists(EW_PRODUCTS_WIDGET_PATH.'Includes/Helpers/Utilities.php')) {
    require_once EW_PRODUCTS_WIDGET_PATH.'Includes/Helpers/Utilities.php';
}

if (!did_action('elementor/loaded')) {
    add_action('admin_notices', function() {
        echo '<div class="notice notice-warning"><p>' . __('Elementor must be installed and activated for this plugin to work.', 'plugin-name') . '</p></div>';
    });
    return;
}

function ew_products_widget_load_plugin(): void
{
    load_plugin_textdomain( 'ew-products-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'ew_products_widget_fail_load' );
        return;
    }
    $core_version = ELEMENTOR_VERSION;
    $core_version_required = '3.23.1';
    $core_version_recommended = '3.23.1';
    if ( version_compare( $core_version, $core_version_required, '<' ) ) {
        add_action( 'admin_notices', 'ew_products_widget_fail_load_out_of_date' );
        return;
    }
    if ( version_compare( $core_version, $core_version_recommended, '<' ) ) {
        add_action( 'admin_notices', 'ew_products_widget_admin_notice_upgrade_recommendation' );
    }
    // Include your main plugin file here
    require plugin_dir_path( __FILE__ ) . 'includes/plugin.php';
}
add_action( 'plugins_loaded', 'ew_products_widget_load_plugin' );

function ew_products_widget_fail_load(): void
{
    echo '<div class="error"><p>' . esc_html__( 'My Elementor Addon requires Elementor to be installed and activated.', 'ew-products-widget' ) . '</p></div>';
}

function ew_products_widget_fail_load_out_of_date(): void
{
    echo '<div class="error"><p>' . esc_html__( 'My Elementor Addon requires Elementor version 3.0.0 or greater.', 'ew-products-widget' ) . '</p></div>';
}

function ew_products_widget_admin_notice_upgrade_recommendation(): void
{
    echo '<div class="error"><p>' . esc_html__( 'For best performance, it is recommended to update Elementor to the latest version.', 'ew-products-widget' ) . '</p></div>';
}



function ew_products_widget_init(): void
{
    Ew_Products_Widget\Classes\Enqueue_Assets::init();
    Ew_Products_Widget\Classes\Widget_Manager::instance();
    Ew_Products_Widget\Maintenance::init();

}
add_action('plugins_loaded', 'ew_products_widget_init');


