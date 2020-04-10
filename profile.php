<!DOCTYPE html> 
<html>
    <head>
        <?php include_once './header.php'; ?>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
        <style>
            .main{
                margin: 0 auto;
                height: 500px;
                width: 1000px;
                border: 10px double #000099;
                background-color: #009999;
            }
            .userimg{
                height: 200px;
                width: 200px;
                background-color: red;
                border: 1px black solid;
            }

            input[type="file"] {
                display: none;
            }
            .upload{
                position: absolute;
                width: 200px;
                margin-top: 180px;
                margin-left: -203px;
                background-color: #1C1C1C;
                text-align: center;
                color: white;
                border: 1px #1C1C1C solid;
                opacity: 0.3;
            }
            .upload:hover{
                opacity: 1;
            }

            .level{
                margin: 0 auto;
                background-color: black;
                float: right;
                width: 100px;
                height: 100px;
                border-radius: 250px;
                border: 12px violet double;
                text-align: center;

            }
            .exlevel{
                position: relative;
                margin-top: 35px;
                font-size: 20px;

            }
            .exlevel:hover{
                font-size: 25px;

            }

            .username{
                border: 3px yellowgreen solid;
                position: absolute;
                margin-left: 210px;
                margin-top:  -190px;
                border-radius: 50px;
                width: 650px;
                height: 100px;
                text-align: center;
                white-space:nowrap;
                overflow: hidden;
                background-color: #005998;

            }
            .exusername{
                font-size: 30px;
                width: 650px;
                margin-top: 30px;
                text-shadow: 1px 3px black, -2px -2px black;
            }

            .messages{
                background-color: yellowgreen;
                position: absolute;
                color: white;
                width: 150px;
                border: 2px #99ffcc solid;
                border-radius: 15px;
                height: 70px;
                text-align: center;
                margin-top: 400px;
                margin-left: 100px;
            }
            .messages:active{
                background-color: #6B8E23;
                color: red;
            }
            .messages:hover{
                border: 3px #99ffcc solid;
            }
            .edit{
                background-color: yellowgreen;
                position: absolute;
                color: white;
                width: 150px;
                height: 70px;
                border: 2px #99ffcc solid;
                border-radius: 15px;
                text-align: center;
                font-size: 32px;
                margin-top: 400px;
                margin-left: 350px;
            }
            .edit:active{
                background-color: #6B8E23;
                color: red;
            }
            .edit:hover{
                border: 3px #99ffcc solid;
            }
            .btntext{
                font-size: 30px;
                margin-top: 13px;
            }
            .btntext:hover{
                color: #000011;
            }

        </style>
    </head>
    <body>
        <div class="main">
            <img class="userimg" src="static/img/money.png" title="Avatar"/>
            <label class="upload">
                <input type="file"/>
                Edit avatar
            </label>
            <div class="username" title="username">
                <p class="exusername"><?php echo ucfirst($_SESSION['username']); ?></p>
            </div>
            <div class="level" title="level">
                <p class="exlevel"><?php echo $_SESSION['xplevel']; ?></p>
            </div>
            <a class="messages" href=""><p class="btntext">Messages</p></a> <a href="" class="edit"><p class="btntext">Edit</p></a>
        </div>
    </body>
</html>
