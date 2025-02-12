<?php
/**
 * Should be in sync with aarsleff_filter_jobs()
 */

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-job-loop';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
    <h2 class="block-job-loop__headline">Unsere offenen Stellen</h2>
    <div id="block-job-loop__filter">
		<?php if ( ! empty( $locationOptions = get_terms( 'job_location' ) ) ): ?>
            <div class="block-job-loop__filter-locations">
                <h5>Standort</h5>
                <div class="block-job-loop__filter-locations-wrapper">
				<?php foreach ( $locationOptions as $locationOption ) : ?>
                    <label>
                        <input type="checkbox" name="location-filter[]"
                               value="<?php echo esc_attr( $locationOption->term_id ); ?>"/>
						<span><?php echo esc_html( $locationOption->name ); ?></span>
                    </label>
				<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
		<?php if ( ! empty( $departmentOptions = get_terms( 'job_department' ) ) ): ?>
            <div class="block-job-loop__filter-departments">
                <h5>Fachbereich</h5>
                <div class="block-job-loop__filter-departments-wrapper">
                <?php foreach ( $departmentOptions as $departmentOption ) : ?>
                    <label>
                        <input type="checkbox" name="department-filter[]"
                               value="<?php echo esc_attr( $departmentOption->term_id ); ?>"/>
						<span><?php echo esc_html( $departmentOption->name ); ?></span>
                    </label>
				<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
    </div>

    <div id="block-job-loop__slider-content" class="block-job-loop__slider"
         data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": false, "dots": true, "autoplay": false, "fade": false, "mobileFirst": true, "infinite": false}'
    >
		<?php

		$queryArgs = [
			'post_type'      => 'job',
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'meta_key'          => 'content_type_job__priority',
			'orderby'           => 'meta_value',
			'order'             => 'DESC'
		];
		$posts     = new WP_Query( $queryArgs );
		$maxSlides = ceil( $posts->post_count / 9 );
		?>
		<?php if ( $posts->have_posts() ): ?>
		<?php
		$index        = 1;
		$currentSlide = 1;
		?>

        <div class="block-job-loop__slide">
			<?php while ( $posts->have_posts() ): ?>
				<?php $posts->the_post(); ?>

				<?php get_template_part( 'template-parts/content', get_post_type() ); ?>


				<?php if ( $index % 9 === 0 && $currentSlide < $maxSlides ): ?>
					<?php $currentSlide ++; ?>
                    </div>
                    <div class="block-job-loop__slide">
				<?php endif; ?>


				<?php $index ++ ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
            </div>
		<?php endif; ?>
    </div>
</div>
