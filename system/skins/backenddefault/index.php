<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
  <head>
    <link rel='stylesheet' href="<?PHP echo sys::getFullSkinPath(); ?>style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?PHP echo Settings::getInstance()->get("host"); ?>system/css/jquery/base/jquery.ui.all.css">
    <link rel="stylesheet" href="<?PHP echo Settings::getInstance()->get("host"); ?>system/css/jquery/contentlion.css">
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/external/jquery.bgiframe-2.1.1.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.core.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.widget.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.mouse.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.draggable.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.position.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.resizable.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.sortable.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/plugins/jquery/ui/jquery.ui.dialog.js"></script>
    <script type="text/javascript" src="<?PHP echo Settings::getInstance()->get("host"); ?>system/js/dialogs.js"></script>
    <script type="text/javascript" src="http://api.contentlion.org/api.php?method=jsbackend&apikey=<?PHP echo Settings::getInstance()->get("apikey"); ?>&alias=<?PHP echo urlencode(sys::getAlias()); ?>&language=<?PHP echo Settings::getInstance()->get("language"); ?>&version=<?PHP echo VERSION; ?>"></script>
    <?PHP
      sys::includeHeader();
    ?>
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?PHP echo sys::getFullSkinPath(); ?>ie7.css">
	<![endif]-->
  </head>
  <body>
    <div id="header">
      <div id="globalmenu">
        <?PHP
          sys::displayGlobalMenu("<ul>","</ul>","<li>"," </li>",
                                 "");
        ?>
      </div>
      <a href="http://www.contentlion.org">
		<img src="<?PHP echo sys::getFullSkinPath(); ?>/images/logo_97x14.png" id="logo" alt="ContentLion Logo" style="border:none" />
	  </a>
    </div>
    <div id="logout">
        <?PHP echo htmlentities(sys::getCurrentUserName()); ?> | <a href="<?PHP echo UrlRewriting::getUrlByAlias("admin/logout"); ?>">Logout</a>
    </div>
    <div id="breadcrumb">
      <?PHP sys::displayBreadcrumb(" -&gt; ","breadcrump","bc"); ?>
    </div>
    <div id="content">
      <h1><?PHP echo Page::Current()->title; ?></h1>
      <?PHP
          sys::includeContent();
      ?>
    </div>
    <div id="footer">
	  <div style="padding-right:5px;float:right">
		  <?PHP echo sys::getFooter(); ?> 
		  <?PHP if(DEVELOPMENT){ ?>
			| Q: <?PHP echo $GLOBALS['db']->countQueries(); ?> | M: <?PHP echo memory_get_usage(); ?> | C: <?PHP echo $GLOBALS['loadedClasses']; ?>
		  <?PHP } ?>
	  </div>
	  <div style="padding-left:5px;">
		<a href="http://www.contentlion.org" style="color:#d19340">ContentLion Online</a> | 
		<?PHP if(strtolower(Settings::GetValue("language")) == "de") { ?><a href="http://www.contentlion.de/doku.html" style="color:#d19340">Dokumentation</a> | <?PHP } ?>
		<a href="http://plugins.contentlion.org" style="color:#d19340">Plugins</a> |
		<a href="http://blogs.contentlion.org" style="color:#d19340">Blogs</a>
	  </div>
    </div>
    <div id="iframedialog" title="" style="display:none;padding:0">
      <iframe id="iframedialog_frame" style="width:100%;height:100%;border-width:0" />
    </div>
  </body>
</html>