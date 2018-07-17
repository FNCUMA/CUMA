<?php
$post = $wp_query->post;

if ( in_category( 'actualité' ) ) {
    include( TEMPLATEPATH.'/single-actualité-cat.php');
}
elseif ( in_category('vidéo') ) {
    include( TEMPLATEPATH.'/single-video-cat.php');
}
elseif ( in_category('événement') ) {
    include( TEMPLATEPATH.'/single-evenement-cat.php');
}
else {
    include( TEMPLATEPATH.'/single-generic.php');
}; ?>
