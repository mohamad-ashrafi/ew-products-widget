<?php
namespace Ew_Products_Widget\Helpers;

if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

class Utilities
{
    public static function add_elementor_widget_categories( $elements_manager ): void
    {
        $category_exists = false;
        foreach ( $elements_manager->get_categories() as $category ) {
            if ( isset( $category['name'] ) && $category['name'] === 'custom-widget-category' ) {
                $category_exists = true;
                break;
            }
        }
        if ( ! $category_exists ) {
            $elements_manager->add_category(
                'custom-widget-category',
                [
                    'title' => esc_html__( 'ویجت های اشرفی', 'ew-products-widget' ),
                    'icon' => 'fa fa-plug',
                ]
            );
        }
    }
}
add_action('elementor/elements/categories_registered', [ __NAMESPACE__ . '\\Utilities' , 'add_elementor_widget_categories']);


