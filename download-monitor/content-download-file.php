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
    // Try Download Monitor's specific image function first
    $download_image = $dlm_download->get_image();
    if ( ! empty( $download_image ) ) : ?>
        <div class="download-thumbnail">
            <?php echo $download_image; ?>
        </div>
    <?php
    // Fallback to standard WordPress functions if DLM's function doesn't return anything
    elseif ( has_post_thumbnail( $dlm_download->get_id() ) ) : ?>
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
