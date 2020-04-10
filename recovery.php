<?php
session_start();
if (isset($_POST['subbtn'])) {
    require_once("./class/users.php");
    $_SESSION['rcpage'] = 1;
    $objUser = new User();
    $objUser->userRecovery($_POST);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include_once("./ga.php"); ?>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style.css">
        <title>Recovery</title>
        <style>
            .main{
                margin: 0 auto;
                color: white;
                background-color: #272822;
                height: 250px;
                width: 500px;
                margin-top: 90px;
                border: 3px #000 solid;
                text-align: center;
            }
            .campo{
                background-color: wheat;
                border: 1px orange solid;
                color: black;
                height: 20px;
            }

            .campo:focus {
                background-color: white;
                color: black;
            }

            .btn{
                display:inline-block;
                text-decoration: none;
                width: 100px;
                padding:11px 13px;
                border:1px solid yellowgreen;
                background-color:yellowgreen;
                color: #000;
                font:17px arial, sans-serif;
                margin-top: 50px;
                margin-left: -50px;
                position: absolute;
                cursor: pointer;
            }
            .btn:hover{
                border: 2px #db781c solid;
                color: #000;
                font:19px arial, sans-serif;
            }
            .btn:active{
                background-color: #6B8E23;
                font:20px arial, sans-serif;
                cursor: none;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <p style="color: aqua">Type your email</p>
            <form method="POST">
                <input type="email" class="campo" name="email" placeholder="Enter your email here" required/><br>
                <input type="submit" name="subbtn" class="btn" value="Submit" />
            </form>
            <?php            
            if (isset($_SESSION['RecoveryError'])) {
                echo "<P style='margin-top: 110px; color: aqua; text-align: center;'>" . $_SESSION['RecoveryError'] . "</P><br>";
                unset($_SESSION['RecoveryError']);
            }
            ?>
        </div>
    </body>
</html>
