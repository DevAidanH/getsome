<?php
session_start();
$link = mysqli_connect("localhost", "id9077059_root", "password2006", "id9077059_getsome");

if($link === false)
{
    die("Error could not connect. " .mysqli_connect_error());
}

$username = mysqli_real_escape_string($link, $_REQUEST['username']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
$tableId  = substr("$username", -3);

if (!preg_match("/^[a-zA-Z ]*$/",$username)) 
{
    $_SESSION['alert'] = "addFail";
    header("location: alert.php");
}
else
{
$sql = ("CREATE TABLE  `".$tableId."`(id int(6) NOT NULL AUTO_INCREMENT, task VARCHAR(30), PRIMARY KEY(id))");
if(mysqli_query($link, $sql))
{
    $sql = "insert into useraccounts (username,password,tableId) values ('$username', '$password', '$tableId')";
    if(mysqli_query($link, $sql))
    {
        $_SESSION['alert'] = "new";
        header("location: alert.php");
    } 
    else
    {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
} 
else
{
    $_SESSION['alert'] = "addFail";
    header("location: alert.php");
}
}
mysqli_close($link);
?>