<?php

function bulmaFormText($attr)
{
	$attributes = join(
		' ',
		array_map(function($key) use ($attr) { return $key . '="' . $attr[$key] . '"'; }, array_keys($attr))
	);

	$output =  '<div class="field has-addons">';
	$output .= '	<p class="control"><button class="button is-static">' . $attr['label'] . '</button></p>';
	$output .= '	<div class="control">';
	$output .= '		<input type="text" class="input" ' . $attributes . '>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}