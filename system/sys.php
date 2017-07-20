<?PHP
class sys{
  function includeContent($home = true){
    global $currentpage;
    $currentpage->getContent($home);
  }

  function includeHeader(){
    global $currentpage;
    if (substr($currentpage->title,0,1) == '{') {
      echo "<title>".Language::Translate($currentpage->title)."</title>
            <meta http-equiv=\"Content-Type\" content=\"text/html;
            charset=iso-8859-1\" />";
    }
    else {
      echo "<title>".$currentpage->title."</title>
            <meta http-equiv=\"Content-Type\" content=\"text/html;
            charset=iso-8859-1\" />";
    }
    $rows = DataBase::Current()->ReadRows("SELECT name, content
                        FROM {'dbprefix'}meta_global
                        UNION SELECT name, content
		            	FROM {'dbprefix'}meta_local
                        WHERE page = '".$currentpage->id."'");
	if($rows){
	  foreach($rows as $row){
        echo "<meta name=\"".$row->name."\" content=\"".$row->content."\" />";
      }
	}
	EventManager::raiseEvent("header_included",".",null);
  }

  function displayBreadcrump($separator,$class,$idpraefix){
    global $currentpage;
    $i = 1;
    $breadcrump = $currentpage->getBreadcrump();
    while($i <= count($breadcrump)){
      echo "<a href=\"".$breadcrump[$i-1][0].".html\" class=\"".$class."\"
            id=\"".$idpraefix.$i."\">".$breadcrump[$i-1][1]."</a>";
      if($i < count($breadcrump)){
        echo $separator;
      }
      $i++;
    }
  }

  function displayMenu($id, $globalstart,$globalend, $elementstart,$elementend,
                       $class){
    Menu::display($id, $globalstart,$globalend, $elementstart,$elementend,$class);
  }

  function displayGlobalMenu($globalstart,$globalend, $elementstart,$elementend,
                       $class){
	   Menu::display(Menu::getIdByName("{LANG:MAIN_MENU}"),
		             $globalstart,
		           	 $globalend,
					 $elementstart,
					 $elementend,
					 $class);
  }

  function displayLocalMenu($globalstart,$globalend, $elementstart,$elementend,
                       $class){
    global $currentpage;
    if($currentpage->menu > -1){
      Menu::display($currentpage->menu, $globalstart,$globalend, $elementstart,$elementend,$class);
    }
  }

  function getColor($area,$areaType,$id){
    return "#".getSetting($area,$areaType,"skin".$id);
  }

  function localMenuExists(){
    global $currentpage;
  	if($currentpage->menu){
  	  return true;
  	}
  	else{
  	  return false;
  	}
  }

  function getTitle(){
    return getSetting("global","global","title");
  }

  function getPageTitle($area){
    global $currentpage;
    if (substr($currentpage->title,0,1) == '{') {
      return Language::Translate($currentpage->title);
    }
    else {
      return $currentpage->title;
    }
    //return getSetting($area,"skins","title");
  }

  function getFullSkinPath(){
    return getSetting("global","global","host")."/".SkinController::getCurrentSkinPath()."/";
  }

  function getMenues(){
    $menus = DataBase::Current()->ReadRows("SELECT id, name, (
                                       SELECT COUNT( * )
                                       FROM {'dbprefix'}menu
                                       WHERE menuID = {'dbprefix'}menu_names.id
                                     )count
                                     FROM `{'dbprefix'}menu_names`
                                     WHERE NOT name = '{admin}'
                                     AND NOT name = '{user}';");

    foreach ($menus as $entry) {

      if (substr($entry->name,0,1) == "{")
      {
        $arr = split(" ",$entry->name);
        if (count($arr) > 2) {
          $entry->name = Language::Translate($arr[0]);
          $entry->name .= " ".$arr[1];
          $entry->name .= " ".Language::Translate($arr[2]);
        }
        else if (count($arr) > 1) {
          $entry->name = Language::Translate($arr[0]);
          $entry->name .= " ".$arr[1];
        }
        else {
          $entry->name = Language::Translate($entry->name);
        }
      }
    }
    return $menus;
  }
}
?>
