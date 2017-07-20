$(function (){
  $(".dropdown").click(function() {
    $(".dropdown-content").toggle();
  });

  $(window).click(function(ev) {
    if($(ev.target).attr('class') != "dropdown" && $(ev.target).attr('class') != "openNav") {
        $(".dropdown-content").hide();
     }
  });

  $(".closeFinish").click(function(event) {
    $(".modalFinish").hide();
  });
});
