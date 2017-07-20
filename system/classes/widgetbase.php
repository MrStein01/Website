<?PHP
  abstract class WidgetBase{
    public $color    = "white";
	public $headline = "";
	public $content = "";
	
    public function display(){
	  ?>
        <li class="widget color-<?PHP echo $this->color; ?>">
          <div class="widget-head">
            <h3><?PHP echo $this->headline; ?></h3>
          </div>
          <div class="widget-content">
            <?PHP echo $this->content; ?>
          </div>
        </li>
	  <?PHP
	}
	
	 public abstract function load();
  }
?>