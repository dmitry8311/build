<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-locations';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

$headline = get_field( 'block_locations__headline' );
$intro    = get_field( 'block_locations__intro' );
$location = get_field( 'block_locations__location' );
$map      = get_field( 'block_locations__map' );


?>
<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
    <div class="block_locations__locations">
        <div class="block_locations__locations-text">
			<?php if ( ! empty( $headline ) ): ?>
                <h2 class="block_locations__headline"><?php echo $headline ?></h2>
			<?php endif; ?>

			<?php if ( ! empty( $intro ) ): ?>
                <p class="block_locations__intro"><?php echo $intro ?></p>
			<?php endif; ?>
			<?php require __DIR__ . '/locations-cards.php' ?>
        </div>

        <div class="block_locations__data">

            <div class="block_locations__location_card-before-map">
				<?php require __DIR__ . '/locations-cards.php' ?>
            </div>

			<?php if ( ! empty( $map ) ): ?>
                <div class="block_locations__locations_map">
					<?php echo file_get_contents( $map['url'], false, stream_context_create( [
						"ssl" => [
							"verify_peer"      => false,
							"verify_peer_name" => false,
						],
					] ) ); ?>
                </div>
			<?php endif; ?>

            <div class="block_locations__location_card-after-map">
				<?php require __DIR__ . '/locations-cards.php' ?>
            </div>
        </div>
    </div>
</div>
