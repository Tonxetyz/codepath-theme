<?php
/**
 * Тексты лендинга: значения по умолчанию и поля в «Внешний вид → Настроить».
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function codepath_defaults() {
	return array(
		'hero_title'       => 'Учись программировать вместе с Отто',
		'hero_text'        => 'CodePath AI — персональный путь в код. ИИ-наставник Отто подсказывает и объясняет, но не делает работу за тебя.',
		'hero_button_text' => 'Начать учиться',
		'hero_button_url'  => '#benefits',
	);
}

// Значение настройки или текст по умолчанию.
function codepath_get( $key ) {
	$defaults = codepath_defaults();
	return get_theme_mod( $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

// Добавляет секцию с полями. $fields: ключ => [подпись, тип (text|textarea|url)].
function codepath_add_section( $wp_customize, $id, $title, $priority, $fields ) {
	$defaults  = codepath_defaults();
	$sanitizer = array(
		'text'     => 'sanitize_text_field',
		'textarea' => 'sanitize_textarea_field',
		'url'      => 'esc_url_raw', // пропускает и якоря вида #benefits
	);

	$wp_customize->add_section( $id, array( 'title' => $title, 'priority' => $priority ) );

	foreach ( $fields as $key => $field ) {
		$wp_customize->add_setting( $key, array(
			'default'           => isset( $defaults[ $key ] ) ? $defaults[ $key ] : '',
			'sanitize_callback' => $sanitizer[ $field[1] ],
		) );
		$wp_customize->add_control( $key, array(
			'section' => $id,
			'label'   => $field[0],
			'type'    => 'url' === $field[1] ? 'text' : $field[1],
		) );
	}
}

add_action( 'customize_register', function ( $wp_customize ) {
	codepath_add_section( $wp_customize, 'codepath_hero', 'Главный экран', 30, array(
		'hero_title'       => array( 'Заголовок', 'text' ),
		'hero_text'        => array( 'Подзаголовок', 'textarea' ),
		'hero_button_text' => array( 'Текст кнопки', 'text' ),
		'hero_button_url'  => array( 'Ссылка кнопки', 'url' ),
	) );
} );
