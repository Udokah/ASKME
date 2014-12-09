<?php
// function to delete question

// security **
if(!isset($_POST) or $_POST['action'] !== 'delete_account'){
header("location: ../../index.php");
}

include("../../processor/connect.php");
extract($_POST);

mysql_query("DELETE FROM users WHERE id='$UID'");

?>