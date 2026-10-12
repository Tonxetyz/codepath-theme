<?php
/**
 * CodePath Theme — настройка темы.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CODEPATH_VERSION', '1.0.0' );

require_once get_theme_file_path( 'inc/customizer.php' );

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

// Меню подвала по умолчанию: ссылка на политику конфиденциальности, если она назначена в Настройках → Конфиденциальность.
function codepath_footer_fallback() {
	$url = get_privacy_policy_url();
	if ( $url ) {
		echo '<ul class="menu"><li><a href="' . esc_url( $url ) . '">Политика конфиденциальности</a></li></ul>';
	}
}

// Мета-теги: description, keywords, Open Graph, Twitter Card.
add_action( 'wp_head', function () {
	$desc = '';
	if ( is_front_page() ) {
		$desc = codepath_get( 'hero_text' );
	} elseif ( is_singular() ) {
		$desc = wp_strip_all_tags( get_the_excerpt() );
	}
	if ( '' === $desc ) {
		$desc = get_bloginfo( 'description' );
	}

	$url   = is_singular() ? get_permalink() : home_url( '/' );
	$title = wp_get_document_title();
	$meta  = array(
		'og:type'        => 'website',
		'og:site_name'   => get_bloginfo( 'name' ),
		'og:title'       => $title,
		'og:description' => $desc,
		'og:url'         => $url,
		'og:locale'      => get_locale(),
	);
	if ( has_site_icon() ) {
		$meta['og:image'] = get_site_icon_url( 512 );
	}

	echo '<meta name="description" content="' . esc_attr( $desc ) . '">' . "\n";
	echo '<meta name="keywords" content="' . esc_attr( codepath_get( 'seo_keywords' ) ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary">' . "\n";
	foreach ( $meta as $property => $content ) {
		echo '<meta property="' . esc_attr( $property ) . '" content="' . esc_attr( $content ) . '">' . "\n";
	}
}, 5 );
