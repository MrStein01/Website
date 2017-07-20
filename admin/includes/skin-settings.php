<h1>Skin-Einstellungen <?PHP echo $_GET['skin']; ?></h1>
<?PHP
  $settings           = new SettingsForm();
  $settings->areaType = 'skins';
  $settings->area     = $_GET['skin'];
  $settings->display();
?>