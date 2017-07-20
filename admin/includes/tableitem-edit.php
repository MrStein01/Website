<?PHP
  $columns = MySQL::getColumns($_GET['table']);
  $res = mysql_query("SELECT * FROM
            ".mysql_real_escape_string($_GET['table'])."
			LIMIT ".mysql_real_escape_string($_GET['position']).",1");
  $data = mysql_fetch_assoc($res);

  if($_POST['save']){
    $olddata = $data;
    foreach($data as $key=>$value){
      if(isset($_POST[$key])){
        $data[$key] = $_POST[$key];
      }
    }
    echo MySQL::update($data,$olddata,$_GET['table']);
  }

  function getColumnSize($type){
    if(strpos($type,"(") > -1 && strpos($type,")") > -1){
	  return substr($type,strpos($type,"(")+1,strpos($type,")")-strpos($type,"(")-1);
	}
	else{
	  return false;
	}
  }
?>
<script language="JavaScript">
  function isInteger(s) {
    return (s.toString().search(/^-?[0-9]+$/) == 0);
  }
  function validate(name,type,value){
    if(type.substring(0,3) == 'int'){
	  if(!isInteger(value)){
        alert('Das Feld ' + name + ' muss vom Typ Integer sein.');
		document.getElementsByName(name)[0].focus();
	  }
	}
  }
</script>
<form action="<?PHP echo "../admin/index.php?page=tableitem-edit&table=".$_GET['table']."&position=".$_GET['position']; ?>" method="POST">
  <table>
    <?PHP foreach($columns as $column){ ?>
      <tr>
        <td><?PHP if($column['Key']) echo "<img src=\"../system/images/icons/key.png\" style=\"width:25px;\" />"; ?></td>
        <td><?PHP echo $column['Field']; ?></td>
        <td><?PHP echo $column['Type']; ?></td>
        <td><input onChange="validate('<?PHP echo $column['Field']; ?>',
                 '<?PHP echo $column['Type']; ?>',this.value)"
               name="<?PHP echo $column['Field']; ?>"
               value="<?PHP echo $data[$column['Field']]; ?>"
                      <?PHP if(getColumnSize($column['Type']))
                      echo " maxlength=\"".getColumnSize($column['Type'])."\"";?>></td>
      </tr>
    <?PHP } ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td><input name="save" type="submit" value="Speichern" /></td>
  </table>
</form>
