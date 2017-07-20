<?PHP
  class UserForm{
    public function display() {
      ?>
        <form class="userform" action="<?PHP echo $_SERVER['REQUEST_URI']; ?>" method="POST">
          <div class="usercontent col-m-9">
            <?PHP
              $rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}user");
              if($rows){
                foreach($rows as $row){
                  if($_SESSION['user']->isGreater($row->name))
                  {
                      if ($row->nick == $_SESSION['user']->nick)
                      {
                        echo "<div class ='card col-m-5'>";  
                      }
                      else
                      {
                        echo "<div class='card col-m-3'>";
                      }
                      echo "<img src='/system/images/users/".$row->pic_dir."/".$row->pic_name."' alt='".$row->nick."' style='width:100%' />
                            <div class='container'>
                            <h1>".$row->vorname." ".$row->nachname."</h1>
                            <p class='title'>CEO & Founder, Example</p>
                            <p>";
                            if($row->email != "") {
                              echo $row->email;
                            }
                            else {
                              echo "***User_EMAIL***";
                            }
                            echo "</p>
                            <p><a href=\"index.php?page=user-show&user=".$row->name."\">".$row->vorname." bearbeiten</a></p>";
                        /*echo "<a href=\"index.php?page=user-show&user=".$row->name."\"><div class='cover'>";
                          echo "<label for=\"".htmlentities($row->nick)."\">";
                          echo $row->nick;
                          echo "</label>";
                        echo "</div></a>";
                        echo "<div class='content'>";
                          echo $row->name;
                          echo "<br />";
                          echo $row->email;
                        echo "</div>";*/
                        echo "</div>";
                      echo "</div>";
                  }
                }
              }
            ?>
          </div>
        </form>
      <?PHP
    }
  }
?>
