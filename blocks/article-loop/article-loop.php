<?php

$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
	$anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$class_name = 'block-article-loop';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
$headline      = get_field( 'block_article-loop__headline' );
$limit         = (int) get_field( 'block_article-loop__limit' );
$limitPerSlide = (int) get_field( 'block_article-loop__items-per-slide' );
$slidesToShow  = (int) get_field( 'block_article-loop__slides-to-show' );
$link          = get_field( 'block_article-loop__link' );

$queryArgs = [
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => $limit,
];
$posts     = new WP_Query( $queryArgs );

$styles = [
	"primary",
	"grey",
	"light-blue",
];

$numStyles = 3;
$columns   = 3;
$maxSlides = $limitPerSlide ? ceil( $posts->post_count / $limitPerSlide ) : 0;

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
    <?php if ( ! empty( $headline ) ): ?>
        <h3 class="block-article-loop__headline">
            <?php echo $headline ?>
        </h3>
    <?php endif; ?>

    <?php if ($slidesToShow && $limitPerSlide ): ?>
        <div class="block-article-loop__slider"
             data-slick='{"slidesToShow": <?php echo $slidesToShow; ?>, "slidesToScroll": <?php echo $slidesToShow; ?>, "arrows": false, "dots": true, "autoplay": false, "fade": false, "mobileFirst": true, "infinite": false }'>
            <?php if ( $posts->have_posts()): ?>
                <?php
                $index        = 1;
                $currentSlide = 1;
                ?>
                <div class="block-article-loop__slide">
                <?php while ( $posts->have_posts() ): ?>

                    <?php
                    $posts->the_post();
                    $topline    = get_field( 'content_type_post__topline', get_the_ID() );
                    $rowIndex   = intdiv( $index - 1, $columns ); // Determine the current row
                    $styleIndex = ( $index - 1 + $rowIndex ) % $numStyles; // Rotate styles by row
                    ?>

                    <article
                            id="post-<?php the_ID(); ?>" <?php post_class( 'block-article-loop__post block-article-loop__post--' . $styles[ $styleIndex ] ); ?>>
                        <header class="post__header">
                            <div class="post__meta">
                                <?php if ( ! empty( $topline ) ): ?>
                                    <div class="post__topline">
                                        <?php echo $topline ?>
                                    </div>
                                <?php endif; ?>
                                <div class="post__date">
                                    <?php the_time( 'd.m.Y' ) ?>
                                </div>
                            </div><!-- .entry-meta -->
                            <h2 class="post__headline"><?php the_title(); ?></h2>
                        </header>
                        <div class="post__content">
                            <?php the_excerpt(); ?>
                        </div>
                        <footer class="post__footer">
                            <a class="post__link" href="<?= the_permalink(); ?>">Mehr erfahren</a>
                        </footer>
                    </article>

                    <?php if ($index % $limitPerSlide === 0 && $currentSlide < $maxSlides ): ?>
                        <?php $currentSlide ++; ?>
                        </div>
                        <div class="block-article-loop__slide">
                    <?php endif; ?>
                    <?php $index ++ ?>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!--    @TODO-->
	<?php if ( ! empty( $link ) ): ?>
        <div class="block-article-loop__read-more">
            <a href="<?= $link['url'] ?>" class="read-more__link"><?= $link['title'] ?></a>
        </div>
	<?php endif; ?>
</div>
