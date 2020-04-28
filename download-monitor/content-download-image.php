<?php
/**
 * Default output for a download via the [download] shortcode
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/** @var DLM_Download $dlm_download */
?>

<a class="download-link image" title="<?php _e('download', 'marta'); ?> - <?php $dlm_download->the_title(); ?>" href="<?php $dlm_download->the_download_link(); ?>" rel="nofollow">
	<?php $dlm_download->the_image('thumbnail'); ?>
	<?php $dlm_download->the_image('large'); ?>
</a>
<div class="filesize"><?php $dlm_download->the_filesize(); ?></div>