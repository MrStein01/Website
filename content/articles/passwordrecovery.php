<h1></h1>
<form action="index.php" method="post">
  <input type="text" name="newPasswort" />
  <input type="text" name="newPasswort_retype" />
  <input type="hidden" name="emailRecovery" value="<?php echo $_GET['email']; ?>" />

  <button><span>Passwort &auml;ndern</span></button>
</form>
