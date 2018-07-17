<?php get_header(); ?>

<main class="container d-flex flex-column align-items-center justify-content-center">
    <section class="row d-flex flex-column justify-content-around my-5">

    <?php if (have_posts()):
        while (have_posts()): the_post();
            the_title('<h2 class="w-100 display-4 mb-5 text-center text-lg-left">','</h2>'); ?>

        <div class=" bg-cuma text-white border-0 pt-3 pt-lg-0 p-lg-4">
            <img class="col-12 col-lg-6 float-lg-left mr-lg-4" src="<?php the_field('image_de_larticle'); ?>" alt="...">
                <p class="my-3 col-12 text-justify"><?php the_field('votre_article'); ?></p>
        </div>

    <?php endwhile; wp_reset_postdata(); ?>

        <ul class="list-unstyled col-lg-12 d-flex flex-row justify-content-between pr-0 mt-5 bg-white">
            <li class="border-0"><?php previous_post_link('%link','%title','actualité',TRUE); ?></li>
            <li class="border-0"><?php next_post_link('%link','%title','actualité',TRUE); ?></li>
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
