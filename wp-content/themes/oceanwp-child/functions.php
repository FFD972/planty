<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'font-awesome','simple-line-icons','oceanwp-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

function add_admin_link_to_menu( $items, $args ) {

    // Vérifie si l'utilisateur est connecté
    if ( is_user_logged_in() && $args->menu->slug == 'principal' ) {
        // Divise les éléments du menu en deux parties
        $menu_items = explode( '</li>', $items );
        $half = ceil( (count( $menu_items )-1) / 2 );

        // Ajoute le lien "Admin" au milieu du menu
        $admin_link = '<li><a href="' . admin_url() . '">Admin</a></li>';
        array_splice( $menu_items, $half, 0, $admin_link );

        // Reconstitue les éléments du menu
        $items = implode( '</li>', $menu_items );
    }

    return $items;
}
add_filter( 'wp_nav_menu_items', 'add_admin_link_to_menu', 10, 2 );
