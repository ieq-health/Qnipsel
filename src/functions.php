<?php

/** Set version
 * Used for cachebusting JS/CSS
 */
$GLOBALS['qnipsel_version'] = '0.18.2';

/** Custom Fields
 * Set up the Custom Fields plugin and define some fields.
 */
require_once(__DIR__ . '/include/fields.php');

/** TinyMCE
 * Extend TinyMCE for our needs
 */
require_once(__DIR__ . '/include/tinymce.php');

/** Walkers
 * Declare our own menu walkers
 */
require_once(__DIR__ . '/include/walkers/pagesearch_walker.php');
require_once(__DIR__ . '/include/walkers/split_nav_sidenav_walker.php');
require_once(__DIR__ . '/include/walkers/split_nav_topnav_walker.php');


/** Post Types
 * Create our own post types and taxonomy
 */
require_once(__DIR__ . '/include/vscode_snippets.php');
require_once(__DIR__ . '/include/userscripts.php');

/** Autoshy
 * Keep a list of strings that should get &shy; added to them
 */
require_once(__DIR__ . '/include/autoshy.php');

/** Cleanup
 * Remove some stuff from the backend
 */
require_once(__DIR__ . '/include/cleanup.php');

/** Styles & Scripts
 * Enqueue stylesheets and javascript in both front and backend
 */
require_once(__DIR__ . '/include/enqueue.php');

/** Fractals
 * Include some template helper functions
 */
require_once(__DIR__ . '/fractals/icons.php');
require_once(__DIR__ . '/fractals/bulma/code.php');
require_once(__DIR__ . '/fractals/bulma/codeview.php');
require_once(__DIR__ . '/fractals/bulma/forms.php');
require_once(__DIR__ . '/fractals/bulma/message.php');
require_once(__DIR__ . '/fractals/bulma/text.php');

/**
 * Allow more file types
 */

add_filter('upload_mimes', function ($mime_types) {
	$mime_types['svg'] = 'image/svg+xml';
	$mime_types['psd'] = 'image/vnd.adobe.photoshop';
	return $mime_types;
}, 1, 1);

/**
 * Supporting scripts and styles
 */

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

/**
 * Enable Access from CMS
 */
function initCors($value)
{
	header('Access-Control-Allow-Origin: https://www.cmsq.ieq-health.de');
	header('Access-Control-Allow-Methods: GET, OPTIONS');
	header('Access-Control-Allow-Credentials: true');

	if ('OPTIONS' == $_SERVER['REQUEST_METHOD']) {
		status_header(200);
		exit();
	}

	return $value;
}

add_action('rest_api_init', function () {
	remove_filter('rest_pre_serve_request', 'rest_send_cors_headers');
	add_filter('rest_pre_serve_request', initCors);
}, 15);
