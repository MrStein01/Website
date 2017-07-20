<?PHP
  class PluginList{
    public $plugins;
    function Add($pluginInfo){
	  $this->plugins[] = $pluginInfo;
	}
	
	function loadAll(){
      $oDir = openDir("../system/plugins/");
      while($item = readDir($oDir)){
        if(is_dir("../system/plugins/".$item)){
		  if(file_exists("../system/plugins/".$item."/info.php")){
            include("../system/plugins/".$item."/info.php");
		  }
        }
      }

      closeDir($oDir);
	}
  }
?>