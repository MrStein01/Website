<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
    "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?PHP
      sys::includeHeader();
    ?>
    <link href="<?PHP echo sys::getFullSkinPath(); ?>style.css" type="text/css" rel="stylesheet" />
    <style>

        body{
          background-color: <?PHP echo sys::getColor("anime","skins","bgcolor"); ?>;
          color: <?PHP echo sys::getColor("global","global","highlight1"); ?>;
          font-family: 'Roboto Condensed';
          margin-left: 0;
          width: 100%;
          height: 100%;
          margin-top: 4rem;
        }

        a{
          color: <?PHP echo sys::getColor("global","global","highlight1"); ?>;
        }

        a:visited{
          color: <?PHP echo sys::getColor("global","global","highlight1"); ?>;
        }

        a:hover{
          color: <?php echo sys::getColor("global","global","highlight2"); ?>
        }

        #container {
          background-color:<?PHP echo sys::getColor("anime","skins","bgcolor"); ?>;
        }

    </style>
  </head>
  <body>
    <div id="container">
	    <h1><?PHP echo sys::getTitle(); ?></h1>
        <div id="menu">
          <?PHP
              sys::displayLocalMenu("<ul id='localmenu'>","</ul>","<li>","</li>",
                                    "localmenu");
          ?>
        </div>
        <div id="content">
          <?PHP
            sys::includeContent();
          ?>
		</div>
    </div>
  </body>
</html>
