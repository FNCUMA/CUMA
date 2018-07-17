<?php

//================================================================
//          Custom post type mycuma_equipe
//================================================================

// Initialize custom post type mycuma-equipe
function mycuma_equipe_init() {

    $labels = array(
        'name' => 'Equipes',
        'singular_name' => 'equipe',
        'add_new' => 'Ajouter un équipe',
        'add_new_item' => 'Ajouter un élément a équipe',
        'edit_item' => 'Modifier un équipe',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Cherche un média',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun média dans la corbeille',
        'menu_name' => 'Equipes'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'equipes'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        // 'supports' => array('title', 'editor', 'thumbnail')
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('mycuma_equipe', $args);
}

add_action('init', 'mycuma_equipe_init');


//================================================================
//    ajout de l'image dans la colonne admin pour le mycuma_equipe
//================================================================

add_filter('manage_edit-mycuma_equipe_columns', 'mycuma_col_change7'); // change le nome de la colonne

function mycuma_col_change7($columns) {
    $columns['mycuma_equipe_image'] = "Image affichée";
    return $columns;
}

add_action('manage_mycuma_equipe_posts_custom_column', 'mycuma_content_show7', 10, 2); // affiche le contenu

function mycuma_content_show7($column, $post_id) {
    global $post;
    if ($column == 'mycuma_equipe_image') {
        echo the_post_thumbnail(array(120,120));
    }
}

