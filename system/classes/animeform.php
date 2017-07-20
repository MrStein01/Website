<?PHP
  class AnimeForm {

    public function displayAll () {
      $rows = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}anime;");
      $anime = new Anime();
      if($rows) {
        foreach ($rows as $row) {
          $noLeer = str_replace(' ','',$row->name);
          $anime->getAnime($row->name);
          ?>
          <script type="text/javascript">
              $(function(){
                $(".showAnime<?PHP echo $noLeer; ?>").click(function(){
                  linkForm<?PHP echo $noLeer ?>();
                });
              });
              function linkForm<?PHP echo $noLeer ?>() {
                document.getElementById('oneAnime<?PHP echo $row->name; ?>').submit();
              }
            </script>
            <form id="oneAnime<?PHP echo $row->name; ?>" action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" method="post">
              <div class="view col-m-3">
                <input type="hidden" value="<?PHP echo $row->name ?>" name="anime" />
                <div class="overlay">
                  <a href="javascript:void(0)" class="showAnime<?PHP echo $noLeer; ?>"><?PHP echo $row->name ?></a>
                </div>
                <div class="background">
                    <div class="cover">
                      <?php
                        echo $anime->getPicDir();
                      ?>
                    </div>
                </div>
              </div>
            </form>
          <?PHP
        }
      }
    }

    public function displayAnime ($name) {
      /* TODO: Das hier auf das Modal bekommen */
      $anime = new Anime();
      $anime->getAnime($name);
      ?>
        <div class="background">
          <div class="cover">
            <?php echo $anime->getPicDir(); ?>
          </div>
          <div class="description">
            <?php echo $anime->description; ?>
          </div>
          <div class="eps">
            <?php
              $eps = DataBase::Current()->ReadRows("SELECT * from {'dbprefix'}episodes WHERE name='".$name."'");
              if ($eps) {
                foreach ($eps as $ep) {
                  ?>
                    <div class="episode<?PHP echo $ep->episode; ?>">
                      <?php
                        echo $ep->name;
                        echo $ep->title;
                      ?>
                    </div>
                  <?php
                }
              }
            ?>
          </div>
        </div>
      <?PHP
    }

  }
?>
