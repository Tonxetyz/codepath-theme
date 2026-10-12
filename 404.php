<?php get_header(); ?>

<main id="main" class="site-main section">
	<div class="wrap content not-found">
		<h1>Страница не найдена</h1>
		<p>Отто обыскал все щупальца, но такой страницы здесь нет. Возможно, ссылка устарела.</p>
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">На главную</a>
	</div>
</main>

<?php get_footer(); ?>
