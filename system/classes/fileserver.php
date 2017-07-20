<?PHP
  class FileServer{

    function getFiles($dir){
      $oDir = openDir($dir);
	  
      while($item = readDir($oDir)){
        if(is_file($dir."/".$item)){
          $res[] = $item;
        }
      }

      closeDir($oDir);
	  
	  return $res;
    }

    function getFolders($dir){
      $oDir = openDir($dir);
	  
      while($item = readDir($oDir)){
        if(is_dir($dir."/".$item)){
		  if($item != "." && $item != ".."){
            $res[] = $item;
		  }
        }
      }

      closeDir($oDir);
	  
	  return $res;
    }

    function createFolder($base,$name){
      $res = mkdir($base."/".$name,0777);
	  $args['name'] = $base."/".$name;
	  if($res) EventManager::raiseEvent("folder_created","../",$args);
	  return $res;
    }
	
	function upload($base,$file){
      $tempname = $file['tmp_name'];
      $name = $file['name'];
	  $res = copy($tempname, $base."/".$name);
	  $args['name'] = $base."/".$name;
	  if($res) EventManager::raiseEvent("file_uploaded","../",$args);
	  return $res;
	}

  }

?>