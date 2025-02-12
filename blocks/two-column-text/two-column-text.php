<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-two-column-text';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$topline = get_field( 'block_two-column_text__top-line' );
$headline = get_field( 'block_two-column_text__headline' );
$text = get_field( 'block_two-column_text__text' );
$links = get_field( 'block_two-column_text__links' );
$link = get_field( 'block_two-column_text__links-link' );
$style = get_field( 'block_two-column_text__style' );
$headlineCentered = get_field('block_two-column_text__headline_centered');

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

<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name ); ?> <?php echo esc_attr( $style ); ?> <?php echo esc_attr( $margins_classes ); ?>">
    <?php if ( ! empty( $topline ) ): ?>
        <h3 class="block_two-column_text__top-line"><?php echo esc_html( $topline ); ?></h3>
    <?php endif; ?>

    <?php if ( ! empty( $headline ) ): ?>
        <h2 class="block_two-column_text__headline<?php echo ( $headlineCentered ) ? ' headline_centered' : ''; ?>">
            <?php echo esc_html( $headline ); ?>
        </h2>
    <?php endif; ?>

    <?php if ( ! empty( $text ) ): ?>
        <div class="block_two-column_text__text"> <?php echo wp_kses_post( $text ); ?></div>
    <?php endif; ?>

    <?php if ( have_rows( 'block_two-column_text__links' ) ): ?>
        <ul class="block_two-column_text__links-list">
            <?php while ( have_rows( 'block_two-column_text__links' ) ): the_row(); ?>
                <?php $linkUrls = get_sub_field( 'block_two-column_text__links-link' ); ?>
                <li class="block_two-column_text__links-list-item">
                    <?php if ( ! empty( $linkUrls ) ): ?>
                        <a class="block_two-column_text__links-link" href="<?php echo esc_url( $linkUrls['url'] ); ?>">
                            <?php echo esc_html( $linkUrls['title'] ); ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
</div>
