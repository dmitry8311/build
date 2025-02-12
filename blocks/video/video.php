<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-video';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$video            = get_field( 'block-video__video' );

?>
<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="block-video__video"><?php echo $video;?></div>
</div>
