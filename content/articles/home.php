<div class="info">
    <h1>AnimePT</h1>
  </div>
<?php
  // news
  $news = new News();
  $news->display();
  $anime = new Anime();
  $anime->getNewAnime();
?>
