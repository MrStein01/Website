<!-- Profil Fenster Overlay -->
<div class="profileWindow">

    <form class="profile-content animate" action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" method="post">
        
        <div class="profile-header">
                <span class="close" title="Close Modal">&times;</span>
                <h2><?php echo $_SESSION['user']->nick; ?></h2>
            </div>

            <div class="profile-body">

                    <div class="imgcontainer">
                        <?PHP
                        echo $_SESSION['user']->getPicture()
                        ?>
                        <br />
                        <a class="chPrPic"><?PHP echo Language::Translate("{LANG:CHANGE}"); ?></a>
                    </div>

                    <div class="main">
                        <label class="prName"><b><?PHP echo Language::Translate("{LANG:USERNAME}"); ?></b></label>
                        <label class="prNameCon"><b><?PHP echo $_SESSION['username']; ?></b></label>
                        <input class="prNameContxt clearable x" name="chName" type="text" style="display:none;" />

                        <br />

                        <label class="prNick"><b><?PHP echo Language::Translate("{LANG:NICKNAME}"); ?></b></label>
                        <label class="prNickCon"><b><?PHP echo $_SESSION['user']->nick; ?></b></label>
                        <input class="prNickContxt clearable x" name="chNick" type="text" style="display:none;" />

                        <br />

                        <label class="prEmail"><b><?PHP echo Language::Translate("{LANG:EMAIL}"); ?></b></label>
                        <label class="prEmailCon"><b><?PHP echo $_SESSION['user']->email; ?></b></label>
                        <input class="prEmailContxt clearable x" name="chEmail" type="text" style="display:none;" />
                    </div>
                
                    <div style="clear:both;"></div>
            </div>

            <div class="profile-footer">
                <button type="submit"><?PHP echo Language::Translate("{LANG:SAVE_CHANGES}"); ?></button>
                <button type="button" class="cancelbtn"><?PHP echo Language::Translate("{LANG:CANCEL}"); ?></button>
            </div>
    
	
        </form>

</div>
