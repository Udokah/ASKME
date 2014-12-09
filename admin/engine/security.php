<?php
// security functions
if(!isset($_POST)){
header("location: ../../index.php");
}

include("../../processor/functions.php");
include("../../processor/connect.php");
extract($_POST);

// function to change username
if($action == 'username'){
$newname = clean($newname);
$mypass = clean(md5($password)); // encrypt password

// check for correct password
$checkpass = mysql_query("SELECT password FROM admin WHERE password='$mypass'");
$data = mysql_fetch_array($checkpass);
if($data){
// password is correct then change username
$update = mysql_query("UPDATE admin SET username='$newname'");
$status = "Username has been changed" ;
}

else{
$status = "wrong password" ;
}

echo $status;
exit();
}

// function to change password
if($action == 'password'){
$oldpass = clean(md5($oldpass));
$newpass = clean(md5($newpass)); // encrypt password

// check for correct password
$checkpass = mysql_query("SELECT password FROM admin WHERE password='$oldpass'");
$data = mysql_fetch_array($checkpass);
if($data){
// password is correct then change username
$update = mysql_query("UPDATE admin SET password='$newpass'");
$status = "password has been changed" ;
}

else{
$status = "wrong password" ;
}

echo $status;
exit();
}
?>