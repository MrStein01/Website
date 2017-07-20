<!-- Login Fenster Overlay -->
<div id="id01" class="modal">

	<!-- Login -->
	<form class="modal-content animate" action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" method="post">
		<span class="close" title="Close Modal">&times;</span>

		<div class="main">
			<h1>
				In Anime Progress Tracker anmelden.
			</h1>

			<input type="text" placeholder="<?php echo Language::Translate('{LANG:ENTER_USERNAME}'); ?>" name="user" required />

			<input type="password" placeholder="<?php echo Language::Translate('{LANG:ENTER_PASSWORD}'); ?>" name="password" required />

			<a class="linkrgt" href="#"><?php echo Language::Translate("{LANG:REGISTER}"); ?>?</a>

			<button type="submit"><?php echo Language::Translate("{LANG:LOGIN}"); ?></button>
			<input type="checkbox"><?php echo Language::Translate("{LANG:REMEMBER_ME}"); ?></input>
		</div>

		<div class="footer">
			<span class="psw">
				<a class="linkpsw" href="#"><?php echo Language::Translate("{LANG:FORGOT_PASSWORD}"); ?>?</a>
			</span>
		</div>
	</form>

	<!-- Register -->
	<form class="modal-content-register animate" action="<?php echo $_SERVER[REQUEST_URI]; ?>" method="post">
		<span class="close" title="Close Modal">&times;</span>

		<span class="error" style="color:red;z-index:700;"></span>

		<div class="main">
			<label><b><?php echo Language::Translate("{LANG:USERNAME}"); ?></b></label>
			<input type="text" placeholder="<?php echo Language::Translate('{LANG:ENTER_USERNAME}'); ?>" name="user_register" required />

			<label><b><?php echo Language::Translate("{LANG:EMAIL}") ?></b></label>
			<input type="text" placeholder="<?php echo Language::Translate('{LANG:ENTER_EMAIL}'); ?>" name="email_register" required />

			<label><b><?php echo Language::Translate("{LANG:PASSWORD}"); ?></b></label>
			<input type="password" placeholder="<?php echo Language::Translate('{LANG:ENTER_PASSWORD}'); ?>" name="password_register" required />

			<label><b><?php echo Language::Translate("{LANG:RETYPE_PASSWORD}") ?></b></label>
			<input type="password" placeholder="<?php echo Language::Translate('{LANG:RETYPE_PASSWORD}'); ?>" name="retype_password_register" required />

			<button type="submit"><?php echo Language::Translate("{LANG:REGISTER}"); ?></button>
		</div>

		<div class="footer">
			<button type="button" class="cancelbtn"><?php echo Language::Translate("{LANG:CANCEL}"); ?></button>
		</div>
	</form>


	<!-- Forgot Password ->
	<form class="modal-content-forgot animate" action="< ?php echo $_SERVER[REQUEST_URI]; ?>" method="post">
		<span class="close" title="Close Modal">&times;</span>

		<div class="main">
			<label><b>< ?php echo Language::Translate("{LANG:EMAIL}"); ?></b></label>
			<input type="text" placeholder="< ?php echo Language::Translate('{LANG:ENTER_EMAIL}'); ?>" name="forEmail" required />

			<button type="submit">< ?php echo Language::Translate("{LANG:RECOVER_PASSWORD}"); ?></button>
		</div>

		<div class="footer">
			<button type="button" class="cancelbtn">< ?php echo Language::Translate("{LANG:CANCEL}"); ?></button>
		</div>
	</form>
-->
</div>
