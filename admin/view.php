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
<title>View Questions</title>
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
	<div id="rightContent">
	<h3>Questions</h3>
	<input type="text" id="Qbox" class="sedang">
	<input type="button" class="button" id="findQ" value="search for question"/>
		<table class="data">
			<tr class="data">
				<th class="data" width="30px">No</th>
				<th class="data">Question</th>
				<th class="data">Frequency</th>
				<th class="data" width="75px">Remove</th>
			</tr>
			<tbody id="spread">
			<?php
include("../processor/connect.php");
$display = 20 ; // no of results to be displayed per page
extract($_GET);

if(!isset($lim1)){
$lim1 = 0;
$viewing = 1;
}

$query = "SELECT question,qid,frequency FROM questions LIMIT $lim1,$display";
$result = mysql_query($query);

$no = $lim1;
$sn = 1 ;
while($row = mysql_fetch_array($result)){
extract($row);
// format outputs
echo "
			<tr id=\"$qid\" class=\"data\">
				<td class=\"data\" width=\"30px\">$sn</td>
				<td class=\"data\">$question</td>
				<td class=\"data\" width=\"75px\">$frequency</td>
				<td class=\"data\" width=\"75px\">
				<center>
				<a href=\"#\" onclick=\"delQ('$qid')\"><img src=\"mos-css/img/delete.png\"></a>&nbsp;&nbsp;&nbsp;
				</center>
				</td>
			</tr>
";
$sn++;
$no++;
}
?>
			</tbody>
		</table>
		<div class="page">
		<?php
$query = "SELECT count(qid) AS counts FROM questions";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
extract($row);

$no = 1;

// loope to create pages
while($display < $counts){

$lim2 = $no * $display; // set limit 1
$lim1 = $lim2 - $display; // set limit 1
$lim1 = $lim1 + 1;  // add one to comlete

if($no == $viewing){
$class = 'current';
}

echo "<a class='$class' href='view.php?lim1=$lim1&viewing=$no'>$no</a>" ;

$counts = $counts - $display ;
$no++;
}

// get final page
$a = $lim1 + $display;

// condition for veiwing

if($no == $viewing){
$class = 'current';
}

echo "<a class='$class' href='view.php?lim1=$a&viewing=$no'>$no</a>" ;
?>
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