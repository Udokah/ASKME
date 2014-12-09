<?php
session_start();
$ip = $_SERVER['REMOTE_ADDR']; // get ip address
$ref = $_SERVER['HTTP_REFERER'] ; // get refferer address
$time = date("d/m/y [g:i:s a]"); // set time
$error = $_GET['error'];

///// SECURITY CHECKING /////////////////////////////
if(!isset($_POST) or $_POST['action'] !== 'login'){
if(isset($_SERVER['HTTP_REFERER'])){
$refer = $ref ;   // get referrer
}
else{
$refer =  "../../index.php";
}
header("location: $refer");
exit();
}

////// END OF SECURITY CHECKING //////

//// TO PROCESS SECOND LOGIN WITH JAVASCRIPT ///////
$fingerid = md5($_SERVER['HTTP_USER_AGENT'].$ip);
if(isset($_SESSION['fingerprint']) AND $_SESSION['finger'] == $fingerid){
// check if reffered or not
if(isset($_POST['reffered'])){
$goto = $_POST['reffered'] ;
}
else{
$goto = '../index.php' ;
}
header("location: $goto");
exit();
}
//// TO PROCESS SECOND LOGIN WITH JAVASCRIPT ////

include("../../processor/functions.php");
include("../../processor/connect.php");
extract($_POST);

$username = clean($username);
$password = md5(clean($password));  //ecnrypt password

// authenticate
$auth = mysql_query("SELECT * FROM admin WHERE username='$username' AND password='$password'");
$data = mysql_fetch_array($auth);
if($data){
// create session cookie
$fingerid = md5($_SERVER['HTTP_USER_AGENT'].$ip.$time);
$finger = md5($_SERVER['HTTP_USER_AGENT'].$ip);

$_SESSION['fingerprint'] = $fingerid ;
$_SESSION['finger'] = $finger ;
$_SESSION['admin_name'] = $username ;

// update database 
$upd = mysql_query("INSERT INTO log SET name='$username',login='$time',session='$fingerid',ip='$ip',logout='online'");

// redirect to referrer
$status = "LoginTrue()";
}
else{
$status = "LoginFalse()" ;
}

echo $status ;
exit();
?>