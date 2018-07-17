<?php

//================================================================
//          Custom post type mycuma_participant
//================================================================

// Initialize custom post type mycuma-participant
function mycuma_participant_init() {

    $labels = array(
        'name' => 'participants',
        'singular_name' => 'participant',
        'add_new' => 'Ajouter un participant',
        'add_new_item' => 'Ajouter un élément a participant',
        'edit_item' => 'Nouveau media',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Cherche un média',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun média dans la corbeille',
        'menu_name' => 'participants'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'participant'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        // 'supports' => array('title', 'editor', 'thumbnail')
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('mycuma_participant', $args);
}

add_action('init', 'mycuma_participant_init');


//================================================================
//          meta boxes pour custom post type mycuma_participant
//================================================================

function mycuma_participant_register_meta_box() {
    add_meta_box('mycuma_participant_meta', 'Référence du participant', 'mycuma_participant', 'normal', 'high');
}

//================================================================
//    ajout de l'image dans la colonne admin pour le mycuma_participant
//================================================================

add_filter('manage_edit-mycuma_participant_columns', 'mycuma_col_change6'); // change le nome de la colonne

function mycuma_col_change6($columns) {
    $columns['mycuma_participant_image'] = "Image affichée";
    return $columns;
}

add_action('manage_mycuma_participant_posts_custom_column', 'mycuma_content_show6', 10, 2); // affiche le contenu

function mycuma_content_show6($column, $post_id) {
    global $post;
    if ($column == 'mycuma_participant_image') {
        echo the_post_thumbnail(array(120,120));
    }
}

//================================================================
//    custom taxonomy pour mycuma-participant
//================================================================

function mycuma_define_taxononomy_participant() {

    $labels = array(
        'name' => 'Types participants',
        'singular_name' => 'type',
        'all_items' => 'tous les types',
        'edit_item' => 'modifier le type',
        'update_item' => 'mettre à jour le type',
        'add_new_item' => 'ajouter un type',
        'search_items' => 'Rechercher dans les types',
        'new_item_name' => 'nouveau nom du type',
        'menu_name' => 'types des participants'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'participant'),
        'show_admin_column' => true
    );

    register_taxonomy('type_participant', 'mycuma_participant', $args);
}

// -------------Action hook to create taxonomy
add_action('init', 'mycuma_define_taxononomy_participant');
