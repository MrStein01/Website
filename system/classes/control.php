<?PHP
  abstract class Control{
    public $name  = "";
    public $value = "";

    public abstract function display();
    public abstract function getCode();
  }
?>
