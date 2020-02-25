<?php

function templateq_message_block($style, $title, $body)
{
	$output = '';
	$output .= '<div class="message is-' . $style . '">';

	if (!empty($title)) {
		$output .= '<div class="message-header">' . $title . '</div>';
	}

	$output .= '<div class="message-body content">';
	$output .= $body;
	$output .= '</div></div>';

	return $output;
}
