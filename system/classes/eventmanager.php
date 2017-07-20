<?PHP
  class EventManager {

  function addHandler($file, $event){
	   $file  = $GLOBALS['db']->EscapeString($file);
	   $event = $GLOBALS['db']->EscapeString($event);
	   return $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}events (event, file) VALUES ('".$event."','".$file."')");
	}

	static function raiseEvent($name,$base,$args){
	   $handler = self::getHandler($name);
	   if($handler){
	     foreach($handler as $file){
		   include("/".$file);
	     }
	   }
	}

	static function getHandler($name){
	   $name = $GLOBALS['db']->EscapeString($name);
       $mySqlRes = $GLOBALS['db']->ReadRows("SELECT file FROM {'dbprefix'}events WHERE event = '".$name."'");
	   if($mySqlRes){
	     foreach($mySqlRes as $row){
	       $res[] = $row->file;
	     }
	   }
	   return $res;
	}

  }
?>
