<?php ?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <?php wp_head(); ?>
</head>

<body <?php body_class( );?>>
<header class="header">

    <?php wp_nav_menu( array(
        'theme_location' => 'main_navigation',
        'menu_class'     => 'main-nav__list',
        'container'      => 'nav',
        'container_class'=> 'main-nav main-nav__hidden',
        'link_before'         => '<span class="main-nav__link-content">',
        'link_after '         => '</span>',

    ) )  ;
    ?>



</header>

<main class="main-content">
