<?php get_header(); ?>

<div class="grid grid-moodboard">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();

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
			<?php echo wp_get_attachment_image( $images[0], 'medium' ); ?>
			<h2>
				<?php the_title(); ?>
			</h2>
		</a>
	</article>

	<?php }
	endwhile; endif; ?>
</div>

<?php get_footer(); ?>