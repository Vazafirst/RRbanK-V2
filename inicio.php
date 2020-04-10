<?php
include_once './header.php';
?>
<link rel="stylesheet" href="css/home.css">
<script src="js/homejs.js"></script>
<div class="divHcontent">
    <div class="inidiv" id="lot" title="Clique em LOTERICA para ser redirecionado">
        <p id="Title" onclick="llot()" >LOTERICA</p>
        <p id="lotUns">Ultímo número sorteado</p>
        <div id="sortnum" ><p id="num"><?php echo $_SESSION['rsvalorlot']; ?></p></div>
        <p id="lotPs">Próximo sorteio será às <?php echo $pre->format('H:i:s'); ?></p>
    </div>
    <div class="inidiv" id="bank" title="Clique em BANCO para ser redirecionado">
        <p id="Title" onclick="lbank()">BANCO</p>
        <p id="bankSAM">Seu saldo atual é</p>
        <p id="bankSA"><?php echo "$ " . number_format($_SESSION['dinheiro'], 0, ".", ","); ?></p>
        <p id="bankSER">Seu saldo está rendendo</p>
        <p id="bankSF"><?php echo "$ " . number_format($_SESSION['dinheiroup'], 0, ".", ","); ?></p>
    </div>
    <div class="inidiv" id="eventos" title="Clique em EVENTOS para ser redirecionado">
        <p id="Title" onclick="lev()">EVENTOS</p>
        <P id="EAT" >EVENTOS ATIVOS</P>
        <p id="EAE" >Não há nenhum evento ativo neste momento :(</p>
    </div>
    <div class="inidiv" id="cofre" title="Clique em COFRE/CAIXA para ser redirecionado">
        <p id="Title" onclick="lcofre()">COFRE/CAIXA</p>
        <p id="CEM">Saldo do cofre emergencial</p>
        <p id="SAEM"><?php echo "$ " . number_format($_SESSION['cofredinheiro'], 0, ".", ","); ?></p>
        <p id="CEV">Saldo do caixa de eventos</p>
        <p id="SAEV"><?php echo "$ " . number_format($_SESSION['cxevdinheiro'], 0, ".", ","); ?></p>
    </div>
</div>
</body>
</html>