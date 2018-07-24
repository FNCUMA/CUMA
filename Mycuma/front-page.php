<?php get_header();?>
<main id="homepage" role="main" class="container my-5">
    <section class="row mb-5">

    <?php
        $args_homepage = array(
          'post_type' => 'page',
          'page_id' => 8,
          'posts_per_page' => 1 );

        $homepage_query = new WP_Query( $args_homepage );

      if ( $homepage_query->have_posts() ) {
        while ($homepage_query->have_posts()) {
          $homepage_query->the_post(); ?>

          <div class="card bg-cuma col-lg-12 pt-3 border-0 rounded-0 ">
              <div>
              <?php $image = get_field('votre_image'); ?>
                  <img class="img-fluid d-block w-100" src="<?= $image['url']; ?>" alt="<?= $image['alt'];?>" />
              </div>
              <div class="card-body text-center h-100">
                  <?php the_title('<h1 class="card-title text-white font-weight-light ">','</h1>'); ?>
                  <p class="card-text text-white text-justify"><?php the_field('votre_message'); ?></p>
              </div>
          </div>

          <?php
          }
        wp_reset_postdata();
      }; ?>

    </section>
    <section class="row my-5">
      <h2 class="col-lg-12 my-3 font-weight-light mb-5 pl-lg-5 pl-0 text-center text-lg-left"><a class="text-dark" href="<?= bloginfo('url'); ?>/service">Nos solutions</a></h2>

      <?php
          $args_homepage_services = array(
                  'post_type' => 'mycuma_service',
                  'posts_per_page' => 10 );

      $homepage_query_services = new WP_Query( $args_homepage_services ); ?>

      <ul class="services col-12 list-lg-group d-flex flex-row flex-wrap px-0 px-lg-5 pb-lg-3">

        <?php
            if ($homepage_query_services->have_posts()) :
            while ($homepage_query_services->have_posts()) : $homepage_query_services->the_post();
            $thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' );
            $image_alt = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
            $thumbnail_src = $thumbnail_html[0]; ?>


          <li class="col-6 d-flex list-group-lg-item align-items-center justify-content-center p-0">
            <a href="<?= get_permalink($post); ?>" class="d-flex flex-lg-row flex-column col-12 col-lg-9 align-items-center pl-lg-5 text-dark nav-link p-0">
              <figure class="rounded-circle p-1" style="height:80px;width:80px;overflow:hidden;">
                  <img class="img-fluid w-100 align-self-center" src="<?= $thumbnail_src; ?>" alt="<?=$image_alt;?>" >
              </figure>

              <?php the_title('<p class="font-weight-light text-dark ml-lg-5 text-center">','</p>'); ?>

            </a>
          </li>

        <?php endwhile; wp_reset_postdata();
        else : ?>

        <p>Il n'y a pas de services</p>

      <?php endif; ?>
    </ul>
    </section>
    <section class="row mt-5 p-lg-3">
    <h2 class=" col-lg-12 text-dark mb-0 font-weight-light text-center text-lg-left pl-lg-5 pl-0">Nos Partenaires</h2>

    <?php
      $args_homepage_partenaires = array(
          'post_type' => 'mycuma_partner',
          'posts_per_page' => 2 );
      $homepage_query_partenaires = new WP_Query( $args_homepage_partenaires ); ?>

    <ul class="w-100 list-group d-flex flex-row flex-lg-wrap justify-content-around align-items-center py-4">

  <?php
      if ( $homepage_query_partenaires->have_posts() )
      {
          while( $homepage_query_partenaires->have_posts())
          {
              $homepage_query_partenaires->the_post();
              $thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
              $image_alt = get_post_meta( get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true );
              $thumbnail_src = $thumbnail_html[0]; ?>

          <li class="list-group-item border-0 d-flex align-items-center justify-content-center p-0 h-100">
              <a href="<?=bloginfo('url')?>/partenaires" class="d-block p-2">
                  <img class="img-fluid d-block w-75 mx-auto" src="<?= $thumbnail_src; ?>" alt="<?=$image_alt;?>" >
              </a>
          </li>

        <?php
          }
        wp_reset_postdata();
      }
      else
      {
          echo "<p>Il n'y a pas de partenaire</p>";
      } ?>

    </ul>
    </section>
</main>

<?php get_footer(); ?>
