<h1>Bild hinzuf&uuml;gen</h1>
<?PHP
  if(ImageServer::insert($_POST['path'],$_POST['name'],$_POST['description'])){
    echo "<p>Das Bild wurde zur Mediathek hinzugef&uuml;gt</p>";
  }
  else{
    echo "<p>Fehler: Das Bild konnte nicht hinzugef&uuml;gt werden!</p>";
  }
?>