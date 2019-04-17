function makeCodeEditor () {
  let lang = $(this).val();
  let $textarea = $(this).parent().parent().next().find('textarea');

  wp.codeEditor.initialize($textarea[0], {
    lineNumbers: false,
    mode: lang
  });
}

$(function() {
  $('input[name*=language]').each(makeCodeEditor);
  $('#carbon_fields_container_sections').on('blur', 'input[name*=language]', makeCodeEditor);
});