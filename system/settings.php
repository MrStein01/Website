<?PHP
function getSetting($area,$areaType,$property){
	$area     = DataBase::Current()->EscapeString($area);
	$areaType = DataBase::Current()->EscapeString($areaType);
	$property = DataBase::Current()->EscapeString($property);
	return DataBase::Current()->ReadField("SELECT value FROM {'dbprefix'}settings WHERE area = '".$area."' AND areaType = '".$areaType."' AND property = '".$property."'");
}
function setSetting($area,$areaType,$property,$value){
	$area     = DataBase::Current()->EscapeString($area);
	$areaType = DataBase::Current()->EscapeString($areaType);
	$property = DataBase::Current()->EscapeString($property);
	$value    =  DataBase::Current()->EscapeString($value);
    return DataBase::Current()->Execute("UPDATE {'dbprefix'}settings SET value = '".$value."' WHERE area = '".$area."' AND areaType = '".$areaType."' AND property = '".$property."'");
}
?>
