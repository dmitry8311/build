<?php
$type   = get_field( 'content_type_library_item__type', get_the_ID() );
$source = match ( $type ) {
	'file' => get_field( 'content_type_library_item__file', get_the_ID() ),
	'link' => get_field( 'content_type_library_item__link', get_the_ID() ),
	'video' => get_field( 'content_type_library_item__oembed', get_the_ID() ),
	default => null,
};
?>

<?php //if ( ! empty( $source ) ): ?>
<?php

$topline = get_field( 'content_type_library_item__topline', get_the_ID() );

$label  = match ( $type ) {
	'file' => $source['title'] ?? 'Download',
	'link' => $source['title'] ?? 'Externer Link',
	'video' => 'Play Video',
	default => '',
};
$url    = match ( $type ) {
	'file', 'link' => $source['url'] ?? '',
	'video' => esc_url( get_permalink() ),
	default => '',
};
$target = match ( $type ) {
	'file', 'link' => '_blank',
	default => '_self',
};

?>
<article
        id="post-<?php the_ID(); ?>" <?php post_class( 'type-library--teaser type-library--' . $type . ' library' ); ?>>
    <header class="entry-header">
		<?php aarsleff_post_thumbnail(); ?>
    </header>

    <div class="entry-content">
		<?php if ( ! empty( $topline ) ): ?>
            <p class="content_type_post__topline"><?php echo $topline ?></p>
		<?php endif; ?>

		<?php
		the_title( '<h3 class="entry-title"><a href="' . $url . '"  target="' . $target . '">', '</a></h3>' );
		?>

        <div class="entity-excerpt">
			<?php the_excerpt(); ?>
        </div>

        <ul class="content_type_library__terms">
			<?php $terms = wp_get_object_terms( get_the_ID(), 'library_tag' ); ?>
			<?php foreach ( $terms as $term ): ?>
				<?php $termlinks = get_term_link( $term ); ?>
                <li class="content_type_library__terms-item">
					<?php echo $term->name; ?>
                </li>
			<?php endforeach; ?>
        </ul>
    </div>
    <footer class="entry-footer">
        <a class="post__link" href="<?php echo $url; ?>" target="<?php echo $target ?>">
			<?php echo $label; ?>
        </a>
    </footer>

</article>
<?php //endif; ?>
