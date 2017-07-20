<?php
      $userRole = $_SESSION['user']->getRole();
      $news = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}news ORDER BY createdDate DESC;");
      if($news)
      {
?>
 <div class="newsSidebar">
  <span class="newsClosebtn" title="Close News">&times;</span>
 <?PHP
        foreach ($news as $var) {
          echo '<div class="news">';
          echo '<h3>';
          echo $var->name;
          echo '</h3>';
          echo $var->value;
          echo '</div><hr />';
        }
		      echo "</div>";
      }
  ?>
