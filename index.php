<?PHP
  function __autoload($class_name){
      require_once "system/classes/".strtolower($class_name).".php";
  }
  include("system/settings.php");
  include("system/filterfilename.php");
  include("system/sys.php");
  $db = new MySQL('system/dbsettings.php');
  $db->Connect();
  $currentpage = new Page();
  $currentpage->loadProperties($GLOBALS['db']->EscapeString($_GET['include']));
  if(!$_GET['skin']){
    include(SkinController::getCurrentSkinPath()."/index.php");
  }
  else{
    include('system/skins/'.$_GET['skin']."/index.php");
  }
?>