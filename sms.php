<?php
$url1 = "http://www.50kobo.com/tools/geturl/Sms.php";
$url2 = "http://www.50kobo.com/tools/xml/Sms.php";
$flash = 1;
$username = 'udswagz@gmail.com';
$userpassword = 'T1vi08Gb';
$recipient;
$listname = '';
$message = '';
$result = '';

if( isset($_POST['button']) ){
    $username = $_POST['username'];

    $userpassword = $_POST['passwd'];

    $sendername = substr($_POST['sender_name'],0,11);
    $recipient = $_POST['telephone'];

    $message =$_POST['message'];
    if ( get_magic_quotes_gpc() ) {
            $message = stripslashes($_POST['message']);
    }
    $message = substr($_POST['message'],0,160);
    $listname = '';

    //Send the sms before re-loading the script page
    $result = 'Nothing sent';

    $result = useGet(); #Uncomment this line then comment the next line to use HTTP GET for sending the message
   // $result = useXML();   #This method sends the message using HTTP POST requestin XML
    
}


//The main function that collects the information and sends it
	function useGET(){
		global $url1, $username, $userpassword, $flash, $sendername, $message, $listname, $recipient;

		$getrequest = $url1
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

	function useXML(){
            global $url2, $username, $userpassword, $flash, $sendername, $message, $listname, $recipient;
            $return_val = '';
            $country_code = '234';
		$arr_recipient = explode(',',$recipient);
            $count = count($arr_recipient);
		$msg_ids = array();
		$generated_id = uniqid('int_', false);
		$generated_id = substr($generated_id, 0, 30);
                $recipients = '';

		for( $i=0; $i < $count; $i++ ){
			$mobilenumber = $arr_recipient[$i];
			if ( substr($mobilenumber,0,1) == '0') $mobilenumber = $country_code . substr($mobilenumber,1);
			elseif( substr($mobilenumber,0,1) == '+' ) $mobilenumber = substr($mobilenumber,1);
			$recipients .= '<gsm messageId="'.$generated_id.'_'.$i.'">'.$mobilenumber.'</gsm>'."\n";
			$msg_ids[$mobilenumber] = $generated_id.'_'.$i;
		}
                
                $xmlrequest = 
			"<SMS>
				<authentification>
					<username>{$username}</username>
					<password>{$userpassword}</password>
				</authentification>
				<message>
					<sender>{$sendername}</sender>
					<msgtext>{$message}</msgtext>
					<flash>{$flash}</flash>
					<sendtime></sendtime>
					<listname>$listname</listname>
				</message>
				<recipients>"
				.$recipients.
				"</recipients>
			</SMS>";
                                    
		$dispatch_status = postXmlData($url2, $xmlrequest);

                if ($dispatch_status) {
                    $p = xml_parser_create();
                    xml_parse_into_struct($p,$dispatch_status,&$vals,&$index);
                    xml_parser_free($p);
                    $return_val = ( isset($vals[1]['value']) )? (int)$vals[1]['value']: $return_val;
                }//print_r($return_val);

		return $return_val;
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


      //Function to connect to SMS sending server using XML POST request
	function postXmlData($url, $data, $optional_headers = null){
		$php_errormsg='';
                $response = '';
		$params = array( 'http' => array(
						 'method' => 'POST',
						 'content' => $data )
		);
		if ($optional_headers!== null) {
			$params['http']['header'] = $optional_headers;
		}
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if (!$fp) {
			//echo ("Problem with $url.<br> $url is inaccessible");
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <p>
  <?php
    if(!empty($_POST) ){
  	if( (int)$result == 100 ){
		print('Message sent');
	}
	else{
		print("Message not sent - Error code: $result");
	}
    }
  ?>
  </p>
  <p>
    <label>Username:
    <input name="username" type="text" id="username"/>
    </label>
  </p>
  <p>
    <label>Password:
    <input name="passwd" type="password" id="passwd" />
    </label>
  </p>
  <p>
    <label>Sender name:
    <input name="sender_name" type="text" id="name" value="Intg.Tester" />
    </label>
  </p>
  <p>
    <label>Recipients
    <textarea name="telephone" id="telephone" cols="45" rows="2"></textarea>
    </label>
  </p>
  <p>
    <label>Message
    <textarea name="message" id="message" cols="45" rows="5"></textarea>
    </label>
  </p>
  <p>
    <label>
    <input type="submit" name="button" id="button" value="Submit" />
    </label>
    <label>
    <input type="reset" name="button2" id="button2" value="Reset" />
    </label>
  </p>
</form>
</body>
</html>

