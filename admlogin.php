<?php
ob_start();

if (isset($_POST['cabtn'])) {
    header('location: ./register.php');
}
if (isset($_POST['lgbtn'])) {
    require_once("./class/users.php");
    $objUser = new User();
    $objUser->userLogin($_POST);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include_once("./ga.php"); ?>
        <meta charset="UTF-8">
        <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
        <link rel="manifest" href="./site.webmanifest">
        <link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#07D506">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>RRBanK - Bem Vindo !!</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="lr">
            <?php
            if (isset($_SESSION['Loginerror'])) {
                $loginerror = $_SESSION['Loginerror'];
                echo "<P id='plm'> $loginerror </P>";
                unset($_SESSION['Loginerror']);
            } else {
                echo '<h1>RRBanK</h1>';
            }
            ?>
            <hr id="loginghr" />
            <form method="POST">
                <input class="campo" type="text" id="user" name="username" placeholder=" LOGIN"  required /><p></p>
                <input class="campo" type="password" id="pass" name="password" minlength="8" placeholder=" SENHA"  required />
              <!--  <p id="fgpass"><a id="fgpass" class="fgpass" href="">
                        Você esqueceu a senha ?
                    </a></p> !-->
                <input type="submit" name="lgbtn" id="lgbtn" class="indexbtn" value="ENTRAR">
            </form>
            <form method="POST">
                <input type="submit" name="cabtn" class="indexbtnac" value="CRIAR CONTA">
            </form>
        </div>
    </body>
</html>
<?php
$html = ob_get_clean();
echo preg_replace('/\s+/', ' ', $html);
