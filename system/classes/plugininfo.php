<?PHP
  class PluginInfo{
    public $path              = '';
	public $name              = '';
	public $description       = '';
	public $authorName        = '';
	public $authorLink        = '';
	public $version           = '';
	public $configurationFile = '';
	
	function isActivated(){
	  $path     = $GLOBALS['db']->EscapeString($this->path);
	  $rowCount = $GLOBALS['db']->ReadField("SELECT COUNT(*) FROM {'dbprefix'}activated_plugins WHERE path = '".$path."'");
	  if($rowCount){
	    return $rowCount > 0;
	  }
	  else{
	    return false;
	  }
	}
	
	function activate(){
	  $path = $GLOBALS['db']->EscapeString($this->path);
	  @include("../system/plugins/".$path."/activate.php");
	  return $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}activated_plugins (path) VALUES ('".$path."')");
	}
	
	function deactivate(){
	  $path = $GLOBALS['db']->EscapeString($this->path);
	  @include("../system/plugins/".$path."/deactivate.php");
	  return $GLOBALS['db']->Execute("DELETE FROM {'dbprefix'}activated_plugins WHERE path = '".$path."'");
	}
  }
?>