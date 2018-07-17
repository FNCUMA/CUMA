<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= get_template_directory_uri(); ?>/assets/img/img-layout/logo_mycuma_long.svg">
    <title>CUMA - homepage</title>
    <?php wp_head(); ?>
  </head>
  <body class="d-flex flex-column justify-content-between">
    <header class="bg-cuma py-lg-2 shadow">
        <div id="wrapper" class="toggled container d-flex px-0 pos-f-t">
            <div id="sidebar-wrapper" class="sidebar-nav h-100" >

               <?php
                wp_nav_menu(array(
                    'menu' => 'principal',
                    'depth' => 3,// modif
                    'container_class' => 'w-50 float-right h-100',
                    'menu_class' => 'list-unstyled bg-cuma h-100 d-flex flex-column justify-content-lg-start',
                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback', // fin modif
                    'walker' => new WP_Bootstrap_Navwalker())
                );
                ?>

            </div>
            <nav class="navbar navbar-dark flex-nowrap col-12 p-0">
                <a class="col-5 col-md-3 animated bounce navbar-brand d-flex align-items-center col-lg-2" href="<?= bloginfo('url'); ?>">
                    <img class="img-fluid w-100" src="<?= get_template_directory_uri(); ?>/assets/img/img-layout/logo_mycuma_long.svg">
                </a>
                <a class="navbar-toggler border-0 btn btn-lg btn-link py-0 menu-toggle" href="#menu-toggle" id="menu-toggle" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon animated bounce"></span>
                    <span class="icon-cross invisible animated bounce"></span>
                </a>
            </nav>
        </div>
    </header>
