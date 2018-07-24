<?php
/*
Template Name: Service
*/
get_header(); ?>

<main id="Services" class="container">
    <h1 class="font-weight-light col-12 pl-lg-5 my-4 my-md-5 text-lg-left text-center">nos services</h1>
    <section class="row justify-content-center">
        <ul class="services pl-0 list-unstyled justify-content-lg-between align-content-lg-between col-lg-12 mb-5 d-flex flex-wrap flex-row pr-0 shadow-lg h-100 p-md-5">

            <?php $category_query = new WP_Query( array(
                'post_type' => 'mycuma_service'
                ) );
                if ($category_query->have_posts()):
                while ( $category_query->have_posts()): $category_query->the_post();
                $thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
                $thumbnail_src = $thumbnail_html[0];?>

            <li class="border-0 col-6 mt-lg-4 mb-lg-0 mb-5 col-lg-4">
                <a class="text-dark d-flex flex-column align-items-lg-center justify-content-lg-between" href="<?= get_permalink($post); ?>">
                    <p class="font-weight-light text-lg-left text-center"><?php the_title(); ?></p>
                    <img class="img-fluid d-block mx-auto w-25"  src="<?php echo $thumbnail_src; ?>" alt="" />
                </a>
            </li>

        <?php
        endwhile; wp_reset_postdata(); ?>

    </ul>

        <?php else: ?>

            <h2 class="text-center">Il n'y a pas de résultat</h2>

        <?php endif; ?>

    </section>
</main>

<?php get_footer(); ?>
