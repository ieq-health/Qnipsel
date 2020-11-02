$(".faq-add").click(function() {

	let faqItem = $(`
<div class="faq__item">
	<div class="faq__item__content">
		<div class="control is-expanded">
			<input type="text" class="input" placeholder="Frage">
		</div>
		<div class="control is-expanded">
			<input type="text" class="input" placeholder="Antwort">
		</div>
	</div>
	<button class="button is-danger faq__item__delete">${icons.delete}</button>
</div>
	`);

	$("button", faqItem).on("click", function () {
		faqItem.remove();
	})

	$(".faq").append(faqItem);
});

$(".faq__item__delete").on("click", function () {
	$(this).parent().remove();
});

$(".faq-generate").click(function(){
	// generate json

	const jsonFAQ = {
		"@context": "https://schema.org",
		"@type": "FAQPage",
		mainEntity: [],
	};

	$(".faq__item__content").each(function () {
		const questionVals = $(this).find('input[name^="question"').val();
		const answerVals = $(this).find('input[name^="answer"').val();

		const jsonFAQItem = {
			"@type": "Question",
			name: questionVals,
			acceptedAnswer: {
				"@type": "Answer",
				text: answerVals,
			},
		};

		jsonFAQ.mainEntity.push(jsonFAQItem);
	});

	$(".faq-generator__output").val(`
<script type="application/ld+json">
	${JSON.stringify(jsonFAQ, null, 2)}
</script>
	`);
	$(".faq-generator__output").select();
	document.execCommand("copy");

	$(".copied-notification").fadeIn("slow");
	setTimeout(function () {
		$(".copied-notification").fadeOut("slow");
	}, 1000);
});
