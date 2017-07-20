<?PHP
class SkinController{

  function getCurrentSkinId(){
    return getSetting("global","global","selectedskin");
  }
  function getCurrentMobileSkinId(){
    return getSetting("global","global","selectedmobileskin");
  }

  function getCurrentSkinName(){
    if(Mobile::isMobileDevice()){
  	  return self::getCurrentMobileSkinName();
  	}
  	else{
      return self::getCurrentDesktopSkinName();
    }
  }

  function getCurrentMobileSkinName(){
	$res = $GLOBALS['db']->ReadField("SELECT name FROM {'dbprefix'}skins WHERE id = '".SkinController::getCurrentMobileSkinId()."'");
	if($res){
      return $res;
    }
    else{
      return "mobile";
    }
  }

  function getCurrentDesktopSkinName(){
    $res = $GLOBALS['db']->ReadField("SELECT name FROM {'dbprefix'}skins WHERE id = '".SkinController::getCurrentSkinId()."'");
	if($res){
      return $res;
    }
    else{
      return "default";
    }
  }

  function getCurrentSkinPath(){
    if (file_exists("system/skins/".SkinController::getCurrentSkinName())) {
      return "system/skins/".SkinController::getCurrentSkinName();
    }
    else {
      die("Skin \"".SkinController::getCurrentSkinName()."\" nicht vorhanden");
    }
  }

  function getInstalledMobileSkins(){
    return $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}skins WHERE isMobile=1");
  }

  function getInstalledSkins(){
    return $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}skins");
  }
}
?>
