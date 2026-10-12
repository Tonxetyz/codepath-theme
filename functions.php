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

add_action( 'after_setup_theme', function () {
	register_nav_menus( array(
		'primary' => 'Основное меню (шапка)',
		'footer'  => 'Меню в подвале',
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script(
		'codepath',
		get_theme_file_uri( 'assets/site.js' ),
		array(),
		CODEPATH_VERSION,
		array( 'strategy' => 'defer', 'in_footer' => true )
	);
} );

// Меню по умолчанию, пока в админке не назначено своё.
function codepath_menu_fallback() {
	echo '<ul class="menu">'
		. '<li><a href="' . esc_url( home_url( '/#benefits' ) ) . '">Преимущества</a></li>'
		. '<li><a href="' . esc_url( home_url( '/#reviews' ) ) . '">Отзывы</a></li>'
		. '</ul>';
}

// Фавикон по умолчанию, если в админке не задана иконка сайта.
add_action( 'wp_head', function () {
	if ( ! has_site_icon() ) {
		echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( get_theme_file_uri( 'assets/favicon.svg' ) ) . '">' . "\n";
	}
} );
