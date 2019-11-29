//
// ─── HELPER ─────────────────────────────────────────────────────────────────────
//

const cmOpts = {
	lineNumbers: false,
	lineWrapping: true,
	markTagPairs: true,
	autoRenameTags: true,
	autoCloseBrackets: true,
	extraKeys: {
		'Tab': 'emmetExpandAbbreviation',
		'Enter': 'emmetInsertLineBreak',
		'Ctrl-Space': 'autocomplete'
	}
};

function translateMode (mode) {
	let output;
	switch (mode) {
		case 'js':   output = 'javascript'; break;
		case 'html': output = 'htmlmixed'; break;
		default:     output = mode;
	}
	return output;
}

//
// ─── CODE BLOCKS ────────────────────────────────────────────────────────────────
//
	
function makeCodeEditor () {
	let $textarea = jQuery(this).parent().parent().next().find('textarea');
	let lang = translateMode(jQuery(this).val());

	// If editor exists, change mode
	if ($textarea.siblings('.CodeMirror').length > 0) {
		$textarea.siblings('.CodeMirror')[0].CodeMirror.setOption('mode', lang);
		return;
	}

	wp.codeEditor.initialize($textarea[0], { codemirror: {
		mode: lang,
		...cmOpts
	}});
}

jQuery(function() {
	jQuery('input[name*=language]').each(makeCodeEditor);
	jQuery('#carbon_fields_container_sections').on('blur', 'input[name*=language]', makeCodeEditor);
});


//
// ─── CODEPEN ────────────────────────────────────────────────────────────────────
//

function makeCodepenEditor () {
	setTimeout(() => {
		jQuery('textarea[data-editor]').each(function() {
			if (jQuery(this).siblings('.CodeMirror').length > 0) return;

			wp.codeEditor.initialize(this, { codemirror: {
				mode: translateMode(jQuery(this).data('editor')),
				...cmOpts
			}});
		});
	}, 100);
}

jQuery(function() {
	jQuery('.cf-complex__inserter-item').on('click', makeCodepenEditor);
	makeCodepenEditor();
});