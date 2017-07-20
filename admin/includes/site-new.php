<h1>Seite erstellen</h1>
<?PHP
  if(!$_POST['alias']){
?>
  <form action="../admin/index.php?page=site-new&dir=<?PHP echo $_GET['dir']; ?>" method="post">
    Alias: <input name="alias" /><br />
    <input type="submit" value="Erstellen" />  </form>
<?PHP
  }
  else{
   if($_GET['dir']){
     $dir = $db->EscapeString($_GET['dir'])."/";
   }
   else{
     $dir = "";
   }
   $id = Page::create("../",$dir.$db->EscapeString($_POST['alias']));
   if($id){
  ?>
    <p>Die Seite wurde erfolgreich erstellt.</p>
    <form action="../admin/index.php" method="GET">
      <input type="hidden" name="page" value="site-edit" />
      <input type="hidden" name="site" value="<?PHP echo $_POST['alias']; ?>" />
      <input type="submit" value="Seite Bearbeiten" />
    </form>
  <?PHP
    }
    else{
   ?>
      <p>Die Seite konnte leider nicht erstellt werden.</p>
   <?PHP
    }
  }
?>
