<?PHP
  class Dashboard{
    public $id;
    public $cols;

    function loadWidgets(){
	  $this->cols[] = $this->loadWidgetsByColumn(1);
	  $this->cols[] = $this->loadWidgetsByColumn(2);
	  $this->cols[] = $this->loadWidgetsByColumn(3);
	}

    function loadWidgetsByColumn($columnId){
	  $columnId = $GLOBALS['db']->EscapeString($columnId);
      $rows = $GLOBALS['db']->ReadRows("SELECT path FROM {'dbprefix'}dashboards
	                                       WHERE col = '".$columnId."' AND id = '".$this->id."'
   	                	                   ORDER BY row");
	  if($rows){
	    foreach($rows as $row){
	      $widgetData = WidgetController::getWidgetData($row->path);
		  $widget = WidgetController::getWidget($widgetData);
		  $widget->load();
		  $res[] = $widget;
	    }
	  }

	  return $res;
  }

	  function display($role) {
      if(isset($_POST['commentSave'])){
        if($_POST['cValue'] == "fertig" || $_POST['cValue'] == "Fertig"
            || $_POST['cValue'] == "Abgeschlossen" || $_POST['cValue'] == "abgeschlossen") {
          DataBase::Current()->Execute("UPDATE {'dbprefix'}todos SET progress=100, neu=1 WHERE id=".$_POST['commentID'].";");
        }
        else if(is_numeric($_POST['cValue'])) {
          if($_POST['cValue'] <= 100)
          {
            DataBase::Current()->Execute("UPDATE {'dbprefix'}todos SET progress=".$_POST['cValue']." WHERE id=".$_POST['commentID'].";");
          }
        }
        else {
          DataBase::Current()->Execute("INSERT INTO {'dbprefix'}comments (todoID, value) VALUES (".$_POST['commentID'].",'".$_POST['cValue']."')");
        }
      }
      $modalRow = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}todos WHERE role>=".$role." AND progress=100 AND neu=1;");
      if ($_SESSION['user']->isAdmin() && $modalRow){
        echo "<div class='modalFinish'>";
          ?>
            <div class="finishTodo">
              <div class="modal-header">
                <span class="closeFinish">&times;</span>
                <h3>Todo's wurden Abgeschlossen</h3>
              </div>
              <div class="modal-body">
                <?php foreach ($modalRow as $row) {
                  echo "<h5>".$row->title."</h5>";
                  echo "<p>".$row->value."</p>";
                  DataBase::Current()->Execute("UPDATE {'dbprefix'}todos SET neu=0 WHERE id=".$row->id.";");
                } ?>
              </div>
              <div class="modal-footer">
                <p>
                  Diese Todo's wurden vor kurzem abgeschlossen.
                </p>
              </div>
            </div>
          <?php
        echo "</div>";
      }
		  $rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}todos WHERE role>=".$role." AND NOT progress=100;");
		  if($rows) {
			foreach($rows as $row)
			{
			  ?>
			  <div class="msg">
          <div class="post">
  			  	<div class="name">
	           <?php
                echo "<p class='importance' style='float:right;'>";
                  if($row->importance == 0){
                    echo "Sehr wichtig";
                  }
                  else if($row->importance == 1) {
                    echo "wichtig";
                  }
                  else if($row->importance == 2) {
                    echo "normal";
                  }
                  else {
                    echo "nicht wichtig";
                  }
                echo "</p>";
 			          echo $row->title;
			       ?>
  			  	</div>
    				<p>
    					<?php
    						echo $row->value;
    					?>
    				</p>
          </div>
				<div class="comments">
					<?php
						$comments = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}comments WHERE todoID=".$row->id.";");
						echo "<form class='comment' action='".$_SERVER['REQUEST_URI']."' method='post'>";
						if($comments){
							foreach($comments as $comment){
								echo "<div class='commentValue'>";
								echo $comment->value;
								echo "</div>";
							}
						}
						echo "<textarea placeholder='Ihr Kommentar...' name='cValue'></textarea>";
            echo "<input type='hidden' name='commentID' value='".$row->id."' />";
            echo "<input type='hidden' name='commentSave' />";
            echo "<input type='submit' value='Kommentieren' />";
						echo "</form>";
					?>
				</div>
			  </div>
			  <?php
			}
		  }
	  }

    function oldDisplay() {
  		$rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}menu WHERE menuID = 8 AND NOT id = 1 ORDER BY id ASC;");
  		if($rows){
  		  foreach($rows as $row){
    			if (substr($row->title,0,1) == "{")
    			{
    			  $name = Language::Translate($row->title);
    			}
    			else
    			{
    			  $name = $row->title;
    			}
    			?>
    			<div class='thumbnail'>
    			  <div class='overlay'>
    				<div class='text'>
    				<a class='title' href="<?PHP echo $row->href; ?>"><?PHP echo $name; ?></a>
    				</div>
    			  </div>
    			  <div class='image'>
    				<img src='../system/images/dashboard/<?PHP
    					if ($row->id == 3)
    					{
    						echo "menue";
    					}
    					else
    					{
    						echo strtolower($row->title);
    					}
    				?>.jpg' />
    			  </div>
    			</div>
    			<?PHP

  		  }
  		}
    }

    function guestDisplay() {
      $rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}menu WHERE menuID = 8 AND uShow = 4 AND NOT id = 1 ORDER BY id ASC;");
  		if($rows){
  		  foreach($rows as $row){
    			if (substr($row->title,0,1) == "{")
    			{
    			  $name = Language::Translate($row->title);
    			}
    			else
    			{
    			  $name = $row->title;
    			}
    			?>
    			<div class='thumbnail'>
    			  <div class='overlay'>
    				<div class='text'>
    				<a class='title' href="<?PHP echo $row->href; ?>"><?PHP echo $name; ?></a>
    				</div>
    			  </div>
    			  <div class='image'>
    				<img src='../system/images/dashboard/<?PHP
    					if ($row->id == 3)
    					{
    						echo "menue";
    					}
    					else
    					{
    						echo strtolower($row->title);
    					}
    				?>.jpg' />
    			  </div>
    			</div>
    			<?PHP

  		  }
  		}
    }

    function userDisplay() {
  		$rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}menu WHERE menuID = 8 AND uShow = 2 AND NOT id = 1 ORDER BY id ASC;");
  		if($rows){
  		  foreach($rows as $row){
    			if (substr($row->title,0,1) == "{")
    			{
    			  $name = Language::Translate($row->title);
    			}
    			else
    			{
    			  $name = $row->title;
    			}
    			?>
    			<div class='thumbnail'>
    			  <div class='overlay'>
    				<div class='text'>
    				<a class='title' href="<?PHP echo $row->href; ?>"><?PHP echo $name; ?></a>
    				</div>
    			  </div>
    			  <div class='image'>
    				<img src='../system/images/dashboard/<?PHP
    					if ($row->id == 3)
    					{
    						echo "menue";
    					}
    					else
    					{
    						echo strtolower($row->title);
    					}
    				?>.jpg' />
    			  </div>
    			</div>
    			<?PHP

  		  }
  		}
    }

    function displayColumn($id){
	  ?>
        <ul id="column<?PHP echo $id; ?>" class="column">
		  <?PHP
		    if($this->cols[$id]){
			  foreach($this->cols[$id] as $widget){
			    $widget->display();
			  }
			}
		  ?>
		</ul>
	  <?PHP
	}
  }
?>
