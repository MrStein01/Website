<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<div class="main">
    <div class="container">
        <center>
            <div class="middle">
              <!-- login -->
                <div id="login">
                    <form action="<?PHP echo $_SERVER[REQUEST_URI]; ?>" method="post">
                        <fieldset class="clearfix">
                            <p ><span class="fa fa-user"></span><input type="text" name="user"  placeholder="Username" required></p>
                            <p><span class="fa fa-lock"></span><input type="password" name="password"  placeholder="Password" required></p>
                            <div>
                                <!--span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="#">Forgot
                                password?</a></span-->
                                <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="Login"></span>
                            </div>
                        </fieldset>
                        <div class="clearfix"></div>
                    </form>
                    <div class="clearfix"></div>
                </div> <!-- end login -->
                <!-- register -->
                <!-- nur aufrufen wenn Admin einen User anlegen will!!! -->
                <div id="register" style="display:none;">
                    <form class="register-form" action="<?PHP User::registerBackend($_POST['name'],$_POST['password'],$_POST['email']) ?>" method="post">
                      <input type="text" name="name" placeholder="Username"/>
                      <input type="password" name="password" placeholder="password"/>
                      <input type="text" name="email" placeholder="email address"/>
                      <input type="submit" value="<?PHP echo Language::Translate("REGISTER") ?>" />
                      <p class="message">Already registered? <a href="#">Sign In</a></p>
                    </form>
                </div><!-- end register -->
                <div class="logo"><img src="img/logo.png" />
                    <div class="clearfix"></div>
                </div>
            </div>
        </center>
    </div>
</div>
