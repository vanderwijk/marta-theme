<?php
/**
 * Default output for a download via the [download] shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if directly accessed

/** @var DLM_Download $dlm_download */
?>
<div class="download-item">
	<?php 
	// Enable debugging to see what we're working with
	$download_id = null;
	
	// Method 1: Try the standard WordPress way first
	$download_id = get_the_ID();
	
	// Method 2: If that doesn't work, try the Download Monitor object methods
	if ( !$download_id && method_exists( $dlm_download, 'get_id' ) ) {
		$download_id = $dlm_download->get_id();
	}
	
	// Method 3: Try accessing the id property directly
	if ( !$download_id && isset( $dlm_download->id ) ) {
		$download_id = $dlm_download->id;
	}
	
	// Method 4: Try the WP_Post object if available
	if ( !$download_id && isset( $dlm_download->post ) && is_object( $dlm_download->post ) ) {
		$download_id = $dlm_download->post->ID;
	}
	
	// Method 5: Try other common property names
	if ( !$download_id && isset( $dlm_download->ID ) ) {
		$download_id = $dlm_download->ID;
	}
	
	// Method 6: Try post_id property
	if ( !$download_id && isset( $dlm_download->post_id ) ) {
		$download_id = $dlm_download->post_id;
	}
	
	// Extensive debug output - uncomment these lines to see what's available
	echo '<!-- Download ID found: ' . ($download_id ? $download_id : 'NONE') . ' -->';
	echo '<!-- Object class: ' . get_class($dlm_download) . ' -->';
	echo '<!-- Available methods: ' . implode(', ', get_class_methods($dlm_download)) . ' -->';
	echo '<!-- Object properties: ' . implode(', ', array_keys(get_object_vars($dlm_download))) . ' -->';
	if ( isset( $dlm_download->post ) ) echo '<!-- Has post object: YES -->';
	else echo '<!-- Has post object: NO -->';
	
	if ( $download_id && has_post_thumbnail( $download_id ) ) : ?>
		<div class="download-thumbnail">
			<?php echo get_the_post_thumbnail( $download_id, 'thumbnail' ); ?>
		</div>
	<?php endif; ?>
	<div class="download-content">
		<a class="download-link filetype-icon <?php echo 'filetype-' .  $dlm_download->get_the_filetype(); ?>" title="<?php if ( $dlm_download->has_version_number() ) printf( __( 'Version %s', 'download_monitor' ), $dlm_download->get_the_version_number() ); ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
			<?php $dlm_download->the_title(); ?>
		</a> - <?php $dlm_download->the_filesize(); ?> (.<?php $dlm_download->the_filetype(); ?>)
	</div>
</div>
