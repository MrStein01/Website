<?PHP
  $plugins = new PluginList();
  $plugins->loadAll();
  foreach($plugins->plugins as $plugin){
    if($plugin->path == $_GET['plugin']){
	  echo "<h1>Einstellungen ".$plugin->name."</h1>";
	  include("../system/plugins/".$plugin->path."/".$plugin->configurationFile);
	}
  }
?>