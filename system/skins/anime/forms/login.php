<div class="modal">
  <div class="container">
    <div class="card"></div>
    <!-- Login -->
    <div class="card">
      <h1 class="title">Login</h1>
      <form action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" method="post">
        <div class="input-container">
          <input type="text" name="user" id="username" required="required"/>
          <label for="user"><?php echo Language::Translate('{LANG:USERNAME}'); ?></label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" name="password" id="password" required="required"/>
          <label for="password"><?php echo Language::Translate('{LANG:PASSWORD}'); ?></label>
          <div class="bar"></div>
        </div>
        <div class="button-container">
          <button><span><?php echo Language::Translate('{LANG:LOGIN}'); ?></span></button>
        </div>
        <div class="footer"><a class="toggleFP" href="#">Forgot your password?</a></div>
      </form>
    </div>
    <!-- Register -->
    <div class="card alt">
      <div class="toggle"></div>
      <h1 class="title"><?php echo Language::Translate("{LANG:REGISTER}"); ?>
        <div class="close"></div>
      </h1>
      <form action="<?php echo $_SERVER[REQUEST_URI]; ?>" method="post">
        <div class="input-container">
          <input type="text" name="user_register" id="username" required="required"/>
          <label for="user_register"><?php echo Language::Translate('{LANG:USERNAME}'); ?></label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="text" name="email_register" id="email" required="required"/>
          <label for="email_register"><?php echo Language::Translate('{LANG:EMAIL}'); ?></label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" name="password_register" id="password" required="required"/>
          <label for="password_register"><?php echo Language::Translate('{LANG:PASSWORD}'); ?></label>
          <div class="bar"></div>
        </div>
        <div class="input-container">
          <input type="password" name="retype_password_register" id="password" required="required"/>
          <label for="retype_password_register"><?php echo Language::Translate('{LANG:RETYPE_PASSWORD}'); ?></label>
          <div class="bar"></div>
        </div>
        <div class="button-container">
          <button><span><?php echo Language::Translate('{LANG:REGISTER}'); ?></span></button>
        </div>
      </form>
    </div>
    <!-- Passwort vergessen -->
    <div class="card altFP">
      <div class="toggleFP"></div>
      <h1 class="title"><?php echo Language::Translate("{LANG:FORGOT_PASSWORD}"); ?>
        <div class="closeFP"></div>
      </h1>
      <form action="<?php echo $_SERVER[REQUEST_URI]; ?>" method="post">
        <div class="input-container">
          <input type="text" name="forEmail" id="email" required="required"/>
          <label for="email_register"><?php echo Language::Translate('{LANG:EMAIL}'); ?></label>
          <div class="bar"></div>
        </div>
        <div class="button-container">
          <button><span><?php echo Language::Translate('{LANG:RECOVER_PASSWORD}'); ?></span></button>
        </div>
      </form>
    </div>
  </div>
</div>
