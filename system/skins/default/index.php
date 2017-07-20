<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
  <head>
    <?PHP
      sys::includeHeader();
    ?>
	<link rel='stylesheet' href="<?PHP echo sys::getFullSkinPath(); ?>style.css" type="text/css" media="all" />
    <style type="text/css">
      body{
        color: <?PHP echo sys::getColor("default","skins","forecolor"); ?>;
      }
      a{
        color: <?PHP echo sys::getColor("default","skins","highlight1"); ?>;
      }
      a:visted{
        color: <?PHP echo sys::getColor("default","skins","highlight2"); ?>;
      }
      #container{
        background-color:<?PHP echo sys::getColor("default","skins","bgcolor"); ?>;
        border: 1px solid  <?PHP echo sys::getColor("default","skins","highlight1"); ?>;
      }
      #content{
		<?PHP if(sys::localMenuExists()){
		?>
        width:78%;
        position:relative;
        margin-left:20%;
		<?PHP
		}
		?>
      }
    </style>
  </head>
  <body>
    <center>
      <div id="container">
	    <h1><?PHP echo sys::getTitle(); ?></h1>
        <?PHP
          sys::displayGlobalMenu("<ul id=\"globalmenu\">","</ul>","<li>"," </li>",
                                 "globalmenu");
        ?>
		<div id="localmenu">
        <?PHP
          sys::displayLocalMenu("<ul>","</ul>","<li>","</li>",
                                "localmenuentry");
        ?>
		</div>
        <div id="content">
          <div id="breadcrump">
            <?PHP
              sys::displayBreadcrump(" -&gt; ","breadcrump","bc");
            ?>
          </div>
          <?PHP
		    if($_POST['content']){
			  echo $_POST['content'];
			}
			else{
              sys::includeContent();
			}
          ?>
        </div>
      </div>
    </center>
  </body>
</html>