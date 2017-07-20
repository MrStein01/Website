<?PHP
  class menueselector extends Control{
    public $style = '';

    public function display(){
	  echo "<div class=\"styled-select\"><select name=\"".$this->name."\" style=\"".$this->style."\">";
      foreach(sys::getMenues() as $menue){

      if (substr($menue->name,0,1) == "{")
      {
        $name = Language::Translate($menue->name);
      }
      else
      {
        $name = $menue->name;
      }

	    if($menue->id == $this->value){
			echo "<option value=\"".$menue->id."\" selected=\"1\">".$name."</option>";
		}
		else{
			echo "<option value=\"".$menue->id."\">".$name."</option>";
		}
	  }
	  echo "</select></div>";
    }

    public function getCode() {

    }

  }
?>
