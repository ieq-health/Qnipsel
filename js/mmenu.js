$(function() {
  $("#menu").mmenu({
    extensions: ["theme-dark"],
    navbar: false,
    offCanvas: false,
    slidingSubmenus: false
  });
  
  $(".mm-listview .current_page_ancestor").addClass("mm-listitem_opened");
  $(".mm-listview .current_page_item").parents(".mm-panel").removeClass("mm-hidden");
});
