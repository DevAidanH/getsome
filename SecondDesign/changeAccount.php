<?php 
    session_start();
    $link = mysqli_connect("localhost", "id9077059_root", "password2006", "id9077059_getsome");

    if($link === false)
    {
        die("Error could not connect. " .mysqli_connect_error());
    }

    $currentPassword = mysqli_real_escape_string($link, $_REQUEST['currentPassword']);
    $newPassword = mysqli_real_escape_string($link, $_REQUEST['newPassword']);

    $sql = "SELECT password FROM useraccounts where password = '$currentPassword'";
    $result = mysqli_query($link, $sql);
    
    if (mysqli_num_rows($result) > 0) 
    {
        $sql = "update useraccounts set password = '$newPassword' where password = '$currentPassword'";
        if(mysqli_query($link, $sql))
        {
            $_SESSION['alert'] = "changed";
            header("location: alert.php");
        }
        else
        {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

        }
    } 
    else 
    {
        $_SESSION['alert'] = "notChanged";
        header("location: alert.php");
    }

    mysqli_close($link);
?>