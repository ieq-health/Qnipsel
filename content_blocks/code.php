<?php

function templateq_code_block($lang, $code)
{
	$id = bin2hex(random_bytes(8)); ?>
	<a class="button is-small is-link copy-code-button" onclick="copyCode('<?= $id ?>')">Copy</a>
	<pre><code id="code_<?= $id ?>" data-language="<?= $lang ?>"><?= htmlspecialchars($code) ?></code></pre>

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