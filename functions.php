<?php

/** Custom Fields
 * Set up the Custom Fields plugin and define some fields.
 */
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/** Add navigation title */
function templateq_add_navigation_option($fields)
{
	return array_merge(
		array(
			Field::make('checkbox', 'nav_title_enabled', 'In Subnavigation?')
			->set_option_value('enabled'),

			Field::make('text', 'nav_title', 'Navtitel')
			->set_conditional_logic(array(
				array(
					'field' => 'nav_title_enabled',
					'value' => true
				)
			))
		),
		$fields
	);
}

/** Code field */
function templateq_code_field()
{
	return array(
		Field::make('text', 'language', 'Sprache'),
		Field::make('textarea', 'code', 'Code')
			->set_attribute('data-editor')
	);
}

/** Text field */
function templateq_text_field()
{
	return array(Field::make('rich_text', 'text', 'Text'));
}

/** Message field */
function templateq_message_field()
{
	return array(
		Field::make('text', 'title', 'Titel'),
		Field::make('rich_text', 'body', 'Text'),
		Field::make('select', 'style', 'Stil')
		->add_options(array(
			'dark'    => 'Dark',
			'primary' => 'Primary',
			'link'    => 'Link',
			'info'    => 'Info',
			'success' => 'Success',
			'warning' => 'Warning',
			'danger'  => 'Danger',
		))
	);
}

