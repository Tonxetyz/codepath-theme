<section id="reviews" class="section reviews">
	<div class="wrap">
		<h2 class="section__title"><?php echo esc_html( codepath_get( 'reviews_title' ) ); ?></h2>
		<div class="review-list">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<figure class="review">
					<blockquote><p><?php echo esc_html( codepath_get( "review_{$i}_text" ) ); ?></p></blockquote>
					<figcaption>
						<strong><?php echo esc_html( codepath_get( "review_{$i}_name" ) ); ?></strong>
						<span><?php echo esc_html( codepath_get( "review_{$i}_role" ) ); ?></span>
					</figcaption>
				</figure>
			<?php endfor; ?>
		</div>
	</div>
</section>
