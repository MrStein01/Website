var tinyMCEImageList = new Array(
	<?PHP
	  include('../system/classes/imageserver.php');
	  include('../system/classes/database.php');
	  include('../system/classes/mysql.php');
	  $db = new MySQL('../system/dbsettings.php');
      $db->Connect();
	  $images = ImageServer::getImages();
	  if($images){
	    $i = 1;
  	    foreach($images as $image){
	      ?>
		  ["<?PHP echo $image->name; ?>", "<?PHP echo $image->path; ?>"]
		  <?PHP
		  if($i < count($images)){
		    echo ",";
		  }
		  $i++;
	    }
	  }
	?>
);
