<?php
  class Anime {
    public $name;
    public $pic_dir;
    public $pic_name;
    public $seasons;
    public $eps;
    public $description;

    function newAnime() {

    }

    function getAnime($aName) {
      $anime = DataBase::Current()->Execute("SELECT * FROM {'dbprefix'}anime WHERE name='".$aName."'");
      while($row = $anime->fetch_row()) {
        $this->name         = $row[0];
        $this->seasons      = $row[1];
        $this->eps          = $row[2];
        $this->pic_dir      = $row[3];
        $this->pic_name     = $row[4];
        $this->description  = $row[5];
      }
    }

    function getPicDir() {
      return "<img src='../system/images/anime/".$this->pic_dir."/".$this->pic_name."' />";
    }

    function getNewAnime() {
      $newAnime = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}anime ORDER BY createdDate DESC LIMIT 3");
      if($newAnime) {
        echo "<div class='animePreview col-m-12'>";
          echo "<h2>Neue Anime</h2>";
        foreach ($newAnime as $anime) {
          echo "<div class='newAnime col-m-4'>
                  <div class='title'>
                    ".$anime->name."
                    <hr />
                  </div>
                  <div class='newAnimedescription'>
                    ".$anime->description."
                  </div>
                </div>";
        }
        echo "</div>";
      }
    }
  }
?>
