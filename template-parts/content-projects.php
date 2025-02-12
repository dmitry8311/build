<?php
$topline = get_field( 'content_type_post__topline' );
$project = get_field_object( 'content_type_project__project_data' );
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
                        <div class="post__info-category">
                            <?php if ( ! empty( $topline ) ): ?>
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

        <ul class="content_type_projects__terms">
            <?php $terms = get_terms( 'project_tag' ); ?>
            <?php foreach ( $terms as $term ): ?>
                <?php $termlinks = get_term_link( $term ); ?>
                <li class="content_type_projects__terms-item">
                    <?php echo $term->name; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php aarsleff_post_thumbnail(); ?>

        <div class="entry-content">
            <div class="entry-content-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <div class="content_type_project">

                <div class="content_type_project-data">
                    <?php if ( ! empty( $project ) ): ?>
                        <h5 class="content_type_project-title"><?php echo $project['label']; ?></h5>
                    <?php endif; ?>

                    <div class="content_type_project__project_data-content">
                        <div class="content_type_project__project_column-left">

                            <!-- Performance Section -->
                            <div class="content_type_project__project_data_performance">
                                <h5 class="content_type_project-title">Leistung</h5>
                                <?php
                                if( have_rows('content_type_project__project_data') ):
                                    while ( have_rows('content_type_project__project_data') ) : the_row();

                                        if( have_rows('content_type_project__project_data_performances') ):
                                            while ( have_rows('content_type_project__project_data_performances') ) : the_row();
                                                $data = get_sub_field_object( 'content_type_project__project_data_performance' );
                                                ?>
                                                <?php if ( ! empty( $data ) ): ?>
                                                    <ul class="content_type_project__project_data_performance-list">
                                                        <li class="content_type_project__project_data_performance-item">
                                                            <?php echo $data['value']; ?>
                                                        </li>
                                                    </ul>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>

                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Client Section -->
                            <div class="content_type_project__project_data_client">
                                <?php if( have_rows('content_type_project__project_data') ):
                                    while ( have_rows('content_type_project__project_data') ) : the_row();

                                        $client = get_sub_field_object('content_type_project__project_data_client');
                                        if ( ! empty( $client ) ): ?>
                                            <h5 class="content_type_project-title"><?php echo $client['label']; ?></h5>
                                            <div class="content_type_project__project_value">
                                                <?php echo $client['value']; ?>
                                            </div>
                                        <?php endif;

                                    endwhile;
                                endif; ?>
                            </div>
                        </div>

                        <div class="content_type_project__project_column-right">

                            <!-- Construction Time Section -->
                            <div class="content_type_project__project_data_construction-time">
                                <?php if ( have_rows('content_type_project__project_data') ): ?>
                                    <?php while ( have_rows('content_type_project__project_data') ) : the_row(); ?>
                                        <?php
                                        $time = get_sub_field_object('content_type_project__project_data_construction-time');
                                        if ( ! empty( $time ) ): ?>
                                            <h5 class="content_type_project-title"><?php echo esc_html($time['label']); ?></h5>
                                            <div class="content_type_project__project_value">
                                                <?php echo esc_html($time['value']); ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>

                            <!-- Contract Sum Section -->
                            <div class="content_type_project__project_data_contract-sum">
                                <?php if( have_rows('content_type_project__project_data') ):
                                    while ( have_rows('content_type_project__project_data') ) : the_row();

                                        $sum = get_sub_field_object('content_type_project__project_data_contract-sum');
                                        if ( ! empty( $sum ) ): ?>
                                            <h5 class="content_type_project-title"><?php echo $sum['label']; ?></h5>
                                            <div class="content_type_project__project_value">
                                                <?php echo $sum['value']; ?>
                                            </div>
                                        <?php endif;

                                    endwhile;
                                endif; ?>
                            </div>
                        </div>

                        <!-- Attachment Section -->
                        <div class="content_type_project__project_data_attachment">
                            <?php if( have_rows('content_type_project__project_data') ):
                                while ( have_rows('content_type_project__project_data') ) : the_row();

                                    $link = get_sub_field('content_type_project__project_data_attachment');
                                    if ( ! empty( $link ) ): ?>
                                        <a href="<?php echo esc_url( $link ); ?>" target="_blank">Als PDF herunterladen</a>
                                    <?php endif;

                                endwhile;
                            endif; ?>
                        </div>
                    </div>


                </div>
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
