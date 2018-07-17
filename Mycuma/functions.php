<?php
/**
* Chargement des scripts
*/
define('MKCUM_VERSION', '1.0.6');
// Chargement dans le front-end
function mkcum_scripts ()
{

    // chargement des styles
    wp_enqueue_style('mkcum_bootstrap-core', get_template_directory_uri().'/css/bootstrap.min.css', array(), MKCUM_VERSION, 'all');

    // chargement du css
    wp_enqueue_style( 'mkcum_animate', get_template_directory_uri(). '/css/animate.css', array(), MKCUM_VERSION, 'all');
    wp_enqueue_style( 'mkcum_customer', get_template_directory_uri(). '/style.css', array('mkcum_bootstrap-core','mkcum_animate'), MKCUM_VERSION, 'all');

//*********************************************************************************
//*********************** chargement des scripts
//*********************************************************************************

    // Le code fonctionne uniquement que lorsque je ne suis plus sur le dashboard
    if ( !is_admin() )
    {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.2.1.min.js', array(), MKCUM_VERSION, true);
    }

        wp_enqueue_script('popper-js', get_template_directory_uri().'/js/popper.min.js', array('jquery'), MKCUM_VERSION, true);
        wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery', 'popper-js' ), MKCUM_VERSION, true);
        wp_enqueue_script('mkcum_admin_script', get_template_directory_uri().'/js/scripts.js', array( 'jquery', 'bootstrap-js' ), MKCUM_VERSION, true);

}
// Fin de la fonction mkcum_scripts
add_action('wp_enqueue_scripts', 'mkcum_scripts');


//*********************************************************************************
//**** Chargement des styles / scripts dashboard dans l'admin
//*********************************************************************************

function mkcum_admin_init ()
{
    // first action
    function mkcum_admin_scripts ()
    {
        if (!isset($_GET['page']) || $_GET['page'] != "mkcum_theme_opts")
        {
            return;
        }

        // chargement des style admin
        wp_enqueue_style( 'bootstrap-adm-core', get_template_directory_uri().'/css/bootstrap.min.css', array(), MKCUM_VERSION );

        // chargement des scripts admin
        wp_enqueue_media();
        wp_enqueue_script( 'mkcum-admin-init', get_template_directory_uri().'/js/admin-options.js', array(), MKCUM_VERSION, true );

    } // fin de la fonction mkcum_admin_scripts

// add_action('admin_init', 'lgmac_admin_script');
add_action( 'admin_enqueue_scripts', 'mkcum_admin_scripts' );


} // fin da la fonction mkcum_admin_init

add_action('admin_init', 'mkcum_admin_init');







//*********************************************************************************
//*********************** Utilitaires
//*********************************************************************************

function mkcum_setup ()
{

    // support des vignettes
    add_theme_support('post-thumbnails');

    //installer un plugin regeneration pour ajouter d'autre image du même format de "régénérate thumbnail"

    // créer format image slider front
    add_image_size( 'front-slider', 1140, 420, true );

    // enlève le générateur de version
    remove_action('wp_head', 'wp_generator');

    // enlève les guillemets à la française
    remove_filter('the_content', 'wptexturize');

    // support du titre
    add_theme_support('title-tag');

    // active la gestion des menus
    register_nav_menus( array('primary' => 'principal', 'menu_up' => 'deuxieme', 'menu_mobile' => 'trois'));

    // Register Custom Navigation Walker
    require_once('includes/class-wp-bootstrap-navwalker.php');

} // fin de la fonction mkcum_setup

add_action('after_setup_theme', 'mkcum_setup');


//*********************************************************************************
//*********************** Ajoute la taille Medium Large dans la sélection
//*********************************************************************************

function my_images_sizes ( $sizes )
{
    $addsizes = array(
        "medium_large" => "Medium Large"
    );

    $newsizes = array_merge($sizes, $addsizes);
    return $newsizes;
}

add_filter('image_size_names_choose', 'my_images_sizes');


//*********************************************************************************
//*********************** modifie la longueur du texte de suite de l'excerpt
//*********************************************************************************

function mkcum_excerpt_length ( $length )
{
    return 22;
}

