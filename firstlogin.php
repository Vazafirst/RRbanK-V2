<!DOCTYPE html>
<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
        <title></title>
    </head>
    <body>
        <div>
            <p>Olá <?php echo $_SESSION['fbname']; ?></p>
            <p>Antes de continuar poderia nos informar o seu nome no Rival Regions ?</p>
            <input type="text" />
        </div>
    </body>
</html>
