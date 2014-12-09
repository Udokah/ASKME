<?php
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$fingerid = md5($_SERVER['HTTP_USER_AGENT'].$ip);
if(!isset($_SESSION['fingerprint']) AND $_SESSION['finger'] !== $fingerid){
header("location: login.php?error=notlogged");
exit();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Send SMS</title>
<link rel="icon" href="http://www.hatlabicecream.com/wp-content/assets/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css">
<script type="text/javascript" src="../jscript/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow" />
</head>

<body>
<div id="header">
	<div class="inHeader">
		<div class="mosAdmin">
		Hello, <?php echo $_SESSION['admin_name']; ?><br>
		<a href="actions/logout.php">Logout</a> | <a href="settings.php">Settings</a>
		</div>
	<div class="clear"></div>
	</div>
</div>

<div id="wrapper">
	<div id="leftBar">
	<ul>
		<li><a href="index.php">Dashboard</a></li>
		<li><a href="view.php">Questions<small>view/remove</small></a></li>
		<li><a href="post.php">Add <small>Questions</small></a></li>
		<li><a href="winnings.php">Winnings</a></li>
		<li><a href="players.php">Players</a></li>
		<li><a href="sms.php">Send SMS</a></li>
		<li><a href="log.php">Log</a></li>
	</ul>
	</div>
	<div id="rightContent">
	        <div class="informasi" id="loading1">
			<img src="mos-css/img/loader.gif" /><br>
		    <label>sending sms</label>
		     </div>
			<div class="informasi" id="loading">
			<img src="mos-css/img/loader.gif" /><br>
		     <label>sending email</label>
		     </div>
	<h3>Sends SMS to all Players</h3>
        <form>
		<table width="95%">
		<tr><td>Message <textarea id="smsText"></textarea></td></tr>
		<tr><td>Telephone NB: seperate multiple phone numbers with a comma e.g 0801234567,070123456 <textarea id="PhoneNumbers"></textarea></td></tr>
		<tr><td>send also to all customers on database<input id="sendtoall" type="checkbox" /></td></tr>
		<tr>
		<td>
		<input type="button" class="button" id="sendsms" value="Send SMS"/>
		<input type="reset" class="button" value="Reset"></td>
		</tr>
		</table>
		</form>
		<h3>Sends Email to all Players</h3>
        <form>
		<table width="95%">
		<tr><td>Subject</td></tr>
		<tr><td><input type="text" id="subject" style="width:600px;"/></td></tr>
		<tr><td>Message</td></tr>
		<tr><td><textarea id="message"></textarea></td></tr>
		<tr>
		<td>
		<input type="button" class="button" id="sendMail" value="Send Email"/>
		<input type="reset" class="button" value="Reset"></td>
		</tr>
		</table>
		</form>
	</div>
<div class="clear"></div>
<div id="footer">
<p>Powered by <a href="http://www.vanatugroup">VANATU GROUP</a> 
 </p>
</div>
</div>
</body>
</html>