<?php
$locations    = wp_get_post_terms( get_the_ID(), 'job_location' );
$beginning    = get_field( 'content_type_job__beginning', get_the_ID() );
$externalLink = get_field( 'content_type_job__link', get_the_ID() );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('block-job-loop__post'); ?>>
    <header class="post__header">
        <h4 class="post__headline"><?php the_title(); ?></h4>
    </header>
    <div class="post__content">
        <p class="content_type_job__location"><?php echo implode( ', ', array_map( static fn( $location ) => $location->name, $locations ) ); ?></p>
        <?php if ( ! empty( $beginning ) ): ?>
            <p class="content_type_job__beginning"><?php echo $beginning ?></p>
		<?php endif; ?>

    </div>
	<?php if ( ! empty( $externalLink ) ): ?>
        <footer class="post__footer">
            <a href="<?= $externalLink['url'] ?>" class="post__link" target="_blank">
				<?php echo $externalLink['title']; ?>
            </a>
        </footer>
	<?php endif; ?>
</article>
