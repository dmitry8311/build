<?php

// Set up block anchor and class name
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-related-articles';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}

// Get the topline from ACF field
$topline = get_field( 'block_related-articles__topline' );

// Get the ACF field values for excerpt and layout options
$excerpt_option = get_field( 'block_related-articles__excerpt' ); // Without excerpt, with excerpt
$layout_option = get_field( 'block_related-articles__layout' ); // 3 column layout, 4 column layout

// Add a class based on the selected layout
$layout_class = '';
if ( $layout_option == '3 column layout' ) {
    $layout_class = 'block-related-articles--three-columns';
} elseif ( $layout_option == '4 column layout' ) {
    $layout_class = 'block-related-articles--four-columns';
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

<div <?php echo $anchor; ?>class="<?php echo esc_attr( $class_name . ' ' . $layout_class ); ?> <?php echo esc_attr( $margins_classes ); ?>">
    <!-- Display topline if it exists -->
    <?php if( !empty($topline) ): ?>
        <p class="block_related-articles__topline"><?php echo esc_html( $topline ); ?></p>
    <?php endif; ?>

    <div class="block_related-articles__items">
        <?php if( have_rows('block_related-articles__item') ) : ?>
            <!-- Loop through the repeater field to access each row -->
            <?php while ( have_rows('block_related-articles__item') ) : the_row(); ?>

                <div class="block_related-articles__item">
                    <?php
                    // Get the selected post (Post Object field)
                    $related_post = get_sub_field('block_related-articles__item-article');
                    if( $related_post ): // Ensure a post is selected ?>

                        <!-- Display the featured image -->
                        <div class="block_related-articles-related-article__thumbnail">
                            <a href="<?php echo get_permalink($related_post->ID); ?>">
                                <?php echo get_the_post_thumbnail( $related_post->ID, 'medium' ); ?>
                            </a>
                        </div>

                        <!-- Display the title -->
                        <h4 class="block_related-articles-related-article__title">
                            <a href="<?php echo get_permalink($related_post->ID); ?>">
                                <?php echo get_the_title($related_post->ID); ?>
                            </a>
                        </h4>

                        <!-- Conditionally display the excerpt based on the ACF option -->
                        <?php if( $excerpt_option == 'With excerpt' ): ?>
                            <p class="block_related-articles-related-article__excerpt">
                                <?php echo get_the_excerpt($related_post->ID); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Display the "Mehr erfahren" (Read more) link -->
                        <a class="block_related-articles-related-article__link" href="<?php echo get_permalink($related_post->ID); ?>">Mehr erfahren</a>

                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
