$(function() {
  $(".settings").click(function(event) {
    $(".profileWindow").hide();
    $(".settingsWindow").show();
  });

  $(".cancelbtn").click(function() {
		/* Das Modal Fenster schließen */
		if($(".settings-content").is(":visible")) {
			$(".settingsWindow").hide();
		}
	});

  $(".close").click(function() {
		/* Das Modal Fenster schließen */
		$(".settingsWindow").hide();
	});

  $(window).click(function(ev) {
		if($(ev.target).attr('class') == "settingsWindow") {
				$(".settingsWindow").hide();
		 }
	});
});
