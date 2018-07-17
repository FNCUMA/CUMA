<section id="imgHome" class="row my-5">
    <div id="map-container" class="w-100">

<?php
    $args = array(
        'post_type' => 'post',
        'category_name' => 'événement',
        'posts_per_page' => -1 );

    $the_query = new WP_Query($args); ?>

        <div class='acf-map'>

    <?php
    while ( $the_query->have_posts() )
        {
        $the_query->the_post();
        $location = get_field('google_maps');
        if( !empty($location) )
        { ?>

            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
                <h4><a href="<?php the_permalink(); ?>" rel="bookmark"> <?php the_title(); ?></a></h4>
                <p class="address"><?php echo $location['address']; ?></p>
            </div>

    <?php
        }
    }
    wp_reset_postdata(); ?>

        </div>
    </div>
</section>
