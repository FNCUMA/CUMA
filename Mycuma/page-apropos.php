<?php
/*
Template Name: Apropos
*/
get_header(); ?>

 <main id="Apropos" class="container d-flex flex-column justify-content-lg-start my-5 mb-lg-5 mt-lg-5 h-100">
 <h1 class="font-weight-light mb-5 my-lg-3 mb-lg-5 mb-md-4 text-lg-left text-center text-md-left pl-lg-5"><?php the_title(); ?></h1>
    <section class="Apropos row w-100 flex-column flex-lg-row flex-lg-nowrap justify-content-lg-between align-items-lg-start px-md-0 mx-md-auto">

      <?php if (have_posts()):
        while( have_posts()): the_post(); ?>
        
            <!-- Récupération de l'image thumbnail de la page de l'interface admin -->
            <?php
            if ($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full')) :
              $image_alt = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
              $thumbnail_src = $thumbnail_html[0]; ?>

        <img class="img-fluid d-block col-lg-5 p-lg-0 col-12 mb-5" src="<?=$thumbnail_src; ?>" alt="<?=$image_alt ;?>" />

          <?php else : ?>

        <img class="img-fluid d-block col-lg-5 p-lg-0 col-12 mb-5" src="<?= get_template_directory_uri(); ?>/assets/img/img-content/Actualités/Image/Placeholder.png" alt="img_default" >

          <?php endif; ?>

        <article class="col-12 col-lg-7 mb-lg-3 ml-lg-4 text-justify pr-lg-0">

            <?php the_field('description'); ?>

        </article>

      <?php endwhile;
        wp_reset_postdata();
      else: ?>

          <p class="col-12 col-lg-8 text-center">Il n'y a pas de résultat</p>

      <?php endif; ?>

    </section>
</main>

<?php get_footer(); ?>
