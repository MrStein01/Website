$(function() {

    $("#menu").click(function() {
      if ($(window).width() < 600) {
        if (!$("#localmenu").is(':visible')) {
          $("#localmenu").show();
          $("#localmenu").css('height', '200px');
        }
        else {
          /*$("#localmenu").css('height', '0px');
          $("#localmenu").hide();*/
        }
      }
    });

    $(window).click(function(ev) {
      if ($(window).width() < 600) {
        if($(ev.target).attr('id') != "menu") {
          $("#localmenu").css('height', '0px');
          $("#localmenu").hide();
        }
     }
    });

    $(window).resize(function() {
      if ($(window).width() > 600) {
        $("#localmenu").show();
      }
      else {
        $("#localmenu").hide();
      }
    });

});
