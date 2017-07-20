<?PHP
  class MySQL extends DataBase{
    private $connection;

    public function Execute($sql){
      return $this->connection->query(str_replace("{'dbprefix'}",$this->Prefix,$sql));
	  }

    public function GetTables(){
      $res =  $this->Execute("SHOW TABLES;");
      while($row = $res->fetch_row()){
        $tables[] = $row[0];
      }
      sort($tables);
      return $tables;
    }

    public function countTables(){
      $res = $this->connection->query("SELECT COUNT(*) FROM `information_schema`.`tables` WHERE `table_schema` = 'db_354554_1';");
      $row = $res->fetch_row();
      return $row[0];
    }

    public function countTableEntries($table){
      $res =  $this->Execute("SELECT count(*) FROM ".$table.";");
      while($row = $res->fetch_row()){
        $tables = $row[0];
      }
      return $tables;
    }

    public function GetColumns($table){
      $mysqlres = $this->Execute("SHOW COLUMNS FROM ".$table);
      while($row = $mysqlres->fetch_object()){
        $res[] = $row;
      }
      return $res;
    }

    public function ReadField($sql){
	  $res = $this->Execute($sql);
	  $row = $res->fetch_row();
	  return $row[0];
	}

    public function ReadRow($sql){
	  $res = $this->Execute($sql);
	  return $res->fetch_object();
	}

    public function ReadRows($sql){
	  $mysqlRes = $this->Execute($sql);
	  while($row = $mysqlRes->fetch_object()){
	    $res[] = $row;
	  }
	  return $res;
	}

	public function InsertID(){
	  return $this->connection->insert_id;
	}

	public function EscapeString($text){
	  return $this->connection->real_escape_string($text);
	}

    public function Connect(){
      $this->connection = new mysqli($this->Host,$this->User,$this->Password,$this->Name);
	}

    public function Disconnect(){
      $this->connection->close();
	}
  }
?>
