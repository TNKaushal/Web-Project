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
    $name = $_POST["username"];
    $email = $_POST["email"];
    $pwd2 = $_POST["password"];

    require_once 'dbh.inc.php';//bind mysql connection to this file
    require_once 'functions.inc.php';//bind function file to this one

    $emptyInput = emptyInputSignup($name,$email,$pwd2);
    // $invalidUid = invalidUid($name);
    $invalidEmail = invalidEmail($email);
    // $pwdMatch = pwdMatch($pwd2 , $pwdRepeat);
    $uidExists = uidExists($conn,$email);

    if($emptyInput !== false)
    {
        header("Location: ../login.php?error=emptyinput");
        exit();
    }

    // if($invalidUid !== false)
    // {
    //     header("Location: ../login.php?error=invaliduserid");
    //     exit();
    // }

    if($invalidEmail !== false)
    {
        header("Location: ../login.php?error=invalidemail");
        exit();
    }

    // if($pwdMatch !== false)
    // {
    //     header("Location: ../login.inc.php?error=passwordmismatch")
    //     exit();
    // }

    if($uidExists !== false)
    {
        header("Location: ../login.php?error=emailalreadyregistered");
        exit();
    }

    createUser($conn, $name, $email, $pwd2);

}
else
{
    header('Location:../login.php'); //go back folder and file access path
}
