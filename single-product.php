<?php get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
	$product_meta = get_post_custom( $post -> ID ); ?>

	<div class="row clearfix">

		<div class="featured">
			<?php the_post_thumbnail( 'medium' ); ?>
		</div>

		<div class="specifications">

			<h1 class="entry-title">
				<?php the_title(); ?>
				<?php if ( isset( $product_meta['_product_year'][0] ) && $product_meta['_product_year'][0] != '' ) {
					echo '<span>(' . $product_meta['_product_year'][0] . ')</span>';
				} ?>
			</h1>

			<table>

				<?php if ( isset( $product_meta['_product_designer'][0] ) ) { ?>
					<tr class="design">
						<td><?php _e('design', 'marta'); ?></td>
						<td><?php echo $product_meta['_product_designer'][0]; ?></td>
					</tr>
				<?php }

				if ( isset( $product_meta['_product_dimensions'][0] ) ) { ?>
					<tr class="dimensions">
						<td class="nowrap"><?php _e('dimensions (mm)', 'marta'); ?></td>
						<td><?php echo $product_meta['_product_dimensions'][0] ?></td>
					</tr>
				<?php }

				if ( isset( $product_meta['_product_materials'][0] ) ) { ?>
					<tr>
						<td><?php _e('materials', 'marta'); ?></td>
						<td><?php echo $product_meta['_product_materials'][0]; ?></td>
					</tr>
				<?php }

				if ( isset( $product_meta['_product_colour'][0] ) ) { ?>
					<tr>
						<td><?php _e('colour', 'marta'); ?></td>
						<td><?php echo $product_meta['_product_colour'][0]; ?></td>
					</tr>
				<?php }

				if ( isset( $product_meta['_product_characteristics'][0] ) ) { ?>
					<tr class="characteristics">
						<td colspan="2"><?php echo $product_meta['_product_characteristics'][0]; ?></td>
					</tr>
				<?php }

				if ( isset( $product_meta['_product_brand'][0] ) ) { ?>
					<tr class="brand">
						<td colspan="2"><?php echo $product_meta['_product_brand'][0]; ?></td>
					</tr>
				<?php } ?>

			</table>

		</div>

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
				$related_projects = get_posts (
					array (
						'post_type' => 'project',
						'meta_query' => array (
							array (
								'key' => 'related_products',
								'value' => '"' . get_the_ID() . '"',
								'compare' => 'LIKE'
							)
						)
					)
				); ?>
				<?php if( $related_projects ) : ?>
					<p><strong><?php _e( 'Projects', 'marta' ); ?></strong></p>
					<ul>
					<?php foreach( $related_projects as $doctor ): ?>
						<li>
							<a href="<?php echo get_permalink( $doctor->ID ); ?>">
								<?php echo get_the_title( $doctor->ID ); ?>
							</a>
						</li>
					<?php endforeach; ?>
					</ul>
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
