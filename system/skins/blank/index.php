<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
  <head>
    <?PHP
      sys::includeHeader();
      if(isset($_GET['tinymce'])){
        ?>
        	<script type="text/javascript" src="<?PHP echo Settings::getValue("host"); ?>system/WYSIWYG/tiny_mce_popup.js"></script>
        <?PHP
      }
    ?>
    <link rel='stylesheet' href="<?PHP echo sys::getFullSkinPath(); ?>style.css" type="text/css" media="all" />
  </head>
  <body>
    <?PHP
      if(isset($_POST['content']) && $_POST['content']){
        echo $_POST['content'];
      }
      else{
        sys::includeContent();
      }
    ?>
  </body>
</html>