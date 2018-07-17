<?php

//================================================================
//          Custom post type mycuma_event
//================================================================

// Initialize custom post type mycuma-event
function mycuma_event_init() {

    $labels = array(
        'name' => 'Evenements',
        'singular_name' => 'Event',
        'add_new' => 'Ajouter un événement',
        'add_new_item' => 'Ajouter un élément a événement',
        'edit_item' => 'Modifier un événement',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Cherche un média',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun média dans la corbeille',
        'menu_name' => 'Evenements'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'events'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        // 'supports' => array('title', 'editor', 'thumbnail')
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('mycuma_event', $args);
}

add_action('init', 'mycuma_event_init');


//================================================================
//          meta boxes pour custom post type mycuma_event
//================================================================

function mycuma_event_register_meta_box() {
    add_meta_box('mycuma_event_meta', 'Référence de l\'événement', 'mycuma_event', 'normal', 'high');
}

//================================================================
//    ajout de l'image dans la colonne admin pour le mycuma_event
//================================================================

add_filter('manage_edit-mycuma_event_columns', 'mycuma_col_change'); // change le nome de la colonne

function mycuma_col_change($columns) {
    $columns['mycuma_event_image'] = "Image affichée";
    return $columns;
}

add_action('manage_mycuma_event_posts_custom_column', 'mycuma_content_show', 10, 2); // affiche le contenu

function mycuma_content_show($column, $post_id) {
    global $post;
    if ($column == 'mycuma_event_image') {
        echo the_post_thumbnail(array(120,120));
    }
}

//================================================================
//    custom taxonomy pour mycuma-event
//================================================================

function mycuma_define_taxononomy_event() {

    $labels = array(
        'name' => 'Types Evenements',
        'singular_name' => 'type',
        'all_items' => 'tous les types',
        'edit_item' => 'modifier le type',
        'update_item' => 'mettre à jour le type',
        'add_new_item' => 'ajouter un type',
        'search_items' => 'Rechercher dans les types',
        'new_item_name' => 'nouveau nom du type',
        'menu_name' => 'types des événements'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'event'),
        'show_admin_column' => true
    );

    register_taxonomy('type_event', 'mycuma_event', $args);
}

// -------------Action hook to create taxonomy
add_action('init', 'mycuma_define_taxononomy_event');

