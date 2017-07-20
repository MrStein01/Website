<h1>Datenbank</h1>
<table>
  <thead>
    <tr>
      <td>Name</td>
      <td class="td-small">Aktionen</td>
      <td class="td-small">Eintr&auml;ge</td>
    </tr>
  </thead>
  <tbody>
    <?PHP
      $tables = $db->GetTables($_GET['dbpage'] * 20,20);

      foreach($tables as $table){
        echo "<tr>
                <td>".$table."</td>
                <td>
                  <a title=\"Anzeigen\"
	                href=\"index.php?page=table-show&table=".urlencode($table)."\">
                      <img src=\"../system/images/icons/table.png\" style=\"width:25px;\" />
		          </a>
                  <a title=\"Bearbeiten\"
                    href=\"index.php?page=table-edit&&table=".urlencode($table)."\">
                      <img src=\"../system/images/icons/table_edit.png\" style=\"width:25px;\" />
		          </a>
                  <a title=\"L&ouml;schen\"
	                href=\"index.php?page=table-delete&table=".urlencode($table)."\">
                      <img src=\"../system/images/icons/table_delete.png\" style=\"width:25px;\" />
		          </a>
                </td>
                <td>".$db->countTableEntries($table)."</td>
               </tr>";
      }
    ?>
  </tbody>
</table>

<!--?PHP
  /*$pagecount = ceil($db->countTables() / 20);
  for($cPage = 0;$cPage < $pagecount;$cPage++){
    echo "<a href=\"../admin/index.php?page=db&dbpage=".$cPage."\">".($cPage + 1)."</a> ";
  }*/
?-->
