<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-facts-and-figures';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
?>
<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">

    <div class="block_facts_and_figures__elements">
		<?php
		if ( have_rows( 'block_facts_and_figures__elements' ) ) :
			while ( have_rows( 'block_facts_and_figures__elements' ) ) :
				the_row();
				?>
				<?php
				$number      = get_sub_field( 'block_facts_and_figures__element-number' );
				$suffix      = get_sub_field( 'block_facts_and_figures__element-suffix' );
				$description = get_sub_field( 'block_facts_and_figures__element-description' );
				?>
                <div class="block_facts_and_figures__element">
	                <?php if ( ! empty( $number ) ||  ! empty( $suffix ) ): ?>
                    <div class="block_facts_and_figures__element-info">
                        <div class="block_facts_and_figures__element-group">
							<?php if ( ! empty( $number ) ): ?>
                                <div class="block_facts_and_figures__element-number"><?php echo $number ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $suffix ) ): ?>
                                <div class="block_facts_and_figures__element-suffix"><?php echo $suffix ?></div>
							<?php endif; ?>
                        </div>
                    </div>
	                <?php endif; ?>
					<?php if ( ! empty( $description ) ): ?>
                        <div class="block_facts_and_figures__element-description"><?php echo $description ?></div>
					<?php endif; ?>
                </div>
			<?php
			endwhile;
		endif;
		?>
    </div>
</div>
