<?php

// function to find question

// security **
if(!isset($_POST)){
header("location: ../../index.php");
}

include("../../processor/connect.php");
extract($_POST);
$sn = 1;
$query = mysql_query("SELECT * FROM gaming WHERE PlayerName LIKE '%$q%'");
$data = mysql_fetch_array($query);
if(!isset($data['qid']) or empty($data['qid']) or !is_numeric($data['qid'])){
echo "<tr><td colspan=5 align=center><h2>Player Not found !</h2></td></tr>";
}
else{
$query2 = mysql_query("SELECT * FROM gaming WHERE PlayerName LIKE '%$q%'");
while($data2 = mysql_fetch_array($query2)){
extract($data2);

// get users personal details
$userinfo = mysql_query("SELECT phone FROM users WHERE id='$pid'");
$userdata = mysql_fetch_array($userinfo);
extract($userdata);

if($paid == 1){
$status = "Received" ;
}
else{
$status = "<center title='pay reward'>
				<a href=\"#\" onclick=\"Pay('$gid')\" ><img src=\"mos-css/img/oke.png\"></a>&nbsp;&nbsp;&nbsp;
				</center>";
}
$date = "$day/$month/$year";
echo "
			<tr class=\"data\">
				<td class=\"data\" width=\"30px\">$sn</td>
				<td class=\"data\">$PlayerName</td>
				<td class=\"data\">$phone</td>
				<td class=\"data\">$code</td>
				<td class=\"data\">$date</td>
				<td align=center>$status</td>
			</tr>
";
$sn++;
}
}
?>