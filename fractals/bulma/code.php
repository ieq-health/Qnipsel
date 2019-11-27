<?php

function templateq_code_block($lang, $code)
{
	$id = bin2hex(random_bytes(8)); ?>
	<a class="has-text-grey-light has-text-weight-bold is-uppercase copy-code-button" onclick="copyCode('<?= $id ?>')">Copy</a>
	<pre data-simplebar>
		<code id="code_<?= $id ?>" data-language="<?= $lang ?>"><?= htmlspecialchars($code) ?></code>
	</pre>

	<script>
		function copyCode(id) {
			let $tmp = $('<textarea>');
			$('body').append($tmp);

			$tmp.val($('#code_' + id).text());

			$tmp.select();
			document.execCommand('copy');
			$tmp.remove();
		}
	</script>
<?php }