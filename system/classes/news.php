<?php
  class News {
    function display() {
      $animes = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}news ORDER BY createdDate DESC;");
      if ($animes) {
        echo '<div class="news col-m-12">
          <h2>Neustes</h2>';
        foreach ($animes as $anime) {
          echo "<div class='article col-m-4'>
                  <div class='title'>
                    ".$anime->name."
                  </div>
                  <div class='value'>
                    ".$anime->value."
                  </div>
                </div>";
        }
        echo '</div>';
      }
    }
  }
?>
