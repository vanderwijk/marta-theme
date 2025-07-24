<?php
/**
 * Default output for a download via the [download] shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="download-item">
	<?php if ( has_post_thumbnail( $dlm_download->get_id() ) ) : ?>
		<div class="download-thumbnail">
			<?php echo get_the_post_thumbnail( $dlm_download->get_id(), 'thumbnail' ); ?>
		</div>
	<?php endif; ?>
	<div class="download-content">
		<a class="download-link filetype-icon <?php echo 'filetype-' .  $dlm_download->get_the_filetype(); ?>" title="<?php if ( $dlm_download->has_version_number() ) printf( __( 'Version %s', 'download_monitor' ), $dlm_download->get_the_version_number() ); ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
			<?php $dlm_download->the_title(); ?>
		</a> - <?php $dlm_download->the_filesize(); ?> (.<?php $dlm_download->the_filetype(); ?>)
	</div>
</div>
