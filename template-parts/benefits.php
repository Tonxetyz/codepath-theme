<section id="benefits" class="section benefits">
	<div class="wrap">
		<h2 class="section__title"><?php echo esc_html( codepath_get( 'benefits_title' ) ); ?></h2>
		<ul class="cards">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<li class="card">
					<span class="card__num" aria-hidden="true"><?php echo (int) $i; ?></span>
					<h3><?php echo esc_html( codepath_get( "benefit_{$i}_title" ) ); ?></h3>
					<p><?php echo esc_html( codepath_get( "benefit_{$i}_text" ) ); ?></p>
				</li>
			<?php endfor; ?>
		</ul>
	</div>
</section>
