<?php
session_start();
if ($_SESSION['rcpage'] != 3) {
    echo "<script language='JavaScript'>
          		alert('You cannot access the password recovery page without first entering the security answer correctly.');
          		window.location.href='./newpass.php'
         		 </script>";
}
if (isset($_POST['subbtn'])) {
    require_once("./class/users.php");
    $objUser = new User();
    $objUser->PassUpdate($_POST);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New pass</title>
        <link rel="stylesheet" href="css/style.css">
        <style>
            .main{
                margin: 0 auto;
                color: white;
                background-color: #272822;
                min-height: 290px;
                height: auto;
                width: 500px;
                margin-top: 90px;
                border: 3px #000 solid;
                text-align: center;
            }
            .campo{
                background-color: wheat;
                border: 1px orange solid;
                color: black;
                width: 300px;
                text-align: center;
                height: 20px;
            }
            .campo:focus{
                background-color: yellowgreen;
                font: 15px arial;
                font-style: inherit;
            }
            .campo:hover{
                background-color: yellowgreen;
            }

            .btn{
                display:inline-block;
                text-decoration: none;
                width: 100px;
                padding:11px 13px;
                border:1px solid yellowgreen;
                background-color:yellowgreen;
                color: #000;
                margin-top: 30px;
                font:17px arial, sans-serif;
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
            .select{
                background-color: wheat;
                border: 1px orange solid;
                color: black;
                height: 20px;
            }
            .select:hover{
                background-color: yellowgreen;
            }
            .select:focus{
                background-color: yellowgreen;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <p>Choose a new password</p>
            <form method="POST">
                <input type="password" class="campo" name="password" placeholder="Type a new pass" autofocus required/><p></p>
                <input type="password" class="campo" name="password2" placeholder="Repeat your new pass" autofocus required/><br>
                <input type="submit" class="btn" name="subbtn" value="Submit" />
            </form>
            <?php
            if (isset($_SESSION['RecoveryError'])) {
                echo "<P style='margin-top: 60px; color: red; text-align: center;'>" . $_SESSION['RecoveryError'] . "</P><br>";
                unset($_SESSION['RecoveryError']);
            }
            ?>
            <p style="font: 12px arial; margin-top: 40px"><a href="support.php" style="color: aquamarine; ">Do you need support ?</a></p>    
        </div>
    </body>
</html>
