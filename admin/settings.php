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
<title>Settings</title>
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
		<p><input type="button" class="button" id="usernameTog" value="Change username"/></p>
		<table class="data" id="usernameTab">
		<tr class="data">
		<td>New Username:</td><td><input type="text" id="uname" class="sedang"></td>
		</tr>
			<tr class="data">
				<td>Password:</td><td><input type="password" id="unamepass" class="sedang"></td>
			</tr>
			<tr class="data">
				<td colspan=2><input type="button" class="button" id="savename" value="save"/></td>
			</tr>
		</table>
		
		<p><input type="button" class="button" id="pswdTog" value="Change Password"/></p>
		<table class="data" id="pswdTab">
		<tr class="data">
		<td>Old Password:</td><td><input type="password" id="oldpass" class="sedang"></td>
		</tr>
			<tr class="data">
				<td>New Password:</td><td><input type="password" id="newpass1" class="sedang"></td>
			</tr>
			<tr class="data">
		<td>Confirm New Password:</td><td><input type="password" id="newpass2" class="sedang"></td>
			</tr>
			<tr class="data">
				<td colspan=2><input type="button" class="button" id="savepass" value="save"/></td>
			</tr>
		</table>
	</div>
<div class="clear"></div>
<div id="footer">
<p>Powered by <a href="http://www.vanatugroup">VANATU GROUP</a> 
 </p>
</div>
</div>
</body>
</html>