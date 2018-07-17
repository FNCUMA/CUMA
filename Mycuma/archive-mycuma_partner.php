<?php
/*
Template Name: Partenaire
*/
get_header(); ?>
   <main id="partenaires" class="container flex-column justify-content-around">
        <h1 class="my-5 pl-lg-5 pl-0 font-weight-bold">Partenaires</h1>
        <section class="row mb-5">
<?php
    $partner_query = new WP_Query( array(
        'post_type' => 'mycuma_partner'
    ));

    if ($partner_query->have_posts()):
        while( $partner_query->have_posts()):
            $partner_query->the_post(); ?>

            <article class="text-dark p-5 border border-w rounded mb-5">

            <?php the_title('<h2 class="font-weight-light">','</h2>');?>
            <p class="mx-auto"><?php the_field('description_de_notre_partenaire'); ?></p>

            <?php if ($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' )) :
                $thumbnail_src = $thumbnail_html[0]; ?>

                <img class="img-fluid d-block w-75 my-5 mx-auto" src="<?=$thumbnail_src; ?>" alt="..." />

            <?php else: ?>

                <img class="img-fluid d-block w-75 my-5 mx-auto" src="<?= get_template_directory_uri(); ?>/assets/img/img-content/Actualites/Image/Placeholder.png" alt="img_default">

            <?php endif; ?>
            </article>

<?php
        endwhile;
        wp_reset_postdata();
    else: ?>

        <h2 class="text-center">Il n'y a pas de résultat</h2>

<?php endif; ?>

        </section>
    </main>

<?php get_footer(); ?>
