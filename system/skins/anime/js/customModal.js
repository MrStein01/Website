$(function (){
  $(".openCusModal").click(function(event) {
    $(".customModal").css('display', 'block');
  });

  $(".closeCusModal").click(function(event) {
    $(".customModal").css('display', 'none');
  });

  $(window).click(function(ev) {
		if($(ev.target).attr('class') == "customModal") {
				$(".customModal").hide();
		 }
	});
});
