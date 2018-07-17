<?php
    $args = array(
    'post_type' => 'post',
    'category_name' => 'vidéo',
    'posts_per_page' => 3
    );
    $slider_query = new WP_Query( $args );
    $titre = $post->post_title;
if ($slider_query->have_posts()) : ?>

<section id="slider" class="row my-5">
    <div class="container px-0">
        <div id="slider-01" class="carousel slide" data-ride="carousel">
            <!-- indicator -->
            <ol class="carousel-indicators d-none d-md-block">

                <?php
                $Indicator_index = 0;
                while ($slider_query->have_posts() ) : $slider_query->the_post();
                    echo '<li data-target="#slider-01" data-slide-to="'.$Indicator_index.'" class="'.($Indicator_index == 0 ? "active" : "").'"></li>';
                    $Indicator_index++;
                endwhile; ?>

            </ol>
            <?php rewind_posts(); ?>

            <div class="carousel-inner">

                <?php
                $active_test = true;
                while( $slider_query->have_posts() ) : $slider_query->the_post();
                    $thumbnail_html = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'front-slider' );
                    $thumbnail_src = $thumbnail_html['0'];
                    if( $active_test )
                    {
                        $theclass = " active";
                    }
                    else
                    {
                        $theclass = "";
                    }
                    ?>
                <div class="carousel-item item<?= $theclass; ?>">
                    <a href="<?=get_permalink($post);?>" class="d-block">
                        <img class="d-block w-100" src="<?= $thumbnail_src;?>" alt="text alternative de l'image">
                        <!-- <div class="carousel-caption d-block"> -->
                        <div class="carousel-caption d-block fixed-top">
                            <h3 class="text-secondary"><?php the_title(); ?></h3>
                            <?=custom_field_excerpt(); ?>
                        </div>
                    </a>
                </div>

                <?php
                $active_test = false;
                endwhile;
                wp_reset_postdata();
                ?>

            </div>
            <!-- Controls -->
            <a href="#slider-01" class="carousel-control-prev" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon d-none d-md-block" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a href="#slider-01" class="carousel-control-next" role="button" data-slide="next">
                <span class="carousel-control-next-icon d-none d-md-block" role="button" data-slide="next"></span>
                <span class="sr-only">Next</span>
            </a>
        </div><!-- /carousel -->
    </div><!-- /container -->
</section>

<?php endif; ?>



































