<h1>Anime</h1>
<?php
  $anime = new AnimeForm();
  if (!$_POST['anime']) {
    $anime->displayAll();
  }
  else {
    $anime->displayAnime($_POST['anime']);
  }
?>
