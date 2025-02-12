<?php
/**
 * Should be in sync with aarsleff_filter_jobs()
 */

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-project-loop';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}

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
    <!--    <h2 class="block-project-loop__headline">Unsere offenen Stellen</h2>-->
    <div id="block-project-loop__filter">
		<?php if ( ! empty( $categoryOptions = get_terms( 'project_category' ) ) ): ?>
            <div class="block-project-loop__filter-categories">
                <div class="block-project-loop__filter-categories-wrapper">
					<?php foreach ( $categoryOptions as $categoryOption ) : ?>

                        <label>
                            <input type="checkbox" name="category-filter[]"
                                   value="<?php echo esc_attr( $categoryOption->term_id ); ?>"/>
                            <span class="block-project-loop__category-name"><?php echo esc_html( $categoryOption->name ); ?></span>
                            <span class="block-project-loop__category-description"><?php echo esc_html( $categoryOption->description ); ?></span>
                            <span class="block-project-loop__category-item-total">
                            <span class="block-project-loop__category-count"><?php echo $categoryOption->count; ?> verfügbar</span>
                            <span class="block-project-loop__category-checkbox"></span>
                        </span>
                        </label>
					<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( ! empty( $serviceOptions = get_terms( 'project_service' ) ) ): ?>
            <div class="block-project-loop__filter-services">
                <h5>Leistung</h5>
                <div class="block-project-loop__filter-services-wrapper">
					<?php foreach ( $serviceOptions as $serviceOption ) : ?>
                        <label>
                            <input type="checkbox" name="service-filter[]"
                                   value="<?php echo esc_attr( $serviceOption->term_id ); ?>"/>
                            <span><?php echo esc_html( $serviceOption->name ); ?></span>
                        </label>
					<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( ! empty( $technologyOptions = get_terms( 'project_technology' ) ) ): ?>
            <div class="block-project-loop__filter-technologies">
                <h5>Technologie</h5>
                <div class="block-project-loop__filter-technologies-wrapper">
					<?php foreach ( $technologyOptions as $technologyOption ) : ?>
                        <label>
                            <input type="checkbox" name="technology-filter[]"
                                   value="<?php echo esc_attr( $technologyOption->term_id ); ?>"/>
                            <span><?php echo esc_html( $technologyOption->name ); ?></span>
                        </label>
					<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( ! empty( $regionOptions = get_terms( 'project_region' ) ) ): ?>
            <div class="block-project-loop__filter-regions">
                <h5>Region</h5>
                <div class="block-project-loop__filter-regions-wrapper">
					<?php foreach ( $regionOptions as $regionOption ) : ?>
                        <label>
                            <input type="checkbox" name="region-filter[]"
                                   value="<?php echo esc_attr( $regionOption->term_id ); ?>"/>
                            <span><?php echo esc_html( $regionOption->name ); ?></span>
                        </label>
					<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
    </div>

    <div id="block-project-loop__slider-content" class="block-project-loop__slider"
         data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": false, "dots": true, "autoplay": false, "fade": false, "mobileFirst": true, "infinite": false}'
    >
		<?php

		$queryArgs = [
			'post_type'      => 'projects',
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'orderby'        => 'date',
			'order'          => 'DESC'
		];
		$posts     = new WP_Query( $queryArgs );
		$maxSlides = ceil( $posts->post_count / 12 );
		?>
		<?php if ( $posts->have_posts() ): ?>
			<?php
			$index        = 1;
			$currentSlide = 1;
			?>

            <div class="block-project-loop__slide">
			<?php while ( $posts->have_posts() ): ?>
				<?php $posts->the_post(); ?>

				<?php get_template_part( 'template-parts/content', get_post_type() . '--teaser' ); ?>

				<?php if ( $index % 12 === 0 && $currentSlide < $maxSlides ): ?>
					<?php $currentSlide ++; ?>
                    </div>
                    <div class="block-project-loop__slide">
				<?php endif; ?>

				<?php $index ++ ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
            </div>
		<?php endif; ?>
    </div>
</div>
