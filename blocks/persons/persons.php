<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-persons';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

$topline = get_field( 'block_persons__topline' );
$headline = get_field( 'block_persons__headline' );
$intro= get_field( 'block_persons__intro' );

?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
    <?php if( !empty($topline) ): ?>
    <div class="block_persons__content-wrapper">
        <h5 class="block_persons__topline"><?php echo $topline ?></h5>
    <?php endif; ?>

    <?php if( !empty($headline) ): ?>
        <h2 class="block_persons__headline"><?php echo $headline ?></h2>
    <?php endif; ?>

    <?php if( !empty($intro) ): ?>
        <p class="block_persons__intro"><?php echo $intro ?></p>
    <?php endif; ?>
    </div>

    <div class="block_persons__persons">
            <?php if( have_rows('block_persons__person') ) : while ( have_rows('block_persons__person') ) : the_row(); ?>
                <?php
                $name = get_sub_field('block_persons__person-name');
                $image = get_sub_field('block_persons__person-image');
                $position = get_sub_field( 'block_persons__person-position' );
                $quote = get_sub_field( 'block_persons__person-quote' );
                ?>
                <div class="block_persons__person">
                    <?php if( !empty($image) ): ?>
                        <div class="block_persons__person-image">
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                        </div>
                    <?php endif; ?>
                    <div class="block_persons__person-info">
                        <?php if( !empty($quote) ): ?>
                            <p class="block_persons__person-quote"><?php echo $quote ?></p>
                        <?php endif; ?>

                        <?php if( !empty($name) ): ?>
                            <h5 class="block_persons__person-name"><?php echo $name ?></h5>
                        <?php endif; ?>
                        <?php if( !empty($position) ): ?>
                            <p class="block_persons__person-position"><?php echo $position ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; endif; ?>
    </div>
</div>

