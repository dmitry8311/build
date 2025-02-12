<?php if ( have_rows( 'block_locations__locations' ) ) : ?>
    <div class="block_locations__location_card">
		<?php while ( have_rows( 'block_locations__locations' ) ) : the_row(); ?>
			<?php
			$Locationimage    = get_sub_field( 'block_locations__location_image' );
			$Locationheadline = get_sub_field( 'block_locations__location_headline' );
			$Locationtitle    = get_sub_field( 'block_locations__location_title' );
			$Locationname     = get_sub_field( 'block_locations__location_name' );
			$Locationemail    = get_sub_field( 'block_locations__location_email' );
			$LocationID       = get_sub_field( 'block_locations__location_id' );
			?>
            <div class="block_locations__location"
				<?php if ( ! empty( $LocationID ) ): ?> data-id="<?php echo $LocationID ?>"<?php endif; ?>>

				<?php if ( ! empty( $Locationimage ) ): ?>
                <div class="block_locations__location_data">
                    <div class="block_locations__location_image">
                        <img src="<?php echo $Locationimage['url']; ?>" alt="<?php echo $Locationimage['alt']; ?>"/>
                    </div>
					<?php endif; ?>
                    <div class="block_locations__location_info">
						<?php if ( ! empty( $Locationheadline ) ): ?>
                            <h4 class="block_locations__location_headline"><?php echo $Locationheadline ?></h4>
						<?php endif; ?>

						<?php if ( ! empty( $Locationtitle ) ): ?>
                            <p class="block_locations__location_title"><?php echo $Locationtitle ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $Locationname ) ): ?>
                            <p class="block_locations__location_name"><?php echo $Locationname ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $Locationemail ) ): ?>
                            <a class="block_locations__location_email"
                               href="mailto:<?php the_field( $Locationemail ); ?>"><?php echo $Locationemail ?></a>
						<?php endif; ?>
                    </div>
                </div>
            </div>
		<?php endwhile; ?>
    </div>
<?php endif; ?>
