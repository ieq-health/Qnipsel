<?php

function templateq_enqueue()
{
    // Pull Bootstrap
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', array(), '4.1.3');

    // Pull latest jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1');

    // Pull mmenu
    wp_enqueue_style('mmenu', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.6/jquery.mmenu.all.css', array(), '7.0.6');
    wp_enqueue_script('mmenu', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.6/jquery.mmenu.all.js', array('jquery'), '7.0.6');

    // Pull custom CSS
    wp_enqueue_style('templateq_dashboard', get_template_directory_uri() . '/css/dashboard.css', array('bootstrap'), '0.0.1');

    // Pull custom JS
    wp_enqueue_script('templateq_mmenu', get_template_directory_uri() . '/js/mmenu.js', array('mmenu'), '0.0.1');
}
add_action('wp_enqueue_scripts', 'templateq_enqueue');
