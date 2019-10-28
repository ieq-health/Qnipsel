<?php
	function parseBody ($body) {
		$output = '';

		foreach (explode('<br />', nl2br($body)) as $line) {
			$line = str_replace('"', '\"', $line);
			$line = preg_replace('/\t/', '\t', $line);
			$line = preg_replace('/\s\s+/', ' ', $line);
			$output .= '      "' . trim($line) . '",
';
		}

		return $output;
	}

	function parseDescription ($desc) {
		if ($desc != '') {
			return '
    "description": "' . $desc . '"';
		}
	}


	// make tabs
	$tabs = '';
	$tabContents = '';
	foreach (get_terms('vscode_taxonomy') as $category) {
		// Create tab
		$tabs .= '<li><a href="#' . $category->slug . '">' . $category->name . '</a></li>';

		// Create code block
		$snippets = new WP_Query(array(
			'post_type' => 'vscode_snippet',
			'tax_query' => array(array(
				'taxonomy' => 'vscode_taxonomy',
				'terms' => array($category->slug),
				'field' => 'slug'
			))
		));

		$tabContents .= '<div id="' . $category->slug . '">';
		// code block id
		$id = bin2hex(random_bytes(8));

		$tabContents .= '<a class="has-text-grey-light has-text-weight-bold is-uppercase copy-code-button" onclick="copyCode(\'' . $id . '\')">Copy</a>';

		$tabContents .= '<pre><code id="code_' . $id . '" data-language="json">
{
';

		while ($snippets->have_posts()) {
			$snippets->the_post();

			$tabContents .=
'  "' . htmlspecialchars(get_the_title()) .'": {
    "scope": "' . implode(',', carbon_get_the_post_meta('scope')) . '",
    "prefix": "' . carbon_get_the_post_meta('prefix') . '",
    "body": [
' . htmlspecialchars(parseBody(carbon_get_the_post_meta('body'))) .
'    ],' .
parseDescription(carbon_get_the_post_meta('description')) . '
  },
';
		}

		$tabContents .= '}';
		$tabContents .= '</code></pre>';
		$tabContents .= '</div>';
	}
?>

<?php get_header(); ?>
<div id="site-container">
	<main>
		<?php if (have_posts()): ?>
			<?php while (have_posts()): the_post(); ?>
				<div class="container">
					<div class="content">
						<h1 class="title"><?php the_title(); ?></h1>
					</div>

					<div class="tabview">
						<div class="tabs">
							<ul>
								<?= $tabs ?>
							</ul>
						</div>
						<div class="tab-content">
							<?= $tabContents ?>
						</div>
					</div>


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
				</div>

			<?php endwhile; ?>
		<?php endif; ?>
	</main>
</div>

<footer class="footer has-text-centered">
	<?php the_author(); ?> | <?= the_date(); ?> &mdash; <?php the_modified_author(); ?> | <?= the_modified_date(); ?>
</footer>
