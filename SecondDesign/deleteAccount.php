<?php 
    session_start();
    $link = mysqli_connect("localhost", "id9077059_root", "password2006", "id9077059_getsome");

    if($link === false)
    {
        die("Error could not connect. " .mysqli_connect_error());
    }

    $username = $_SESSION['username'];
    $tableId = $_SESSION['tableId'];

    $sql = ("Delete from useraccounts where username = '$username'");
    if(mysqli_query($link, $sql))
    {
        $sql = ("Drop table $tableId");
        if(mysqli_query($link, $sql))
        {
            $_SESSION['alert'] = "deleted";
            header("location: alert.php");
        }
        else
        {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    } 
    else 
    {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    mysqli_close($link);
?>