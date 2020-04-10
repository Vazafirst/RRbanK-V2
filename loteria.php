<?php
include_once './header.php';
if (isset($_POST['num'])) {
    $objLot->Vrloto($_POST);
}
if(!isset($_SESSION['lotwin'])){
    $_SESSION['lotwin'] = "Faça uma aposta e ganhe cada vez mais no RRBanK";
}
?>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/loteria.css">
</head>
<div class="container">
    <p id="wclot"> Bem vindo a Lotérica </p>
    <p> Último número sorteado</p>
    <div id="sortnum"><p id="num"><?php echo $_SESSION['rsvalorlot']; ?></p></div><br>
    <p style="font-weight: bold;">Valor do prêmio:<BR><label style="color: greenyellow; background-color: black; border: 8px black groove"> <?php echo "$ " . number_format($_SESSION['lotpremio'], 0, ".", ","); ?></label></p>
    <!-- <p>Tivemos um total de <label style="color: aquamarine; font-weight: bold;";>N/A</label> vencedores nesta rodada.</p> !-->
    <p>Próxima rodada será às <label style="color: #ff66cc; font-weight: bold;"><?php echo $pre->format('H:i:s'); ?></label> do dia <label style="color: #ff66cc; font-weight: bold;"><?php echo $pre->format('d/m/Y'); ?></label></p>
    <p><?php echo $_SESSION['lotwin']; ?></p>
