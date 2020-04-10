<?php
session_start();
session_unset();
session_destroy();

unset($_SESSION['username']);
unset($_SESSION['adm']);
unset($_COOKIE['login']);
?>

<script language="JavaScript" >
    location.href = "index.php";
</script>