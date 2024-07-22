<?php

namespace Ew_Products_Widget\Classes;

use Ew_Products_Widget\Widgets\WoocommerceProductsWidget;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Widget_Manager {
    private static $_instance = null;

    public static function instance(): ?Widget_Manager
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
    }

    public function register_widgets($widgets_manager): void
    {
        // Ensure that Elementor is loaded
        if (defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')) {
            require_once EW_PRODUCTS_WIDGET_INCLUDES_PATH.'Widgets'.DIRECTORY_SEPARATOR.'WoocommerceProductsWidget.php';
            $widgets_manager->register(new WoocommerceProductsWidget());
        } else {
            add_action('admin_notices', [$this, 'elementor_not_loaded']);
        }
    }

    public function elementor_not_loaded(): void
    {
        echo '<div class="notice notice-warning"><p>' . __('Elementor must be installed and activated for the WooCommerce Products Widget plugin to work.', 'ew-products-widget') . '</p></div>';
    }
}