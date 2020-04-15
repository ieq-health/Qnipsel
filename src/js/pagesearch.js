$('.page-search .input').on('input', function() {
  const searchterm = $(this).val();

  $('.page-search__results a').each(function() {
    $(this).toggleClass('match', $(this).html().includes(searchterm));
  });
});