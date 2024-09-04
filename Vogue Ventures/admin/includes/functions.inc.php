<?php
function emptyInputSignup($name,$email,$pwd2)
{
    $result;
    if(empty($name) || empty($email) || empty($pwd2))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

// function invalidUid($name)
// {
//     $result;
//     if(!preg_match("/^[a-zA-Z0-9]*$/",$name))
//     {
//         $result = true;
//     }
//     else
//     {
//         $result = false;
//     }
//     return $result;
// }

function invalidEmail($email)
{
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function uidExists($conn, $email)
{
    $sql = "SELECT *  FROM a_details WHERE a_email = ?;"; //query select all columns from table matches with the provided email
    $stmt = mysqli_stmt_init($conn);  //initialize a statement object from the db connection- $conn
    if(!mysqli_stmt_prepare($stmt, $sql)) // prepare sql statement to execute
    {
        header("Location:../login.php?error=stmtfailed"); // if failed redirect to login
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email); //bind email parameter to prepared statement, s mean that parameter is a string
    mysqli_stmt_execute($stmt); //execute the prepared statement
    $resultData = mysqli_stmt_get_result($stmt); // retrive the result from executed statement

    if($row= mysqli_fetch_assoc($resultData)) //a function that fetches a result row as an associative array from the result obtained by query
    {
        return $row; // if succeffully fetched row will return. $row = ["c_id--> kc","c_email-->gh@g.com",..etc].  
    }
    else
    {
        return false;
    }

    mysqli_stmt_close($stmt); //properly close and release resources associated with prepared statement.
}

function createUser($conn, $name, $email, $pwd2)
{
    $sql = "INSERT INTO a_details(a_name,a_email,a_pass) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql))
    {
        header("Location:../login.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd2, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    LoginUser($conn,$email,$pwd2,$rmb);
    // header("Location: ../index.php?error=none");
    exit();
}

function emptyInputLogin($u_email,$pwd)
{
    $result;
    if(empty($u_email) || empty($pwd))
    {
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}

function LoginUser($conn,$u_email,$pwd,$rmb)
{
    $uidExists = uidExists($conn,$u_email);
    if($uidExists === false)
    {
        header("location: ../login.php?error=invalidcredintials");
        exit();
    }

    /*this is associative array. Array value is a row returned by database matched with user
    email address. row includes all column data of the user. in here we only need c_pass*/
    $pwdHashed = $uidExists["a_pass"];  
    $checkPwd = password_verify($pwd, $pwdHashed); //inbuild function to verify passwords

    if($checkPwd === false)
    {
        header("Location: ../login.php?error=invalidcredintials");
    }
    else if($checkPwd === true)
    {
        session_start();
        $_SESSION["userid"] = $uidExists["aid"];
        $_SESSION["usersname"] = $uidExists["a_email"];


        header("Location: ../admin.php");
    }
}

function isLoggedIn() {
    session_start();

    if (isset($_SESSION['userid']) && isset($_SESSION['usersname'])) {
        return true; // User is logged in
    } else {
        return false; // User is not logged in
    }
}
?>