<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Blank Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blank_theme_body_classes( $classes )
{
    global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
    if( $is_lynx )
        $classes[] = 'lynx';
    elseif( $is_gecko )
        $classes[] = 'gecko';
    elseif( $is_opera )
        $classes[] = 'opera';
    elseif( $is_NS4 )
        $classes[] = 'ns4';
    elseif( $is_safari )
        $classes[] = 'safari';
    elseif( $is_chrome )
        $classes[] = 'chrome';
    elseif( $is_IE ) {
        $classes[] = 'ie';
        if( isset( $_SERVER[ 'HTTP_USER_AGENT' ] ) && preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER[ 'HTTP_USER_AGENT' ], $browser_version ) ) {
            $classes[] = 'ie' . $browser_version[ 1 ];
        }
    } else {
        $classes[] = 'unknown';
    }
    if( $is_iphone ) {
        $classes[] = 'iphone';
    }

    if( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Mobile' ) !== false ) {
        $classes[] = 'mobile';
    }

    if( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Android' ) !== false ) {
        $classes[] = 'android';
    }

    if( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Opera Mini' ) !== false ) {
        $classes[] = 'opera-mini';
    }

    if( strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'BlackBerry' ) !== false ) {
        $classes[] = 'blackberry';
    }

    if( isset( $_SERVER[ 'HTTP_USER_AGENT' ] ) && stristr( $_SERVER[ 'HTTP_USER_AGENT' ], 'mac' ) ) {
        $classes[] = 'osx';
    } elseif( isset( $_SERVER[ 'HTTP_USER_AGENT' ] ) && stristr( $_SERVER[ 'HTTP_USER_AGENT' ], 'linux' ) ) {
        $classes[] = 'linux';
    } elseif( isset( $_SERVER[ 'HTTP_USER_AGENT' ] ) && stristr( $_SERVER[ 'HTTP_USER_AGENT' ], 'windows' ) ) {
        $classes[] = 'windows';
    }
    if( !is_multi_author() ) {
        $classes[] = 'blank-theme-single-author';
    }
    if( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    if( get_header_image() ) {
        $classes[] = 'header-image';
    } else {
        $classes[] = 'masthead-fixed';
    }
    if( is_archive() || is_search() || is_home() ) {
        $classes[] = 'blank-theme-list-view';
    }
    if( is_singular() && !is_front_page() ) {
        $classes[] = 'singular';
    }
    return $classes;
}

add_filter( 'body_class', 'blank_theme_body_classes' );
