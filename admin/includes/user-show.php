<?PHP
  $user = new User();
  if($_GET['user']) {
    $user->getUser($_GET['user']);
    if ($_SESSION['user']->isGreater($user->name))
    {
      echo "<h1>".$user->nick."</h1>";
      ?>
        <form action="<?PHP echo $_SERVER['REQUEST_URI']; ?>" method="post">
          <div class="view">
            Nick: <?PHP
                    $control        = new Textbox();
                    $control->name  = "userNick";
                    $control->value = $user->nick;
                    $control->display();
                  ?>
          </div>
          <?PHP if(!$user->isGuest()) { ?>
          <div class="view">
            Email: <?PHP
                      $control        = new Textbox();
                      $control->name  = "userEmail";
                      $control->value = $user->email;
                      $control->display();
                    ?>
          </div>
          <?PHP } ?>
          <div class="view">
            Name: <?PHP
                    $control        = new Textbox();
                    $control->name  = "userName";
                    $control->value = $user->name;
                    $control->display();
                  ?>
          </div>
          <input type="submit" value="<?PHP echo Language::Translate("{LANG:SAVE}"); ?>" />
        </form>
      <?PHP
    }
  }
?>
