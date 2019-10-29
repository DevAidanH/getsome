<?php
    session_start();
    $link = mysqli_connect("localhost", "id9077059_root", "password2006", "id9077059_getsome");
    if($link === false)
    {
        die("Error could not connect. " .mysqli_connect_error());
    }

    $inputUsername = mysqli_real_escape_string($link, $_REQUEST["usernameInput"]);
    $inputPassword = mysqli_real_escape_string($link, $_REQUEST["passwordInput"]);

    $sql = "SELECT username, password FROM useraccounts where username = '$inputUsername' and password = '$inputPassword'";
    $result = mysqli_query($link, $sql);
    
    if (mysqli_num_rows($result) > 0) 
    {
        $_SESSION['username'] = $inputUsername;
        $_SESSION['tableId'] = ($tableId  = substr("$inputUsername", -3));
        header("location: profile.php");
    } 
    else 
    {
        $_SESSION['alert'] = "incorrect";
        header("location: alert.php");
    }
    mysqli_close($link);
?>
