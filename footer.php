<footer class="site-footer">
	<div class="wrap site-footer__inner">
		<div>
			<p class="site-footer__brand"><?php bloginfo( 'name' ); ?></p>
			<p class="site-footer__text"><?php echo esc_html( codepath_get( 'footer_text' ) ); ?></p>
		</div>
		<nav class="footer-nav" aria-label="Подвал">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'menu',
				'depth'          => 1,
				'fallback_cb'    => 'codepath_footer_fallback',
			) );
			?>
		</nav>
	</div>
	<p class="wrap site-footer__copy">© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
</footer>

<div id="cookie-banner" class="cookie" role="region" aria-label="Уведомление о cookie" hidden>
	<p><?php echo esc_html( codepath_get( 'cookie_text' ) ); ?></p>
	<button type="button" class="btn">Понятно</button>
</div>

<?php wp_footer(); ?>
</body>
</html>
