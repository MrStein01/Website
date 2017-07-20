$(function() {
  $(".profile").click(function() {
    $(".settingsWindow").hide();
    $(".profileWindow").show();
  });

  $(".cancelbtn").click(function() {
		/* Das Modal Fenster schließen */
		if($(".profile-content").is(":visible")) {
			$(".profileWindow").hide();
		}
	});

  $(".close").click(function() {
		/* Das Modal Fenster schließen */
		$(".profileWindow").hide();
	});

  $(window).click(function(ev) {
		if($(ev.target).attr('class') == "profileWindow") {
				$(".profileWindow").hide();
		 }
	});

  function tog(v){return v?'addClass':'removeClass';}
  $(document).on('input', '.clearable', function(){
      $(this)[tog(this.value)]('x');
  }).on('mousemove', '.x', function( e ){
      $(this)[tog(this.offsetWidth-18 < e.clientX-this.getBoundingClientRect().left)]('onX');
  });

  $(document).on('touchstart click', '.prNickContxt.onX', function( ev ){
      ev.preventDefault();
      $(this).removeClass('onX').hide().change();
      $(".prNickCon").show();
  });

  $(document).on('touchstart click', '.prNameContxt.onX', function( ev ){
      ev.preventDefault();
      $(this).removeClass('onX').hide().change();
      $(".prNameCon").show();
  });

  $(document).on('touchstart click', '.prEmailContxt.onX', function( ev ){
      ev.preventDefault();
      $(this).removeClass('onX').hide().change();
      $(".prEmailCon").show();
  });

  // $('.clearable').trigger("input");
  // Uncomment the line above if you pre-fill values from LS or server

  $(".prNickCon").click(function() {
    $(".prNickCon").hide();
    $(".prNickContxt").val($(".prNickCon").text());
    $(".prNickContxt").show();
  });

  $(".prNameCon").click(function() {
    $(".prNameCon").hide();
    $(".prNameContxt").val($(".prNameCon").text());
    $(".prNameContxt").show();
  });

  $(".prEmailCon").click(function() {
    $(".prEmailCon").hide();
    $(".prEmailContxt").val($(".prEmailCon").text());
    $(".prEmailContxt").show();
  });

	$(".dropdown").click(function() {
		$(".dropdown-content").toggle();
	});

  $(window).click(function(ev) {
    if($(ev.target).attr('class') != "dropdown") {
        $(".dropdown-content").hide();
     }
  });

  $(".openNav").click(function() {
    if ($(".sidebar").css('width', '0')) {
        if ($(window).width() > '600')
        {
            $(".sidebar").css('width', '250px');
        }
        else
        {
            $(".sidebar").css('width', '100%');
        }
      //$(".sidebar").css('width', '250px');
    }
    else {
      $(".sidebar").css('width', '0');
    }
  });

  $(window).click(function(ev) {
    if($(ev.target).attr('class') != "sidebar" && $(ev.target).attr('class') != "openNav") {
      $(".sidebar").css('width', '0px');
    }
  });

  $(".closebtn").click(function() {
    $(".sidebar").css('width', '0px');
  });

  /* Menue */
  $(".openMen").click(function() {
    if ($("#menu").css('width', '0')) {
        if ($(window).width() > '600')
        {
            $("#menu").css('width', '250px');
        }
        else
        {
            $("#menu").css('width', '100%');
        }
    }
    else {
      $("#menu").css('width', '0');
    }
  });

  $(window).click(function(ev) {
    if($(ev.target).attr('id') != "menu" && $(ev.target).attr('class') != "openMen") {
      $("#menu").css('width', '0px');
    }
  });

  $(".closeMen").click(function() {
    $("#menu").css('width', '0px');
  });
  
  $(".searchBar").keypress(function() {
        if ($(".searchBar").val() != "")
        {
            $(".searchResult").css("display","block"); 
        }
        else
        {
            $(".searchResult").css("display","none");
        }
  });

});
