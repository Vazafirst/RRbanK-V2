<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/style.css">
        <style>
            .main{
                margin: 0 auto;
                color: white;
                background-color: #272822;
                height: 280px;
                width: 500px;
                margin-top: 90px;
                border: 3px #000 solid;
                text-align: center;
            }
            .campo{
                background-color: wheat;
                border: 1px orange solid;
                color: black;
                margin-top: 20px;
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
                margin-top: 50px;
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
        </style>
    </head>
    <body>
        <div class="main">
            <p style="font: 22px arial; color: aqua;">Enter the code that was sent to your email</p>
            <input type="text" class="campo" name="answer" autofocus required/><br>
            <input type="submit" class="btn" value="Submit" />
            <p style="font: 12px arial; margin-top: 40px"><a href="support.php" style="color: aquamarine; ">Do you need support ?</a></p>  
        </div>
    </body>
</html>
