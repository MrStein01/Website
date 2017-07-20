<?PHP
  class Meta{
    public $pageid      = '';
    public $description = '';
	public $keywords    = '';
	public $robots      = 'index, follow';
	
	public function load(){
      $rows = $GLOBALS['db']->ReadRows("SELECT name, content
						               FROM {'dbprefix'}meta_local
                                       WHERE page = '".$this->pageid."'");
	  if($rows){
        foreach($rows as $row){
	      if(strtolower($row->name == 'description')){
		    $this->description = $row->content;
		  }
		  else if(strtolower($row->name == 'keywords')){
		    $this->keywords = $row->content;
		  }
	      else if(strtolower($row->name == 'robots')){
  		    $this->robots = $row->content;
		  }
		}
	  }
	}
	
	public function save(){
	  $GLOBALS['db']->Execute("DELETE FROM {'dbprefix'}meta_local WHERE page = '".$this->pageid."'");
      if(trim($this->keywords) != ""){
	    $GLOBALS['db']->Execute("INSERT INTO {'dbprefix'}meta_local (page,               name      , content)
                                                              VALUES('".$this->pageid."','keywords','".$this->keywords."')");
	  }
      if(trim($this->description) != ""){
	    $GLOBALS['db']->Execute("insert into {'dbprefix'}meta_local (page,               name      , content)
                                                              VALUES('".$this->pageid."','description','".$this->description."')");
	  }
      if(trim(strtolower($this->robots)) != 'index, follow'){
        $GLOBALS['db']->Execute("insert into {'dbprefix'}meta_local (page,               name      , content)
                                                              VALUES('".$this->pageid."','robots','".$this->robots."')");
	  }										
	}
	
  }
?>