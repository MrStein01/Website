<?PHP
  class CustomCSS{

    function printStylesheet($id){
      $path = self::getStylePath($id);
  	  if($path){
  	    echo "<link href=\"".$path."\" rel=\"stylesheet\" type=\"text/css\" />";
  	  }
  	}

  	function getStylePath($id){
  	  $id = $GLOBALS['db']->EscapeString($id);
  	  return $GLOBALS['db']->ReadField("SELECT stylePath FROM {'dbprefix'}custom_css
  	                    WHERE id = '".$id."'");
  	}

  }
?>
