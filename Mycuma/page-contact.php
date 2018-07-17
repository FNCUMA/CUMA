<?php
/*
Template Name: Contact
*/
get_header(); ?>

<main id="contact" class="container d-flex flex-column justify-content-center align-items-center">
    <section class="row w-100 flex-column flex-lg-row justify-content-lg-between align-items-lg-start flex-nowrap flex-lg-wrap my-5">

        <?php
        if (have_posts()):
        while( have_posts()): the_post();
        the_title('<h1 class="text-center text-lg-left pl-lg-5 display-4 col-12 col-lg-12">','</h1>'); ?>

        <article class="pr-lg-5 px-0 col-12 col-lg-6 d-flex flex-column justify-content-between">

            <?=do_shortcode( '[contact-form-7 id="5" title="Formulaire de contact 1"]' ); ?>

        </article>
        <article class="px-0 pl-lg-5 col-12 col-lg-6 d-flex flex-lg-row flex-wrap align-content-lg-start ">
            <iframe class="mt-4 w-100 col-lg-12 px-0 mb-3 mb-lg-0" " src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4875.19503256699!2d2.3715564936224727!3d48.85918060223343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc3d574dc943d1fcb!2sFNCUMA!5e0!3m2!1sfr!2sfr!4v1527080404632" width="550" height="225" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
            <div class="col-md-6 mb-3 my-lg-0 col-lg-6 h-100 d-flex flex-column align-items-center py-3 bg-cuma text-white">

                <?php the_field('adresse'); ?>

            </div>
            <div class="col-md-6 h-100 col-lg-6 d-flex flex-column align-items-center text-nowrap py-3">

                <?php the_field('horaire'); ?>

            </div>
        </article>

    <?php
    endwhile; wp_reset_postdata();
    else: ?>

        <p class="text-center">Il n'y a pas de résultat</p>

    <?php endif; ?>

    </section>
</main>

<?php get_footer(); ?>



