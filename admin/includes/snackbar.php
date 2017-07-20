<?php
      $userRole = $_SESSION['user']->getRole();
      $news = DataBase::Current()->ReadRows("SELECT * FROM {'dbprefix'}todos WHERE role>=".$userRole." AND NOT progress=100 ORDER BY progress DESC LIMIT 1;");
      if($news)
      {
          ?>
          <button class="infoSnackbar" onclick="showTodo()">!</button>

          <a style="opacity:unset;" href="/admin/">
              <div id="snackbar">
            	<?PHP
                foreach ($news as $var) {
                   echo $var->title;
            		}
            	?>
            </div>
          </a>

          <script>
            function showTodo() {
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }
          </script>
<?php } ?>
