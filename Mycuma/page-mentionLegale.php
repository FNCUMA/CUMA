<?php
/*
Template Name: MentionLegale
*/
get_header(); ?>
<main class="container">

    <?php if (have_posts()): ?>
            <?php while( have_posts()): the_post(); ?>
                <?php the_title('<h1 class="font-weight-light mt-5">','</h1>'); ?>

    <section class="row d-flex flex-column justify-content-around p-3 p-lg-5 my-5 bg-light">
        <article class="mb-3">
                <h2 class="font-weight-light"><?php the_field('titre_1'); ?></h2>
                <p class="m-0 text-justify"><?php the_field('description_1'); ?></p>
        </article>
        <article class="mb-4">
                <h2 class="font-weight-light"><?php the_field('titre_2'); ?></h2>
                <p class="m-0 text-justify"><?php the_field('description_2'); ?></p>
        </article>
        <article class="mb-4">
                <h2 class="font-weight-light"><?php the_field('titre_3'); ?></h2>
                <p class="m-0 text-justify"><?php the_field('description_3'); ?></p>
        </article>
        <article class="mt-3">
                <h2 class="font-weight-light"><?php the_field('titre_4'); ?></h2>
                <p class="m-0 text-justify"><?php the_field('description_4'); ?></p>
        </article>
    </section>

            <?php endwhile; ?><?php wp_reset_postdata(); ?>
    <?php else: ?>

        <p class="text-center">Il n'y a pas de résultat</p>

    <?php endif; ?>

</main>

<?php get_footer(); ?>
