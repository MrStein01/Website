<h1>Men&uuml; l&ouml;schen</h1>
<?PHP
  if(!$_GET['delete']){
?>
  <p>Soll das Men&uuml; unwideruflich gel&ouml;scht werden?</p>
  <a class="styled-link" href="../admin/?page=menues">Abbrechen</a>
  <a class="styled-link" href="../admin/?page=menu-delete&menu=<?PHP echo $_GET['menu']; ?>&delete=true">
    Men&uuml; l&ouml;schen
  </a>
<?PHP
  }
  else{
    if(Menu::delete($GLOBALS['db']->EscapeString($_GET['menu']))){
      ?>
        <p>Das Men&uuml; wurde gel&ouml;scht!</p>
      <?PHP
    }
    else{
      ?>
        <p>Das Men&uuml; konnte nicht gel&ouml;scht werden!</p>
      <?PHP
    }
  }
?>
