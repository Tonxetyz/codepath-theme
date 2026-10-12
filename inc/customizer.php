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

		'benefits_title'    => 'Почему CodePath AI',
		'benefit_1_title'   => 'Наставник, который учит',
		'benefit_1_text'    => 'Отто даёт подсказки и разбирает ошибки, но не пишет решение за тебя. Ты действительно учишься.',
		'benefit_2_title'   => 'Код прямо в браузере',
		'benefit_2_text'    => 'Python запускается на странице: ничего не нужно устанавливать, начать можно за минуту.',
		'benefit_3_title'   => 'Честный прогресс',
		'benefit_3_text'    => 'Считаем только реальное время практики, поэтому ты видишь настоящий рост, а не цифры для галочки.',

		// Примеры отзывов — замените настоящими в Настройщике.
		'reviews_title'     => 'Что говорят ученики',
		'review_1_name'     => 'Мария',
		'review_1_role'     => '10 класс',
		'review_1_text'     => 'Раньше боялась программирования. Отто объясняет ошибки так, что наконец стало понятно, а не страшно.',
		'review_2_name'     => 'Артём',
		'review_2_role'     => 'начинает с нуля',
		'review_2_text'     => 'Не нужно ничего ставить: открыл страницу и сразу пишу код. За неделю дошёл до первых циклов.',
		'review_3_name'     => 'Елена',
		'review_3_role'     => 'родитель',
		'review_3_text'     => 'Нравится, что считаются реальные часы. Видно, сколько сын правда занимался, без накруток.',

		'footer_text'       => 'Учись программировать спокойно и честно. Отто всегда рядом.',
		'cookie_text'       => 'Сайт использует cookie, чтобы работать корректно. Продолжая им пользоваться, вы соглашаетесь с этим.',
		'seo_keywords'      => 'обучение программированию, Python, ИИ-наставник, CodePath AI',
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

	$benefits = array( 'benefits_title' => array( 'Заголовок блока', 'text' ) );
	for ( $i = 1; $i <= 3; $i++ ) {
		$benefits[ "benefit_{$i}_title" ] = array( "Карточка $i: заголовок", 'text' );
		$benefits[ "benefit_{$i}_text" ]  = array( "Карточка $i: текст", 'textarea' );
	}
	codepath_add_section( $wp_customize, 'codepath_benefits', 'Преимущества', 31, $benefits );

	$reviews = array( 'reviews_title' => array( 'Заголовок блока', 'text' ) );
	for ( $i = 1; $i <= 3; $i++ ) {
		$reviews[ "review_{$i}_name" ] = array( "Отзыв $i: имя", 'text' );
		$reviews[ "review_{$i}_role" ] = array( "Отзыв $i: кто это (класс, роль)", 'text' );
		$reviews[ "review_{$i}_text" ] = array( "Отзыв $i: текст", 'textarea' );
	}
	codepath_add_section( $wp_customize, 'codepath_reviews', 'Отзывы', 32, $reviews );

	codepath_add_section( $wp_customize, 'codepath_footer', 'Подвал, cookie и SEO', 33, array(
		'footer_text'  => array( 'Текст в подвале', 'textarea' ),
		'cookie_text'  => array( 'Текст баннера cookie', 'textarea' ),
		'seo_keywords' => array( 'Ключевые слова (через запятую)', 'text' ),
	) );
} );
