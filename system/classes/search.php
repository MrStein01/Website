<?PHP
    class Search{
        
        private function searchDB($searchString){
                        
            $found = array();
            
            $animeName = DataBase::Current()->ReadRows("SELECT name FROM {'dbprefix'}anime where name like '%".$searchString."%';");
            
            $animeDescription = DataBase::Current()->ReadRows("SELECT description FROM {'dbprefix'}anime where description like '%".$searchString."%';");
            
            $user = DataBase::Current()->ReadRows("SELECT nick FROM {'dbprefix'}user where nick like '%".$searchString."%';");
            
            $pages = DataBase::Current()->ReadRows("SELECT title FROM {'dbprefix'}pages where title like '%".$searchString."%';");
            
            foreach($animeName as $aName)
            {
                array_push($found, $aName->name);
            }
            
            foreach($animeDescription as $aDescription)
            {
                array_push($found, $aDescription->description);
            }
            
            foreach($user as $sUser)
            {
                array_push($found, $sUser->nick);
            }
            
            foreach($pages as $sPages)
            {
                array_push($found, $sPages->title);
            }
            
            return $found;
        }
        
        function display($searchString) {
            $found = $this->searchDB($searchString);
            ?>
                <div class="searchResult">
                    <ul>
                    <?php
                        foreach ($found as $result)
                        {
                            if ($result != "Passwort aendern")
                            {
                                echo "<li>";
                                echo $result;
                                echo "</li>";
                            }
                        }
                    ?>
                    </ul>
                </div>
            <?php
        }
    }
?>