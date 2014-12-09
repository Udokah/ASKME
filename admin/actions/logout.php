<?php
session_start();
$time = date("d/m/y [g:i:s a]");
$ses = $_SESSION['fingerprint'] ;
include("../../processor/connect.php");
$update = mysql_query("UPDATE log SET logout = '$time' WHERE session = '$ses'")or die(mysql_error());
unset($_SESSION['fingerprint'],$_SESSION['admin_name'],$_SESSION['finger']);
header("location: ../login.php");
?>