<?PHP
class Menu{
  function display($id, $globalstart,$globalend, $elementstart,$elementend,$class){
    $entries = self::getEntries($id);
    echo $globalstart;
    $i = 1;
	if($entries){
	  foreach($entries as $entry){
	      $entry->display($globalstart,$globalend, $elementstart,$elementend,$class,$index);
        $i++;
      }
	}
    echo $globalend;
  }

  function getIdByName($name){
  	$name = $GLOBALS['db']->EscapeString(strtolower(trim($name)));
  	return $GLOBALS['db']->ReadField("SELECT id FROM {'dbprefix'}menu_names WHERE lower(trim(name)) = '".$name."' LIMIT 0,1");;
  }

  function displayEditable($id){
    $entries = self::getEntries($id);
	if($entries){
	  foreach($entries as $entry){
	    $entry->displayEditable();
      }
	}
  }

  function addEntry($menu,$title,$href){
	$maxID = $GLOBALS['db']->ReadField("SELECT MAX(id) FROM {'dbprefix'}menu
                                        WHERE menuID = '".$menu."'");
	$id = $maxID + 1;
    $res = $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}menu (id,menuID,title,href)
                                    VALUES('".$id."','".$menu."',
                                    '".$title."','".$href."')");
    if($res){
      $args['menu']  = $menu;
	  $args['title'] = $title;
	  $args['href']  = $href;
	  EventManager::raiseEvent("menu_entry_added","../",$args);
	}
	return $res;
  }

  function editEntry($menu,$id,$title,$href){
    $res =  $GLOBALS['db']->Execute("UPDATE {'dbprefix'}menu SET
	                                 href = '".$href."',
					                 title = '".$title."'
						             WHERE id = '".$id."'
						             AND menuID = '".$menu."'");
    if($res){
      $args['menu']  = $menu;
	  $args['title'] = $title;
	  $args['href']  = $href;
	  $args['id']    = $href;
	  EventManager::raiseEvent("menu_entry_edit","../",$args);
	}
	return $res;
  }

  function deleteEntry($menu,$id){
    $res = $GLOBALS['db']->Execute("DELETE FROM {'dbprefix'}menu WHERE menuID = '".$menu."' AND id = '".$id."'");
    if($res){
      $res = $GLOBALS['db']->Execute("UPDATE {'dbprefix'}menu SET id = id - 1 WHERE id > '".$id."'");
      if($res){
        $args['menu']  = $menu;
	    $args['id'] = $id;
	    EventManager::raiseEvent("menu_entry_deleted","../",$args);
	  }
    }
    return $res;
  }

  function create($name){
    $res = $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}menu_names (name) VALUES ('".$name."')");
    if($res){
      $args['name']  = $name;
	  EventManager::raiseEvent("menu_created","../",$args);
	}
    return $GLOBALS['db']->InsertID();
  }

  function delete($id){
    $res = $GLOBALS['db']->Execute("DELETE FROM {'dbprefix'}menu_names WHERE id = '".$id."'");
    if($res){
      $res = $GLOBALS['db']->Execute("DELETE FROM {'dbprefix'}menu WHERE menuID = '".$id."'");
      if($res){
        $args['id']  = $id;
	    EventManager::raiseEvent("menu_deleted","../",$args);
	  }
    }
    return $res;
  }

  function getEntries($id){
    $rows = $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}menu WHERE menuID = '".$id."' ORDER BY id");
    if($rows){
  	  foreach($rows as $row){
        //$page = "index.php?page=".$_GET['page'];
        //if ($page != $row->href) {
      	    $entry = new MenuEntry();
        		$entry->id    = $row->id;
        		$entry->type  = $row->type;
        		$entry->href  = $row->href;
            if (substr($row->title,0,1) == '{') {
                $entry->title = Language::Translate($row->title);
            }
            else {
        		    $entry->title = $row->title;
            }
            $entry->picture = $row->picture;
        		$entry->menu  = $id;
        		$res[] = $entry;
       //}
     }
  	}
  	return $res;
  }
}
?>
