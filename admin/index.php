<?PHP
  session_start();
  if ($_POST['SU']) {
    if (!$_SESSION['SU']){
      $_SESSION['SU'] = $_POST['SU'];
    }
  }
  function __autoload($class_name){
      require_once "../system/classes/".strtolower($class_name).".php";
  }
  include("../system/settings.php");
  include("../system/filterfilename.php");
  include("../system/sys.php");
  $db = new MySQL('../system/dbsettings.php');
  $db->Connect();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
  <head>
    <title>Admin-Bereich</title>
    <meta name="viewport" content="width=device-width; initial-scale=1.0;">
    <link href="../admin/style.css" rel="stylesheet" type="text/css" />
    <link href="../admin/customcss/menue.css" rel="stylesheet" type="text/css" />
    <link href="../admin/customcss/dropdown.css" rel="stylesheet" type="text/css" />
    <link href="../admin/customcss/snackbar.css" rel="stylesheet" type="text/css" />
    <style>
        .settingsform input[type=submit] {
          background: <?php echo sys::getColor("global","global","highlight2"); ?>;
        }
        .form input[type=submit] {
          background: <?php echo sys::getColor("global","global","highlight2"); ?>;
        }
        .form .message a {
          color: <?PHP echo sys::getColor("global","global","highlight2") ?>;
        }

        a{
          color: <?PHP echo sys::getColor("global","global","highlight1"); ?>;
        }

        a:visited{
          color: <?PHP echo sys::getColor("global","global","highlight1"); ?>;
        }

        a:hover{
          color: <?php echo sys::getColor("global","global","highlight2"); ?>;
        }

    </style>
	<?PHP
	  CustomCSS::printStylesheet("{admin}/".$_GET['page']);
	?>
  <script src="../system/js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
  <script src="../admin/customjs/sidebar.js" type="text/javascript"></script>
  <script src="../admin/customjs/dropdown.js" type="text/javascript"></script>
  <?php
    CustomJS::printScript("{admin}/".$_GET['page']);
  ?>
  </head>
  <body>
      <?PHP
        $user = new User();
        if($_POST['user']){
          if($_POST['SU'] || $user->login($_POST['user'],$_POST['password'])){
            $user->setCurrentUser($_POST['user']);
            $_SESSION['user'] = $user;
            $_SESSION['username'] = $_POST['user'];
            $_SESSION['isAU'] = 1;
          }
          else{
            echo "<p>Login Fehlgeschlagen!</p>";
          }
        }
	if($_SESSION['SU'] || isset($_SESSION['username']) && $_SESSION['isAU'] == 1){
      echo '<div class="navigationOpen">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
      </div>';
    include("includes/menue.php");
     echo "</div>";
      if(!$_GET['page']){
        $_GET['page'] = 'dashboard';
	     }
	  echo "<div id=\"content\" class=\"col-m-12\">";
      ?>
        <div class="sidebar superUser">
          <div class="user">
            <?php
              $SU = new SuperUser();
              $SU->display();
            ?>
          </div>
          <?php if ($_SESSION['SU'] && $_SESSION['SU'] != $_SESSION['username']) { ?>
            <a class='closeSU'>Super User Modus schließen</a>
          <?php } else {?>
            <div id='logout'><a href="index.php?page=logout"><img src="../system/images/icons/admin/logout.png" style="width:2rem;" alt="Logout" />LOGOUT</a></div>
          <?php } ?>
        </div>
      <?PHP
      include("includes/dropdown.php");
      include("includes/SUModus.php");
		include("includes/snackbar.php");
      include(filterfilename("includes/".$_GET['page']));
	  echo "</div>";
	}
	else{
        if(isset($_SESSION['username'])){
          echo "<script type='text/javascript'>";
          echo "setTimeout(\"window.location.href='../access_denied.html'\",0);";
          echo "</script>";
        }
		echo "<link href=\"../admin/customcss/login.css\" rel=\"stylesheet\" type=\"text/css\" />";
		echo "<script src=\"../system/js/login/login.js\" type=\"text/javascript\"></script>";
        include('includes/login.php');
	}
      ?>
  </body>
</html>
