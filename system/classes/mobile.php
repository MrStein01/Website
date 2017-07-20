<?PHP
  class Mobile{
    public function isMobileDevice(){
	  $res           = false;
	  $res           = self::isMobileAppleBrowser();
	  if(!$res) $res = self::isOperaMini();
	  if(!$res) $res = self::doesBrowserContainMobileKeywords();
      return $res;
	}
	
	public function isMobileAppleBrowser(){
	  return eregi('apple',$_SERVER['HTTP_USER_AGENT'])&&eregi('mobile',$_SERVER['HTTP_USER_AGENT']);
	}
	
	public function isOperaMini(){
	  return eregi('opera mini',$_SERVER['HTTP_USER_AGENT']);
	}
	
	public function doesBrowserContainMobileKeywords(){
	  return ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'text/vnd.wap.wml')>0) or (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0)) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']))) or in_array(strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4)),array('acs-'=>'acs-', 'alav'=>'alav', 'alca'=>'alca', 'amoi'=>'amoi', 'audi'=>'audi', 'aste'=>'aste', 'avan'=>'avan', 'benq'=>'benq', 'bird'=>'bird', 'blac'=>'blac', 'blaz'=>'blaz', 'brew'=>'brew', 'cell'=>'cell', 'cldc'=>'cldc', 'cmd-'=>'cmd-', 'dang'=>'dang', 'doco'=>'doco', 'eric'=>'eric', 'hipt'=>'hipt', 'inno'=>'inno', 'ipaq'=>'ipaq', 'java'=>'java', 'jigs'=>'jigs', 'kddi'=>'kddi', 'keji'=>'keji', 'leno'=>'leno', 'lg-c'=>'lg-c', 'lg-d'=>'lg-d', 'lg-g'=>'lg-g', 'lge-'=>'lge-', 'maui'=>'maui', 'maxo'=>'maxo', 'midp'=>'midp', 'mits'=>'mits', 'mmef'=>'mmef', 'mobi'=>'mobi', 'mot-'=>'mot-', 'moto'=>'moto', 'mwbp'=>'mwbp', 'nec-'=>'nec-', 'newt'=>'newt', 'noki'=>'noki', 'opwv'=>'opwv', 'palm'=>'palm', 'pana'=>'pana', 'pant'=>'pant', 'pdxg'=>'pdxg', 'phil'=>'phil', 'play'=>'play', 'pluc'=>'pluc', 'port'=>'port', 'prox'=>'prox', 'qtek'=>'qtek', 'qwap'=>'qwap', 'sage'=>'sage', 'sams'=>'sams', 'sany'=>'sany', 'sch-'=>'sch-', 'sec-'=>'sec-', 'send'=>'send', 'seri'=>'seri', 'sgh-'=>'sgh-', 'shar'=>'shar', 'sie-'=>'sie-', 'siem'=>'siem', 'smal'=>'smal', 'smar'=>'smar', 'sony'=>'sony', 'sph-'=>'sph-', 'symb'=>'symb', 't-mo'=>'t-mo', 'teli'=>'teli', 'tim-'=>'tim-', 'tosh'=>'tosh', 'treo'=>'treo', 'tsm-'=>'tsm-', 'upg1'=>'upg1', 'upsi'=>'upsi', 'vk-v'=>'vk-v', 'voda'=>'voda', 'wap-'=>'wap-', 'wapa'=>'wapa', 'wapi'=>'wapi', 'wapp'=>'wapp', 'wapr'=>'wapr', 'webc'=>'webc', 'winw'=>'winw', 'winw'=>'winw', 'xda-'=>'xda-'));
	}
  }
?>