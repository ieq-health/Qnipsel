<?php

/** Custom Fields
 * Set up the Custom Fields plugin and define some fields.
 */
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/** Add custom fields to pages */
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
                          Field::make('textarea', 'html', 'HTML')
                               ->set_attribute('data-editor', 'html'),
                          Field::make('textarea', 'css', 'CSS')
                               ->set_attribute('data-editor', 'css'),
                          Field::make('textarea', 'js', 'JS')
                               ->set_attribute('data-editor', 'javascript'),
                      ))
             ));
}
add_action('carbon_fields_register_fields', 'templateq_crb_attach_post_options');

/** Bootstrap Custom Fields */
function templateq_crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}
add_action('after_setup_theme', 'templateq_crb_load');

/** We don't need the standard editor on pages anymore */
function templateq_disable_editor()
{
    remove_post_type_support('page', 'editor');
}
add_action('admin_head', 'templateq_disable_editor');


/**
 * Supporting scripts and styles
 */
/** Backend */
function templateq_enqueue_admin()
{
    wp_enqueue_script('ace', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.1/ace.js', array(), '1.4.1');
    wp_enqueue_script('templateq_backend', get_template_directory_uri() . '/backend/script.js', array(), '0.0.1');
}
add_action('admin_enqueue_scripts', 'templateq_enqueue_admin');

/** Frontend */
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

    // Pull Rainbow
    wp_enqueue_script('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js', array(), '1.2.0');
    wp_enqueue_script('rainbow-html', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.min.js', array('rainbow'), '1.2.0');
    wp_enqueue_script('rainbow-css', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/css.min.js', array('rainbow'), '1.2.0');
    wp_enqueue_script('rainbow-js', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.min.js', array('rainbow'), '1.2.0');
    wp_enqueue_style('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/tomorrow-night.min.css', array(), '1.2.0');

    // Pull custom CSS
    wp_enqueue_style('templateq_codeview', get_template_directory_uri() . '/css/codeview.css', array('bootstrap'), '0.0.1');
    wp_enqueue_style('templateq_dashboard', get_template_directory_uri() . '/css/dashboard.css', array('bootstrap'), '0.0.1');

    // Pull custom JS
    wp_enqueue_script('templateq_mmenu', get_template_directory_uri() . '/js/mmenu.js', array('mmenu'), '0.0.1');
}
add_action('wp_enqueue_scripts', 'templateq_enqueue');
