<?php

class Templateq_Pagesearch_Walker extends Walker_Page
{
	public function start_lvl(&$output, $depth = 0, $args = array())
	{
	}

	public function start_el(&$output, $page, $depth = 0, $args = array(), $id = 0)
	{
		$output .= '<li><a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';
	}

	public function end_el(&$output, $page, $depth = 0, $args = array())
	{
	}

	public function end_lvl(&$output, $depth = 0, $args = array())
	{
	}
}
