<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-cta';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
$image = get_field( 'block_cta__image' );
$size = 'full';
$img = wp_get_attachment_image_src( $image, $size );
$headline = get_field( 'block_cta__headline' );
$intro = get_field( 'block_cta__intro' );
$link = get_field( 'block_cta__link' );


{?>
<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="background:  url('<?php echo $img[0] ?>') no-repeat;  background-size: cover;">
    <?php if(!empty($headline )): ?>
        <h2 class="block_cta__headline"><?php echo $headline ?></h2>
    <?php endif; ?>
    <?php if(!empty($intro )): ?>
        <p class="block_cta__intro"><?php echo $intro ?></p>
    <?php endif; ?>
    <?php if(!empty($link)): ?>
        <div class="block_cta__link">
            <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
        </div>
    <?php endif; ?>
</div>
<?php }
?>
