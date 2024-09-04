<!-- no need to close php tag if there are none html tags.
 we only use php in here -->\
<?php

// this if statement will check whether submit button 
// clicked or not
/* this function will use variable value with POST method sent
by html login form. If someone used the link directly access this
login file it should block for security reasons. but access can 
be approve if someone used submit button.others will be redirect 
back to login page*/

if(isset($_POST["submit"])) //isset will check that submit button has a value.
{
    $u_email = $_POST["remail"];
    $pwd = $_POST["rpsw"];
    $rmb = isset($_POST["rmbMe"]);

    require_once 'dbh.inc.php';//bind mysql connection to this file
    require_once 'functions.inc.php';//bind function file to this one

    if(emptyInputLogin($u_email, $pwd) !== false)
    {
        header("Location: ../login.php?error=emptyinput");
        exit();
    }

    LoginUser($conn,$u_email,$pwd,$rmb);

}
else
{
    header('Location:../login.php'); //go back folder and file access path
}
