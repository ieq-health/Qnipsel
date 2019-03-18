<div class="container">
	<div class="content">
		<h1 class="title"><?php the_title(); ?></h1>
	</div>
</div>

<div class="container-fluid">
	<div class="columns">
		<div class="column"><textarea class="textarea" name="" id="input" cols="30" rows="10"></textarea></div>
		<div class="column"><textarea class="textarea" name="" id="output" cols="30" rows="10"></textarea></div>
	</div>
</div>

	<script>
		$(function() {
			$('#input').on('input propertychange', function() {
				let xml = $(this).val();

				xml = xml.replace(/.*<lastmod.*\n/g, '');
				xml = xml.replace(/.*<priority.*\n/g, '');

				$('#output').val(xml);
			});
		});
	</script>
</div>