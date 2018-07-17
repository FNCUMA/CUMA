<?php

//================================================================
//          Custom post type mycuma_actualite
//================================================================

// Initialize custom post type mycuma-actu
function mycuma_actualite_init() {

    $labels = array(
        'name' => 'Actualites',
        'singular_name' => 'Actu',
        'add_new' => 'Ajouter un actualité',
        'add_new_item' => 'Ajouter un élément a actualité',
        'edit_item' => 'Modifier une actualité',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Cherche un média',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun média dans la corbeille',
        'menu_name' => 'Actualites'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'actualites'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        // 'supports' => array('title', 'editor', 'thumbnail')
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('mycuma_actualite', $args);
}

add_action('init', 'mycuma_actualite_init');


//================================================================
//          meta boxes pour custom post type mycuma_actualite
//================================================================

function mycuma_actualite_register_meta_box() {
    add_meta_box('mycuma_actualite_meta', 'Référence de l\'actualité', 'mycuma_actualite', 'normal', 'high');
}

//================================================================
//    ajout de l'image dans la colonne admin pour le mycuma_actualite
//================================================================

add_filter('manage_edit-mycuma_actualite_columns', 'mycuma_col_change5'); // change le nome de la colonne

function mycuma_col_change5($columns) {
    $columns['mycuma_actualite_image'] = "Image affichée";
    return $columns;
}

add_action('manage_mycuma_actualite_posts_custom_column', 'mycuma_content_show5', 10, 2); // affiche le contenu

function mycuma_content_show5($column, $post_id) {
    global $post;
    if ($column == 'mycuma_actualite_image') {
        echo the_post_thumbnail(array(120,120));
    }
}

//================================================================
//    custom taxonomy pour mycuma-actu
//================================================================

function mycuma_define_taxononomy_actu() {

    $labels = array(
        'name' => 'Types Actualites',
        'singular_name' => 'type',
        'all_items' => 'tous les types',
        'edit_item' => 'modifier le type',
        'update_item' => 'mettre à jour le type',
        'add_new_item' => 'ajouter un type',
        'search_items' => 'Rechercher dans les types',
        'new_item_name' => 'nouveau nom du type',
        'menu_name' => 'types des actualités'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'actu'),
        'show_admin_column' => true
    );

    register_taxonomy('type_actu', 'mycuma_actualite', $args);
}

// -------------Action hook to create taxonomy
add_action('init', 'mycuma_define_taxononomy_actu');

