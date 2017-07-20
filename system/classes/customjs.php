<?PHP
  class CustomJS{

    function printScript($id){
      $path = self::getScriptPath($id);
  	  if($path){
  	    echo "<script src=\"".$path."\" type=\"text/javascript\"></script>";
  	  }
  	}

  	function getScriptPath($id){
  	  $id = $GLOBALS['db']->EscapeString($id);
  	  return $GLOBALS['db']->ReadField("SELECT script_Path FROM {'dbprefix'}custom_js
  	                    WHERE id = '".$id."'");
  	}

  }
?>
