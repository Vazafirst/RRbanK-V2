<!DOCTYPE html>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
 if ($_SESSION['adm'] < 10) {
  echo "<script language='JavaScript'>
  alert('Error: Você não tem permissão para acessar essa página');
  window.location.href='../inicio.php'
  </script>";
  }
require_once '../class/adm/users.php';
$admconta = new users();
if (isset($_POST['confacc'])) {
    $admconta->ConfAcc($_POST);
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Banco</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>

    </head> 
    <style>
        #vrcod{
            width: 80%;
            height: 200px;
            background-color: #005998;
            margin: 0 auto;
            text-align: center;
        }
        #excod{
            width: 80%;
            min-height: 200px;
            height: auto;
            background-color: #005998;
            margin: 5px auto;
            border: 2px #00BFFF solid;
            text-align: center;
        }
        #confcod{
            width: 80%;
            height: 250px;
            background-color: #005998;
            margin: 5px auto;
            border: 2px #00BFFF solid;
            text-align: center;
        }
        input{
            height: 25px;
            width: 250px;
            border: 2px #000099 groove;
            cursor: pointer;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div id="vrcod"><p>Verificar código</p>
        <form method="POST">
            <input type="number" name="usercod" id="usercod" />
            <input type="submit" value="PROCURAR" />
        </form>
    </div>
    <div id="excod">
        <p>Usuário com esse ID de verificação</p>
        <p><?php
            if (isset($_POST['usercod'])) {
                $admconta->VrRRID($_POST);
            }
            if (isset($_SESSION['Loginerror'])) {
                echo $_SESSION['Loginerror'];
                unset($_SESSION['Loginerror']);
            }
            ?>
        </p>
    </div>
    <div id="confcod">
        <form method="post">
            <p> Serial do user </p>
            <input class="saqdep" name="userid" type="number" /><br>
            <p> Adicionar id no RR </p>
            <input class="saqdep" name="userrrid" type="number" /><br>
            <input type="submit" name="confacc" value="confirmar"/>
        </form>
    </div>
</body>
</html>
