function makeCodeEditor () {
  let $textarea = $(this).parent().parent().next().find('textarea');
  let lang = (function(input) {
    switch (input) {
      case 'js':   'javascript'; break;
      case 'html': 'htmlmixed'; break;
      default: input;
    }
  })($(this).val());

  // If editor exists, change mode
  if ($textarea.siblings('.CodeMirror').length > 0) {
    $textarea.siblings('.CodeMirror')[0].setOption('mode', lang);
    return;
  }

  wp.codeEditor.initialize($textarea[0], {
    lineNumbers: false,
    mode: lang
  });
}

$(function() {
  $('input[name*=language]').each(makeCodeEditor);
  $('#carbon_fields_container_sections').on('blur', 'input[name*=language]', makeCodeEditor);
});