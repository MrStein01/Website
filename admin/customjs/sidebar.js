$(function() {
  $(".openNa").click(function() {
    if ($(".sidebar").css('width', 'o')) {
        if($(window).width() > '600')
        {
            $(".sidebar").css('width', '250px');
        }
        else
        {
            $(".sidebar").css('width', '100%');
        }
      $(".sidebar").css('width', '250px');
    }
    else {
      $(".sidebar").css('width', '0');
    }
  });

  $(".closebtn").click(function() {
    $(".sidebar").css('width', '0px');
  });

  /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
  $(".navigationOpen").click(function() {
      if($(window).width() > '600')
        {
            $("#menue").css('width', '250px');
            $("#content").css('margin-left',"250px");
        }
        else
        {
            $("#menue").css('width', '100%');
        }
  });

  /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
  $(".navigationClose").click(function() {
      $("#menue").css('width',"0");
      $("#content").css('margin-left',"0");
  });

});
