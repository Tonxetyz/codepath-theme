<?php
/**
 * CodePath Theme — настройка темы.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CODEPATH_VERSION', '1.0.0' );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 160, 'flex-width' => true ) );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'codepath', get_stylesheet_uri(), array(), CODEPATH_VERSION );
} );
