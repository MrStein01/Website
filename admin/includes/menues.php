<h1>Men&uuml;s</h1>
<p>
  <a class="styled-link" href="../admin/index.php?page=menue-new">Neues Men&uuml;</a>
</p>
<table>
  <thead>
    <tr>
      <td class="td-small"><strong>ID</strong></td>
      <td><strong>Name</strong></td>
      <td class="td-small"><strong>Seiten</strong></td>
      <td class="td-small"><strong>Aktionen</strong></td>
    </tr>
  </thead>
  <tbody>
    <?PHP
      foreach(sys::getMenues() as $menue){
    ?>
    <tr>
      <td><?PHP echo $menue->id; ?></td>
      <td><?PHP echo $menue->name; ?></td>
      <td><?PHP echo $menue->count; ?></td>
      <td>
        <a title="Bearbeiten" href="index.php?page=menu-edit&menu=<?PHP
           echo $menue->id;
        ?>">
           <img src="../system/images/icons/page_edit.png" style="width:25px;" />
	</a>
        <a title="L&ouml;schen" href="index.php?page=menu-delete&menu=<?PHP
           echo $menue->id;
        ?>">
           <img src="../system/images/icons/cross.png" style="width:25px;" />
	</a>
      </td>
    </tr>
    <?PHP
      }
    ?>
  </tbody>
</table>
