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
<title>Dashboard: Admin</title>
<link rel="icon" href="http://www.hatlabicecream.com/wp-content/assets/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow" />
</head>
<body>
<div id="header">
	<div class="inHeader">
		<div class="mosAdmin">
		Hello,<?php echo $_SESSION['admin_name']; ?><br>
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
	<h3>Dashboard</h3>
	<div class="quoteOfDay">
	<b>Quote of the day :</b><br>
	<i style="color: #5b5b5b;">"If you think you can, you really can"</i>
	</div>
		<div class="shortcutHome">
		<a href="post.php"><img src="mos-css/img/add.png"><br>Add Question</a>
		</div>
		<div class="shortcutHome">
		<a href="view.php"><img src="mos-css/img/view.png"><br>View Questions</a>
		</div>
		<div class="shortcutHome">
		<a href="winnings.php"><img src="mos-css/img/winnings.png"><br>Winnings</a>
		</div>
		<div class="shortcutHome">
		<a href="sms.php"><img src="mos-css/img/sms.png"><br>Send SMS</a>
		</div>
		<div class="shortcutHome">
		<a href="log.php"><img src="mos-css/img/log.png"><br>Log</a>
		</div>
		<div class="shortcutHome">
		<a href="players.php"><img src="mos-css/img/players.png"><br>Players</a>
		</div>
		
		<div class="clear"></div>
		<div style="display:none;">
		<?php
		// get all stat data and store in local variable
		include("../processor/connect.php"); // connect to database
		
		/// get total site visit data stored in variable $hitcount
		$hit = mysql_query("SELECT hitcount FROM admin");
        $data = mysql_fetch_array($hit);
        extract($data);
		
		///  get total registered players stored in variable $totalplayers
		$players = mysql_query("SELECT COUNT(id) AS totalplayers FROM users");
        $data = mysql_fetch_array($players);
        extract($data);
		
		///  get total questions stored in variable totalquestions
		$questions = mysql_query("SELECT COUNT(qid) AS totalquestions FROM questions");
        $data = mysql_fetch_array($questions);
        extract($data);
		
		///  get total games played stored in variable totalgames
		$games = mysql_query("SELECT COUNT(gid) AS totalgames FROM gaming");
        $data = mysql_fetch_array($games);
        extract($data);
		
		///  get total winnings from games stored in variable totalwins
		$gameswins = mysql_query("SELECT COUNT(gid) AS totalwins FROM gaming WHERE winner='1'");
        $data = mysql_fetch_array($gameswins);
        extract($data);
		
		///  get total games played today
		$today = date("d");
		$gamestoday = mysql_query("SELECT COUNT(gid) AS totaltoday FROM gaming WHERE day='$today'");
        $data = mysql_fetch_array($gamestoday);
        extract($data);
		?>
		</div>
		
		<div id="smallRight"><h3>Site Statistics</h3>
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">Total Visit</td><td style="border: none;padding: 4px;"><b><?php echo $hitcount; ?></b></td></tr>
			<tr><td style="border: none;padding: 4px;">Registered Players</td><td style="border: none;padding: 4px;"><b><?php echo $totalplayers; ?></b></td></tr>
			<tr><td style="border: none;padding: 4px;">Total Questions</td><td style="border: none;padding: 4px;"><b><?php echo $totalquestions; ?></b></td></tr>
		</table>
		</div>
		<div id="smallRight"><h3>Gaming Statistics</h3>
		
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">Total Played</td><td style="border: none;padding: 4px;"><b><?php echo $totalgames; ?></b></td></tr>
			<tr><td style="border: none;padding: 4px;">Total Winnings</td><td style="border: none;padding: 4px;"><b><?php echo $totalwins; ?></b></td></tr>
			<tr><td style="border: none;padding: 4px;">Played Today</td><td style="border: none;padding: 4px;"><b><?php echo $totaltoday; ?></b></td></tr>
		</table>
		</div>
	</div>
<div class="clear"></div>
<div id="footer">
<p>Powered by <a href="http://www.vanatugroup">VANATU GROUP</a> 
 </p>
</div>
</div>
</body>
</html>