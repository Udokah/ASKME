<?php
// function to delete question

// security **
if(!isset($_POST) or $_POST['action'] !== 'paywinner'){
header("location: ../../index.php");
}

include("../../processor/connect.php");
extract($_POST);

if(mysql_query("UPDATE gaming SET paid='1' WHERE gid='$GID'")){
$status = "Received";
}
else{
$status = "Unable to update winnings";
}
echo $status;

?>