<div id="menu">
  <a href='javascript:void(0)' class='closeMen'>&times;</a>
  <?PHP
    if (isset($_SESSION['username'])) {
      sys::displayGlobalMenu("<ul id='localmenu'>","</ul>","<li>","</li>","localmenu");
    }
  ?>
</div>
