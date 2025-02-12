<?php
$topline = get_field( 'content_type_post__topline' );


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post__overview">
        <div class="post__overview-button">
            Übersicht
        </div>
    </div>
    <div class="post__content">
	<header class="entry-header">
        <?php

        if ( 'post' === get_post_type() ) :
            ?>

            <div class="entry-meta">
                <div class="post__info">
                    <div class="post__info-text">
                        <?php if( !empty($topline) ): ?>
                            <p class="content_type_post__topline"><?php echo $topline ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="post__info-date">
                        <?php the_time('d.m.Y') ?>
                    </div>
                </div>
            </div><!-- .entry-meta -->
        <?php endif;
        if ( is_singular() ) :
			the_title( '<h2 class="entry-title">', '</h2>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

	?>
	</header><!-- .entry-header -->

	<div class="entry-content">
        <div class="entry-content-excerpt">
            <?php the_excerpt(); ?>
        </div>
        <?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'aarsleff' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aarsleff' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
