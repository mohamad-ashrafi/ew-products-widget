<?php

namespace Ew_Products_Widget;

class Maintenance
{

    public static function init() {
        register_activation_hook( ELEMENTOR_PLUGIN_BASE, [ __CLASS__, 'activation' ] );
        register_uninstall_hook( ELEMENTOR_PLUGIN_BASE, [ __CLASS__, 'uninstall' ] );

        add_action( 'wpmu_new_blog', function ( $site_id ) {
            if ( ! is_plugin_active_for_network( ELEMENTOR_PLUGIN_BASE ) ) {
                return;
            }

            static::create_default_kit( [ $site_id ] );
        } );
    }

    public static function activation() {
    }

    public static function uninstall() {

    }
    protected static function create_default_kit( $site_ids ) {
    }

}