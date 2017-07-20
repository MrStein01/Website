$(function() {
    $(".openNews").click(function() {
        $(".newsSidebar").css('width', '250px');
        $("#content").removeClass("col-m-12");
        $("#content").addClass("col-m-10");
        ellipsizeTextBox('newAnimedescription');
    });

    $(".newsClosebtn").click(function() {
        $(".newsSidebar").css('width', '0px');
        $("#content").removeClass("col-m-10");
        $("#content").addClass("col-m-12");
    });

    $(window).on('resize', function() {
      ellipsizeTextBox('newAnimedescription');
    });
});

function ellipsizeTextBox(id) {
    var el = document.getElementsByClassName(id);
    for (var i = 0; i < el.length; i++) {
      var wordArray = el[i].innerHTML.split(' ');
      while(el[i].scrollHeight > el[i].offsetHeight) {
          wordArray.pop();
          el[i].innerHTML = wordArray.join(' ') + ' ...';
      }
    }
}
ellipsizeTextBox('newAnimedescription');
