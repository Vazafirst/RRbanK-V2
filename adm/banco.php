<!DOCTYPE html>
<html>
    <head>
        <?php
        include_once '../class/adm/banco.php';
        $objAdBanco = new AdmBanco();
        if (isset($_POST['confbtn'])) {
            if (!isset($_POST['sq'])) {
                echo '<script>alert("Selecione o tipo de transação")</script>';
            } else {
                $objAdBanco->ConfTransacao($_POST);
            }
        }
        ?>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/admbanco.css">
        <style>
            #ini{
                width: 100px;
                padding: 10px;
                margin-top: -100px;
                color: white;
                text-align: center;
                left: 0;
                bottom: -10px;
                right: 0;
                margin: 0 auto;
                position: fixed;
                border: 1px black solid;
                background-color: red;
            }
            #ini:hover{
                bottom: 0px;
                background-color: #ff3333;
            }
        </style>
    </head>
    <body>
        <div class="adm">
            <p style="color: AQUA; background-color: black; font-weight: bold;">SAQUES</p><?php $objAdBanco->Saques(); ?>
            <p style="color: AQUA; background-color: black; font-weight: bold;">DEPOSITOS</p><?php $objAdBanco->Depositos(); ?>
        </div>
        <div class="conf">
            <form method="POST">
                <br>
                <p>Tipo de transação</p>
                <select name="sq" id="sel">
                    <option value="" selected disabled style="display: none;"></option>
                    <option value="1">SAQUE</option>
                    <option value="2">DEPOSITO</option>
                </select>
                <p> Id do usuario </p>
                <input class="saqdep" name="iduser" type="number" required /><br>
                <p>Valor da transação</p>
                <input class="saqdep" name="dpsq" type="number" required /><br><br>
                <input class="confirmar" type="submit" name="confbtn" value="Confirmar" /><br>
            </form>
        </div>
        <a id="ini" href="../inicio.php">
            INÍCIO
        </a>
    </body>
</html>

