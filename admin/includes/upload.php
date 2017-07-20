<h1>Upload</h1>
<?php
  if(@FileServer::upload($_POST['dir'],$_FILES['file'])){
    $name = $_FILES['file']['name'];
    echo "Die Datei ".$name." wurde erfolgreich hochgeladen!";
    $path_info = pathinfo("../content/uploads/".$_POST['dir']."/".$name);
	if(strtolower($path_info['extension'] == 'jpg') or
	   strtolower($path_info['extension'] == 'jpeg') or
	   strtolower($path_info['extension'] == 'gif') or
	   strtolower($path_info['extension'] == 'png') or
	   strtolower($path_info['extension'] == 'bmp')){
	 ?>
	   <h2>Bild in Mediathek einf&uuml;gen</h2>
	   <form action="../admin/index.php?page=addImage" method="POST">
	   <input type="hidden" name="path" value="<?PHP echo "/content/uploads/".$base."/".$name; ?>" />
	   <table>
	       <tr>
		     <td>Name:</td>
		     <td><input name="name" /></td>
		   </tr>
	       <tr>
		     <td>Beschreibung:</td>
		     <td><input name="description" /></td>
		   </tr>
		   <tr>
		     <td></td>
		     <td><input type="submit" value="Einf�gen" />
		   </tr>
  	     </table>
	   </form>
	   <img src="<?PHP echo "../content/uploads/".$_POST['dir']."/".$name; ?>" style="max-width:300px" />
		 <?PHP
	}
  }
  else {
    echo "Der Upload ist leider fehlgeschlagen.";
  }
?>
