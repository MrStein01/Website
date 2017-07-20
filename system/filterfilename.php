<?PHP
function filterfilename($filename){
  if ($filename == "content/articles/") {
    $filename .= "errors/notFound";
  }
	$filename = strtolower($filename);
	$filename = preg_replace("/[^a-z0-9\-\/]/i","",$filename);
	if($filename[0] == "/"){
		$filename = substr($filename,1);
	}
	$filename .= ".php";
	return $filename;

}
?>
