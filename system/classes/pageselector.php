<?PHP
  class PageSelector extends Control{
    public $style = '';

    public function display(){
	  echo "<div class=\"styled-select\"><select name=\"".$this->name."\" style=\"".$this->style."\">";
	  $pages = $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}pages ORDER BY title");
	  if($pages){
        foreach($pages as $page){

        if (substr($page->title,0,1) == "{")
        {
          $name = Language::Translate($page->title);
        }
        else
        {
          $name = $page->title;
        }

	      if($page->id == $this->value){
		    echo "<option value=\"".$page->id."\" selected=\"1\">".$name."</option>";
		  }
		  else{
		    echo "<option value=\"".$page->id."\">".$name."</option>";
		  }
	    }
	    echo "</select></div>";
	  }
    }

    public function getCode(){

    }

  }
?>
