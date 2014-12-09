<?php
session_start();
error_reporting(0);
include("functions.php");
include("connect.php");
extract($_POST);

$email = clean($email);
$pass = md5(clean($pass));

// authenticate
$auth = mysql_query("SELECT id,name FROM users WHERE email='$email' AND password='$pass'");
$data = mysql_fetch_array($auth);
if($data){
extract($data);
// create session cookie
$_SESSION['id'] = $id ;
$_SESSION['name'] = $name ;
$status = "LoginTrue()";
}
else{
$status = "LoginFalse()" ;
}

echo $status;

?>