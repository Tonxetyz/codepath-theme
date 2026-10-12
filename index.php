<?php get_header(); ?>

<main id="main" class="site-main section">
	<div class="wrap content">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<?php is_singular() ? the_content() : the_excerpt(); ?>
				</article>
			<?php endwhile; ?>
			<?php the_posts_navigation(); ?>
		<?php else : ?>
			<h1>Ничего не найдено</h1>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Вернуться на главную</a></p>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
