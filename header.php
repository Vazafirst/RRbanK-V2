<?php
date_default_timezone_set('America/Bahia');
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include_once './class/users.php';
$objUser = new User();
if ($objUser->admVr() == "ok") {
    $id['iduser'] = $_SESSION['iduser'];
    $objUser->querySelect($id);
    include_once './class/banco.php';
    $objBanco = new Banco();
    $objBanco->querySelectBanco();
    $objBanco->ControllerBanco();
    $porc = 7 / 100; // Porcentagem de rendimento
    $valor = ($porc * $_SESSION['dinheiro']);
    if ($valor != $_SESSION['dinheiroup']) {
        $_SESSION['dupvalor'] = $valor;
        $objBanco->FixMoneyup();
    }
    include_once './class/loterica.php';
    $objLot = new Loterica();
    $objLot->ControllerLot();
    include_once './class/caixa.php';
    $objCofre = new Caixa();
    $objCofre->CofreSelect();
    $objCofre->CxEvSelect();
    $pre = new Datetime($_SESSION['dataresult']);
}
?>
<!DOCTYPE html>
<html>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
    <link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#07D506">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="js/usernot.js"></script>
    <?php include_once("./ga.php"); ?>
    <title>RRBanK</title>
    <body>
        <div class="header">
            <P id="pmenu">MENU</p>
            <input type="checkbox" id="bt_menu">
            <label for="bt_menu">&#9776;</label>
            <nav class="menu">
                <ul id="ful">
                    <li><p id="MP">INÍCIO</p>
                        <ul>
                            <li><a href="./inicio.php" >Página inicial</a>
                            </li>
                            <li><a href="./banco.php" >Banco</a>
                            </li>
                            <li><a href="./loteria.php" >Loteria</a>
                            </li>
                            <li><a href="./eventos.php" >Eventos</a>
                            </li>
                            <li><a href="./atts.php" >Atualizações</a>
                            </li>
                            <li><a href="./caixa.php" >Caixa</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="./logout.php" >SAIR</a></li>
                </ul>
            </nav><br>
            <hr>
        </div>
        <style>
            #vracc{
                width: 95%;
                height: 95%;
                background-color: black;
                position: fixed;
                z-index: 20;
                left: 0;
                right: 0;
                bottom: 0;
                top: 0;
                display: block;
                margin: auto;
                border-radius: 10px;
                text-align: center;
                color: white;
                border: 2px #00D3F0 solid;
            }
        </style>
        <div id="usernot">
            <p id="titlenot">DEPOSITO</p>
            <p id="descnot">Seu deposito foi confirmado</p>
        </div>
        <?php
        if (isset($_SESSION['vr']) && $_SESSION['vr'] >= 1) {
            $vrs = $_SESSION['vr'];
            echo '
        <div id="vracc">
            <p id="pvsc">VERIFIQUE A SUA CONTA PARA USAR O RRBANK</p>
            <p id="lpf">Envie esse número abaixo para o perfil do <a id="adpf" href="https://m.rivalregions.com/#slide/profile/812857693001919?1562921343360"> Avicii◢◤</a> no RR </p>
            <p id="nvr">' . $vrs . '</p>
            <p>Atenção:</p>
            <p>Você pode clicar no nome do "Avicii" para ser redirecionado automaticamente para o perfil dele</p>
            <p>A verificação da conta serve para garantir a segurança do seu dinheiro e que ele nunca será enviado para pessoa errada, mesmo que você troque de nome no jogo</p>
        </div>';
        }
        