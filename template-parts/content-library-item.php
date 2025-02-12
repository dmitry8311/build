<?php
$topline = get_field( 'content_type_library_item__topline', get_the_ID() );
$oembed = get_field( 'content_type_library_item__oembed', get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
            <div class="embed-container">
			    <?php echo $oembed; ?>
            </div>
        </div>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->

<style>
    .embed-container {
        position: relative;
        padding-bottom: 56.25%;
        overflow: hidden;
        max-width: 100%;
        height: auto;
    }

    .embed-container iframe,
    .embed-container object,
    .embed-container embed {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