/** Add custom fields to pages */
function templateq_crb_attach_post_options()
{
	Container::make('post_meta', 'Sections')
		->where('post_type', '=', 'page')
		->add_fields(array(
			Field::make('complex', 'crb_sections', 'Sections')

			/** Spalten */
			->add_fields('columns', 'Spalten', templateq_add_navigation_option(array(
				Field::make('complex', 'crb_columns', 'Spalten')
				->add_fields('text', 'Text', templateq_text_field())
				->add_fields('message', 'Message', templateq_message_field())
				->add_fields('code', 'Code', templateq_code_field())
			)))
			
			/** Tabs */
			->add_fields('tabs', 'Tabs', templateq_add_navigation_option(array(
				Field::make('complex', 'crb_tabs', 'Tabs')
				->add_fields('text', 'Text', array(
					Field::make('text', 'title', 'Titel'),
					Field::make('rich_text', 'text', 'Text')
				))
				->add_fields('code', 'Code', array(
					Field::make('text', 'title', 'Titel'),
					Field::make('text', 'language', 'Sprache'),
					Field::make('textarea', 'code', 'Code')
				))
			)))

			/** Text */
			->add_fields('text', 'Text', templateq_add_navigation_option(templateq_text_field()))

			/** Code */
			->add_fields('code', 'Code', templateq_add_navigation_option(templateq_code_field()))

			/** Message */
			->add_fields('message', 'Message', templateq_message_field())

			/** Codepen */
			->add_fields('codepen', 'Codepen', templateq_add_navigation_option(array(
				Field::make('text', 'title', 'Titel'),
				Field::make('textarea', 'html', 'HTML')
				->set_attribute('data-editor', 'html'),
				Field::make('textarea', 'css', 'CSS')
				->set_attribute('data-editor', 'css'),
				Field::make('multiselect', 'css_libs', 'CSS Libraries')
				->add_options(array(
					'bootstrap' => 'Bootstrap',
					'slick' => 'Slick'
				)),
				Field::make('textarea', 'js', 'JS')
				->set_attribute('data-editor', 'javascript'),
				Field::make('multiselect', 'js_libs', 'JS Libraries')
				->add_options(array(
					'bootstrap' => 'Bootstrap',
					'jquery' => 'jQuery',
					'slick' => 'Slick'
				))
			)))

			/** Horizontal Rule */
			->add_fields('hr', 'Trennlinie', array(
				Field::make('html', 'hr', 'Trennlinie')
				->set_html('<hr>')
			))

			/** Output in REST Api */
			->set_visible_in_rest_api($visible = true)
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

/**
 * Remove things
 */

/** We don't need the standard editor on pages anymore */
function templateq_disable_editor()
{
	remove_post_type_support('page', 'editor');
}
add_action('admin_head', 'templateq_disable_editor');

/** Or Gutenberg */
add_filter('use_block_editor_for_post_type', '__return_false');

/** Title Tag */
add_theme_support('title-tag');

/** Remove unnecessary menu items */
function templateq_clean_admin_menu()
{
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'templateq_clean_admin_menu');

/**
 * Allow more file types
 */

function templateq_allow_filetypes($mime_types)
{
	$mime_types['svg'] = 'image/svg+xml';
	$mime_types['psd'] = 'image/vnd.adobe.photoshop';
	return $mime_types;
}
add_filter('upload_mimes', 'templateq_allow_filetypes', 1, 1);

/**
 * Supporting scripts and styles
 */

/** Backend */
function templateq_enqueue_admin()
{
	wp_enqueue_code_editor( array( 'type' => 'text/html' ) );
	wp_enqueue_script('cm_emmet', 'https://cdn.jsdelivr.net/npm/@emmetio/codemirror-plugin@0.5.4/dist/emmet-codemirror-plugin.min.js', array(), '0.5.4');
	wp_add_inline_script('cm_emmet', 'let CodeMirror = wp.CodeMirror;', 'before');
	wp_enqueue_script('templateq_backend', get_template_directory_uri() . '/backend/script.js', array(), '0.0.1');
}
add_action('admin_enqueue_scripts', 'templateq_enqueue_admin');

/** Frontend */
function templateq_enqueue()
{
	// Remove block library (Gutenberg)
	wp_deregister_style('wp-block-library');

	// Pull latest jQuery
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', array(), '3.3.1');

	// Pull custom CSS
	wp_enqueue_style('templateq_css', get_template_directory_uri() . '/dist/css/main.min.css', array(), '0.0.1');
	wp_enqueue_style('bulma-switch', 'https://cdn.jsdelivr.net/npm/bulma-extensions@6.2.4/bulma-switch/dist/css/bulma-switch.min.css', array(), '6.2.4');
	wp_enqueue_style('fontawesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5/css/all.min.css', array(), '5.8.1');
	wp_enqueue_style('bulma-tooltip', 'https://cdn.jsdelivr.net/npm/bulma-tooltip@2.0.2/dist/css/bulma-tooltip.min.css', array(), '2.0.2');

	// Pull custom JS
	wp_enqueue_script('templateq_codeview', get_template_directory_uri() . '/js/codeview.js', array('jquery'), '0.0.1');
	wp_enqueue_script('templateq_submenu', get_template_directory_uri() . '/js/submenu.js', array('jquery'), '0.0.1');
	wp_enqueue_script('templateq_tabview', get_template_directory_uri() . '/js/tabview.js', array('jquery'), '0.0.1');

	// Dennismode && Darkmode && Linewrap
	wp_enqueue_script('cookies', 'https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js', array(), '2');
	wp_enqueue_script('templateq_dennisMode', get_template_directory_uri() . '/js/dennisMode.js', array('cookies'), '0.0.1');
	wp_enqueue_script('templateq_darkMode', get_template_directory_uri() . '/js/darkMode.js', array('cookies'), '0.0.1');
	wp_enqueue_script('templateq_lineWrap', get_template_directory_uri() . '/js/lineWrap.js', array('cookies'), '0.0.1');

	// Custom Scrollbars
	wp_enqueue_script('simplebar', 'http://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js', array(), 'latest');
	wp_enqueue_style('simplebar', 'http://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css', array(), 'latest');

	// Pull Rainbow
	wp_enqueue_script('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js', array(), '1.2.0');
	wp_enqueue_script('rainbow-generic', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_script('rainbow-html', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_script('rainbow-css', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/css.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_script('rainbow-js', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.min.js', array('rainbow'), '1.2.0');
	wp_enqueue_style('rainbow', 'https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.min.css', array('templateq_css'), '1.2.0');
}
add_action('wp_enqueue_scripts', 'templateq_enqueue');

/** Recent Changes */
function templateq_recent_updates()
{
	$loop = new WP_Query(array(
		'post_type' => 'page',
		'orderby' => 'modified'
	));

	$counter = 0;

	$string = '<table class="table"><tbody>';

	while ($loop->have_posts() && $counter < 5) {
		$loop->the_post();
		$string .= '<tr><td><a href="' . get_permalink($loop->post->ID) .'">' . get_the_title($loop->post->ID) . '</a></td>';
		$string .= '<td><small>(' . get_the_modified_date() . ')</small></td>';
		$string .= '<td>' . get_the_modified_author() . '</td></tr>';
		$counter++;
	}

	$string .= '</tbody></table>';
	return $string;
}

/** Snippet post type */

function templateq_snippet_taxonomies()
{
	$tax_options = array(
		'labels' => array(
			'name'          => 'Kategorien',
			'singular_name' => 'Kategorie'
		),
		'hierarchical' => true
	);

	register_taxonomy(
		'vscode_taxonomy',
		array('vscode_snippet'),
		$tax_options
	);
}
add_action('init', 'templateq_snippet_taxonomies');

function templateq_crb_attach_snippet_options()
{
	Container::make('post_meta', 'Snippet')
		->where('post_type', '=', 'vscode_snippet')
		->add_fields(array(
			Field::make('multiselect', 'scope', 'Scopes')
				->add_options(array(
					'css' => 'CSS',
					'html' => 'HTML',
					'javascript' => 'Javascript'
				)),

			Field::make('text', 'prefix', 'Prefix'),

			Field::make('textarea', 'body', 'Body')
				->set_attribute('data-editor'),

			Field::make('text', 'description', 'Description')
		));
}
add_action('carbon_fields_register_fields', 'templateq_crb_attach_snippet_options');

function templateq_snippet_post_type()
{
	register_post_type('vscode_snippet', array(
		'labels' => array(
			'name' => 'VSCode Snippets',
			'singular_name' => 'VSCode Snippet'
		),
		'public' => true,
		'has_archive' => false
	));
}
add_action('init', 'templateq_snippet_post_type');

/** Custom Menu Walker */
class Templateq_Nav_Walker extends Walker_Page
{
	public function start_lvl(&$output, $depth=0, $args=array())
	{
		if ($depth == 0) {
			$output .= '<div class="navbar-dropdown">';
		}
	}

	public function start_el(&$output, $page, $depth=0, $args=array(), $id=0)
	{
		$children = count(get_pages(array('child_of' => $page->ID)));

		if ($depth == 0) {
			$output .= '	<div class="navbar-item is-hoverable' . ($children > 0 ? ' has-dropdown' : '') . '">';
			$output .= '		<div class="navbar-link">';
			$output .= '			<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>';
			$output .= '		</div>';
		} elseif ($depth == 1) {
			if ($children > 0) {
				$output .= '	<hr class="navbar-divider">';
			}
			$output .= '	<a href="' . get_permalink($page->ID) . '" class="navbar-item' . ($children > 0 ? ' has-text-weight-bold' : '') . '">' . $page->post_title . '</a>';
		} else {
			$output .= '	<a href="' . get_permalink($page->ID) . '" class="navbar-item" style="padding-left: 2rem">' . $page->post_title . '</a>';
		}
	}

	public function end_el(&$output, $page, $depth=0, $args=array(), $id=0)
	{
		$children = count(get_pages(array('child_of' => $page->ID)));

		if ($depth == 0) {
			$output .= '	</div>';
		} else {
			if ($children > 0) {
				$output .= '	<hr class="navbar-divider">';
			}
		}
	}

	public function end_lvl(&$output, $depth=0, $args=array())
	{
		if ($depth == 0) {
			$output .= '</div>';
		}
	}
}

class Templateq_Walker extends Walker_Page
{
	public function start_lvl(&$output, $depth=0, $args=array())
	{
		$output .= '<ul class="menu-list">';
	}

	public function start_el(&$output, $page, $depth=0, $args=array(), $id=0)
	{
		// has children?
		$children = count(get_pages(array('child_of' => $page->ID)));

		$link = '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>';

		if ($depth == 0) {
			$output .= '<p class="menu-label">' . $link . '</p>';
			return;
		}

		$output .= '<li>' . $link;
	}

	public function end_el(&$output, $page, $depth=0, $args=array())
	{
		if ($depth != 0) {
			$output .= '</li>';
		}
	}
}

/** Split Nav Walker */
class Templateq_Split_Nav_Topnav_Walker extends Walker_Page
{
	public function start_lvl(&$output, $depth=0, $args=array())
	{
	}

	public function start_el(&$output, $page, $depth=0, $args=array(), $id=0)
	{
		$children = count(get_pages(array('child_of' => $page->ID)));

		if ($depth == 0) {
			$output .= '	<div class="navbar-item is-hoverable">';
			$output .= '		<div class="navbar-link">';
			$output .= '			<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a>';
			$output .= '		</div>';
			$output .= '    </div>';
		}
	}

	public function end_el(&$output, $page, $depth=0, $args=array(), $id=0)
	{
	}

	public function end_lvl(&$output, $depth=0, $args=array())
	{
	}
}
