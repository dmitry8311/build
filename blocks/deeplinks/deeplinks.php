<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-deeplinks';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$headline = get_field( 'block_deeplinks__headline' );

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

    <?php if(!empty($headline)): ?>
        <h5 class="block_deeplinks__headline"><?php echo $headline ?></h5>
    <?php endif; ?>

    <ul class="block_deeplinks__items-list">
        <?php if( have_rows('block_deeplinks__items') ) : while ( have_rows('block_deeplinks__items') ) : the_row(); ?>
            <?php
            $linkUrls = get_sub_field('block_deeplinks__links');
            ?>
            <li class="block_deeplinks__links<?php if( get_sub_field('block_deeplinks__links-indented') ): ?> <?php echo 'indented'; ?><?php endif; ?>">
                <?php if(!empty($linkUrls)): ?>
                    <a class="block_deeplinks__links-link" href="<?php echo $linkUrls['url']; ?>"><?php echo $linkUrls['title']; ?></a>
                <?php endif; ?>
            </li>
        <?php endwhile; endif; ?>
    </ul>
</div>