<?php get_header(); ?>

<main id="service_type" class="container d-flex flex-column align-items-center justify-content-center px-lg-0">
    <header class="row w-100 mt-3 mb-5 my-lg-5 flex-column flex-lg-row flex-wrap align-items-lg-start">
    <img class="col-12 col-lg-5 mb-3 img-fluid" src="<?php the_field('image_du_service'); ?>" alt="...">
    <div class="col-12 col-lg-7 d-flex flex-column align-content-lg-between px-0">
      <h2 class="p-lg-2 mb-3 ml-lg-5"><?php the_field('titre'); ?></h2>
      <p class="mb-auto p-lg-2 ml-lg-5 text-justify"><?php the_field('description_du_service'); ?></p>
    </div>
    </header>
    <section class="row w-100 flex-column flex-lg-row flex-nowrap flex-lg-wrap my-2 my-lg-5 px-lg-0">
        <article class="d-flex flex-column flex-lg-row flex-nowrap flex-lg-wrap col-12 pb-lg-0 mb-lg-5 px-0">
            <div class="col-12 col-lg-6 d-flex flex-column align-content-between px-0 pr-lg-3 mb-3">
                <h3 class="font-weight-light mb-3 mb-lg-5"><?php the_field('titre_2'); ?></h3>
                <p><?php the_field('description_du_service_2'); ?></p>
            </div>
            <img class="img-fluid col-12 col-lg-6 align-self-start px-0 shadow" src="<?php the_field('image_du_service_2'); ?>" alt="...">
        </article>
        <hr class="my-0 w-100 border-w">
        <article class="col-12 d-flex justify-content-center justify-content-lg-between flex-wrap align-items-center my-5 py-lg-0 px-0">
            <img class="img-fluid col-lg-4 col-12 mb-5 shadow" src="<?php the_field('image_du_service_3'); ?>" alt="...">
            <div class="px-0 col-lg-8 pl-lg-5">
                <h3 class="font-weight-light mb-lg-3"><?php the_field('titre_3'); ?></h3>
                <p><?php the_field('description_du_service_3'); ?></p>
            </div>
        </article>
        <article class="col-12 d-flex flex-row flex-wrap align-items-start my-0 px-0">
            <h3 class="font-weight-light col-12 py-0 py-lg-3"><?php the_field('titre_4'); ?></h3>
            <div class="card col-12 col-lg-10 ml-lg-5">
                <div class="card-body h-100">
                    <p><?php the_field('description_du_service_4'); ?></p>
                </div>
            </div>
        </article>

<?php
    global $post;

    if ( $post->post_title == 'cuma paie')
    {
      $type_cuma = 'cuma paie';
    }
    elseif ( $post->post_title == 'cuma formation')
    {
      $type_cuma = 'cuma formation';
    }
    elseif ( $post->post_title == 'mécagest')
    {
      $type_cuma = 'mécagest';
    }
    elseif ( $post->post_title == 'cuma data')
    {
      $type_cuma = 'cuma data';
    }
    elseif ( $post->post_title == 'cuma reseaux')
    {
      $type_cuma = 'cuma reseaux';
    }
    elseif ( $post->post_title == 'cuma temps')
    {
      $type_cuma = 'cuma temps';
    }
    elseif ( $post->post_title == 'cuma travaux')
    {
      $type_cuma = 'cuma travaux';
    }
    elseif ( $post->post_title == 'cuma planning')
    {
      $type_cuma = 'cuma planning';
    }
    elseif ( $post->post_title == 'cuma crm')
    {
      $type_cuma = 'cuma crm';
    }
    elseif ( $post->post_title == 'cuma compta')
    {
      $type_cuma = 'cuma compta';
    }
    else
    {
      $type_cuma = undefined;
    }

    $participant_query_args = array(
        'post_type' => 'mycuma_participant',
        'post_title' => $type_cuma,
        'posts_per_page' => 2
    );

    $participant_query = new WP_Query( $participant_query_args ); ?>

        <article class="my-md-5 col-12 d-flex flex-column flex-lg-row flex-nowrap flex-lg-wrap px-0 mt-5">
            <h3 class="font-weight-light mb-lg-5 col-12">Ils en parlent</h3>
            <ul class="equipeList col-12 px-0 pt-5 mb-0 d-flex flex-column flex-nowrap flex-md-row flex-md-wrap justify-content-between align-items-between">

    <?php
    if ( $participant_query->have_posts() ):
            while ( $participant_query->have_posts() ):
                $participant_query->the_post(); ?>

              <li class="h-100 col-12 col-md-6 d-flex flex-column flex-nowrap flex-lg-row justify-content-between align-items-center px-0 mb-5 my-md-0 pr-lg-5">

                <?php if ($thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium')):
                    $thumbnail_src = $thumbnail_html['0']; ?>

                    <img class="d-block mx-auto col-lg-4 col-7 img-fluid rounded-circle align-self-lg-start mb-md-5" src="<?= $thumbnail_src; ?>" alt="...">

                <?php else: ?>

                    <img class="d-block mx-auto img-fluid col-lg-4 col-7 rounded-circle align-self-lg-start mb-md-5" src="<?=get_template_directory_uri();?>/assets/img/img-content/Actualites/Image/Placeholder.png" alt="...">

                <?php endif; ?>

                <div class=" d-flex flex-column justify-content-between ml-lg-1 col-lg-8 col-12 px-0 mt-5 mt-md-0">
                  <p class="col-12"><?php the_field('message'); ?></p>
                  <div class="card ml-lg-5 mr-lg-3 px-0">
                    <div class="card-body p-2 h-100">
                      <p class="text-nowrap d-inline col-12"><?php the_field('prenom');?></p>&nbsp;<p class="text-nowrap d-inline"><?php the_field('nom'); ?></p>
                      <p class="col-12 mt-3 mt-md-2"><?php the_field('fonction'); ?></p>
                    </div>
                  </div>
                </div>
              </li>

              <?php endwhile; wp_reset_postdata(); ?>

        </ul>

        <?php else: ?>

        <h2 class="text-center">Il n'y a pas de résultat</h2>

    <?php endif; ?>

        </article>
    </section>
</main>

<?php get_footer(); ?>
