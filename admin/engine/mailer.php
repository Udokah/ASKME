<?php
set_time_limit(0);
error_reporting(0);
// function to send sms


include("../../processor/functions.php");
include("../../processor/connect.php");
extract($_POST);



###############################################################################
############## FUNCTION TO SEND SMS #########################################

//The main function that collects the information and sends it
	function useGET($message,$recipient){
$url = "http://www.50kobo.com/tools/geturl/Sms.php";
$flash = 1;
$username = 'udswagz@gmail.com';
$userpassword = 'T1vi08Gb';
$listname = '';
$sendername = 'HATLAB' ;

		$getrequest = $url
			."?username=".urlencode($username)."&"
			."password=".urlencode($userpassword)."&"
			."sender=".urlencode($sendername)."&"
			."message=".urlencode($message)."&"
			."flash=".urlencode($flash)."&"
			."sendtime="."&"
			."listname=".$listname."&"
			."recipients=".$recipient
			;

		return postRequestData($getrequest);
	}
	
	  //Function to connect to SMS sending server using GET request
	function postRequestData($url){
                $response = '';
		$fp = @fopen($url, 'rb', false);
		if (!$fp) {
			echo ("Problem with $url.<br> Url is inaccessible");
			return false;
		}
		stream_set_timeout($fp, 0, 250);
		try{
                    $response = @stream_get_contents($fp);
		     if ($response === false) {
			throw new Exception("Problem reading data from $url, $php_errormsg");
                     }
		 }
                 catch(Exception $e){
                     echo $e->getMessage();
                 }
		return $response;
	}
	
	// function to format numbers properly
	function format_number($contacts){
	
	// check for + sign and then remove
	$sign = substr($contacts,0,1);
	if($sign == '+'){
	$contacts =  substr($contacts, 1);
	}
	
	// check for 0
	$zero = substr($contacts,0,1);
	if($sign == '0'){
	$contacts =  substr($contacts, 1);
	}
	
	// check for country code 234
	$code = substr($contacts,0,3);
	if($code !== '234'){
	$contacts = '234'.$contacts ;
	}
	
	return $contacts;
	}



############## END FUNCTION TO SEND SMS #########################################
###############################################################################

// function to send sms
if($action == 'sms'){
$textmsg = clean($textmsg);  // message
$textmsg = substr($textmsg,0,200); // only 160 characters allowed

$phone = clean($phone);   // phone numbers
$toall = clean($toall);  // send to all if equals to one then each number is added to database

// send to only one person
if($toall !== 1){
}

// send to entered phone numbers first
if(!empty($phone)){
$phone_numbers = explode(",",$phone);
foreach ($phone_numbers as $contacts){
$contacts = trim($contacts);
// send to number if it is valid
if(is_numeric($contacts)){

// check if user exits in contact table, if not add to table
$check = mysql_query("SELECT phone FROM contacts WHERE phone = '$contacts'");
@$checkdata = mysql_fetch_array($check);

// check if user exists in users table
$check2 = mysql_query("SELECT phone FROM users WHERE phone = '$contacts'");
@$checkdata2 = mysql_fetch_array($check2);

if(!isset($checkdata['phone']) and !isset($checkdata2['phone'])){
mysql_query("INSERT INTO contacts SET phone = '$contacts'"); // add number to database

if($toall !== 1){
$contacts = format_number($contacts);
useGET($textmsg,$contacts) ; // send text if text is personal
}

}
}
}
}

/// send to contacts in users table
if($toall == 1){
$query = mysql_query("SELECT phone FROM users");
while($data = mysql_fetch_array($query)){
$phone = format_number($data['phone']);
useGET($textmsg,$phone) ;
}

// send to all contacts in contacts table
$query2 = mysql_query("SELECT phone FROM contacts");
while($data2 = mysql_fetch_array($query2)){
$phone = format_number($data2['phone']);
useGET($textmsg,$phone) ;
}

}




exit();
}

// function to send EMAIL
if($action == 'email'){
$message = clean($message);
$subject = clean($subject);
// get phone numbers from database
$getemails = mysql_query("SELECT email FROM users");
while($data = mysql_fetch_array($getemails)){
extract($data);
@mail_user($email,$subject,$message);
}
echo "Message Sent to all members" ;
exit();
}

?>