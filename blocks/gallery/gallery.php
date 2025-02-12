<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-gallery';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$images = get_field( 'block_gallery__gallery' );
$style = get_field( 'block_gallery__style' );

if( $images ): ?>
    <div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?> <?php echo esc_attr($style); ?>">
        <div class="block_gallery__gallery">
            <?php foreach( $images as $index => $image ): ?>
                <a href="<?php echo $image['url']; ?>" target="_blank" class="thumbnail" data-index="<?php echo $index; ?>">
                    <img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php the_title(); ?>" />
                </a>
            <?php endforeach; ?>
        </div>
        <div class="slider-dots">
            <?php foreach( $images as $index => $image ): ?>
                <span class="dot" data-slide="<?php echo $index; ?>"></span>
            <?php endforeach; ?>
        </div>
        <!-- Lightbox structure -->
        <div id="block_gallery__gallery-lightbox">
            <span id="block_gallery__gallery-lightbox-close">&times;</span>
            <span id="block_gallery__gallery-lightbox-prev">&lt;</span>
            <span id="block_gallery__gallery-lightbox-next">&gt;</span>
            <img id="block_gallery__gallery-lightbox-image" src="" alt="">
        </div>
    </div>
<?php endif; ?>
