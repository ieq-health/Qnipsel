<?php

class Templateq_Split_Nav_Sidenav_Walker extends Walker_Page
{
	public function start_lvl(&$output, $depth = 0, $args = array())
	{
		$output .= '<ul class="menu-list">';
	}

	public function start_el(&$output, $page, $depth = 0, $args = array(), $id = 0)
	{
		$class = ($page->ID == $id) ? 'is-active' : '';
		$link = '<a href="' . get_permalink($page->ID) . '" class="' . $class . '">' . $page->post_title . '</a>';
		$output .= '<li>' . $link;
	}

	public function end_el(&$output, $page, $depth = 0, $args = array())
	{
		$output .= '</li>';
	}
}