</div>
<div class="faposta">
    <p id="FSA">FAÇA A SUA APOSTA</p>
    <p style="color: aqua; font-weight: bold;">Números apostados</p>
    <p style="color: yellow"><?php $objLot->ShowNums(); ?></p>
    <div class="numap" id="na1"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="1"/></form></div>
    <div class="numap" id="na2"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="2"/></form></div>
    <div class="numap" id="na3"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="3"/></form></div>
    <div class="numap" id="na4"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="4"/></form></div>
    <div class="numap" id="na5"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="5"/></form></div>
    <div class="numap" id="na6"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="6"/></form></div>
    <div class="numap" id="na7"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="7"/></form></div>
    <div class="numap" id="na8"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="8"/></form></div>
    <div class="numap" id="na9"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="9"/></form></div>
    <div class="numap" id="na10"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="10"/></form></div>
    <div class="numap" id="na11"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="11"/></form></div>
    <div class="numap" id="na12"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="12"/></form></div>
    <div class="numap" id="na13"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="13"/></form></div>
    <div class="numap" id="na14"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="14"/></form></div>
    <div class="numap" id="na15"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="15"/></form></div>
    <div class="numap" id="na16"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="16"/></form></div>
    <div class="numap" id="na17"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="17"/></form></div>
    <div class="numap" id="na18"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="18"/></form></div>
    <div class="numap" id="na19"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="19"/></form></div>
    <div class="numap" id="na20"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="20"/></form></div>
    <div class="numap" id="na21"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="21"/></form></div>
    <div class="numap" id="na22"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="22"/></form></div>
    <div class="numap" id="na23"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="23"/></form></div>
    <div class="numap" id="na24"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="24"/></form></div>
    <div class="numap" id="na25"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="25"/></form></div>
    <div class="numap" id="na26"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="26"/></form></div>
    <div class="numap" id="na27"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="27"/></form></div>
    <div class="numap" id="na28"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="28"/></form></div>
    <div class="numap" id="na29"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="29"/></form></div>
    <div class="numap" id="na30"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="30"/></form></div>
    <div class="numap" id="na31"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="31"/></form></div>
    <div class="numap" id="na32"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="32"/></form></div>
    <div class="numap" id="na33"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="33"/></form></div>
    <div class="numap" id="na34"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="34"/></form></div>
    <div class="numap" id="na35"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="35"/></form></div>
    <div class="numap" id="na36"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="36"/></form></div>
    <div class="numap" id="na37"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="37"/></form></div>
    <div class="numap" id="na38"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="38"/></form></div>
    <div class="numap" id="na39"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="39"/></form></div>
    <div class="numap" id="na40"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="40"/></form></div>
    <div class="numap" id="na41"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="41"/></form></div>
    <div class="numap" id="na42"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="42"/></form></div>
    <div class="numap" id="na43"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="43"/></form></div>
    <div class="numap" id="na44"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="44"/></form></div>
    <div class="numap" id="na45"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="45"/></form></div>
    <div class="numap" id="na46"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="46"/></form></div>
    <div class="numap" id="na47"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="47"/></form></div>
    <div class="numap" id="na48"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="48"/></form></div>
    <div class="numap" id="na49"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="49"/></form></div>
    <div class="numap" id="na50"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="50"/></form></div>
    <div class="numap" id="na51"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="51"/></form></div>
    <div class="numap" id="na52"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="52"/></form></div>
    <div class="numap" id="na53"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="53"/></form></div>
    <div class="numap" id="na54"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="54"/></form></div>
    <div class="numap" id="na55"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="55"/></form></div>
    <div class="numap" id="na56"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="56"/></form></div>
    <div class="numap" id="na57"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="57"/></form></div>
    <div class="numap" id="na58"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="58"/></form></div>
    <div class="numap" id="na59"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="59"/></form></div>
    <div class="numap" id="na60"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="60"/></form></div>
    <div class="numap" id="na61"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="61"/></form></div>
    <div class="numap" id="na62"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="62"/></form></div>
    <div class="numap" id="na63"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="63"/></form></div>
    <div class="numap" id="na64"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="64"/></form></div>
    <div class="numap" id="na65"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="65"/></form></div>
    <div class="numap" id="na66"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="66"/></form></div>
    <div class="numap" id="na67"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="67"/></form></div>
    <div class="numap" id="na68"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="68"/></form></div>
    <div class="numap" id="na69"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="69"/></form></div>
    <div class="numap" id="na70"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="70"/></form></div>
    <div class="numap" id="na71"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="71"/></form></div>
    <div class="numap" id="na72"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="72"/></form></div>
    <div class="numap" id="na73"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="73"/></form></div>
    <div class="numap" id="na74"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="74"/></form></div>
    <div class="numap" id="na75"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="75"/></form></div>
    <div class="numap" id="na76"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="76"/></form></div>
    <div class="numap" id="na77"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="77"/></form></div>
    <div class="numap" id="na78"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="78"/></form></div>
    <div class="numap" id="na79"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="79"/></form></div>
    <div class="numap" id="na80"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="80"/></form></div>
    <div class="numap" id="na81"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="81"/></form></div>
    <div class="numap" id="na82"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="82"/></form></div>
    <div class="numap" id="na83"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="83"/></form></div>
    <div class="numap" id="na84"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="84"/></form></div>
    <div class="numap" id="na85"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="85"/></form></div>
    <div class="numap" id="na86"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="86"/></form></div>
    <div class="numap" id="na87"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="87"/></form></div>
    <div class="numap" id="na88"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="88"/></form></div>
    <div class="numap" id="na89"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="89"/></form></div>
    <div class="numap" id="na90"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="90"/></form></div>
    <div class="numap" id="na91"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="91"/></form></div>
    <div class="numap" id="na92"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="92"/></form></div>
    <div class="numap" id="na93"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="93"/></form></div>
    <div class="numap" id="na94"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="94"/></form></div>
    <div class="numap" id="na95"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="95"/></form></div>
    <div class="numap" id="na96"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="96"/></form></div>
    <div class="numap" id="na97"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="97"/></form></div>
    <div class="numap" id="na98"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="98"/></form></div>
    <div class="numap" id="na99"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="99"/></form></div>
    <div class="numap" id="na100"><form method="POST" action=""><input type="submit" name="num" id="btnnum" value="100"/></form></div>
    <p>Valor por número:<BR> $ 3.000.000.000</p>
</div>
</body>
</html>
