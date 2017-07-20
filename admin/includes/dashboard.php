<h1>Dashboard</h1>
<?PHP
  $dashboard = new Dashboard();
  $dashboard->display($_SESSION['user']->getRole());
?>