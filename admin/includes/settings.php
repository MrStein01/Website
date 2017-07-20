<h1>Einstellungen</h1>
<?PHP
  $settings = new SettingsForm();
  $settings->display();
?>
<!--div id="siteNav" style=";margin-top:6rem;">
  <div id="skins">
    <h2>Skins</h2>
    < ?PHP
      $skins = $GLOBALS['db']->ReadRows("SELECT * FROM {'dbprefix'}skins WHERE LOWER(name) IN (SELECT DISTINCT name FROM {'dbprefix'}settings WHERE areaType = 'skins' AND area = {'dbprefix'}skins.name)");
      if($skins){
        foreach($skins as $skin){
          echo "<a href=\"../admin/index.php?page=skin-settings&skin=".urlencode($skin->name)."\">".$skin->name."</a><br />";
        }
      }
    ?>
  </div>
  <div id="plugins">
    <h2>Plugins</h2>
    < ?PHP
      $plugins = new PluginList();
      $plugins->loadAll();
      foreach($plugins->plugins as $plugin){
        if($plugin->configurationFile != ''){
          ?>
            <a class="styled-link" href="../admin/index.php?page=plugin-settings&plugin=< ?PHP echo $plugin->path; ?>">< ?PHP echo $plugin->name; ?></a><br />
          < ?PHP
        }
      }
    ?>
  </div>
</div-->
