<?php

//================================================================
//          Custom post type mycuma_video
//================================================================

// Initialize custom post type mycuma-video
function mycuma_video_init() {

    $labels = array(
        'name' => 'Video',
        'singular_name' => 'video',
        'add_new' => 'Ajouter un video',
        'add_new_item' => 'Ajouter un élément a la section de la video',
        'edit_item' => 'Modifier les élément de la section de la vidéo',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Cherche un média',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun média dans la corbeille',
        'menu_name' => 'Videos'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'video'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('mycuma_video', $args);
}

add_action('init', 'mycuma_video_init');


//================================================================
//          meta boxes pour custom post type mycuma_video
//================================================================

function mycuma_video_register_meta_box() {
    add_meta_box('mycuma_video_meta', 'Référence du video', 'mycuma_video', 'normal', 'high');
}

//================================================================
//    ajout de l'image dans la colonne admin pour le mycuma_video
//================================================================

add_filter('manage_edit-mycuma_video_columns', 'mycuma_col_change4'); // change le nome de la colonne

function mycuma_col_change4($columns) {
    $columns['mycuma_video_image'] = "Image affichée";
    return $columns;
}

add_action('manage_mycuma_video_posts_custom_column', 'mycuma_content_show4', 10, 2); // affiche le contenu

function mycuma_content_show4($column, $post_id) {
    global $post;
    if ($column == 'mycuma_video_image') {
        echo the_post_thumbnail(array(120,120));
    }
}

//================================================================
//    custom taxonomy pour mycuma-video
//================================================================

function mycuma_define_taxononomy_video() {

    $labels = array(
        'name' => 'Types Videos',
        'singular_name' => 'type',
        'all_items' => 'tous les types',
        'edit_item' => 'modifier le type',
        'update_item' => 'mettre à jour le type',
        'add_new_item' => 'ajouter un type',
        'search_items' => 'Rechercher dans les types',
        'new_item_name' => 'nouveau nom du type',
        'menu_name' => 'types des Videos'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'video'),
        'show_admin_column' => true
    );

    register_taxonomy('type_video', 'mycuma_video', $args);
}

// -------------Action hook to create taxonomy
add_action('init', 'mycuma_define_taxononomy_video');
