let faqcount = 1; // start count number

$('.faq-add').click(function() {
    faqcount++; // count elements

    let faq = [
        '<div class="faq__item">',
            '<div class="faq__item__content">',
                '<div class="control is-expanded">',
                    '<input type="text" class="input" name="question_' + faqcount + '" placeholder="Frage">',
                '</div>',
                '<div class="control is-expanded">',
                    '<input type="text" class="input" name="answer_' + faqcount + '" placeholder="Antwort">',
                '</div>',
            '</div>',
            '<span class="faq__item__delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M3 6v18h18v-18h-18zm5 14c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4-18v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712z"/></svg></span>',
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

    $('.faq-generator__output').val(`<script type="application/ld+json">${JSON.stringify(jsonFAQ,null,'\t')}<\/script>`);
});
