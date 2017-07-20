<h1>Tabelle <?PHP echo $_GET['table']; ?></h1>
<?PHP
  $columns = $db->getColumns($_GET['table']);
  if($columns){
    if(!$_GET['pos']){
    $pos = 0 * 30;
    }
    else{
      $pos = mysql_real_escape_string($_GET['pos']) * 30;
    }
    $res = mysql_query("SELECT COUNT(*) FROM ".mysql_real_escape_string($_GET['table']));
    $count = mysql_fetch_row($res);
    $pagecount = ceil($count[0] / 30);
    for($cPage = 0;$cPage < $pagecount;$cPage++){
      echo "<a href=\"../admin/index.php?page=table-show&table=".$_GET['table']."&pos=".$cPage."\">".($cPage + 1)."</a> ";
    }
?>
<script language="JavaScript">
  function check(pos){
    document.getElementById('check-' + pos).checked = !document.getElementById('check-' + pos).checked;
  }
  function checkAll(){
    for (i = 0; i < document.table.entries.length; i++){
      document.table.entries[i].checked = document.getElementById('checkall').checked;
    }
  }
</script>
<form name="table">
  <table class="dbtable">
    <thead>
      <tr>
         <td><input id="checkall" type="checkbox" onClick="checkAll()" /></td>
         <td>Aktionen</td>
        <?PHP
          foreach($columns as $column){
            echo "<td>".htmlentities($column->Field)."</td>";
          }
        ?>
      </tr>
    </thead>
    <tbody>
      <?PHP
        $res = mysql_query("SELECT * FROM ".mysql_real_escape_string($_GET['table'])." LIMIT ".$pos.",30");
        $pos = 0;
        while($row = mysql_fetch_assoc($res)){
          ?>
          <tr onClick="check(<?PHP echo $pos; ?>)">
            <td>
              <input onClick="check(<?PHP echo $pos; ?>)" type="checkbox" id="check-<?php echo $pos; ?>" name="entries" value="<?PHP echo $pos; ?>" />
            </td>
            <td>
              <a title="Bearbeiten"
                 href="index.php?page=tableitem-edit&table=<?PHP echo $_GET['table']."&position=".$pos; ?>">

                <img src="../system/images/icons/page_edit.png" style=\"width:25px;\" />

              </a>
              <a title="L&ouml;schen"
                 href="index.php?page=tableitem-delete&table=<?PHP echo $_GET['table']."&position=".$pos; ?>">
                <img src="../system/images/icons/cross.png" style=\"width:25px;\" />

              </a>
            </td>
        <?PHP
          foreach($columns as $column){
            echo "<td>".substr(htmlentities($row[$column['Field']]),0,30)."</td>";
          }
          echo "</tr>";
          $pos++;
        }
      ?>
    </tbody>
  </table>
</form>
<?PHP
  }
  else{
    echo "<p>Tabelle wurde nicht gefunden</p>";
  }
?>
