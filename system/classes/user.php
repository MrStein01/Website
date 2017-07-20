<?PHP
class User{
  var $name;
  private $username;
  private $role;
  private $pic;
  private $lastaccess;
  private $created;
  public $picDir;
  public $email;
  public $nick;

  function getUser($username) {
    $mysqlres = DataBase::Current()->Execute("SELECT * FROM {'dbprefix'}user WHERE name = '".$username."';");
    while ($row = $mysqlres->fetch_row()) {
      $this->username   = $row[1];
      $this->name       = $row[1];
      $this->role       = $row[3];
      $this->nick       = $row[4];
      $this->email      = $row[5];
      $this->picDir     = $row[6];
      $this->pic        = $row[7];
      $this->lastaccess = $row[8];
      $this->created    = $row[9];
    }
  }

  function isGreater($userRole) {
    $tmpRole = DataBase::Current()->ReadField("SELECT role FROM {'dbprefix'}user WHERE name = '".$userRole."';");
    $greater = false;
    if ($this->role <= $tmpRole) {
      $greater = true;
    }
    return $greater;
  }

  function setCurrentUser($currUser){
    $mysqlres = DataBase::Current()->Execute("SELECT * FROM {'dbprefix'}user WHERE name = '".$currUser."';");
    while ($row = $mysqlres->fetch_row()) {
      $this->username   = $row[1];
      $this->role       = $row[3];
      $this->nick       = $row[4];
      $this->email      = $row[5];
      $this->picDir     = $row[6];
      $this->pic        = $row[7];
    }
  }

  function getRole(){
    return $this->role;
  }

  function isAdmin(){
    $admin = False;
    if($this->role == 1) {
      $admin = True;
    }
    return $admin;
  }

  function isUser(){
    $user = false;
    if($this->role == 2) {
      $user = true;
    }
    return $user;
  }

  function isGuest(){
    $guest = false;
    if($this->role == 4) {
      $guest = true;
    }
    return $guest;
  }

  function isSiteUser(){
    $nuser = false;
    if ($this->role == 3) {
      $nuser = true;
    }
    return $nuser;
  }

  function getPicture($admin = false){
    if (!is_null($this->pic)) {
      if (!$admin) {
        return "<img src='system/images/users/".$this->picDir."/".$this->pic."' />";
      }
      else {
        return "<img class='openNav' src='../system/images/users/".$this->picDir."/".$this->pic."' />";
      }
    }
  }

  function login($name,$password){
    $password   = DataBase::Current()->EscapeString(trim($password));
    $this->name = DataBase::Current()->EscapeString(trim($name));
    if($this->checkPassword($password)){
      DataBase::Current()->Execute("UPDATE {'dbprefix'}user SET last_access_timestamp=NOW() WHERE name = '".$name."';");
      return true;
    }
    else{
      return false;
    }
  }

  function checkPassword($password){
    $password = DataBase::Current()->EscapeString(trim($password));
    $name     = DataBase::Current()->EscapeString(trim($this->name));
	  $count    = DataBase::Current()->ReadField("SELECT COUNT(*) FROM {'dbprefix'}user WHERE
                        name='".$name."' AND password = '".md5($password)."'");
    return $count == 1;
  }

  /*TODO: Bei Registrierung einen Bilderordner anlegen!!!!*/
  function registerBackend($name,$password,$email){
    $name = strtolower($name);
    $count = DataBase::Current()->ReadField("SELECT COUNT(*) FROM {'dbprefix'}user WHERE name='".$name."';");
    if ($count == 0) {
      if (isset($name) && isset($password))
      {
        DataBase::Current()->Execute("INSERT INTO {'dbprefix'}user (name,password,role,email,pic_dir,last_access_timestamp,create_timestamp) VALUES ('".$name."','".md5($password)."',4,'".$email."','".$name."',now(),now())");
      }
      return true;
    }
    else {
      return false;
    }
  }

  function registerFrontend ($name,$password,$email) {
    $alluser = DataBase::Current()->Execute("SELECT * FROM {'dbprefix'}user;");
    foreach ($alluser as $user) {
      if($name == $user->name || $email == $user->email) {
        return false;
      }
    }
    $name = strtolower($name);
    $count = DataBase::Current()->ReadField("SELECT COUNT(*) FROM {'dbprefix'}user WHERE name='".$name."';");
    if ($count == 0) {
      if (isset($name) && isset($password)) {
        DataBase::Current()->Execute("INSERT INTO {'dbprefix'}user (name,password,role,nick,email,last_access_timestamp,create_timestamp) VALUES ('".$name."','".md5($password)."',5,'".$name."','".$email."',now(),now())");
      }
      return true;
    }
    else {
      return false;
    }
  }

  function recoverPassword ($email, $password) {
    DataBase::Current()->Execute("UPDATE {'dbprefix'}user SET password='".md5($password)."' WHERE email='".$email."';");
  }

  function logout(){
	 session_destroy();
  }
}
?>
