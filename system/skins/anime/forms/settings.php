<!-- Settings Fenster Overlay -->
<div class="settingsWindow">

	<!-- Settings -->
	<form class="settings-content animate" action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" method="post">
		<span class="close" title="Close Modal">&times;</span>

		<div class="main">
			<label><b>Facebook</b></label>
		</div>

		<div class="footer">
			<button type="submit"><?PHP echo Language::Translate("{LANG:SAVE_CHANGES}"); ?></button>
			<br />
			<button type="button" class="cancelbtn"><?PHP echo Language::Translate("{LANG:CANCEL}"); ?></button>
		</div>
		<div style="clear:both">
		</div>
	</form>
</div>
