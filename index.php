<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body>
    <header>
        <h1><?php bloginfo('name'); ?></h1>
        <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        <?php get_search_form(); ?>
    </header>
    <main>

    </main>
    <footer>

    </footer>
    <?php wp_footer(); ?>
</body>

</html>