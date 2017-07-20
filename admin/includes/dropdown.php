<div class='dropdown'>
<?PHP echo "<span class='openNav'>".$_SESSION['user']->getPicture(true)."</span>"; ?>
  <ul class='dropdown-content'>
    <?php if ($_SESSION['SU'] == $_SESSION['username'] || ($_SESSION['user']->isAdmin() || $_SESSION['user']->isUser())) { ?>
      <li>
        Super User
        <ul>
          <?php
            $SU = new SuperUser();
            $SU->display(true);
          ?>
        </ul>
      </li>
    <?php } ?>
    <?php if ($_SESSION['SU'] && $_SESSION['SU'] != $_SESSION['username']) { ?>
      <li class='closeSU'>Super User Modus schließen</li>
    <?php } ?>
    <li class='logout'><a href='index.php?page=logout'>Logout</a></li>
  </ul>
</div>
