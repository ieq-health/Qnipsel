<?php

function _parseAttr($attr)
{
	return join(
		' ',
		array_map(function ($key) use ($attr) {
			if ($key != 'label' && $key != 'classes' && $key != 'borderless' && $key != 'addon') {
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

function fractalFormTextAddon($attr)
{
	$output =  '<div class="field">';
	$output .= _addLabel($attr);
	$output .=  '	<div class="field has-addons">';
	$output .= '		<div class="control">';
	$output .= '			<span id="addon-' . $attr['name'] . '" class="button is-static">';
	$output .= $attr['addon'];
	$output .= '			</span>';
	$output .= '		</div>';
	$output .= '		<div class="control is-expanded">';
	$output .= '			<input type="text" class="input" ' . _parseAttr($attr) . '>';
	$output .= '		</div>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}

function fractalFormTextarea($attr)
{
	$classes = "textarea";

	if (!(array_key_exists('borderless', $attr) && $attr['borderless'] == true)) {
		$classes .= ' has-border';
	}

	if (array_key_exists('classes', $attr)) {
		$classes .= ' ' . $attr['classes'];
	}

	$output =  '<div class="field">';
	$output .= _addLabel($attr);
	$output .= '	<div class="control">';
	$output .= '		<textarea class="' . $classes . '" ' . _parseAttr($attr) . '></textarea>';
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

	if (array_key_exists('multiple', $attr) && $attr['multiple'] == true) {
		$output .= '	<div class="select is-fullwidth is-multiple">';
		$output .= '		<select name="' . $attr['name'] . '" multiple>';
	} else {
		$output .= '	<div class="select is-fullwidth">';
		$output .= '		<select name="' . $attr['name'] . '">';
	}

	for ($i=0; $i < count($attr['options']); $i++) {
		$option = $attr['options'][$i];
		$output .= '		<option value="' . $option['value'] . '">' . $option['label'] . '</option>';
	}

	$output .= '		</select>';
	$output .= '	</div>';
	$output .= '</div>';

	return $output;
}
