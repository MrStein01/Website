<?PHP
  class ImageServer{
    function insert($path,$name,$description){
      $path        = $GLOBALS['db']->EscapeString($path);
      $name        = $GLOBALS['db']->EscapeString($name);
      $description = $GLOBALS['db']->EscapeString($description);
	  $res         = $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}images (path,name,description) 
                                              VALUES ('".$path."','".$name."','".$description."')");
	  if($res){
	    $args['path']        = $path;
		$args['name']        = $name;
		$args['description'] = $description;
	    EventManager::raiseEvent("image_registered","../",$args);
	  }
      return $res;
    }
	
	function getImages(){
	  return $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}images");
	}
  }
?>
