<?php
/*
Template Name: Vidéo
*/
get_header(); ?>
<main class="container">
    <h1 class="font-weight-light mt-5 my-lg-3 text-lg-left text-center pl-lg-5"><?php the_title(); ?></h1>

    <?php get_template_part('slider', 'videos'); ?>

    <section class="row justify-content-lg-center mt-lg-5">
        <ul class="list-group col-lg-12 d-flex flex-wrap flex-row pr-0">

<?php

    $paged = (get_query_var('paged')) ? absint( get_query_var( 'paged' )): 1;

    $video_query_args = array(
        'post_type' => 'post',
        'category_name' => 'vidéo',
        'posts_per_page' => 3,
        'paged' => $paged );

    $video_query = new WP_Query( $video_query_args );
    if ($video_query->have_posts()):
    while( $video_query->have_posts()): $video_query->the_post(); ?>

                <li class="list-group-item border-0 col-12 col-lg-4 mb-5">
                    <a class="d-block text-dark align-items-lg-center justify-content-lg-center" href="<?=get_permalink($post); ?>">
                        <div class="card border-0 h-100 w-100">

                        <?php
                            if ($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium')) :
                                $thumbnail_src = $thumbnail_html['0']; ?>

                            <img class="img-fluid d-block w-100 card-img-top animated" src="<?=$thumbnail_src; ?>" alt="..." />

                        <?php else: ?>

                            <img class="img-fluid d-block w-100 card-img-top animated" src="<?= get_template_directory_uri();?>/assets/img/img-content/Actualites/Image/Placeholder.png" alt="img_default">

                        <?php endif; ?>

                            <div class="card-body h-100">

                            <?php
                                the_title('<h3 class="text-dark">', '</h3>');
                                echo custom_field_excerpt(); ?>

                            </div>
                        </div>
                    </a>
                </li>

    <?php endwhile;
    wp_reset_postdata(); ?>

        </ul>
    <?php else: ?>

        <div class="row">
            <div class="col-lg-12">
                <p>y a pas de résultat</p>
            </div>
        </div>

    <?php endif; ?>

    <?php
        global $wp_query;
        $big = 999999999;
        $total_pages = $video_query->max_num_pages;

        if ( $total_pages > 1 ):

        $links = paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ))),
            'format' => '/page/%#%',
            'total' => $total_pages,
            'prev_next' => False ) ); ?>

        <nav class="pagination mt-5 mt-md-0 mb-md-2 mx-auto"><?=$links; ?></nav>

    <?php endif; ?>

    </section>
</main>

<?php get_footer(); ?>
