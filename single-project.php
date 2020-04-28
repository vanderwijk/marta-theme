<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	$product_meta = get_post_custom( $post -> ID ); ?>

	<div class="row clearfix">
		<h1 class="entry-title">
			<?php the_title(); ?>
		</h1>
	</div>

	<div class="row clearfix gallery">

	<?php $images = get_field( 'gallery' );
	if ( $images ) { ?>

		<div class="carousel">

			<?php foreach( $images as $image ) : ?>

				<div class="carousel-cell">
					<a href="<?php echo $image['sizes']['large']; ?>" data-size="<?php echo $image['sizes']['large-width'] . 'x' . $image['sizes']['large-height']; ?>">
						<img src="/wp-content/themes/marta/img/collection.gif" data-flickity-lazyload="<?php echo $image['sizes']['medium']; ?>" />
					</a>
				</div>

			<?php endforeach; ?>

		</div>

	<?php } ?>

	</div>
	<div class="row clearfix information">

		<div class="description e-description">
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>

		<div class="related">
			<div class="entry-content">
				<?php
				$posts = get_field('related_products');

				if ( $posts ): ?>
					<p><strong><?php _e( 'Items used in this project', 'marta' ); ?></strong></p>
					<ul>
					<?php foreach( $posts as $post) :
						setup_postdata($post); ?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</li>
					<?php endforeach; ?>
					</ul>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</div>
		</div>

	</div>

	<?php endwhile;	endif; ?>

</article>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg"></div>
	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>
		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>
				<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
				<button class="pswp__button pswp__button--share" title="Share"></button>
				<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
				<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
					<div class="pswp__preloader__cut">
						<div class="pswp__preloader__donut"></div>
					</div>
					</div>
				</div>
			</div>
			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div>
			</div>
			<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
			<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
