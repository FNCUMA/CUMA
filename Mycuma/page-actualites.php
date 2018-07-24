<?php
/*
Template Name: Actualité
*/
get_header(); ?>
<main class="container">
    <h1 class="font-weight-light col-12 pl-lg-5 mt-5 mt-lg-3 text-md-left text-center">Actualités</h1>

    <?php get_template_part('slider','actualites'); ?>

    <section class="row justify-content-center mt-lg-5">
        <ul class="Actu list-unstyled col-md-12 d-flex justify-content-md-between flex-md-wrap flex-column flex-md-row mt-md-0 px-0 h-100">

        <?php $paged = (get_query_var('paged')) ? absint( get_query_var( 'paged' )): 1;
            $category_query_args = array(
                'post_type' => 'post',
                'category_name' => 'actualité',
                'posts_per_page' => 3,
                'paged' => $paged );

            $category_query = new WP_Query( $category_query_args ); ?>

        <?php
            if ($category_query->have_posts()):
                while( $category_query->have_posts()):
                    $category_query->the_post(); ?>

            <li class="col-12 col-md-6 col-lg-4 mb-5">
                <a class="text-dark d-flex align-items-center justify-content-center" href="<?=get_permalink($post);?>">
                    <div class="card border-0 h-100 w-100">

                <?php if ($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium')) :
                $image_alt = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
                $thumbnail_src = $thumbnail_html[0]; ?>

                        <img class="img-fluid d-block w-100 card-img-top px-0" src="<?=$thumbnail_src; ?>" alt="<?=$image_alt; ?>" />

                <?php else: ?>

                        <img class="img-fluid d-block w-100 card-img-top" src="<?= get_template_directory_uri(); ?>/assets/img/img-content/Actualites/Image/Placeholder.png" alt="img_default" >

                <?php endif; ?>

                        <div class="text-dark card-body h-100">

                          <?php
                            the_title('<h3>','</h3>');
                            echo custom_field_excerpt(); ?>

                        </div>
                    </div>
                </a>
            </li>

    <?php
        endwhile;
        wp_reset_postdata(); ?>

        </ul>

    <?php else: ?>

        <h2 class="text-center">Il n'y a pas de résultat</h2>

    <?php endif; ?>


        <?php
            global $wp_query;
            $big = 9999999999;
            $total_pages = $category_query->max_num_pages;

            if( $total_pages > 1): ?>

        <nav class="pagination mt-md-0 mb-md-2 mx-auto">

        <?php
            $links = paginate_links( array(
                'base' => str_replace($big, '%#%', esc_url( get_pagenum_link( $big ))),
                'format' => '/page/%#%',
                'total' => $total_pages,
                'prev_next' => False ) );

            echo $links; ?>

        </nav>

        <?php endif; ?>

      </section>
    </main>

<?php get_footer(); ?>
