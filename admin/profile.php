<?php
session_start();
$ip = $_SERVER['REMOTE_ADDR'];
$fingerid = md5($_SERVER['HTTP_USER_AGENT'].$ip);
if(!isset($_SESSION['fingerprint']) AND $_SESSION['finger'] !== $fingerid){
header("location: login.php?error=notlogged");
exit();
}

	// div to get all users info
	include("../processor/connect.php");
	$id = $_GET['id'];
	$info = mysql_query("SELECT * FROM users WHERE id='$id'");
	$infodata = mysql_fetch_array($info);
	extract($infodata);
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $name; ?></title>
<link rel="icon" href="http://www.hatlabicecream.com/wp-content/assets/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow" />
<script type="text/javascript" src="../jscript/jquery.js"></script>
<script type="text/javascript" src="js/script.js"></script>
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
	<div style="display:none;">
	</div>
	<div style="display:none;">
	<?php
		$joindate = "$join_day/$join_month/$join_year" ;
		// get user last game and score
$gamescore = mysql_query("SELECT score,day,month,year FROM gaming WHERE id='$id' ORDER BY gid DESC");
        $datascore = mysql_fetch_array($gamescore);
        extract($datascore);
		$lastgame = "$day/$month/$year";
	?>
	</div>
	<div id="rightContent">
	<h2><?php echo $name ; ?> Profile</h2>
		<table class="data">
			<tr class="data">
				<td>Name: <?php echo $name ; ?></td>
				<td>Phone: <?php echo $phone ; ?></td>
				<td>Email: <?php echo $email ; ?></td>
			</tr>
			<tr class="data">
				<td>Total Played: <?php echo $total_played ; ?></td>
				<td>Joined: <?php echo $joindate ; ?></</td>
				<td>Winnings: <?php echo $winnings ; ?></td>
			</tr>
			<tr class="data">
				<td>&nbsp;</td>
				<td>Last game: <?php echo $lastgame ; ?></td>
				<td>Last Score: <?php echo $score ; ?></td>
			</tr>
		</table>
		
		<h2>EDIT PROFILE</h2>
		<table id="editprofile" class="data" border=1>
		<tr class="data">
				<td><a href="#">Name</a></td>
		<td><input type="text" id="editname" value="<?php echo $name ; ?>" class="sedang"></td>
				<td><input type="button" class="button" id="changepass" value="Change Password"/></td>
			</tr>
			<tr class="data">
				<td><a href="#">Phone</a></td>
	<td><input type="text" value="<?php echo $phone ; ?>" id="editphone" class="sedang"></td>
				<td><input style="width:250px;" type="password" id="passbox" class="sedang"></td>
			</tr>
			<tr class="data">
				<td><a href="#">Email</a></td>
	<td><input type="text" value="<?php echo $email ; ?>" id="editemail" class="sedang"></td>
				<td><input type="button" class="button" id="savepassedit" value="save"/></td>
			</tr>
			<tr class="data">
<td><input type="hidden" value="<?php echo $id ; ?>" id="userid" class="sedang"></td>
		<td colspan=2 align=left><input type="button" class="button" id="savedits" value="save"/></td>
				
			</tr>
		</table>
		
		<h2>Gaming History</h2>
		<table class="data">
			<tr class="data">
				<th class="data">NO</th>
				<th class="data">Date</th>
				<th class="data">Score</th>
			</tr>
			<?php
			/// get gamin history
			$query = mysql_query("SELECT * FROM gaming WHERE pid='$id'");
			while($data = mysql_fetch_array($query)){
			extract($data);
			$date = "$day/$month/$year" ;
			echo "
             <tr class=\"data\">
				<td>$gid</td>
				<td>$date</td>
				<td>$score</td>
			</tr>
			";
			}
			?>
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