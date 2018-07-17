<?php

//================================================================
//          Custom post type mycuma_partner
//================================================================

// Initialize custom post type mycuma-partner
function mycuma_partner_init() {

    $labels = array(
        'name' => 'Partenaires',
        'singular_name' => 'Partner',
        'add_new' => 'Ajouter un partenaire',
        'add_new_item' => 'Ajouter un élément aux partenaires',
        'edit_item' => 'Modifier un élément du partenaire',
        'all_items' => 'Voir la liste',
        'view_item' => 'Voir l\'élément',
        'search_item' => 'Cherche un média',
        'not_found' => 'Aucun élément trouvé',
        'not_found_in_trash' => 'Aucun média dans la corbeille',
        'menu_name' => 'Partenaires'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'partenaires'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        'supports' => array('title', 'thumbnail')
    );

    register_post_type('mycuma_partner', $args);
}

add_action('init', 'mycuma_partner_init');



//================================================================
//    ajout de l'image dans la colonne admin pour le mycuma_partner
//================================================================

add_filter('manage_edit-mycuma_partner_columns', 'mycuma_col_change2'); // change le nome de la colonne

function mycuma_col_change2($columns) {
    $columns['mycuma_partner_image'] = "Image affichée";
    return $columns;
}

add_action('manage_mycuma_partner_posts_custom_column', 'mycuma_content_show2', 10, 2); // affiche le contenu

function mycuma_content_show2($column, $post_id) {
    global $post;
    if ($column == 'mycuma_partner_image') {
        echo the_post_thumbnail(array(120,120));
    }
}


