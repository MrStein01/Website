<?PHP
  $page = new Page();
  $page->loadProperties($GLOBALS['db']->EscapeString($_GET['site']));
?>
<h1>Seite l&ouml;schen</h1>
<?PHP
  if(!$_GET['delete']){
?>
  <p>Soll die Seite <strong><?PHP echo $page->title; ?></strong>
     unwideruflich gel&ouml;scht werden?</p>
  <a class="styled-link" href="../admin/?page=sites">Abbrechen</a>
  <a class="styled-link" href="../admin/?page=site-delete&site=<?PHP echo $_GET['site']; ?>&delete=true">
    Seite l&ouml;schen
  </a>
<?PHP
  }
  else{
    if($page->delete()){
      ?>
        <p>Die Seite <strong><?PHP echo $page->title; ?></strong>
           wurde gel&ouml;scht!</p>
      <?PHP
    }
  }
?>
