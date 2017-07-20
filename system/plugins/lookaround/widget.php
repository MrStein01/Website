<?PHP
  class LookAround extends WidgetBase{
    public function load(){
	  $this->headline = "Rundgang durch CMS";
	  $this->content = "<p style=\"text-align:center;\">
	                    <object width=\"320\" height=\"265\">
	                      <param name=\"movie\" 
						    value=\"http://www.youtube.com/v/MdpnMFZHbFc&hl=de_DE&fs=1&rel=0\">
						  </param>
						  <param name=\"allowFullScreen\" value=\"true\" />
						  <param name=\"allowscriptaccess\" value=\"always\" />
						  <embed 
						    src=\"http://www.youtube.com/v/MdpnMFZHbFc&hl=de_DE&fs=1&rel=0\" 
						    type=\"application/x-shockwave-flash\" 
						    allowscriptaccess=\"always\" 
						    allowfullscreen=\"true\" 
						    width=\"320\" 
						    height=\"265\" />
						</object>
						</p>";
	}
  }
?>