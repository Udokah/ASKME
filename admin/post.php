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
<title>Add Questions</title>
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
	<h3>Add Questions</h3><span style="color:red;" id="alert"></span>
        <form name="form">
		<table width="95%">
		<tr><td>Question <textarea id="question"></textarea></td></tr>
		<tr><td>Enter options and select the right answer</td></tr>
		<tr>
		<td><input type="radio" name="radio" id="opt1"/>
		<input type="text" id="ans1" class="sedang">
		</td>
		</tr>
		<tr>
		<td><input type="radio" name="radio" id="opt2"/>
		<input type="text" id="ans2" class="sedang">
		</td>
		</tr>
		<tr>
		<td><input type="radio" name="radio" id="opt3"/>
		<input type="text" id="ans3" class="sedang">
		</td>
		</tr>
		<tr>
		<td><input type="radio" name="radio" id="opt4"/>
		<input type="text" id="ans4" class="sedang">
		</td>
		</tr>
		<tr>
		<td>
		<input type="button" class="button" id="add" value="Add Questions"/>
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