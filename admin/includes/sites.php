<h1>Seiten</h1>
<?php
  $dir = $_GET['dir'];
  if($_POST['newFolder']){
    FileServer::createFolder("../content/articles/".$dir,$_POST['name']);
  }
  if($_GET['rmdir']){
    rmdir("../content/articles/".$_GET['rmdir']);
	echo "<p>Verzeichnis ".$_GET['rmdir']." wurde gel&ouml;scht!</p>";
  }
  $verzeichnis = openDir("../content/articles/".$dir);
?>
<p>
  <?PHP
    if($dir){
      ?>
        <a class="styled-link" href="../admin/index.php?page=site-new&dir=<?PHP echo substr($dir,1); ?>">Neue Seite</a>
      <?PHP
        }
	    else{
      ?>
        <a class="styled-link" href="../admin/index.php?page=site-new">Neue Seite</a>
      <?PHP
	}
  ?>
</p>
<?php
$files = FileServer::getFiles("../content/articles/".$dir);
if($files){
?>

<?PHP
  foreach ($files as $file) {

    if ($dir) {
      $file = substr($dir,1)."/".substr($file,0,strlen($file)-4);
    }
    else {
      $file = substr($file,0,strlen($file)-4);
    }

    $page = $db->ReadRow("SELECT * FROM {'dbprefix'}pages WHERE alias = '".$db->EscapeString($file)."'");

    if ($page && $page->alias != "logout") {

      if (substr($page->title,0,1) == "{") {
        $name = Language::Translate($page->title);
      }
      else {
        $name = $page->title;
      }
      echo '<div class="modalAdmin-content">
        <div class="modalAdmin-header">
          <h3>'.$name.'</h3>
          <h6>'.$page->alias.'</h6>
        </div>
        <div class="modalAdmin-body">';
            include("../content/articles/".$page->alias.".php");
      echo '
        <div style="clear:both;"></div>
        </div>
        <div class="modalAdmin-footer">
          <p>
          <a title="Bearbeiten"
            href="index.php?page=site-edit&site='.$page->alias.'">
              <img src="../system/images/icons/page_edit.png" style="width:25px;" />
          </a>
          <a title="L&ouml;schen"
            href="index.php?page=site-delete&site='.$page->alias.'">
              <img src="../system/images/icons/cross.png" style="width:25px;" />
          </a>
          </p>
        </div>
      </div>';
    }
  }
}
else{
echo "<p>Es sind keine Seiten vorhanden.</p>";
}
?>
 <form action="../admin/index.php?page=sites&dir=<?PHP echo $_GET['dir']; ?>" method="POST">
  <p>
    Path:
      <?PHP
	    $pre = "";
        foreach(split("/",$dir) as $cDir){
		  $path .= "/".$cDir;
		  if($path == "/"){
		    echo " <a href=\"../admin/index.php?page=sites\">/</a>";
			$path = "";
		  }
		  else{
  	        echo " <a href=\"../admin/index.php?page=sites&dir=".$path."\">".$cDir."/</a>";
		  }
	    }
      ?>
	  <input name="name" style="width:100px;" />
	  <input name="newFolder" type="submit" value="Neu" />
  </p>
  </form>
  <ul style="list-style-type:none;">
  <?PHP
    $subFolders = FileServer::getFolders("../content/articles/".$dir);
	if($subFolders){
      foreach($subFolders as $folder){
	    echo "<li>
		        <img src=\"../system/images/icons/folder.png\" style=\"width:25px;\" />
		        <a href=\"../admin/index.php?page=sites&dir=".$dir."/".$folder."\">".$folder."</a>
		      </li>";
	  }
	}
  ?>
  </ul>

   <?PHP
    if(trim($_GET['dir']) != "" & trim($_GET['dir']) != "/"){
	  echo "<a class='styled-link' href=\"../admin/index.php?page=sites&rmdir=".$_GET['dir']."\">Ordner l&ouml;schen</a><br /><br />";
	 }
  ?>
