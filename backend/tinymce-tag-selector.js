(function () {
	tinymce.PluginManager.add("templateq_tag_selector", function (editor, url) {
		function makeTag(color) {
			editor.focus();
			editor.selection.setContent('<span class="tag is-' + color + '">' + editor.selection.getContent() + "</span>");
		}

		editor.addButton("templateq_tag_selector", {
			title: "Tag",
			icon: "wp_page",
			type: "menubutton",
			menu: [{
        text: "Info",
        value: "Info",
        onclick: function () { makeTag("info") },
      },
      {
        text: "Success",
        value: "Success",
        onclick: function () { makeTag("success") },
      },
      {
        text: "Warning",
        value: "Warning",
        onclick: function () { makeTag("warning") },
      },
      {
        text: "Danger",
        value: "Danger",
        onclick: function () { makeTag("danger") },
      }],
		});
	});
})();
