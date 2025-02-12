<?php
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-hero';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Get Media Type
$media_type = get_field( 'block-hero__media-type' );

if ( $media_type === 'Single image' ) {
    $image = get_field( 'block-hero__media-image' );
    if ( $image ) : ?>
        <div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?> block-hero__media-image">
            <figure class="block-hero__media">
                <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="block-hero__file" />
            </figure>
        </div>
    <?php endif;
} elseif ( $media_type === 'Slider' ) {
    if ( have_rows( 'block-hero__media-slider' ) ) : ?>
        <div <?php echo esc_attr( $anchor ); ?>
                class="<?php echo esc_attr( $class_name ); ?> block-hero__slider"
                data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": false, "dots": false, "autoplay": true, "autoplaySpeed": 3000, "fade": true, "mobileFirst": true, "infinite": true}'>
            <?php while ( have_rows( 'block-hero__media-slider' ) ) : the_row();
                $slider_image = get_sub_field( 'block-hero__media-slider-image' );
                if ( $slider_image ) : ?>
                    <div class="block-hero__slider-item">
                        <img src="<?php echo esc_url( $slider_image['url'] ); ?>" alt="<?php echo esc_attr( $slider_image['alt'] ); ?>" />
                    </div>
                <?php endif;
            endwhile; ?>
        </div>
    <?php endif;
} elseif ( $media_type === 'Video' ) {
    $video = get_field( 'block-hero__media-video' );
    if ( $video ) : ?>
        <div <?php echo esc_attr( $anchor ); ?> class="<?php echo esc_attr( $class_name ); ?>">
            <figure class="block-hero__media">
                <video class="block-hero__video" loop autoplay muted playsinline>
                    <source src="<?php echo esc_url( $video['url'] ); ?>" type="video/mp4">
                    Ihr Browser unterstützt das Video-Tag nicht.
                </video>
            </figure>
        </div>
    <?php endif;
} else {
    // Default case if media type is not set or invalid
    echo '<p>No media found for this block.</p>';
}
?>
