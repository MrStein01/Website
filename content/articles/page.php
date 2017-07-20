<?PHP
class Page{
  var $id      = -1;
  var $alias   = '';
  var $title   = '';
  var $ownerid = -1;
  var $owner   = false;
  var $menu    = -1;
  var $meta    = null;
  var $pageIdent  = 0;

  function loadProperties($alias){
    if ($alias == "") {
      $alias = "home";
    }
    else if ($alias == "access_denied")
    {
      $alias = "accessDenied/access_denied";
    }
    $row = $GLOBALS['db']->ReadRow("SELECT id,title,owner,menu FROM {'dbprefix'}pages
                           WHERE alias = '".$alias."'");
    if($row){
      $this->id = $row->id;
      $this->title = $row->title;
      $this->ownerid = $row->owner;
      $this->menu = $row->menu;
      $this->alias = $alias;
	  $this->meta  = new Meta();
	  $this->meta->pageid = $this->id;
	  $this->meta->load();
    }
  }

  function getContent($home = true){
    EventManager::raiseEvent("content_top",".",$this);
    if ($home) {
      include(filterfilename("content/articles/".$this->alias));
    }
    else {
      include(filterfilename("content/articles/home"));
    }
    EventManager::raiseEvent("content_bottom",".",$this);
  }

  function getAdminContent($page){
    EventManager::raiseEvent("content_top",".",$this);
    include(filterfilename("../content/articles/".$page));
    EventManager::raiseEvent("content_bottom",".",$this);
  }

  function getOwner(){
    if(!$this->owner){
      $alias = $GLOBALS['db']->ReadField("SELECT alias FROM {'dbprefix'}pages
                                          WHERE id = '".$this->ownerid."'");
      if($alias){
        $this->owner = new Page();
        $this->owner->loadProperties($alias);
      }
    }
    return $this->owner;
  }

  function getBreadcrump(){
    if(!$this->owner) $this->getOwner();
    if($this->owner){
      $breadcrump = $this->owner->getBreadcrump();
    }
    $breadcrump[] = array($this->alias,$this->title);
    return $breadcrump;
  }

  function readContent($dirpraefix){
    $filename = $dirpraefix."content/articles/".$this->alias.".php";
    $handle = @fopen ($filename, "rb");
    if($handle && filesize($filename) > 0){
      $contents = fread ($handle, filesize ($filename));
      fclose ($handle);
    }
    else{
      $contents = "";
    }
    return $contents;
  }

  function save(){
	$res = $GLOBALS['db']->Execute("UPDATE {'dbprefix'}pages SET
                                    title = '".$this->title."',
                                    alias = '".$this->alias."',
                                    menu = '".$this->menu."'
                                    WHERE id = '".$this->id."'");
	$this->meta->save();
	if($res){
	  $args['title'] = $this->title;
	  $args['alias'] = $this->alias;
	  $args['menu']  = $this->menu;
	  $args['id']    = $this->id;
      EventManager::raiseEvent("page_saved","../",$args);
	}
	return $res;
  }

  function writeContent($dirpraefix,$content,$alias){
    if(!$alias){
  	  $alias = $this->alias;
  	}
    $filename = $dirpraefix."content/articles/".$alias.".php";
    $handle = fopen ($filename, "a");
    $res = fwrite ($handle, $content);
    fclose ($handle);
  	if($res){
  	  $args['alias'] = $alias;
  	  $args['filename']  = $filename;
  	  $args['content'] = $content;
        EventManager::raiseEvent("pagecontent_writed","../",$args);
  	}
    return $res;
  }

  function create($dirpraefix,$alias){
    $id = 0;
    $res = $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}pages (alias) VALUES ('".$alias."')");
  	self::writeContent($dirpraefix,"",$alias);
  	if($res){
  	  $args['id']    = $GLOBALS['db']->InsertID();
      $pageIdent     = $args['id'];
  	  $args['alias'] = $alias;
        EventManager::raiseEvent("page_created","../",$args);
  	}
    return $pageIdent;
  }

  function deleteContent($dirpraefix){
    $filename = $dirpraefix."content/articles/".$this->alias.".php";
    if(file_exists($filename)){
      unlink($filename);
	  $args['alias'] = $this->alias;
	  $args['filename']  = $filename;
      EventManager::raiseEvent("pagecontent_deleted","../",$args);
    }
  }

  function delete(){
    $res = $GLOBALS['db']->Execute("DELETE FROM {'dbprefix'}pages WHERE alias = '".$this->alias."'");
    if (file_exists("../content/articles/".$this->alias.".php")) {
      unlink('../content/articles/'.$this->alias.'.php');
    }
  	if($res){
  	  $args['alias'] = $this->alias;
        EventManager::raiseEvent("page_deleted","../",$args);
  	}
    return $res;
  }
}
?>
