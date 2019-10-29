<?php 
    session_start();
    $link = mysqli_connect("localhost", "id9077059_root", "password2006", "id9077059_getsome");
    $errors = "";
    
    $username =  $_SESSION['username'];
    $tableId  = substr("$username", -3);

    //add task
    if (isset($_POST['submit'])) 
    {
        if (empty($_POST['task'])) 
        {
			$errors = "You must fill in the task";
        }
        else
        {
			$task = $_POST['task'];
			$sql = "INSERT INTO $tableId (task) VALUES ('$task')";
			mysqli_query($link, $sql);
			header('location: profile.php');
		}
    }	
    
    //delete task
    if (isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
    
        mysqli_query($link, "DELETE FROM $tableId WHERE id=".$id);
        header('location: profile.php');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>To Do List - Get Some</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href ="main.css" type="text/css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="Images/favicon.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>

    <body class="body">
        <div class="containerProfile">
        <h1 id="one"><span class="caps"><?php echo $_SESSION['username']?></span>'s to do list<h1>
    
        <!-- --------To-Do Application Code here-------- -->
        
        <form method="post" action="profile.php">
		    <input class="input" type="text" name="task" maxlength="20" placeholder="New item...">
		    <button class="addTask" type="submit" name="submit"><i class="fas fa-plus"></i></button>
        </form>
        
        <table>
	        <tbody>
		        <?php 
                    $username =  $_SESSION['username'];
                    $tableId  = substr("$username", -3);
		            $tasks = mysqli_query($link, "SELECT * FROM $tableId");

		            $i = 1; while ($row = mysqli_fetch_array($tasks)) { 
                ?>
			        <tr>
                        <td class="task" onClick="done()">
                             <?php echo $row['task']; ?> 
                             <a href="profile.php?del_task=<?php echo $row['id'] ?>">
                                <i class="fas fa-trash"></i>
                            </a>  
                             <a href="profile.php?del_task=<?php echo $row['id'] ?>">
                             <span><i class="far fa-check-circle"></i><span>
                            </a>  

                        </td>
			        </tr>
		        <?php $i++; } ?>	
	        </tbody>
        </table>

        <!-- prints error below form if input box is empty -->
        <?php if (isset($errors)) { ?>
	        <p><?php echo $errors; ?></p>
        <?php } ?>
        </div>
        <!-- --------Account settings here-------- -->
        <div class="accountSettings">
            <button class="settingsButton" onmouseover="spin()" onmouseout="stopSpin()" onclick="openNav()"><i id="setting" class="fas fa-cog "></i></button>
        </div>
            
            <div id="settingsMenu" class="sideNav">
                <form action="deleteAccount.php"><input class="deleteButton" type="submit" value="Delete Account" onclick="return confirm('Are you sure you want to do that?');"></form>
                <br/>
                <button class="passwordButton" onclick="changePasswordMenu()">Change password</button>
                    <div id="passwordMenu">
                        <form action="changeAccount.php" method="POST">
                            <!--<label>Please enter your current password</label><br/>-->
                            <input class="newPasswordInput" type="password" name="currentPassword" placeholder="Current password..."/>
                            <br/>
                            <!--<label>Please enter a new password</label><br/>-->
                            <input class="newPasswordInput" tpye="password" name="newPassword"  placeholder="New password..."/>
                            <br/>
                            <input class="savePassword" type="submit" value="Save changes"/> 
                        </form>
                        <button class="cancelPassword" onclick="cancelChange()">Cancel changes</button>  
                    </div>
                <br/>
                <button class="logButton" onclick="window.location.href='index.html'">Sign out  <i class="far fa-times-circle"></i></button>
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            </div>
       

        <script language="Javascript"> 
            //menu button functions
            function openNav() 
            {
                document.getElementById("settingsMenu").style.width = "250px";
            }
            function closeNav()
            {
                document.getElementById("settingsMenu").style.width = "0px";
                document.getElementById("passwordMenu").style.display="none";   
            }
            function cancelChange()
            {
                document.getElementById("passwordMenu").style.display="none";   
            }
            function changePasswordMenu()
            {
                document.getElementById("passwordMenu").style.display="block";
            }

            //spin button icon
            function spin(){document.getElementById("setting").className = "fas fa-cog fa-spin";}
            function stopSpin(){document.getElementById("setting").className = "fas fa-cog";}
            

        </script>
    </body>
</html>