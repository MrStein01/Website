$(function(){
  $(".login").click(function () {
		/* Das Modal Fenster zeigen */
		$(".modal").toggle();
	});

  $('.toggle').on('click', function() {
    $('.container').stop().addClass('active');
    $('.container').stop().removeClass('activeFP');
  });

  $('.toggleFP').on('click', function() {
    $('.container').stop().addClass('activeFP');
    $('.container').stop().removeClass('active');
  });

  $('.close').on('click', function() {
    $('.container').stop().removeClass('active');
  });

  $('.closeFP').on('click', function() {
    $('.container').stop().removeClass('activeFP');
  });

	$(window).click(function(ev) {
		if($(ev.target).attr('class') == "modal") {
				$(".modal").hide();
		 }
	});
});
