<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Get Some: The ToDo List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href ="main.css" type="text/css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link rel="icon" type="image/png" sizes="32x32" href="Images/favicon.png">
    </head>

    <body class="bodyA">
        <?php 
            $alertType = $_SESSION['alert'];

            $loginlink = "index.html";
            $profileLink = "profile.php";
            $newAccount = "register.html";

            $linker = "";
            
            switch($alertType)
            {
                case 'deleted':
                    echo('<h1 class="alertHeading">Your Account has been deleted - Thank You</h1><br/><button class="alertButton" onclick="move()">Goodbye</button>');
                    $linker = $loginlink;
                    break;
                case 'new':
                    echo('<h1 class="alertHeading">New account has been created - you may now log in with the new account</h1><br/><button class="alertButton" onclick="move()">Continue</button>');
                    $linker = $loginlink;
                    break;
                case 'incorrect':
                    echo('<h1 class="alertHeading">Sorry that username/password is not correct</h1><br/><button class="alertButton" onclick="move()">Try again</button>');
                    $linker = $loginlink;
                    break;
                case 'changed':
                    echo("<h1 class='alertHeading'>Your password has been changed</h1><button class='alertButton' onclick='move()'>Back to my to-do list</button>");
                    $linker = $profileLink;
                    break;
                case 'notChanged':
                    echo("<h1 class='alertHeading'>Current password not correct - Your password hasn't been changed</h1><button class='alertButton' onclick='move()'>Back to my to-do list</button>");
                    $linker = $profileLink;
                    break;
                case 'addFail':
                    echo("<h1 class='alertHeading'>That username isn't accptable - please try again</h1><button class='alertButton' onclick='move()'>Try again</button>");
                    $linker = $newAccount;
            }
        ?>

        <script language="Javascript">
            function move()
            {
                var link = "<?php echo "$linker";?>";
                window.location = (link);
            }
        </script>
    </body>
</html>