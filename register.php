<?php
require_once("./class/users.php");
$objUser = new User();
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['adm'])) {
    header('location: ./inicio.php');
}
if (isset($_POST['btnrg'])) {
    if ($_POST['password'] != $_POST['password2']) {
        $_SESSION['rlogin'] = $_POST['username'];
        $_SESSION['remail'] = $_POST['email'];
        echo '<script>alert("Às senhas não combinam, verifique as senhas e tente novamente")</script>';
    } else if (strlen($_POST['password']) < 8) {
        $_SESSION['rlogin'] = $_POST['username'];
        $_SESSION['remail'] = $_POST['email'];
        echo '<script>alert("Sua senha deve conter mais de 8 caracteres")</script>';
    } else {
        $_SESSION['rlogin'] = "";
        $_SESSION['remail'] = "";
        $objUser->queryInsert($_POST);
    }
}

if (isset($_POST['username'])) {
    $user = $_SESSION['rlogin'];
    $email = $_SESSION['remail'];
} else {
    $user = "";
    $email = "";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php
        include_once("./ga.php");
        ?>
        <meta charset="UTF-8">
        <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
        <link rel="manifest" href="./site.webmanifest">
        <link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#07D506">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>RRBanK - Cadastro</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/register.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            function rindex() {
                window.location = "index.php";
            }
        </script>
        <style> 
            #termos{
                background-color: #222;
                width: 85%;
                height: 80%;
                border: 2px aqua solid;
                margin: 0 auto;
                border-radius: 10px;
                right: 0;
                left: 0;
                top: 50px;
                position: fixed;
                max-height: 500px;
                display: none;
                z-index:1;
            }
            .textterm{
                text-align: center;
                width: 95%;
                font-size: 26px;
                margin: 10px auto;
                position: absolute;
                right: 0;
                left: 0;
                font-weight: bold;
                height: 95%;
                border-radius: 15px;
            }

            .fecharcad{
                background-color: red;
                color: white;
                border: 0px;
                float: right;
                font-size: 26px;
                cursor: pointer;
                position: absolute;
                border-radius: 10px;
                font-weight: bold;
            }
            #plm{
                left: 0; 
                right: 0; 
                white-space: normal; 
                margin-top: 15px; 
                color: #00BFFF; 
                position: relative;
            }
        </style>
    </head>
    <body>
        <div class="main">
            <?php
            if (isset($_SESSION['Loginerror'])) {
                $loginerror = $_SESSION['Loginerror'];
                echo "<P id='plm'> $loginerror </P>";
                unset($_SESSION['Loginerror']);
            } else {
                echo '<h1 onclick="rindex()">RRBanK</h1>';
            }
            ?>
            <hr/>
            <form method="POST" id="rgform">
                <input class="campo" id="logininput" placeholder="LOGIN" type="text" value="<?php echo $user ?>" name="username" required autofocus />
                <input class="campo" id="emailinput" type="text" placeholder="NICK DO RR" value="<?php echo $email ?>" name="rrname" required />
                <div class="hrline" id="hr1" ></div>
                <input class="campo" id="passinput" type="password" minlength="8" placeholder="SENHA" name="password" required />
                <input class="campo" id="repeatpassinput" type="password" minlength="8" placeholder="REPITA A SENHA" name="password2" required/>
                <p class="passwarn">Sua senha deve conter mais de 8 caracteres</p>
                <div class="hrline" id="hr2"></div>
                <label class="pterms" for="cb"><input type="checkbox" id="cb" required />Ao criar a conta no RRBank você confirma que leu e concorda com os nossos 
                    <a id="hterm" href="#" style="color: white;
                       ">TERMOS DE USO.</a></label>
                <input type="submit" class="btn" id="btnnext" name="btnrg" value="CONFIRMAR"/>
            </form>
        </div> 
        <div id="termos">
            <textarea readonly="true" class="textterm" > Termos de uso RR Bank, blá blá blá, tu nem vai ler isso aqui mesmo, mas...
1° Ao criar uma conta no rrbank você concorda em dar acesso as suas finanças no jogo(disponibilizadas por você através de saques e depósitos).
2° Sua imagem de perfil e nome no jogo poderão ser usados para eventos do rrbank dentro do mesmo.
3° Pequenas porcentagens do seu saldo bancário dentro do rrbank poderão ser revertidos para o caixa/cofre do banco.
4° O ID do seu perfil no jogo será usado para identificação da sua conta.
5° A imagem e nome do seu perfil no jogo poderá ser usado para criação de artigos de marketing do rrbank </textarea>
            <input class="fecharcad" id="btn_fechar" type="button" value="X" />
        </div>
        <script type="text/javascript" src="js/register.js"></script>
    </body>
</html>
