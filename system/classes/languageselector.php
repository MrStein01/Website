<?PHP
  class languageselector extends Control{
    public $style = '';

    /**
     *
     * @return string
     */
    public function display(){
      $res =  "<div class=\"styled-select\"><select name=\"".$this->name."\" style=\"".$this->style."\">";
      $res .= "<option value=\"de\">Deutsch</option>";
      if($this->value == "en"){
        $res .= "<option value=\"en\" selected=\"true\">English</option>";
      }
      else{
        $res .= "<option value=\"en\">English</option>";
      }
      $res .= "</select></div>";
      echo $res;
    }

    /**
     *
     * @return string
     */
    public function getCode(){
      /*$res =  "<select name=\"".$this->name."\" style=\"".$this->style."\">";
      $res .= "<option value=\"de\">Deutsch</option>";
      if($this->value == "en"){
        $res .= "<option value=\"en\" selected=\"true\">English</option>";
      }
      else{
        $res .= "<option value=\"en\">English</option>";
      }
      $res .= "</select>";
      return $res;*/
    }
  }
?>
