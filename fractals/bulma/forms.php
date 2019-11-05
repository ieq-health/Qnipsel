<?php

function _parseAttr($attr)
{
	return join(
		' ',
		array_map(function($key) use ($attr) { return $key . '="' . $attr[$key] . '"'; }, array_keys($attr))
	);
}

function fractalFormText($attr)
{
	$output =  '<div class="field has-addons">';

	if ($attr['label']) {
		$output .= '	<p class="control"><button class="button is-static">' . $attr['label'] . '</button></p>';
	}

	$output .= '	<div class="control">';
	$output .= '		<input type="text" class="input" ' . _parseAttr($attr) . '>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}

function fractalFormTextarea($attr)
{
	$output =  '<div class="field">';

	if ($attr['label']) {
		$output .= '	<label class="label">' . $attr['label'] . '</label>';
	}

	$output .= '	<div class="control">';
	$output .= '		<textarea class="textarea has-border" ' . _parseAttr($attr) . '></textarea>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}

function fractalFormCheckbox($attr)
{
	$output =  '<label class="checkbox">';
	$output .= '	<input type="checkbox" class="checkbox" ' . _parseAttr($attr) . '>';
	$output .= '	' . $attr['label'];
	$output .= '</label>';

	return $output;
}