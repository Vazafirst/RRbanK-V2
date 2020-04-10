<?php
    
$_checkbox = $_POST['check'];
foreach($_checkbox as $_valor){
    echo $_valor;
}

$id = implode( ",", $_POST['check'] );
echo $id;