add_filter( 'excerpt_length', 'mkcum_excerpt_length', 999);


//*********************************************************************************
//*********************** modifie Advanced custom field ( Acf ) du texte de suite de l'excerpt
//*********************************************************************************

function custom_field_excerpt()
{
    global $post;

    if ( in_category( 'vidéo' ) )
    {
        $text= get_field('description_de_la_video');
    }
    elseif( in_category('actualité') )
    {
        $text= get_field('votre_article', false, false);
    }
    elseif ( in_category( 'événement' ))
    {
        $text = get_field('votre_evenement');
    }
    elseif ( $post->post_type == 'mycuma_partner')
    {
        $text = get_field('notre_partenaire');
    }
    elseif ( $post->post_type == 'mycuma_service')
    {
        $text = get_field('nos_service');
    }
    else
    {
        $text = undefined;
    }


    if('' != $text )
    {
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]&gt;', ']]&gt;', $text);
        $excerpt_length = 20;
        $excerpt_more = apply_filters('excerpt_more', ' ...');
        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
    }
    return apply_filters('the_excerpt', $text);
}



//*********************************************************************************
//*********************** Insert google map
//*********************************************************************************

function my_acf_google_map_api( $api ) {
    $api['key'] = 'AIzaSyArYdNE0Mu40VZe1YN18rkEEhqfMuFdbxs';
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyArYdNE0Mu40VZe1YN18rkEEhqfMuFdbxs', array(), '3', true);
wp_enqueue_script('google', get_template_directory_uri().'/js/google.js', array('google-map', 'jquery'), '0.1', true);


//*********************************************************************************
//*************** désactiver l'editeur de text pour toutes les pages
//*********************************************************************************

add_action('admin_head', 'remove_content_editor');

function remove_content_editor()
{
    remove_post_type_support('page', 'editor');
}


//*********************************************************************************
//*************** add class post link and next link
//*********************************************************************************

add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function post_link_attributes($output) {
    $code = 'class="text-dark"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}


//***********************************************************************************
//******************* Masquer l'éditeur de texte dans les posts article ****************************
//***********************************************************************************

if (!current_user_can('manage_options'))
{
    function init_remove_support(){
        $post_type = 'post';
        remove_post_type_support( $post_type, 'editor');
    }
    add_action('init', 'init_remove_support',100);
}

//***********************************************************************************
//******************* Masquer l'éditeur de texte  dans les pages ********************
//***********************************************************************************

if (!is_admin() )
{
    add_action('init', 'remove_editor_init');
}

function remove_editor_init() {

    if (isset($_GET['post'])) {
        $post_id = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_id = $_POST['post_ID'];
    } else {
        return;
    }
    $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
    if ($template_file == 'page-assistance.php')
    {
        remove_post_type_support('page', 'editor');
    }
    elseif ($template_file == 'page-partenaires.php')
    {
        remove_post_type_support('page', 'editor');
    }
    elseif ($template_file == 'page-mentionLegale.php')
    {
        remove_post_type_support('page', 'editor');
    }

    remove_post_type_support('page','editor');
}

//***********************************************************************************
//******************* Add image into navbar ********************
//***********************************************************************************

add_filter( 'menu_image_default_sizes', function($sizes){

  // remove the default 36x36 size
  unset($sizes['menu-36x36']);

  // add a new size
  $sizes['menu-50x50'] = array(50,50);

  // return $sizes (required)
  return $sizes;

});


//==========================================================
//  désactiver les articles principaux et des pages dans le menu admin
//===========================================================

function remove_menu_pages () {

    remove_menu_page('index.php'); // Dashboard
    remove_menu_page('edit.php?post_type=page'); // Pages
    remove_menu_page('edit-comments.php'); // Comments
    remove_menu_page('themes.php'); // Appearance
    remove_menu_page('plugins.php'); // Plugin
    remove_menu_page('users.php'); // Users
    remove_menu_page('tools.php'); // Tools
    remove_menu_page('options-general.php'); // Settings
    remove_menu_page('wpcf7'); // contact form 7
    remove_menu_page('admin.php?page=wpcf7'); // contact form 7
    remove_menu_page('edit.php?post_type=acf'); // Advanced Custom Fields
}

if (!current_user_can('manage_options'))
{
    add_action( 'admin_menu', 'remove_menu_pages' );
}

//==================================================
//      Masquer les messages de mise à jour
//=================================================

function hide_wp_update_nag ()
{
    remove_action( 'admin_notices', 'update_nag', 3 );
}

if( !is_admin() )
{
    add_action('admin_menu', 'hide_wp_update_nag');
}

//==================================================
//  Supprimer les crédits WordPress du footer
//=================================================

// Remove Wordpress Footer Credits
function wpc_remove_footer_admin() {

    return '';
}
add_action('admin_footer_text','wpc_remove_footer_admin');

//=================================================
// Modifier un favicon de wordpress
//================================================

// Favicon in Wordpress admin
function wpc_admin_favicon() {

    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_stylesheet_directory_uri().'/assets/img/img-layout/Plus.png">';
}
add_action('admin_head','wpc_admin_favicon');


//=======================================================
// Supprimer l'onglet help de l'écran admin
//========================================================

// Remove Help tab
if (!current_user_can('manage_options'))
{
    add_filter('contextual_help','wpc_remove_help', 999, 3);
}

function wpc_remove_help( $old_help, $screen_id, $screen ) {

    $screen->remove_help_tabs();
    return $old_help;
}

//===============================================
// Supprimer l'onglet Options de l'écran admin
//===============================================

// Remove Screen Options
if (!current_user_can('manage_options'))
{
    add_filter( 'screen_options_show_screen', '__return_false' );
}

//===============================================
// Supprimer des widgets du tableau de bord
//===============================================

// Remove Dashboard widgets

function wpc_remove_dashboard_widgets() {

    global $wp_meta_boxes;

    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

if (!current_user_can('manage_options'))
{
    add_action( 'wp_dashboard_setup', 'wpc_remove_dashboard_widgets' );
}





//===============================================
// Supprimer des éléments de l'admin bar
//===============================================

// Remove element from Wordpress admin bar
if (!current_user_can('manage_options'))
{
    add_action( 'admin_bar_menu', 'wpc_remove_wp_logo', 999 );
}

function wpc_remove_wp_logo( $wp_admin_bar ) {

    $wp_admin_bar->remove_node('wp-logo');
    $wp_admin_bar->remove_node('updates');
    $wp_admin_bar->remove_node('menu-toggle');
    $wp_admin_bar->remove_menu('view');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('search');
    $wp_admin_bar->remove_node('edit');
}


//===============================================
//
// Supprimer les notifications d'updates Wordpress
//
//===============================================

if ( !is_admin() )
{
    // Disable Update WordPress nag
    add_action('after_setup_theme', 'wpc_remove_core_updates');

    // Disable Plugin Update Notifications
    remove_action('load-update-core.php','wp_update_plugins');
    add_filter('pre_site_transient_update_plugins', '__return_null');
}

// Disable all the Nags & Notifications
function wpc_remove_core_updates() {

    global $wp_version;
    return (object) array(
        'last_checked' => time(),
        'version_checked' => $wp_version
    );
}

if ( !is_admin() )
{
    add_filter('pre_site_transient_update_core', 'wpc_remove_core_updates');
    add_filter('pre_site_transient_update_plugins', 'wpc_remove_core_updates');
    add_filter('pre_site_transient_update_themes', 'wpc_remove_core_updates');

    // Hide WordPress Update Alert
    add_action('admin_menu', 'wpc_wphidenag');
}

function wpc_wphidenag() {
    remove_action('admin_notices', 'update_nag', 3);
}

//===============================================
// Supprimer les roles utilisateur wordpress
//===============================================

$wp_roles = new WP_Roles();
$wp_roles->remove_role("author");
$wp_roles->remove_role("contributor");
$wp_roles->remove_role("subscriber");

//===============================================
// retirer le reditionnement d'une image
//===============================================

add_action( 'admin_menu', 'wpse107783_redirect_media_edit' );
function wpse107783_redirect_media_edit()
{
    if (
        ! is_admin()
        OR 'attachment' !== get_current_screen()->id
    )
        return;

    exit( wp_redirect( admin_url() ) );
}

