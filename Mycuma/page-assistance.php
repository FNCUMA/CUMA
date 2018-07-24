<?php
/*
Template Name: Assistance
*/
get_header(); ?>

<main id="Assistance" class="container d-flex flex-column align-items-center justify-content-between my-3 h-100">
    <h1 class="font-weight-light text-center text-lg-left row w-100 mb-5 mb-lg-5 mt-lg-3 pl-lg-5"><?php the_title(); ?></h1>
    <section class="row w-100 mb-lg-5">
        <ul class="list-unstyled p-0 col-12 d-flex flex-wrap flex-row align-items-between pr-0">
            <?php
                $assistance_query = new WP_Query( array(
                    'post_type' => 'mycuma_equipe'
                ) );
                if ($assistance_query->have_posts()):
                    while( $assistance_query->have_posts()):
                        $assistance_query->the_post(); ?>

            <li class="col-6 d-flex flex-column border-0 flex-lg-row flex-lg-wrap flex-nowrap align-items-center justify-content-start p-3 mb-3 mb-md-0">

             <?php if( $thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' )):
                        $image_alt = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
                        $thumbnail_src = $thumbnail_html[0]; ?>

                <img class="img-fluid rounded-circle w-100 col-md-6 col-lg-5" src="<?=$thumbnail_src; ?>" alt="<?=$image_alt;?>" />

            <?php else: ?>

                <img class="img-fluid px-0 d-block w-100 mx-auto mx-lg-0 rounded-circle mb-3 col-md-6 col-lg-5" src="<?=get_template_directory_uri(); ?>/assets/img/img-content/Actualites/Image/Placeholder.png" alt="img_default">

            <?php endif; ?>

                <p class="text-nowrap text-center d-inline p-0 my-3 align-self-lg-center ml-lg-5"><?php the_field('prenom');?><br><?php the_field('nom'); ?></p>
                <p class="text-center p-0 col-lg-10 pl-lg-5 pt-lg-4 pl-0"><?php the_field('fonction'); ?></p>
            </li>

        <?php
        endwhile;
        wp_reset_postdata(); ?>

        </ul>

        <?php else: ?>

        <h2 class="text-center">Il n'y a pas de résultat</h2>

    <?php endif; ?>

    </section>
    <section class="row col-12 col-md-9 mt-4 mt-md-0 px-0 px-md-4 px-lg-0 justify-content-center pt-3 p-lg-5 bg-cuma align-self-md-start text-white">

    <?php if (have_posts()):
        while( have_posts()): the_post(); ?>

                <p class="mx-md-2 py-md-3 col-12 mb-lg-0 text-justify"><?php the_field('description'); ?></p>

    <?php
        endwhile; wp_reset_postdata();
        else: ?>

        <p>Il n'y a pas de résultat</p>

    <?php endif; ?>

    </section>
</main>

<?php get_footer(); ?>
