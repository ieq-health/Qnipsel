(function() {
  console.log('adding plugin')
  tinymce.PluginManager.add('templateq_code_button', function(editor, url) {
    editor.addButton('templateq_code_button', {
      title: 'Code',
      icon: 'wp_code',
      onclick: function() {
        editor.focus();
        editor.selection.setContent('<code>' + editor.selection.getContent() + '</code>');
      }
    });
  });
})();