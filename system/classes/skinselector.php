<?PHP
  class skinselector extends Control{

    public function display(){
          ?>
  	      <input type="hidden" name="<?PHP echo htmlentities($this->name); ?>" value="<?PHP echo htmlentities($this->value); ?>" />
            <img id="btnLeft" style="width:35px;height:70px;" OnClick="document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value--;
  		                             document.getElementById('skinpreview').src='../system/skins/' + skins[document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value-1]['name'] + '/screenshot.jpg';
  							         document.getElementById('btnRight').style.visibility='visible';
  							         if(1 == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  									     document.getElementById('btnLeft').style.visibility='hidden'
  								     };"
  							 src="../system/images/btnLeft.png" />
  		  <img id="skinpreview" style="border:1px solid #aaa;width:59%;" src="../system/skins/<?PHP echo SkinController::getCurrentSkinName(); ?>/screenshot.jpg" />
  		  <img id="btnRight" style="width:35px;height:70px;" OnClick="document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value++;
  		                              document.getElementById('skinpreview').src='../system/skins/' + skins[document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value-1]['name'] + '/screenshot.jpg';
  									  if(skins.length == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  									      document.getElementById('btnRight').style.visibility='hidden';
  								      }
  									  document.getElementById('btnLeft').style.visibility='visible';"
  						     src="../system/images/btnRight.png" />
  	      <script language="JavaScript">
  		      var skins = new Array();
  			  <?PHP
  			    $i = 0;
  			    foreach(SkinController::getInstalledSkins() as $skin){
                    echo "skins[".$i."] = new Object();";
  				  echo "skins[".$i."][\"id\"] = \"".$skin->id."\";";
  				  echo "skins[".$i."][\"name\"] = \"".$skin->name."\";";
  				  $i++;
  	            }
  	          ?>
  			  if(skins.length == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  			      document.getElementById('btnRight').style.visibility='hidden';
  			  }
  			  if(1 == document.getElementsByName('<?PHP echo htmlentities($this->name); ?>')[0].value){
  			      document.getElementById('btnLeft').style.visibility='hidden';
  		      }
  		  </script>
  	  <?PHP
  	}

    public function getCode(){}

  }
?>
