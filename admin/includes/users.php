<h1><?PHP echo Language::Translate("{LANG:USER}") ?></h1>
<?php
  $users = new UserForm();
  $users->display();
?>
