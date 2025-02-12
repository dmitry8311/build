<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-timeline';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

$headline = get_field( 'block_timeline__headline' );

?>
<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="block-timeline__container">
		<?php if ( ! empty( $headline ) ): ?>
            <h2 class="block_timeline__headline"><?php echo $headline ?></h2>
		<?php endif; ?>
        <div class="block-timeline__scroll">
            <ul class="block_timeline__items">
				<?php if ( have_rows( 'block_timeline__item' ) ) : while ( have_rows( 'block_timeline__item' ) ) :
					the_row(); ?>
					<?php
					$itemimage    = get_sub_field( 'block_timeline__item_image' );
					$itemheadline = get_sub_field( 'block_timeline__item_headline' );
					$itemtext     = get_sub_field( 'block_timeline__item_text' );
					?>
                    <li class="block_timeline__item">
                        <div class="block_timeline__item_card">
							<?php if ( ! empty( $itemimage ) ): ?>
                                <div class="block_timeline__item_image">
                                    <img src="<?php echo $itemimage['url']; ?>" alt="<?php echo $itemimage['alt']; ?>"/>
                                </div>
							<?php endif; ?>

                            <div class="block_timeline__item_info">
								<?php if ( ! empty( $itemheadline ) ): ?>
                                    <h2 class="block_timeline__item_headline"><?php echo $itemheadline ?></h2>
								<?php endif; ?>
								<?php if ( ! empty( $itemtext ) ): ?>
                                    <p class="block_timeline__item_text"><?php echo $itemtext ?></p>
								<?php endif; ?>
                            </div>
                        </div>
                    </li>
				<?php endwhile;
				endif; ?>
            </ul>
        </div>
    </div>
</div>
