<?php
/**
 * Should be in sync with aarsleff_filter_library()
 */

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-library-loop';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
?>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>">
    <!--    <h2 class="block-library-loop__headline">Unsere offenen Stellen</h2>-->
    <div id="block-library-loop__filter">
		<?php if ( ! empty( $categoryOptions = get_terms( 'library__category' ) ) ): ?>
            <div class="block-library-loop__filter-categories">
                <div class="block-library-loop__filter-categories-wrapper">
					<?php foreach ( $categoryOptions as $categoryOption ) : ?>

                        <label>
                            <input type="checkbox" name="category-filter[]"
                                   value="<?php echo esc_attr( $categoryOption->term_id ); ?>"/>
                            <span class="block-library-loop__category-name"><?php echo esc_html( $categoryOption->name ); ?></span>
                            <span class="block-library-loop__category-description"><?php echo esc_html( $categoryOption->description ); ?></span>
                            <span class="block-library-loop__category-item-total">
                            <span class="block-library-loop__category-count"><?php echo $categoryOption->count; ?> verfügbar</span>
                            <span class="block-library-loop__category-checkbox"></span>
                        </span>
                        </label>
					<?php endforeach; ?>
                </div>
            </div>
		<?php endif; ?>
	    <?php if ( ! empty( $filterOptions = get_terms( 'library__filter' ) ) ): ?>
            <div class="block-library-loop__filter-filters">
                <h5>Filter</h5>
                <div class="block-library-loop__filter-filters-wrapper">
				    <?php foreach ( $filterOptions as $filterOption ) : ?>
                        <label>
                            <input type="checkbox" name="filter-filter[]"
                                   value="<?php echo esc_attr( $filterOption->term_id ); ?>"/>
                            <span><?php echo esc_html( $filterOption->name ); ?></span>
                        </label>
				    <?php endforeach; ?>
                </div>
            </div>
	    <?php endif; ?>
        <div class="block-library-loop__filter-types">
            <h5>Medium</h5>
            <div class="block-library-loop__filter-types-wrapper">
                <label class="block-library-loop__filter-types--file">
                    <input type="checkbox" name="type-filter[]" value="file"/><span>Dokument</span>
                </label>
                <label class="block-library-loop__filter-types--video">
                    <input type="checkbox" name="type-filter[]" value="video"/><span>Video</span>
                </label>
                <label class="block-library-loop__filter-types--link">
                    <input type="checkbox" name="type-filter[]" value="link"/><span>Link</span>
                </label>
            </div>
        </div>
    </div>

    <div id="block-library-loop__slider-content" class="block-library-loop__slider"
         data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": false, "dots": true, "autoplay": false, "fade": false, "mobileFirst": true, "infinite": false}'
    >
		<?php

		$queryArgs = [
			'post_type'      => 'library-item',
			'post_status'    => 'publish',
			'posts_per_page' => - 1,
			'orderby'        => 'date',
			'order'          => 'DESC'
		];
		$posts     = new WP_Query( $queryArgs );
		$limitPerSlide       = (int)(get_field( 'block_library-loop__limit-per-slide') ?? 9);
		$limitPerSlide = $limitPerSlide <= 0 ? 9 : $limitPerSlide;
		$maxSlides = ceil( $posts->post_count / $limitPerSlide );
		?>
		<?php if ( $posts->have_posts() ): ?>
			<?php
			$index        = 1;
			$currentSlide = 1;
			?>

            <div class="block-library-loop__slide">
			<?php while ( $posts->have_posts() ): ?>
				<?php $posts->the_post(); ?>
				<?php get_template_part( 'template-parts/content', get_post_type() . '--teaser' ); ?>

				<?php if ( $index % 9 === 0 && $currentSlide < $maxSlides ): ?>
					<?php $currentSlide ++; ?>
                    </div>
                    <div class="block-library-loop__slide">
				<?php endif; ?>

				<?php $index ++ ?>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
            </div>
		<?php endif; ?>
    </div>
</div>
