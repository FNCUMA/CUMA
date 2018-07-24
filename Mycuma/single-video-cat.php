<?php get_header(); ?>

<main class="container d-flex flex-column align-items-center justify-content-center px-md-0 mx-md-auto">
    <section class="row w-100 d-flex flex-column justify-content-around my-5">

    <?php if (have_posts()):
        while (have_posts()): the_post();
            the_title('<h2 class="w-100 font-weight-light mb-3 mb-lg-5 text-center text-md-left">','</h2>');
            ?>

        <div class="card bg-cuma text-white border-0 rounded-0">
            <div class="embed-responsive embed-responsive-16by9">
                <?php the_field('url_de_la_video'); ?>
            </div>
            <div class="card-body h-100">
                <p class="my-3 card-text text-justify"><?php the_field('description_de_la_video'); ?></p>
            </div>
        </div>
    <?php
        endwhile;
        wp_reset_postdata(); ?>

        <ul class="list-group col-lg-12 d-flex flex-row justify-content-between pr-0 mt-5 bg-white">
            <li class="list-group-item pl-0 border-0"><?php previous_post_link('%link','%title','vidéo',TRUE); ?></li>
            <li class="list-group-item pr-0 border-0"><?php next_post_link('%link','%title','vidéo',TRUE); ?></li>
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
