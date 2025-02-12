<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-single-column-text';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$text = get_field( 'block_single-column_text__text' );

$margins_classes = '';
$margins = get_field( 'block_shared__margins' );
if ( ! empty( $margins ) && is_array( $margins ) ) {
    if ( in_array( 'top', $margins ) ) {
        $margins_classes .= 'margin-top';
    }
    if ( in_array( 'bottom', $margins ) ) {
        $margins_classes .= ' margin-bottom';
    }
}
$margins_classes = trim( $margins_classes );

?>
 <div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?> <?php echo esc_attr( $margins_classes ); ?>">
     <?php if(!empty($text)): ?>
         <div class="block_single-column_text__text"><?php echo $text?></div>
     <?php endif; ?>
 </div>