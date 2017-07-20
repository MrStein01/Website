<?PHP
  class colorpicker extends Control{

    public function display(){
  	  global $colorPickerIncludes;
  	  if(!$colorPickerIncludes){
  	    $colorPickerIncludes = true;
  	    ?>
  	      <script type="text/javascript" src="../system/jscolor/jscolor.js"></script>
  	    <?PHP
  	  }
      echo "<input class=\"color autoWidth\" name=\"".str_replace("\"","&quot;",htmlentities($this->name))."\" value=\"".str_replace("\"","&quot;",htmlentities($this->value))."\" />";
    }

    public function getCode() {}

  }
?>
