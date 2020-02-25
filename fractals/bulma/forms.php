<?php

function _parseAttr($attr)
{
	return join(
		' ',
		array_map(function ($key) use ($attr) {
			if ($key != 'label') {
				return $key . '="' . $attr[$key] . '"';
			}
		}, array_keys($attr))
	);
}

function _addLabel($attr)
{
	if (is_array($attr['label'])) {
		$required = $attr['label']['required'];
	} else {
		$required = false;
	}

	$label = (is_array($attr['label']) ? $attr['label']['string'] : $attr['label']);
	$required = (is_array($attr['label']) ? $attr['label']['required'] : false);

	if ($required) {
		$label .= ' *';
	}

	if ($attr['label']) {
		return '	<label for="' . $attr['name'] . '" class="label">' . $label . '</label>';
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
	$output .= '	<input id="' . $attr['name'] . '"';
	$output .= '	       type="checkbox"';
	$output .= '	       class="checkbox switch is-small is-rounded"';
	$output .= _parseAttr($attr);
	$output .= '>';
	$output .= _addLabel($attr);
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
