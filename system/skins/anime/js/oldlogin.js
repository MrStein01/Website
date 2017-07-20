$(function () {

	$(".login").click(function () {
		/* Das Modal Fenster zeigen */
		$(".error").text("");
		$(".modal-content-register").hide();
		$(".modal-content-forgot").hide();
		$(".modal-content").show();
		$(".modal").show();
	});

	$(".cancelbtn").click(function() {
		/* Das Modal Fenster schließen */
		if($(".modal-content").is(":visible")) {
			$(".modal").hide();
		}
		else if($(".modal-content-forgot").is(":visible")) {
			$(".modal-content-forgot").fadeOut('400');
			$(".modal-content").fadeIn('400');
		}
		else {
			$(".modal-content-register").fadeOut('400');
			$(".modal-content").fadeIn('400');
		}
	});

	$(".close").click(function() {
		/* Das Modal Fenster schließen */
		$(".modal").hide();
	});

	$(window).click(function(ev) {
		if($(ev.target).attr('class') == "modal") {
				$(".modal").hide();
		 }
	});

	$(".linkpsw").click(function() {
		$(".modal-content").fadeOut('400');
			$(".modal-content-forgot").fadeIn('400');
	});

	$(".linkrgt").click(function() {
		$(".modal-content").fadeOut('400');
			$(".modal-content-register").fadeIn('400');
	});
});
