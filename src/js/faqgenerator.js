let faqcount = 1; // start count number

$('.faq-add').click(function() {
    faqcount++; // count elements

    let faq = [
        '<div class="faq__item columns">',
            '<div class="faq__item__content column">',
                '<div class="control is-expanded">',
                    '<input type="text" class="input" name="question_' + faqcount + '" placeholder="Frage">',
                '</div>',
                '<div class="control is-expanded">',
                    '<input type="text" class="input" name="answer_' + faqcount + '" placeholder="Antwort">',
                '</div>',
            '</div>',
            '<button class="faq__item__delete button is-danger is-outlined"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg></button>',
        '</div>'
        ].join("\n");

    $('.faq').append(faq); // add another faq
});


$('.faq').bind('DOMNodeInserted DOMNodeRemoved', function() {   //listen on change and add remove event
    $('.faq__item__delete').click(function(e) {
        $(this).parent().remove();
    });
});

$('.faq-generate').click(function(){  // generate json

    let jsonFAQ = {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": []
           };
    
           

    $('.faq__item__content').each(function () {
        let questionVals = $(this).find('input[name^="question"').val();
        let answerVals = $(this).find('input[name^="answer"').val();
    
        let jsonFAQItem = {
            "@type": "Question",
            "name": questionVals,
            "acceptedAnswer": {
                "@type": "Answer",
                "text": answerVals
            }
        }

        jsonFAQ.mainEntity.push(jsonFAQItem);
       
    });            

    $('.faq-generator__output').val(`
        <script type="application/ld+json">
            ${JSON.stringify(jsonFAQ)}
        <\/script>`);

});
