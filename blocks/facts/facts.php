<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-facts';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$headline = get_field( 'block_facts__headline' );
$intro = get_field( 'block_facts__intro' );
$items = get_field( 'block_facts__items' );
$itemIcon = get_field( 'block_facts__item-icon' );
$itemHeadline= get_field( 'block_facts__item-headline' );
$itemText= get_field( 'block_facts__item-text' );

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
    <?php if( !empty($headline) ): ?>
        <h2 class="block_facts__headline"><?php echo $headline ?></h2>
    <?php endif; ?>

    <?php if( !empty($intro) ): ?>
        <p class="block_facts__intro"><?php echo $intro ?></p>
    <?php endif; ?>

    <div class="block_facts__items">
        <?php if( have_rows('block_facts__items') ) : while ( have_rows('block_facts__items') ) : the_row(); ?>
        <?php
        $itemIcon = get_sub_field('block_facts__item-icon');
        $itemHeadline= get_sub_field( 'block_facts__item-headline' );
        $itemText= get_sub_field( 'block_facts__item-text' );
        ?>
        <div class="block_facts__item">
            <?php if( !empty($itemIcon) ): ?>
                <div class="block_facts__item-icon">
                    <img src="<?php echo $itemIcon['url']; ?>" alt="<?php echo $itemIcon['alt']; ?>" />
                </div>
            <?php endif; ?>
            <?php if( !empty($itemHeadline) ): ?>
                <h4 class="block_facts__item-headline"><?php echo $itemHeadline ?></h4>
            <?php endif; ?>
            <?php if( !empty($itemText) ): ?>
                <div class="block_facts__item-text"><?php echo $itemText ?></div>
            <?php endif; ?>
        </div>
<?php endwhile; endif; ?>
    </div>
</div>
