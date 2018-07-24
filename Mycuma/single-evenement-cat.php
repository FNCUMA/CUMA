<?php get_header(); ?>

<!-- stylisation de l'affichage de la carte -->
<main class="container d-flex flex-column align-items-center justify-content-center px-md-0 mx-md-auto">
    <section class="row w-100 d-flex flex-column justify-content-around my-5">

            <?php
                if (have_posts()):
                while (have_posts()): the_post(); ?>

        <div class="d-flex flex-md-row flex-column justify-content-between align-items-start mb-4">

            <?php
            the_title('<h2 class="col-12 col-md-8 font-weight-light mb-5 mb-md-0 float-left">','</h2>');
            $date = get_field('date', false, false);
            $date = new DateTime($date); ?>

            <h3 class="col-12 col-md-4 text-right"><?=$date->format('d/m/Y'); ?></h3>
        </div>
        <div class="col-12 card flex-column flex-lg-row px-0 flex-lg-wrap text-white border-0">

            <?php
            $location = get_field('google_maps');
            if ( !empty( $location ) ): ?>

                <div class="acf-map col-12 col-lg-6 w-100 border-0">
                    <div class="marker" data-lat="<?=$location['lat'];?>" data-lng="<?=$location['lng'];?>" style="display:block;">
                        <h4 class="font-weight-light text-left text-lg-center text-dark"><?php the_title();?></h4>
                        <p class="address text-dark"><?=$location['address'];?></p>
                    </div>
                </div>

            <?php endif; ?>
            <?php $image_event = get_field('ajouter_une_image');?>
            <img src="<?=$image_event['url']; ?>" alt="<?=$image_event['alt'];?>" class="card-img-top img-fluid d-block h-100 col-12 col-lg-6 px-0 pl-lg-2 ">
            <div class="card-body bg-cuma h-100 col-12 mt-lg-4">
                <p class="my-3 card-text text-justify"><?php the_field('votre_evenement'); ?></p>
            </div>
        </div>

        <?php
        endwhile;
        wp_reset_postdata(); ?>

        <ul class="list-group col-lg-12 d-flex flex-row justify-content-between pr-0 mt-5 bg-white">
            <li class="list-group-item border-0 pl-0 bg-none"><?php previous_post_link('%link','%title','événement',TRUE); ?></li>
            <li class="list-group-item border-0 pr-0 bg-none"><?php next_post_link('%link','%title','événement',TRUE); ?></li>
        </ul>

    <?php else: ?>

        <div class="row">
            <div class="col-lg-12">
                <p>Il n'y a  pas de résultat</p>
            </div>
        </div>

<?php endif; ?>

    </section>
</main>

<?php get_footer(); ?>
