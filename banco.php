<?php
include_once './header.php';
if (isset($_POST['confdpbtn'])) {
    $objBanco->Deposito($_POST);
}
if (isset($_POST['confsqbtn'])) {
    if ($_POST['decmoney'] > $_SESSION['dinheiro']) {
        $_SESSION['bError'] = '<p id="bmerror"> Você não pode sacar um valor maior do que você possua</p>';
    } else {
        $objBanco->Saque($_POST);
    }
}
if (isset($_SESSION['sverificar']) && $_SESSION['sverificar'] == 1) {
    $tipo = "saque ";
    $val = number_format($_SESSION['ssaque'], 0, '.', ',');
    echo "<div class='tea'>
    <p style='text-align: center; color: red;'>Você tem uma transação em andamento e não poderá realizar outra até essa ser confirmada<br>Por favor aguarde</p>
     Valor do  $tipo <br>$ $val
</div>";
}
if (isset($_SESSION['dverificar']) && $_SESSION['dverificar'] >= 1) {
    $tipo = "deposito ";
    $val = number_format($_SESSION['ddeposito'], 0, '.', ',');
    echo "<div class='tea'>
    <p style='text-align: center; color: red;'>Você tem uma transação em andamento e não poderá realizar outra até essa ser confirmada<br>Envie o dinheiro para o <a id='adpf' style='color: aqua;' href='https://m.rivalregions.com/#slide/profile/812857693001919?1562921343360'> Avicii◢◤</a> no RR e aguarde</p>
     Valor do  $tipo <br>$ $val
</div>";
}
if ($_SESSION['dverificar'] >= 1 or $_SESSION['sverificar'] >= 1) {
    $dbtn1 = "disabled ";
} else {
    $dbtn1 = "";
}
?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banco.css">
</head>
<div class="main">
    <div class="divdpsq" id="dp">
        <input type="button" value="X" class="cd" id="cddp" />
        <p id="qv">Qual é o valor que você deseja depositar ?</p>
        <p id="vms">Valor mínimo para depósito: $ 1.000,000,000</p>
        <form method="POST">
            <input type="number" pattern="[0-9]" class="dpsq" id="inpdp" min="1000000000" max="100000000000000" name="incmoney" autocomplete="off" placeholder="DIGITE SOMENTE NÚMEROS" required><br>
            <input type="submit" value="CONFIRMAR" name="confdpbtn" id="confbtn" <?php echo $dbtn1; ?> />
        </form>
        <p id="ssr" style="font-weight: bold;">Seu saldo atual é <br><?php echo "$ " . number_format($_SESSION['dinheiro'], 0, ".", ","); ?></p>
    </div>
    <div class="divdpsq" id="sq">
        <input type="button" value="X" class="cd" id="cdsq" />
        <p id="qv">Qual é o valor que você deseja sacar ?</p>
        <p id="vms">Valor mínimo para saque: $ 1.000,000,000</p>
        <form method="POST">
            <input type="number" pattern="[0-9]" class="dpsq" id="inpsq" min="1000000000" max="<?php echo $_SESSION['dinheiro']; ?>" name="decmoney" autocomplete="off" placeholder="DIGITE SOMENTE NÚMEROS" required><br>
            <input type="submit" value="CONFIRMAR" name="confsqbtn" id="confbtn" <?php echo $dbtn1; ?> />
        </form>
        <p id="ssr" style="font-weight: bold;">Seu saldo atual é <br><?php echo "$ " . number_format($_SESSION['dinheiro'], 0, ".", ","); ?></p>
    </div>
    <script type="text/javascript" src="js/banco.js"></script>
    <div class="content">
        <?php
        if (isset($_SESSION['bError'])) {
            echo $_SESSION['bError'];
            unset($_SESSION['bError']);
        }
        ?>
        <p style="text-align: left; font-weight: bold; color: #A9A9A9;"><?php echo ucfirst($_SESSION['username']); ?></p>
        <div class="s">
            <p id="sa">Saldo atual</p>
            <p id="vsa"><?php echo "$ " . number_format($_SESSION['dinheiro'], 0, ".", ","); ?></p>
            <p id="sr">Seu saldo atual renderá (por semana)</p>
            <p id="vsa"><?php echo "$ " . number_format($valor, 0, ".", ","); ?></p>
        </div>
        <p id="inf">Próxima atualização do seu rendimento será ás <br>
            <?php
            $ndt = new DateTime($_SESSION['datalimite']);
            echo $ndt->format('H:i:s d/m');
            ?>
        </p>
    </div>
    <input type="button" value="DEPOSITAR" id="btndp" class="btndpsq" <?php echo $dbtn1; ?> />
    <input type="button" value="SACAR" id="btnsq" class="btndpsq" <?php echo $dbtn1; ?> />
</div>
<script type="text/javascript" src="js/fifo.js"></script>
</body>
</html>
