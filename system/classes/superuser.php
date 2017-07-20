<?PHP
  class SuperUser{
    public function display($admin = false) {
      ?>
        <form action="<?PHP echo $_SERVER['REQUEST_URI']; ?>" method="post" id="superuser">
          <?php if(!$admin){ ?>
            <a href='#' class="closebtn">&times;</a>
          <?php } ?>
            <input type="hidden" name="SU" value="<?PHP echo $_SESSION['username'] ?>" />
            <input type="hidden" id="user" name="user" value="" />
            <?PHP
              $rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}user WHERE NOT name='".$_SESSION['username']."'");
              if($rows){
                foreach($rows as $row){
                  if($_SESSION['user']->isGreater($row->name))
                  {
                      echo "<a href='javascript:void(0)' class='submit".$row->name."' onclick=\"linkForm".$row->name."();\">";
                        echo $row->nick;
                      echo "</a>";
                      echo "<script type=\"text/javascript\">
                          $(function(){
                            $(\".submit".$row->name."\").click(function(){
                              linkForm".$row->name."();
                            });
                          });
                          function linkForm".$row->name."() {
                            document.getElementById('user').value = '".$row->name."';
                            document.getElementById('superuser').submit();
                          }
                        </script>";
                  }
                }
              }
            ?>
          </form>
      <?PHP
    }
  }
?>
