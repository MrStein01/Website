<div class="login-page">
  <div class="form">
    <form class="register-form" action="<?PHP User::registerBackend($_POST['name'],$_POST['password'],$_POST['email']) ?>" method="post">
      <input type="text" name="name" placeholder="Username"/>
      <input type="password" name="password" placeholder="password"/>
      <input type="text" name="email" placeholder="email address"/>
      <input type="submit" value="<?PHP echo Language::Translate("REGISTER") ?>" />
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" method="post">
      <input name="user" placeholder="username" /><br />
      <input name="password" type="password" placeholder="password"><br />
      <input type="submit" value="Login" />
      <!--p class="message">Not registered? <a href="#">Create an account</a></p-->
    </form>
  </div>
</div>
