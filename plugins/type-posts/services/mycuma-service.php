<?php

//================================================================
//          Custom post type mycuma_service
//================================================================

// Initialize custom post type mycuma-service
function mycuma_service_init() {

    $labels = array(
        'name' => 'Services',
        'singular_name' => 'service',
        'add_new' => 'Ajouter un service',
        'add_new_item' => 'Ajouter un élément a service',
        'edit_item' => 'Nouveau media',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Cherche un média',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun média dans la corbeille',
        'menu_name' => 'Services'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'service'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        // 'supports' => array('title', 'editor', 'thumbnail')
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('mycuma_service', $args);
}

add_action('init', 'mycuma_service_init');




//================================================================
//    ajout de l'image dans la colonne admin pour le mycuma_service
//================================================================

add_filter('manage_edit-mycuma_service_columns', 'mycuma_col_change3'); // change le nome de la colonne

function mycuma_col_change3($columns) {
    $columns['mycuma_service_image'] = "Image affichée";
    return $columns;
}

add_action('manage_mycuma_service_posts_custom_column', 'mycuma_content_show3', 10, 2); // affiche le contenu

function mycuma_content_show3($column, $post_id) {
    global $post;
    if ($column == 'mycuma_service_image') {
        echo the_post_thumbnail(array(120,120));
    }
}

