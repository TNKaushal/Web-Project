<?php
    include_once 'header.php';
    if(isset($_COOKIE['emailid']) && isset($_COOKIE['password']))
    {
        $emailid = $_COOKIE['emailid'];
        $password = $_COOKIE['password'];
    }
    else
    {
        $emailid = $password = "";
    }
?>
    <link rel="stylesheet" href="loginstyle.css">
    <!-- There are two methods. In here we use POST method.We dont use GET method because 
    that method will share details through URl. It will show the email and Password used to
    Log in to your account in URL.It is a risk -->
    <div class="tebackground"></div>
    <div class="logcontainer">
        <div class="logcontent">
            <div class="text-sci">
                <br><br><br><br><br><br><br><br><br>
                <h2>Welcome<br><span>Our Exclusive Members</span></h2>
                <br>
                <p>At Vogue Venture, we believe every step should be taken with confidence. Our exclusive 
                    collection of footwear is designed to not only complement your style but also empower your journey. 
                <br><a href="admin/admin.php">Admin Account</a>
                </p> 
            </div>  
        </div>
 

        <div class="hlogreg-box">
            <div class="form-box login">
                <form action="includes/login.inc.php" method="POST">

                <h2>Sign In</h2>

                <div class="input-box">
                    <span class="icon1"><i class='bx bxs-envelope'></i></span>
                    <input type="email" id="remail" name="remail" value="<?php echo ($emailid); ?>" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon1"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" id="rpsw" name="rpsw" value="<?php echo ($password); ?>" required>
                    <label>Password</label>
                </div>

                <div class="remember-forgot">
                  <label><input type="checkbox" name="rmbMe" id="rmbMe" <?php echo !empty($emailid) ? 'checked' : ''; ?>> Remember me </label>
                  <!-- <a href="#">Forgot password?</a> -->
                </div>

                <button type="submit" class="rbtn" name="submit">Sign In</button>

                <?php
                if(isset($_GET["error"]))
                {
                    if($_GET["error"]=="emptyinput")
                    {
                        echo'<div class = "error">Fill in the all fields</div>';
                    }
                    else if($_GET["error"]=="emailalreadyregistered")
                    {
                        echo'<div class = "error">Email Address already have a account.Sign in</div>';
                    }
                    else if($_GET["error"]=="invalidemail")
                    {
                        echo'<div class = "error">Invalid Email Address</div>';
                    }
                    else if($_GET["error"]=="stmtfailed")
                    {
                        echo'<div class = "error">Something went wrong. Contact support</div>';
                    }
                    else if($_GET["error"]=="invalidcredintials")
                    {
                        echo'<div class = "error">Invalid Credentials</div>';
                    }
                    else if($_GET["error"]=="none")
                    {
                        echo'<div class = "error">Account created</div>';
                    }
                }
                ?>

                <div class="login-register">
                  <p>Dont have an account?<a href="#" class="register-link">Sign Up</a></p>
                </div>

            </form>
            </div>

            <div class="form-box register">
                <form action="includes/signup.inc.php" method="POST">

                <h2>Sign Up</h2>
                
                <div class="input-box">
                    <span class="icon1"><i class='bx bxs-user'></i></span>
                    <input type="text" id="username" name="username" required>
                    <label>Name</label>
                </div>

                <div class="input-box">
                    <span class="icon1"><i class='bx bxs-envelope'></i></span>
                    <input type="email" id="email" name="email" required>
                    <label>Email</label>
                </div>

                <div class="input-box">
                    <span class="icon1"><i class='bx bxs-lock-alt' ></i></span>
                    <input type="password" id="password" name="password" required>
                    <label>Password</label>
                </div>

                <div class="remember-forgot">
                  <label><input type="checkbox" required> I agree to the <a href="#">terms & conditions</a> </label>
                </div>

                <button type="submit" class="rbtn" name="submit">Sign Up</button>

                <div class="login-register">
                  <p>Already have an account?<a href="#" class="rlogin-link">Sign in</a></p>
                </div>

            </form>
            </div>
             
        </div>
 </div>
 
<script src="loginscript.js"></script>


