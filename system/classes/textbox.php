<?PHP
  class textbox extends Control{

    public function display(){
      echo "<input class='autoWidth' name=\"".htmlentities($this->name)."\" value=\"".htmlentities($this->value)."\" />";
    }

    public function getCode(){

    }

  }
?>
