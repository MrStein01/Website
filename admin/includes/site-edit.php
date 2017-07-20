<?PHP
  $page = new Page();
  $page->loadProperties(DataBase::Current()->EscapeString($_GET['site']));
  if($_POST['save']){
    $page->deleteContent("../");
    $page->title = $_POST['title'];
    $page->menu = $_POST['menu'];
    $page->meta->description = $_POST['meta-description'];
    $page->meta->keywords = $_POST['meta-keywords'];
    $page->meta->robots = $_POST['meta-robots'];
    $page->save();
    $page->writeContent("../",$_POST['content'],$page->alias);
    $content = $_POST['content'];
  }
  else if(isset($_POST['menu'])){
    $page->title = $_POST['title'];
    $page->alias = $_POST['alias'];
    $page->menu = $_POST['menu'];
    $content = $_POST['content'];
  }
  else{
    $content = $page->readContent("../");
  }

  if (substr($page->title,0,1) == "{")
  {
    $name = Language::Translate($page->title);
  }
  else
  {
    $name = $page->title;
  }

?>
<h1>Seite bearbeiten</h1>
<form name="form" action="../admin/index.php?page=site-edit&site=<?PHP echo $page->alias; ?>"
      method="post">
  <div class="siteContent" style="float:left;">
    <div class="siteTitle">
    <!--label for="title">Titel:</label-->
      <input type="text" name="title" value="<?PHP echo $name; ?>" />

    <!--label for="alias">Alias:</label-->
      <input type="hidden" name="alias" value="<?PHP echo $page->alias; ?>" />

    </div>

    <!--label for="content" />Inhalt</label-->
      <script type="text/javascript" src="../system/WYSIWYG/tiny_mce.min.js"></script>
      <script type="text/javascript">
      tinyMCE.init({
      	// General options
              language : "de",
      	mode : "textareas",
      	theme : "modern",
      	plugins : "spellchecker,pagebreak,table,save,emoticons,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,template",
        width : 750,
        height : 300,
        skin : "light",

      	// Theme options
      	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
      	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,code,|,forecolor,backcolor",
      	theme_advanced_buttons3 : "tablecontrols,|,visualaid,|charmap,|,fullscreen,spellchecker,|,visualchars,template,blockquote,|,insertfile,insertimage",
      	theme_advanced_toolbar_location : "top",
      	theme_advanced_toolbar_align : "left",
      	theme_advanced_statusbar_location : "bottom",
      	theme_advanced_resizing : true,

      	// Example content CSS (should be your site CSS)
      	//content_css : "css/example.css",

      	// Drop lists for link/image/media/template dialogs
      	template_external_list_url : "template_list.js",
      	external_link_list_url : "link_list.js",
      	external_image_list_url : "../content/imagelist.php",
      	media_external_list_url : "js/media_list.js",
      });
      </script>
      <textarea name="content"><?PHP echo $content; ?></textarea>
  </div>
  <div class="siteSetting">
	   <h2>Meta Daten</h2>
      <label for="meta-description">Description:</label>
      <input type="text" name="meta-description" value="<?PHP echo $page->meta->description; ?>" /><br />
      <label for="meta-keywords">Keywords:</label>
      <input type="text" name="meta-keywords" value="<?PHP echo $page->meta->keywords; ?>" /><br />
      <label for="meta-robots">Robots:</label>
      <input type="text" name="meta-robots" value="<?PHP echo $page->meta->robots; ?>" /><br />
    <h2>Seitenmen&uuml;</h2>
    <select name="menu" onchange="document.form.submit();">
      <option value="0">-- Kein Men&uuml; --</option>
      <?PHP
        foreach(sys::getMenues() as $menue){
          echo "<option value=\"".$menue->id."\"";
          if($_POST['menu'] == $menue->id){
            echo " selected=\"selected\"";
          }
          else if($page->menu == $menue->id && !$_POST['menu']){
            echo " selected=\"selected\"";
          }

          echo ">".$menue->name."</option>";
        }
      ?>
    </select>
    <div id="menupreview">
      <?PHP
        if($_POST['menu']){
          Menu::display($_POST['menu'],"<ul>","</ul>","<li>","</li>","");
        }
        else if($page->menu > 0){
          Menu::display($page->menu,"<ul>","</ul>","<li>","</li>","");
        }
      ?>
    </div>
  </div>
  <?PHP
  	EventManager::raiseEvent("site_edit_shown","../",$page);
  ?>
  <div style="clear:both;">
    <input name="vorschau" type="submit" value="Vorschau" onclick="form.action='../<?PHP echo $page->alias; ?>.html' ; target='_blank' ; return true" />
    <input name="save" type="submit" value="&Auml;ndern" onclick="form.action='<?PHP echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'] ?>' ; target='_self' ; return true" />
  </div>
</form>
