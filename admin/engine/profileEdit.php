<?php
// security **
if(!isset($_POST)){
header("location: ../../index.php");
}

include("../../processor/connect.php");
include("../../processor/functions.php");

extract($_POST);

if($_POST['action'] == 'savedits'){
$name = clean($name);
$phone = clean($phone);
$email = clean($email);

$phone = checkPhone($phone) ;
if($phone == false){
echo "Invalid Phone number" ;
exit();
}

$email = checkEmail($email);
if($email == false){
echo "Invalid email address" ;
exit();
}

if(mysql_query("UPDATE users SET name='$name', phone='$phone', email='$email' WHERE id='$id'")){
$status = "Data has been saved" ;
}
else{
$status = "Unable to save changes" ;
}

echo $status ;
exit();
}

// function to save password
if($_POST['action'] == 'savepass'){
$pass = md5(clean($pass));
if(mysql_query("UPDATE users SET password='$pass' WHERE id='$id'")){
$status = "Password has been changed" ;
}
else{
$status = "Unable to change password" ;
}
echo $status;
exit();
}



?>