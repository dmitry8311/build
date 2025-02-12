<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-two-column-text-manual';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . esc_attr( $block['className'] );
}

// Fetch ACF fields
$topline = get_field( 'block_two-column_text_manual__top-line' );
$headline = get_field( 'block_two-column_text_manual__headline' );
$columns = get_field( 'block_two-column_text_manual__columns' ); // Group field
$headlineCentered = get_field('block_two-column_text_manual__headline_centered');

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


<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?> <?php echo esc_attr( $margins_classes ); ?>">
    <?php if ( ! empty( $topline ) ) : ?>
        <h3 class="block_two-column_text-manual__top-line"><?php echo esc_html( $topline ); ?></h3>
    <?php endif; ?>

    <?php if ( ! empty( $headline ) ) : ?>
        <h2 class="block_two-column_text-manual__headline<?php echo ($headlineCentered) ? ' headline_centered' : ''; ?>">
            <?php echo esc_html( $headline ); ?>
        </h2>
    <?php endif; ?>

    <?php if ( ! empty( $columns ) && is_array( $columns ) ) : ?>
        <div class="block_two-column_text-manual__columns">
            <?php
            // Left column content
            $columnLeft = $columns['block_two-column_text_manual__column-left'];
            if ( ! empty( $columnLeft ) ) : ?>
                <div class="block_two-column_text-manual__column-left">
                    <?php echo wp_kses_post( $columnLeft ); ?>
                </div>
            <?php endif; ?>

            <?php
            // Right column content
            $columnRight = $columns['block_two-column_text_manual__column-right'];
            if ( ! empty( $columnRight ) ) : ?>
                <div class="block_two-column_text-manual__column-right">
                    <?php echo wp_kses_post( $columnRight ); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
