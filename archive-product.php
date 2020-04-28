<?php get_header(); ?>

<div class="filter">
	<button data-filter="*">all</button>
	<button data-filter=".category-indoor">indoor</button>
	<button data-filter=".category-outdoor">outdoor</button>
</div>

<div class="grid grid-collection">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		$product_meta = get_post_custom( $post -> ID ); ?>
		<article <?php post_class( 'collection' ); ?>>
			<a href="<?php the_permalink(); ?>">
			<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'collection' );
				} else {
					echo '<img src="/wp-content/themes/marta/img/collection.gif" />';
				} ?>
				<figcaption>
					<p><?php the_title(); ?><br />
					<?php if ( isset( $product_meta['_product_designer'][0] ) ) {
						echo $product_meta['_product_designer'][0];
					} ?></p>
				</figcaption>
			</a>
		</article>
	<?php endwhile; endif; ?>
</div>

<?php get_footer(); ?>