<?php
/*
Template Name: Event
*/
get_header(); ?>

<main class="container">
    <h1 class="font-weight-light col-12 pl-lg-5 mt-5 mt-lg-3 text-lg-left text-center">Evenements</h1>

        <?php get_template_part('map', 'event'); ?>

    <section class="row justify-content-center mt-lg-5">
        <ul class="list-unstyled col-lg-12 d-flex justify-content-md-between flex-md-wrap flex-column flex-md-row mt-3 mt-md-0 px-0 h-100">
<?php
    $paged = (get_query_var('paged')) ? absint( get_query_var('paged') ) : 1;

    $event_query_args = array(
        'post_type' => 'post',
        'category_name' => 'événement',
        'posts_per_page' => 3,
        'paged' => $paged );
    $event_query = new WP_Query( $event_query_args );

    if( $event_query->have_posts()):
    while( $event_query->have_posts()): $event_query->the_post(); ?>

            <li class="col-12 col-md-6 col-lg-4 h-100 mb-5">
                <a class="text-dark d-flex align-items-center justify-content-center" href="<?=get_permalink($post); ?>">
                    <div class="card border-0 h-100 w-100">

                    <?php
                        if( $thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' )) :
                            $image_alt = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
                            $thumbnail_src = $thumbnail_html['0']; ?>
                            
                        <img class="img-fluid d-block w-100 card-img-top" src="<?=$thumbnail_src; ?>" alt="<?=$image_alt;?>" />

                    <?php else: ?>

                        <img class="img-fluid d-block w-100 card-img-top" src="<?=get_template_directory_uri(); ?>/assets/img/img-content/Actualites/Placeholder.png" alt="img_default">

                    <?php endif; ?>

                        <div class="card-body h-100">

                            <?php
                            the_title('<h3 class="text-dark">','</h3>');
                            echo custom_field_excerpt();
                            ?>

                        </div>
                    </div>
                </a>
            </li>
    <?php
    endwhile;
    wp_reset_postdata(); ?>

    </ul>

    <?php else: ?>
        <div class="row">
            <div class="col-lg-12">
                <p>Il n'y a pas résultat</p>
            </div>
        </div>
    <?php
        endif;

        global $wp_query;
        $big = 9999999999;
        $total_pages = $event_query->max_num_pages;

        if( $total_pages > 1): ?>

    <nav class="pagination mb-md-2 mt-md-0 mx-auto">

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
