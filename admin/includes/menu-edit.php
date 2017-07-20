<?PHP
  if($_POST['add']){
    if(trim($_POST['newtitle']) != ""){
      if(trim($_POST['newurl']) != ""){
	    $entry        = new MenuEntry();
	    $entry->menu  = $_GET['menu'];
	    $entry->title = $_POST['newtitle'];
	    $entry->type  = $_POST['type'];
		if($entry->type == 0){
	      $entry->href  = $_POST['newPage'];
		}
		else if($entry->type == 1){
	      $entry->href  = $_POST['newurl'];
		}
		else{
	      $entry->href  = $_POST['newMenu'];
		}
	    $res = $entry->save();
        if($res){
          echo "<p>Eintrag hinzugef&uuml;gt!</p>";
        }
        else{
          echo "<p>Eintrag nicht hinzugef&uuml;gt!</p>";
        }
      }
      else{
         echo "<p>Bitte geben Sie ein Link-Ziel ein</p>";
      }
    }
    else{
       echo "<p>Bitte geben Sie einen Link-Titel ein</p>";
    }
  }
  else if($_POST['save']){
    foreach($_POST as $param=>$value){
      if(strlen($param) >= 6){
        if(substr($param,-5,5) == "_href"){
          $entries[substr($param,0,-5)][href] = $value;
        }
        else if(strlen($param) >= 7 && substr($param,-6,6) == "_title"){
          $entries[substr($param,0,-6)][title] = $value;
        }
        else if(substr($param,-5,5) == "_type"){
          $entries[substr($param,0,-5)][type] = $value;
        }
      }
    }
    foreach($entries as $id=>$params){
	  $entry        = new MenuEntry();
	  $entry->id    = $id;
	  $entry->menu  = $_GET['menu'];
	  $entry->title = $params['title'];
	  $entry->href  = $params['href'];
	  $entry->type  = $params['type'];
	  $entry->save();
	}
  }
  else{
    foreach($_POST as $param=>$value){
      if(strlen($param) >= 8){
        if(substr($param,-7,7) == "_delete"){
          Menu::deleteEntry($GLOBALS['db']->EscapeString($_GET['menu']),
                            $GLOBALS['db']->EscapeString(substr($param,0,-7)));
        }
      }
    }
  }
?>
<h1>Men&uuml; bearbeiten</h1>
<form action="index.php?page=menu-edit&menu=<?PHP echo $_GET['menu']; ?>" method="POST">
  <h2>Eintr&auml;ge Bearbeiten</h2>
  <?PHP
    Menu::displayEditable($GLOBALS['db']->EscapeString($_GET['menu']));
  ?>
  <input name="save" type="submit" value="Speichern"/>

  <h2>Neuen Eintrag hinzuf&uuml;gen</h2>
  <table>
    <tr>
	  <td style="width:100px;">Text:</td>
	  <td><input name="newtitle" style="width:200px;" /></td>
	</tr>
	<tr>
	  <td>Typ:</td>
	  <td>
	    <script language="javascript">
		  function typeSelected(){
			document.getElementsByName('newPage')[0].style.visibility ='hidden';
			document.getElementsByName('newurl')[0].style.visibility ='hidden';
			document.getElementsByName('newMenu')[0].style.visibility  ='hidden';

      if(document.getElementById('type').selectedIndex == 0){
			  document.getElementsByName('newPage').style.visibility ='visible';
			  document.getElementById('newLabel').innerHTML = 'Seite';
			}
			else if(document.getElementById('type').selectedIndex == 1){
			  document.getElementsByName('newurl')[0].style.visibility  ='visible';
			  document.getElementById('newLabel').innerHTML = 'Url';
			}
			else{
			  document.getElementsByName('newMenu')[0].style.visibility ='visible';
			  document.getElementById('newLabel').innerHTML = 'Men&uuml;:';
			}
		  }
		</script>
        <select id="type" name="type" onChange="typeSelected()" style="width:200px;">
          <option value="0">Seite Intern</option>
          <option value="1">Seite Extern</option>
          <option value="2">Men&uuml;</option>
        </select>
	  </td>
	  </tr>
	  <tr>
	    <td><span id="newLabel">Seite</a>:</td>
        <td>
		  <input name="newurl" value="http://" style="width:200px;visibility:hidden" />
		  <?PHP
          $selector = new MenueSelector();
	        $selector->name  = 'newMenu';
	        $selector->value = -1;
	        $selector->style = 'width:200px;position:relative;left:-210px;visibility:hidden';
	        $selector->display();
      ?>
		  <?PHP
          $selector = new PageSelector();
	        $selector->name  = 'newPage';
	        $selector->value = -1;
	        $selector->style = 'width:200px;position:relative;left:-415px;';
	        $selector->display();
      ?>
		</td>
	  </tr>
  </table>
  <input name="add" type="submit" value="Hinzuf&uuml;gen"/>
</form>
