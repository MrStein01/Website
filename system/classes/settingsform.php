<?PHP
  class SettingsForm{
    public $area     = "global";
    public $areaType = "global";

  	public function display(){
      if($_POST['save']){
        foreach($_POST as $property=>$value){
          if($property != "save"){
            setSetting($this->area,$this->areaType,$property,$value);
          }
        }
      }
      ?>
      <div class="tab">
        <button class="tablinks active" onclick="openOverview(event, 'Overview')">Allgemein</button>
        <button class="tablinks" onclick="openOverview(event, 'Skins')">skins</button>
      </div>

      <div id="Overview" class="tabcontent" style="display:block;">
        <form class="settingsform" action="<?PHP echo $_SERVER['REQUEST_URI']; ?>" method="POST">
          <div class="settingscontent">
              <?PHP
                $rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}settings WHERE area = '".$this->area."' AND areaType = '".$this->areaType."' AND activated = 1");
                if($rows){
                  foreach($rows as $row){
                    if (substr($row->description,0,1) == "{")
                    {
                      $name = Language::Translate($row->description);
                    }
                    else
                    {
                      $name = $row->description;
                    }
                    echo "<div style='float:left;width:30%;'><div class='accordion'>".$name."</div>
                          <div class='panel'>";
                    $control        = new $row->type;
                    $control->name  = $row->property;
                    $control->value = $row->value;
                    $control->display();
                    echo "</div></div>";
                  }
                }
              ?>
          </div>
          <div style="clear:both;"></div>
          <input style="clear:both;" type="submit" name="save" value="Speichern" />
        </form>
      </div>

      <div id="Skins" class="tabcontent">
          <?PHP
            $skins = $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}skins WHERE LOWER(name) IN (SELECT DISTINCT name FROM {'dbprefix'}settings WHERE areaType = 'skins' AND area = {'dbprefix'}skins.name)");
            if($skins){
              foreach($skins as $skin){
                echo "<div class='accordion'>".$skin->name."</div>
                      <div class='panel'>";
                      $settings           = new SettingsForm();
                      $settings->areaType = 'skins';
                      $settings->area     = $skin->name;
                      $settings->displaySkin();
                echo "</div>";
              }
            }
          ?>
      </div>

      <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].onclick = function(){
              /* Toggle between adding and removing the "active" class,
              to highlight the button that controls the panel */
              this.classList.toggle("active");

              /* Toggle between hiding and showing the active panel */
              var panel = this.nextElementSibling;
              if (panel.style.display === "block") {
                  panel.style.display = "none";
              } else {
                  panel.style.display = "block";
              }
          }
        }

        function openOverview(evt, name) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(name).style.display = "block";
            evt.currentTarget.className += " active";
        }
      </script>
    	<?PHP
  	}

    public function displaySkin(){
      ?>
        <form class="skinform" action="<?PHP echo $_SERVER['REQUEST_URI']; ?>" method="POST">
          <div class="settingscontent" style="color:black;">
              <?PHP
                $rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}settings WHERE area = '".$this->area."' AND areaType = '".$this->areaType."' AND activated = 1");
                if($rows){
                  foreach($rows as $row){
                    if (substr($row->description,0,1) == "{")
                    {
                      $name = Language::Translate($row->description);
                    }
                    else
                    {
                      $name = $row->description;
                    }
                    echo "<div style='float:left;width:30%;'><div class='accordion'>".$name."</div>
                          <div class='panel'>";
                    $control        = new $row->type;
                    $control->name  = $row->property;
                    $control->value = $row->value;
                    $control->display();
                    echo "</div></div>";
                  }
                }
              ?>
          </div>
          <div style="clear:both;"></div>
          <input style="clear:both;" type="submit" name="save" value="Speichern" />
        </form>
      <?php
    }
  }
?>
