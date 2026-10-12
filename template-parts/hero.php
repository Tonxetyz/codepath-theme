<section class="hero">
	<div class="wrap hero__inner">
		<div class="hero__copy">
			<h1><?php echo esc_html( codepath_get( 'hero_title' ) ); ?></h1>
			<p class="hero__text"><?php echo esc_html( codepath_get( 'hero_text' ) ); ?></p>
			<a class="btn" href="<?php echo esc_url( codepath_get( 'hero_button_url' ) ); ?>"><?php echo esc_html( codepath_get( 'hero_button_text' ) ); ?></a>
		</div>
		<div class="hero__art">
			<img src="<?php echo esc_url( get_theme_file_uri( 'assets/otto.svg' ) ); ?>" width="400" height="400" fetchpriority="high" alt="Отто — фиолетовый осьминог, маскот CodePath AI">
		</div>
	</div>
</section>
