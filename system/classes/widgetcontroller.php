<?PHP
  class WidgetController{
  
    function register($class,$name,$path){
	  $class = $GLOBALS['db']->EscapeString($class);
	  $name  = $GLOBALS['db']->EscapeString($name);
	  $path  = $GLOBALS['db']->EscapeString($path);
	  return $GLOBALS['db']->Execute("INSERT {'dbprefix'}widgets 
                                     (class       ,name       , path)
	                                 VALUES('".$class."','".$name."','".$path."')");
	}
	
	function getAllWidgets(){
	  $widgetData = getAllWidgetData();
	  if($widgetData){
	    foreach($widgetData as $widget){
		  $res[] = getWidget($widget);
		}
	  }
	  
	  return $res;
    }
	
	function getWidgetData($path){
	  $path = $GLOBALS['db']->EscapeString($path);
	  return $GLOBALS['db']->ReadRow("SELECT class,path FROM {'dbprefix'}widgets WHERE path = '".$path."'");
	}
	
	function getWidget($data){
	  include_once('../system/plugins/'.$data->path);
	  return new $data->class();
	}
	
	function getAllWidgetData(){
	  return $GLOBALS['db']->ReadRows("SELECT class,path FROM {'dbprefix'}widgets");
    }
  }
?>