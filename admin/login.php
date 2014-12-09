<?php
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$fingerid = md5($_SERVER['HTTP_USER_AGENT'].$ip);
if(isset($_SESSION['fingerprint']) AND $_SESSION['finger'] == $fingerid){
header("location: index.php");
exit();
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin Login</title>
<link rel="icon" href="http://www.hatlabicecream.com/wp-content/assets/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css">
<script type="text/javascript" src="../jscript/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow" />
</head>

<body>
<div id="header">
	<div class="inHeaderLogin"></div>
</div>

<div id="loginForm">
	<div class="headLoginForm">
	Login Administrator
	</div>
	<div class="fieldLogin">
	<span id="error"></span>
	<form id="LoginMainForm" method="POST" action="engine/login.php">
	<label>Username</label><br>
	<input type="text" id="username" class="login" /><br>
	<label>Password</label><br>
	<input type="hidden" name="action" value="login" />
<?php
// condition if referred by session time out
if(isset($_GET['error']) and $_GET['error'] == 'notlogged'){
$ref = $_SERVER['HTTP_REFERER'] ;
echo "<input type=\"hidden\" name=\"reffered\" value=\"$ref\" />" ;
}
?>
	<input type="password" id="password" class="login" /><br>
	<input type="button" id="loginbutton" class="button" value="Login" />
	</form>
	</div>
</div>
<center>
<div id="footer">
<p align=center>Powered by <a href="http://www.vanatugroup">VANATU GROUP</a> 
 </p>
</div>
</center>
</body>
</html>