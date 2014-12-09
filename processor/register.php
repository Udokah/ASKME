<?php

$action = $_POST['action']; // get particular action from post
include("functions.php");
include("connect.php");
extract($_POST);
// validate inputs
$name = clean($name);
$Phone = clean($Phone);
$email = clean($email);
$pass = md5(clean($pass));

$Phone = checkPhone($Phone);
if($Phone == false){
echo "Oops! that phone number is not valid.";
exit();
}

$email = checkEmail($email);
if($email == false){
echo "Oops! that email address is not valid";
exit();
}

// check if phone number has been used
$checkphone = mysql_query("SELECT phone FROM users WHERE phone='$Phone'");
$phonedata = mysql_fetch_array($checkphone);
if(isset($phonedata['phone'])){
echo "Oops! Phone number has been used";
exit();
}

// check if email has been used
$checkemail = mysql_query("SELECT email FROM users WHERE email='$email'");
$emaildata = mysql_fetch_array($checkemail);
if(isset($emaildata['email']) or $emaildata['email'] == $email){
echo "Oops! email has been used";
exit();
}

// format parameters
$day = date("d");
$month = date("m");
$year = date("Y");

$store = "INSERT INTO users SET name='$name',phone='$Phone',email='$email',password='$pass',join_day='$day',join_month='$month',join_year='$year'" ;
if(mysql_query($store)){
$status = "signUpSuccess()" ;
}
else{
$status = "Unable to register user !";
}

echo $status ;
exit();
?>