<div class='dropdown'>
<?PHP echo $_SESSION['user']->getPicture()."  ".$_SESSION['user']->nick; ?>
  <div class='dropdown-content'>
    <a class='profile' <?PHP if ($_SESSION['username'] == "guest") { echo "style='display:none;'";} ?>>Profile</a>
    <a class='settings'>Settings</a>
    <?php if ($_SESSION['SU'] == $_SESSION['username'] || ($_SESSION['user']->isAdmin() || $_SESSION['user']->isUser())) { ?>
      <a class='openNav'>Super User</a>
    <?php } ?>
    <?php if ($_SESSION['SU'] && $_SESSION['SU'] != $_SESSION['username']) { ?>
      <a class='closeSU'>Super User Modus schließen</a>
    <?php } ?>
    <a class='logout' href='logout.html'><span>Logout</span></a>
  </div>
</div>
