<?php

function bulmaFormText($attr)
{
	$output = '';

	$output .= '<div class="field has-addons">';
	$output .= '	<p class="control"><button class="button is-static">' . $attr['label'] . '</button></p>';
	$output .= '	<div class="control">';
	$output .= '		<input name="' . $attr['name'] . '" type="text" class="input" placeholder="' . $attr['placeholder'] . ' value="' . $attr['value'] . '">';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}