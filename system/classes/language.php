<?PHP
  class Language{

    public $language      = null;
    public $root          = "";
    private static $isLoading = false;

    /**
     *
     * @param string $token
     */
    public function __construct($token = null){
      if($token == null){
        $token = Settings::getInstance()->get("language");
      }
      $this->language = $token;
      $alias = Page::Current()->alias;
    }

    public function getLanguage()
    {
      $language = DataBase::Current()->ReadField("SELECT value FROM {'dbprefix'}settings WHERE area = 'global' AND areaType = 'global' AND property = 'language'");
      return $language;
    }

    /**
     *
     * @param string $token
     * @return string
     */
    public function Translate($token){
      $token = str_replace("{LANG:","",$token);
      $token = str_replace("}","",$token);
      $failtoken = $token;
      if(isset($token)){
          $language = DataBase::Current()->ReadField("SELECT value FROM {'dbprefix'}settings WHERE area = 'global' AND areaType = 'global' AND property = 'language'");
          $packageName = DataBase::Current()->EscapeString(self::getLanguagePackName($token,$language));
          $token = DataBase::Current()->ReadField("SELECT text FROM {'dbprefix'}languagepack_".$packageName." WHERE token = '".DataBase::Current()->EscapeString($token)."'");
      	  if(!$token){
        		if(DEVELOPMENT){
        			die("Language-Token ".$failtoken." not found");
    		    }
          }
      }
      return $token;
    }

    /**
     *
     * @param string $token
     * @return string
     */
    public function getString($token){
        return $this->Translate($token);
    }

    /**
     * returns the translation of $token
     * @return string Translation
     */
    public static function DirectTranslate($token){
        return self::GetGlobal()->Translate($token);
    }

    /**
     *
     * @param string $token
     * @return string
     */
    public static function DirectTranslateHtml($token){
        return htmlentities(self::GetGlobal()->Translate($token));
    }

    /**
     *
     * @param string $token
     * @return string
     */
    private static function getLanguagePackName($token,$language){
      $namespaces = explode("_",strtolower($token));
      if(sizeOf($namespaces) >= 2){
        if($namespaces[0] == "plugin"){
          return strtoupper($language)."_plugin_".$namespaces[1];
        }
        else if($namespaces[0] == "skin"){
          return strtoupper($language)."_skin_".$namespaces[1];
        }
      }
      return strtoupper($language)."_global";
    }

    /**
     *
     * @param string $token
     * @param string $text
     */
    public function addTranslation($token,$text){
      $token = DataBase::Current()->EscapeString($token);
      $text = DataBase::Current()->EscapeString($text);
      $packageName = DataBase::Current()->EscapeString(self::getLanguagePackName($token,$this->language));
      DataBase::Current()->Execute("INSERT INTO  {'dbprefix'}languagepack_".$packageName." (token,text) VALUES ('".$token."','".$text."')");
    }

    /**
     *
     * @param string $token
     */
    public function deleteTranslation($token){
      $token = DataBase::Current()->EscapeString($token);
      $packageName = DataBase::Current()->EscapeString(self::getLanguagePackName($token,$this->language));
      DataBase::Current()->Execute("DELETE FROM {'dbprefix'}languagepack_".$packageName." WHERE token = '".$token."'");
    }

    /**
     *
     * @param string $token
     * @param string $text
     */
    public function updateTranslation($token,$text){
      $this->deleteTranslation($token);
      $this->addTranslation($token,$text);
    }

    /**
     *
     * @param mixed $obj
     * @return mixed
     */
    public function replaceLanguageTokensByObject($obj){
      if($obj){
        foreach($obj as $key => $value) {
          preg_match_all("/{LANG:([^}]+)}/", $value, $tokens, PREG_SET_ORDER);
          foreach($tokens as $token){
            $translation = Language::DirectTranslate($token[1]);
            $obj->{$key} = str_ireplace($token[0],$translation,$obj->{$key});
          }
        }
      }
      return $obj;
    }


    /**
    *
    * returns a the global instance of the language class
    * @return Language
    */
    public static function GetGlobal(){
        if(!isset($GLOBALS['language'])){
	    self::$isLoading = true;
            $GLOBALS['language'] = new Language();
  	    self::$isLoading = false;
            self::GetGlobal()->replaceLanguageTokensByObject(Page::Current());
        }
        return $GLOBALS['language'];
    }

    /**
     *
     * @return boolean
     */
    public static function IsLoading(){
        return isset(self::$isLoading) && self::$isLoading;
    }

    public static function CreateLanguagePack($name,$language = null){
        $name = self::getLanguagePackName($name, $language);
        DataBase::Current()->Execute("CREATE TABLE {'dbprefix'}languagepack_".$name." (
                    `token` varchar(255) NOT NULL,
                    `text` TEXT NOT NULL,
                        PRIMARY KEY (`token`)
                       ) ENGINE=MyISAM DEFAULT CHARSET=latin1");
    }

    public static function DropLanguagePack($name,$language = null){
        $name = self::getLanguagePackName($name, $language);
        DataBase::Current()->Execute("DROP TABLE {'dbprefix'}languagepack_".$name);
    }

  }
?>
