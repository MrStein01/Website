<?PHP
  abstract class DataBase{

	  public $Name     = '';
      public $Prefix   = '';
	  public $User     = '';
	  public $Password = '';
	  public $Host     = '';
	  public $Type     = '';

	  public abstract function Execute($sql);
	  public abstract function GetTables();
	  public abstract function GetColumns($table);
	  public abstract function ReadField($sql);
	  public abstract function ReadRow($sql);
	  public abstract function ReadRows($sql);
	  public abstract function Connect();
	  public abstract function Disconnect();

	  public function __construct($config){
	    include($config);
		$this->Prefix   = $dbpraefix;
		$this->Host     = $dbhost;
		$this->Password = $dbpassword;
		$this->User     = $dbuser;
		$this->Name     = $db;
		$this->Connect();
	  }

    /**
    *
    * returns the current database instance
    * @return DataBase instance
    */
      public static function Current(){
          if(!isset($GLOBALS['db'])){
            $GLOBALS['db'] = new MySQL('system/dbsettings.php');
            $GLOBALS['db']->Connect();
          }
          return $GLOBALS['db'];
      }

      /**
       *
       * @param DataBase $db
       */
      public static function SetCurrent(DataBase $db){
          $GLOBALS['db'] = $db;
      }

  }
?>
