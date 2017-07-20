<h1>Dateien</h1>
<form enctype="multipart/form-data" action="../admin/index.php?page=upload" method="post">
  <input type="hidden" name="dir" value="<?PHP echo  $_GET['dir']; ?>" />
  Datei: <input type="file" name="file">
  <input type="submit" value="Datei hochladen">
</form>

<?php
  $dir = $_GET['dir'];
  if($_POST['newFolder']){
    FileServer::createFolder("../content/uploads/".$dir,$_POST['name']);
  }
  if($_GET['unlink']){
    unlink("../content/uploads/".$_GET['dir']."/".$_GET['unlink']);
	echo "<p>Datei ".$_GET['unlink']." wurde gel&ouml;scht!</p>";
  }
  if($_GET['rmdir']){
    rmdir("../content/uploads/".$_GET['rmdir']);
	echo "<p>Verzeichnis ".$_GET['rmdir']." wurde gel&ouml;scht!</p>";
  }
  $verzeichnis = openDir("../content/uploads/".$dir);
?>
  <form action="../admin/index.php?page=files&dir=<?PHP echo $_GET['dir']; ?>" method="POST">
  <p>
    Path:
      <?PHP
	    $pre = "";
        foreach(split("/",$dir) as $cDir){
		  $path .= "/".$cDir;
		  if($path == "/"){
		    echo " <a href=\"../admin/index.php?page=files\">/</a>";
			$path = "";
		  }
		  else{
  	        echo " <a href=\"../admin/index.php?page=files&dir=".$path."\">".$cDir."/</a>";
		  }
	    }
      ?>
	  <input name="name" style="width:100px;" />
	  <input name="newFolder" type="submit" value="Neu" />
  </p>
  </form>
  <ul style="list-style-type:none;">
  <?PHP
    $subFolders = FileServer::getFolders("../content/uploads/".$dir);
	if($subFolders){
      foreach($subFolders as $folder){
	    echo "<li>
		        <img src=\"../system/images/icons/folder.png\" style=\"width:25px;\" />
		        <a href=\"../admin/index.php?page=files&dir=".$dir."/".$folder."\">".$folder."</a>
		      </li>";
	  }
	}
  ?>
  </ul>
  <?PHP
    if(trim($_GET['dir']) != "" & trim($_GET['dir']) != "/"){
	  echo "<a class='styled-link' href=\"../admin/index.php?page=files&rmdir=".$_GET['dir']."\">Ordner l&ouml;schen</a>";
	}
    $files = FileServer::getFiles("../content/uploads/".$dir);
	if($files){
	  ?>
	    <table>
		  <thead>
		    <td>Vorschau</td>
			<td>Dateiname</td>
			<td>Aktionen</td>
		  </thead>
		  <tbody>
	  <?PHP
      foreach($files as $file){
	    echo "<tr><td>";
		$path_info = pathinfo("../content/uploads/".$dir."/".$file);
	    if(strtolower($path_info['extension'] == 'jpg') or
	       strtolower($path_info['extension'] == 'jpeg') or
	       strtolower($path_info['extension'] == 'gif') or
	       strtolower($path_info['extension'] == 'png') or
	       strtolower($path_info['extension'] == 'bmp')){
		   echo "<img src=\"../content/uploads/".$dir."/".$file."\" style=\"max-width:100px;max-height:100px;\" />";
		}
		echo "</td><td><a href=\"../content/uploads".$dir."/".$file."\">".$file."</a></td>
		      <td><a href=\"../admin/index.php?page=files&dir=".urlencode($_GET['dir'])."&unlink=".urlencode($file)."\"><img src=\"/system/images/icons/cross.png\" style=\"width:25px;\" /></a></td>
			  </tr>";
	  }
	  ?>
	    </tbody>
  	  </table>
	  <?PHP
   	}
	else{
	  echo "<p>Es sind keine Dateien vorhanden.</p>";
	}
  ?>
