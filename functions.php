<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function templateq_crb_attach_post_options()
{
    Container::make('post_meta', 'Sections')
        ->where('post_type', '=', 'page')
        ->add_fields(array(
            Field::make('complex', 'crb_sections', 'Sections')
                ->add_fields('text', 'Text', array(
                    Field::make('rich_text', 'text', 'Text')
                ))

                ->add_fields('codepen', 'Codepen', array(
                    Field::make('text', 'title', 'Titel'),
                    Field::make('textarea', 'html', 'HTML'),
                    Field::make('textarea', 'css', 'CSS'),
                    Field::make('textarea', 'js', 'JS'),
                ))
        ));
}
add_action('carbon_fields_register_fields', 'templateq_crb_attach_post_options');

function templateq_crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}
add_action('after_setup_theme', 'templateq_crb_load');

function templateq_enqueue()
{
    // Pull Bootstrap
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', array(), '4.1.3');
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', array('jquery'), '4.1.3');

    // Pull latest jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1');

    // Pull mmenu
    wp_enqueue_style('mmenu', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.6/jquery.mmenu.all.css', array(), '7.0.6');
    wp_enqueue_script('mmenu', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.6/jquery.mmenu.all.js', array('jquery'), '7.0.6');

    // Pull custom CSS
    wp_enqueue_style('templateq_codeview', get_template_directory_uri() . '/css/codeview.css', array('bootstrap'), '0.0.1');
    wp_enqueue_style('templateq_dashboard', get_template_directory_uri() . '/css/dashboard.css', array('bootstrap'), '0.0.1');

    // Pull custom JS
    wp_enqueue_script('templateq_mmenu', get_template_directory_uri() . '/js/mmenu.js', array('mmenu'), '0.0.1');
}
add_action('wp_enqueue_scripts', 'templateq_enqueue');
