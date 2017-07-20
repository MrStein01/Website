<?PHP
  class MenuEntry{
    public $id      = -1;
    public $type    = 0;
	  public $href    = '';
	  public $menu    = '';
    public $picture = '';

	public function display($globalstart,$globalend, $elementstart,$elementend,$class,$index){
	  if($this->type == 0 || $this-> type == 1){
      if($this->picture == '') {
        echo $elementstart."<a href=\"".$this->href."\" title=\"".$this->title."\"
             class=\"".$class." menue-".$id."-".$index."\">".$this->title."</a>".$elementend;
       }
       else if(substr($this->picture,0,5) == 'admin')
       {
         echo $elementstart."<a href=\"".$this->href."\" title=\"".$this->title."\"
              class=\"".$class." menue-".$id."-".$index."\"><img src='../system/images/icons/".$this->picture."' style='width:2rem;' />".$this->title."</a>".$elementend;
       }
       else {
         echo $elementstart."<a href=\"".$this->href."\" title=\"".$this->title."\"
              class=\"".$class." menue-".$id."-".$index."\"><img src='system/images/icons/".$this->picture."' style='width:2rem;' />".$this->title."</a>".$elementend;
       }
		}
		else{
		  Menu::display($this->href,$globalstart,$globalend, $elementstart,$elementend,$class);
		}
	}

	public function displayEditAble(){
        ?>
		  <input name="<?PHP echo $this->id; ?>_title" value="<?PHP echo $this->title; ?>" />
          <select name="<?PHP echo $this->id; ?>_type" onChange="typeSelected()">
            <option value="0"<?PHP if($this->type == 0) echo " selected=\"1\""; ?>>Seite Intern</option>
            <option value="1"<?PHP if($this->type == 1) echo " selected=\"1\""; ?>>Seite Extern</option>
            <option value="2"<?PHP if($this->type == 2) echo " selected=\"1\""; ?>>Men&uuml;</option>
          </select>
		  <?PHP
		    if($this->type == 0){
              $selector = new PageSelector();
	          $selector->name  = $this->id.'_href';
	          $selector->value = $this->href;
	          $selector->display();
		    }
		    else if($this->type == 1){
		  ?>
            <input name="<?PHP echo $this->id; ?>_href" value="<?PHP echo $this->href; ?>" />
		  <?PHP
		    }
		    else if($this->type == 2){
              $selector = new MenueSelector();
	          $selector->name  = $this->id.'_href';
	          $selector->value = $this->href;
	          $selector->display();
		    }
		  ?>
		  <input type="submit" name="<?PHP echo $this->id; ?>_delete" value="X" /><br />
		<?PHP
	}

	public function save(){
	  if($this->id == -1){
	    return $this->insert();
	  }
	  else{
	    return $this->update();
	  }
	}

	private function insert(){
	  $menu     = $GLOBALS['db']->EscapeString($this->menu);
	  $title    = $GLOBALS['db']->EscapeString($this->title);
	  $href     = $GLOBALS['db']->EscapeString($this->href);
	  $type     = $GLOBALS['db']->EscapeString($this->type);
	  $maxID    = $GLOBALS['db']->ReadField("SELECT MAX(id) FROM {'dbprefix'}menu
                                          WHERE menuID = '".$menu."'");
	  $id = $maxID + 1;
      $res = $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}menu (id,menuID,title,href,type)
                                      VALUES('".$id."','".$menu."',
                                      '".$title."','".$href."','".$type."')");
      if($res){
        $args['menu']  = $menu;
	    $args['title'] = $title;
	    $args['href']  = $href;
	    EventManager::raiseEvent("menu_entry_added","../",$args);
	  }
	  return $res;
	}

	private function update(){
	  $id    = $GLOBALS['db']->EscapeString($this->id);
	  $menu  = $GLOBALS['db']->EscapeString($this->menu);
	  $title = $GLOBALS['db']->EscapeString($this->title);
	  $href  = $GLOBALS['db']->EscapeString($this->href);
	  $type  = $GLOBALS['db']->EscapeString($this->type);
      $res =  $GLOBALS['db']->Execute("UPDATE {'dbprefix'}menu SET
	                                   href = '".$href."',
		  			                   title = '".$title."',
		  			                   type = '".$type."'
						               WHERE id = '".$id."'
						               AND menuID = '".$menu."'");
    if($res){
      $args['menu']  = $menu;
	  $args['title'] = $title;
	  $args['href']  = $href;
	  $args['id']    = $id;
	  EventManager::raiseEvent("menu_entry_edit","../",$args);
	}
	return $res;
	}
  }

?>
