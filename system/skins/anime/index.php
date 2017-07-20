<?PHP
  session_start();
  sys::includeHeader();
  if ($_POST['SU']) {
    if (!$_SESSION['SU']){
    // Super User Modus implementieren.
		$_SESSION['SU'] = $_POST['SU'];
	}
  }
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">

    <head>
        <link rel="shortcut icon" type="image/x-icon" href="system/skins/anime/pictures/tab.ico" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0;">
        <link href="<?PHP echo sys::getFullSkinPath(); ?>customcss/fonts.css" type="text/css" rel="stylesheet" media="all" />
        <link href="<?PHP echo sys::getFullSkinPath(); ?>customcss/responsive.css" type="text/css" rel="stylesheet" media="all" />
        <link href="<?PHP echo sys::getFullSkinPath(); ?>customcss/style.css" type="text/css" rel="stylesheet" media="all" />
        <link href="<?PHP echo sys::getFullSkinPath(); ?>customcss/dropdown.css" type="text/css" rel="stylesheet" media="all" />
        <link href="<?PHP echo sys::getFullSkinPath(); ?>customcss/profile.css" type="text/css" rel="stylesheet" media="all" />
        <link href="<?PHP echo sys::getFullSkinPath(); ?>customcss/settings.css" type="text/css" rel="stylesheet" media="all" />
        <link href="<?PHP echo sys::getFullSkinPath(); ?>customcss/customModal.css" type="text/css" rel="stylesheet" media="all" />
        <script src="system/js/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
        <!--script src="< ?PHP echo sys::getFullSkinPath(); ?>js/responsive.js" type="text/javascript"></script-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <?php
      CustomJS::printScript("{anime}/".$_GET['include']);
    ?>
            <style>
                body {
                    color: white;
                    font-family: 'Roboto Condensed';
                    margin-left: 0;
                    background-color: <?PHP echo sys::getColor("anime", "skins", "bgcolor");
                    ?>
                }
                
                a {
                    color: <?PHP echo sys::getColor("global", "global", "highlight1");
                    ?>;
                }
                
                a:visited {
                    color: <?PHP echo sys::getColor("global", "global", "highlight1");
                    ?>;
                }
                
                a:hover {
                    color: <?php echo sys::getColor("global", "global", "highlight2");
                    ?> !important;
                }
            </style>
            <?PHP
		  CustomCSS::printStylesheet("{anime}/".$_GET['include']);
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
            if ($user->isUser() || $user->isAdmin())
            {
              $_SESSION['isAU'] = 1;
            }
            else {
              $_SESSION['isAU'] = 0;
            }
    			}
    			else{
    				echo "<p>Login Fehlgeschlagen!</p>";
    			}
    		}

        if ($_POST['newPasswort'] && $_POST['newPasswort_retype']) {
          if ($_POST['newPasswort'] == $_POST['newPasswort_retype']) {
            $user = new User();
            $user->recoverPassword($_POST['emailRecovery'] ,$_POST['newPasswort']);
          }
        }

        if($_POST['forEmail']) {
          $empfaenger = $_POST['forEmail'];
          $betreff = "Passwort vergessen";
          $from = "From: Password Recovery <joscha.mueller@live.de>\n";
          $from .= "Reply-To: joscha.mueller@live.de\n";
          $from .= "Content-Type: text/html\n";
          $link = "<a href='http://animept.de/index.php?include=password_recovery&email=".$_POST['forEmail']."'>Passwort</a>";
          $text = "Klicken sie um ihr ".$link." zu ändern.";

          mail($empfaenger, $betreff, $text, $from);
        }

        if($_POST['user_register']) {
          if($user->registerFrontend($_POST['user_register'],$_POST['password_register'],$_POST['email_register'])) {
            $user->setCurrentUser($_POST['user']);
            $_SESSION['user'] = $user;
            $_SESSION['username'] = $_POST['user'];
            if ($user->isUser() || $user->isAdmin())
            {
              $_SESSION['isAU'] = 1;
            }
            else {
              $_SESSION['isAU'] = 0;
            }
          }
          else {
            echo "<script type='text/javascript'>";
            echo "$(function(){
              $(\".modal-content\").hide();
              $(\".modal-content-forgot\").hide();
              $(\".modal-content-register\").show();
              $(\".modal\").show();
              $(\".error\").text(\"Benutzername oder E-Mail wird bereits verwendet.\")});";
            echo "</script>";
          }
        }

        if($_POST['chName'] || $_POST['chNick'] || $_POST['chEmail']) {
          if ($_POST['chName'] != $_SESSION['username'] && $_POST['chName'] != "") {
            DataBase::Current()->Execute("UPDATE {'dbprefix'}user SET name='".$_POST['chName']."' WHERE name='".$_SESSION['username']."';");
            $_SESSION['username'] = $_POST['chName'];
          }
          if ($_POST['chNick'] != $_SESSION['user']->nick && $_POST['chNick'] != "") {
            DataBase::Current()->Execute("UPDATE {'dbprefix'}user SET nick='".$_POST['chNick']."' WHERE name='".$_SESSION['username']."';");
            $_SESSION['user']->nick = $_POST['chNick'];
          }
          if ($_POST['chEmail'] != $_SESSION['user']->email && $_POST['chEmail'] != "") {
            DataBase::Current()->Execute("UPDATE {'dbprefix'}user SET email='".$_POST['chEmail']."' WHERE name='".$_SESSION['username']."';");
            $_SESSION['user']->email = $_POST['chEmail'];
          }
        }

      ?>
            <center>
                <div id="container">
              <?php
                include("forms/menue.php");
                if (isset($_SESSION['username'])) {
              ?>
                        <div class="openMen">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                        </div>
                    
                        <input type="text" name="search" class="searchBar" placeholder="Search..">
                        
          <?php
                    $search = new Search();
                    $search->display('a');
                    if($_GET['include'] == "" || $_GET['include'] == "home")
                    {
                        echo '<button class="openNews">!</button>';
                    }
              include("forms/dropdown.php");
            }
            else {
              echo "<div class=\"login\"><span>Login</span></div>";
            }
          ?>
            <div id="content" class="col-m-12">
                                <?PHP
              if($_SESSION['username'] || $_GET['include'] == "password_recovery") {
  					    if(isset($_POST['content'])){
  					      echo $_POST['content'];
  					    }
  					    else{
  					      sys::includeContent();
  					    }
              }
              else {
                sys::includeContent(false);
              }
					  ?>
                            </div>
                </div>
                <?PHP
        if (isset($_SESSION['username'])) {
          ?>
                    <div class="sidebar superUser">
                        <div class="user">
                            <?php
                  $SU = new SuperUser();
                  $SU->display();
                ?>
                        </div>
                    </div>
                    <!-- TEST-BEREICH ->
                    <button class="openCusModal">Modal öffnen</button>
                    <!- ENDE TEST-BEREICH-->
        <?PHP
            /// Profil-Einstellungen
            echo '<script src="system/skins/anime/js/profile.js" type="text/javascript"></script>';
            include ("forms/settings.php");

            /// Userbedingte Einstellungen
            echo '<script src="system/skins/anime/js/settings.js" type="text/javascript"></script>';
            include ("forms/profile.php");

            /// Modal für andere Sachen
            echo '<script src="system/skins/anime/js/customModal.js" type="text/javascript"></script>';
            include ("forms/customModal.php");

          if($_GET['include'] == "" || $_GET['include'] == "home")
          {
            echo '<link href="system/skins/anime/customcss/news.css" type="text/css" rel="stylesheet" media="all" />';
            echo '<script src="system/skins/anime/customjs/home.js" type="text/javascript"></script>';
            include ("forms/news.php");
          }

          if ($_SESSION['SU'] && $_SESSION['SU'] != $_SESSION['username']) {
            include ("forms/SUModus.php");
          }
        }
        else {
          echo "<script src=\"system/skins/anime/js/login.js\" type=\"text/javascript\"></script>";
          echo "<link href='".sys::getFullSkinPath()."customcss/login.css' type='text/css' rel='stylesheet' media='all' />";
          echo '<script src="system/skins/anime/customjs/home.js" type="text/javascript"></script>';
          include ("forms/login.php");
        }
      ?>
            </center>
    </body>

    </html>