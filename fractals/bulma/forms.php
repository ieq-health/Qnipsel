<?php

function _parseAttr($attr)
{
	return join(
		' ',
		array_map(function($key) use ($attr) { if ($key != 'label') return $key . '="' . $attr[$key] . '"'; }, array_keys($attr))
	);
}

function _addLabel($attr)
{
	if ($attr['label']) {
		return '	<label class="label">' . $attr['label'] . '</label>';
	}
}

function fractalFormText($attr)
{
	$output =  '<div class="field">';
	$output .= _addLabel($attr);
	$output .= '	<div class="control is-expanded">';
	$output .= '		<input type="text" class="input" ' . _parseAttr($attr) . '>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}

function fractalFormTextarea($attr)
{
	$output =  '<div class="field">';
	$output .= _addLabel($attr);
	$output .= '	<div class="control">';
	$output .= '		<textarea class="textarea has-border" ' . _parseAttr($attr) . '></textarea>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}

function fractalFormCheckbox($attr)
{
	$output =  '<div class="field">';
	$output .= '	<input id="' . $attr['name'] . '" type="checkbox" class="checkbox switch is-small is-rounded" ' . _parseAttr($attr) . '>';
	$output .= '	<label for="' . $attr['name'] . '" class="checkbox">';
	$output .= '		' . $attr['label'];
	$output .= '	</label>';
	$output .= '</div>';

	return $output;
}

function fractalFormSelect($attr)
{
	$output = '<div class="field">';
	$output .= _addLabel($attr);
	$output .= '	<div class="select is-fullwidth">';
	$output .= '		<select name="' . $attr['name'] . '">';

	for ($i=0; $i < ( count($attr['options']) - 1 ); $i++) { 
		$option = $attr['options'][$i];
		$output .= '		<option value="' . $option['value'] . '">' . $option['label'] . '</option>';
	}

	$output .= '		</select>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}