<?php
include_once './header.php';

if(isset($_POST[''])){
    
}
?>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/cofre.css">
<style>
    #dcem{
        position: fixed;
        width: 90%;
        height: 80%;
        border: 2px black solid;
        background-color: #1C1C1C;
        margin: 0 auto;
        left: 0;
        right: 0;
        display: none;
        text-align: center;
    }
    input{
       width: 300px;
       height: 50px;
       margin: 0 auto;
       border-radius: 20px;
       margin-top: 150px;
       border: 2px darkolivegreen solid;
    }
    input:focus{
        text-align: center;
    }
    #confbtn{
        background-color: yellowgreen;
        border: 0px;
        position: absolute;
        top: 150px;
        left: 0;
        right: 0;
        font-size: 24px;
        font-weight: bold;
        cursor: pointer;
    }
    #confbtn:active{
        font-size: 30px;
        border: 2px darkolivegreen solid;
    }
    #closediv{
        background-color: transparent;
        width: 50px;
        color: red;
        height: 50px;
        border: 0px;
        font-weight: bold;
        font-size: 30px;
        position: absolute;
        right: 0;
        top: -140px;
        cursor: pointer;
    }
    #closediv:hover{
        border: 2px darkolivegreen solid;
        font-size: 31px;
    }
</style>

<div id="dcem">
    <input type="button" id="closediv" value="X"/>
    <p style="color: aqua; font-size: 24px;">Coloque o valor que deseja doar para o Cofre Emergencial</p>
    <form method="POST">
    <input type="number" id="duv" pattern="[0-9]" placeholder="Digite um valor" max="<?php echo $_SESSION['dinheiro']; ?>"/>
    <input type="submit" id="confbtn" name="dmoney" value="CONFIRMAR" />
    </form>
</div>
<div class="container">
    <div class="cc">
        <p id="CEM">Cofre Emergencial</p>
        <p class="SA" id="SAEM"><?php echo "$ " . number_format($_SESSION['cofredinheiro'], 0, ".", ","); ?></p>
        <input type="button" class="btndoar" id="btnem" value="DOAR" />
    </div>
    <div class="cc">
        <p id="CEM">Caixa de Eventos</p>
        <p class="SA" id="SAEV"><?php echo "$ " . number_format($_SESSION['cxevdinheiro'], 0, ".", ","); ?></p>
        <input type="button" class="btndoar" id="btncev" value="DOAR" />
    </div>
</div>
<script>
var closediv = document.getElementById('closediv');
var dcem = document.getElementById('dcem');
var btnem = document.getElementById('btnem');
var btncev = document.getElementById('btncev');

btnem.addEventListener('click', function () {
    $('#dcem').fadeIn('slow');
    document.getElementById("duv").focus();
});

closediv.addEventListener('click', function () {
    $('#dcem').fadeOut('slow');
});
</script>
</body>
</html>