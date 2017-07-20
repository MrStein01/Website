<h1>Neues Men&uuml;</h1>
<?PHP
  if(!$_POST['name']){
?>
  <form action="../admin/index.php?page=menue-new" method="POST">
    Name: <input name="name"><br />

    <input type="submit" value="Erstellen" />
  </form>
<?PHP
  }
  else{
   $id = Menu::create($GLOBALS['db']->EscapeString($_POST['name']));
   if($id){
     ?>
       <p>Das Men&uuml; wurde erfolgreich erstellt.</p>
       <form action="../admin/index.php" method="GET">
         <input name="page" value="menu-edit" type="hidden" />
         <input name="menu" value="<?PHP echo $id; ?>" type="hidden" />
         <input type="submit" value="Eintrage hinzuf�gen" />
       </form>
     <?PHp
   }
   else{
     echo "<p>Das Men&uuml; konnte leider nicht erstellt werden.</p>";
   }
  }
?>
