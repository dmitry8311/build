<article id="post-<?php the_ID(); ?>" <?php post_class( 'type-projects--teaser projects' ); ?>>
    <header class="entry-header">
		<?php aarsleff_post_thumbnail(); ?>
    </header>

    <div class="entry-content">
		<?php
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		?>
    </div>
    <footer class="entry-footer">
        <a class="post__link" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
            Zum Projekt
        </a>
    </footer>

</article>
