<?PHP
  class mobileskinselector extends Control{

    public function display(){
          ?>
  	      <input type="hidden" name="<?PHP echo htmlentities($this->name); ?>" value="<?PHP echo htmlentities($this->value); ?>" />
            <img id="mobilebtnLeft" style="width:35px;height:70px;" OnClick="document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value--;
  		                             document.getElementById('mobileskinpreview').src='../system/skins/' + mobileskins[document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value-1]['name'] + '/screenshot.jpg';
  							         document.getElementById('mobilebtnRight').style.visibility='visible';
  							         if(1 == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  									     document.getElementById('mobilebtnLeft').style.visibility='hidden'
  								     };"
  							 src="../system/images/btnLeft.png" />
  		  <img id="mobileskinpreview" style="border:1px solid #aaa;width:59%;" src="../system/skins/<?PHP echo SkinController::getCurrentMobileSkinName(); ?>/screenshot.jpg" />
  		  <img id="mobilebtnRight" style="width:35px;height:70px;" OnClick="document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value++;
  		                              document.getElementById('mobileskinpreview').src='../system/skins/' + mobileskins[document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value-1]['name'] + '/screenshot.jpg';
  									  if(mobileskins.length == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  									      document.getElementById('mobilebtnRight').style.visibility='hidden';
  								      }
  									  document.getElementById('mobilebtnLeft').style.visibility='visible';"
  						     src="../system/images/btnRight.png" />
  	      <script language="JavaScript">
  		      var mobileskins = new Array();
  			  <?PHP
  			    $i = 0;
  			    foreach(SkinController::getInstalledMobileSkins() as $skin){
                    echo "mobileskins[".$i."] = new Object();";
  				  echo "mobileskins[".$i."][\"id\"] = \"".$skin->id."\";";
  				  echo "mobileskins[".$i."][\"name\"] = \"".$skin->name."\";";
  				  $i++;
  	            }
  	          ?>
  			  if(mobileskins.length == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  			      document.getElementById('mobilebtnRight').style.visibility='hidden';
  			  }
  			  if(1 == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  			      document.getElementById('mobilebtnLeft').style.visibility='hidden';
  		      }
  		  </script>
  	  <?PHP
  	}

    public function getCode() {

    }

  }
?>
