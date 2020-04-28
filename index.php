<?php get_header(); ?>

<?php if ( have_posts() ) : ?>

	<div class="grid grid-moodboard">

		<?php $args = array( 'posts_per_page' => -1, 'order'=> 'DESC', 'orderby' => 'date', 'post_type' => 'banner' );
		$postslist = get_posts( $args );
		foreach ( $postslist as $post ) :
			setup_postdata( $post ); ?>

			<article <?php post_class( 'moodboard' ); ?>>
				<a href="<?php the_field( 'link' ); ?>" rel="external">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					} ?>
					<h2>
						<?php the_title(); ?>
					</h2>
				</a>
			</article>

		<?php endforeach;
		wp_reset_postdata(); ?>

		<?php while ( have_posts() ) : the_post();

			$product_meta = get_post_custom( $post -> ID );
			$images = get_field( 'gallery', false, false );
			if ( $images ) {

				$image = wp_get_attachment_image_src( $images[0], 'medium' );
				$image_w = $image[1];
				$image_h = $image[2];

				if ($image_w > $image_h) { 
					$image_c = 'moodboard landscape';
				} elseif ( $image_w == $image_h ) { 
					$image_c = 'moodboard square';
				} else {
					$image_c = 'moodboard portrait';
				} ?>
		
		<article <?php post_class( $image_c ); ?>>
			<a href="<?php the_permalink(); ?>">
				<?php if( get_field('_product_new') ) { ?>
					<h3><?php _e('New','marta'); ?></h3>
				<?php } ?>
				<?php echo wp_get_attachment_image( $images[0], 'medium' ); ?>
				<h2>
					<?php the_title(); ?>
				</h2>
			</a>
		</article>

	<?php }
		endwhile; ?>

	</div>

<?php else : ?>

	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'marta' ); ?></h1>
		</header>

		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'marta' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>

<?php endif; ?>

<?php get_footer(); ?>