$(function() {
    $('.codeview__code').each(function() {
	let $tabs = $(this).find('.tabs a');
	let $tabcontents = $(this).find('.tab-content > div');

	$tabs.on('click', function(e) {
	    let $target = $($(this).attr('href'));

	    $tabs.parent('li').removeClass('is-active');
	    $tabcontents.removeClass('is-active');

	    $(this).parent('li').addClass('is-active');
	    $target.addClass('is-active');

	    e.preventDefault();
	});
    });
});
