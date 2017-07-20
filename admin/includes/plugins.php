<?PHP
  $plugins = new PluginList();
  $plugins->loadAll();
  foreach($plugins->plugins as $plugin){
    if($_GET['activate'] == $plugin->path){
	  $plugin->activate();
    }
	elseif($_GET['deactivate'] == $plugin->path){
	  $plugin->deactivate();
    }
    ?>
	  <h2><?PHP echo $plugin->name; ?></h2>
	  <p><?PHP echo $plugin->description; ?></p>
	  <p style="font-size:80%">
	    <?PHP echo $plugin->version; ?>
	    <a href="<?PHP $plugin->authorLink; ?>">
		  <?PHP echo $plugin->authorName; ?>
		</a>
	  </p>
	  <?PHP
	    if($plugin->isActivated()){
		  echo "<a href=\"../admin/index.php?page=plugins&deactivate=".urlencode($plugin->path)."\">Deaktvieren</a>";
		}
		else{
		  echo "<a href=\"../admin/index.php?page=plugins&activate=".urlencode($plugin->path)."\">Aktvieren</a>";
		}
	  ?>
	<?PHP
  }
?>
