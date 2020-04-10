<?php 
include_once("../connection/connection.php");
include_once("./users.php");

if(isset($_POST['btnchatmessage'])){
$objUser = new User();
$objUser->ControllerChat();
}
?>