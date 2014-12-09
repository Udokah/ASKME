<?php

// function to find question

// security **
if(!isset($_POST)){
header("location: ../../index.php");
}

include("../../processor/connect.php");
extract($_POST);
$sn = 1;
$query = mysql_query("SELECT * FROM users WHERE name LIKE '%$q%'");
$data = mysql_fetch_array($query);
if(!isset($data['id']) or empty($data['id']) or !is_numeric($data['id'])){
echo "<tr><td colspan=5 align=center><h2>User Not found !</h2></td></tr>";
}
else{
$query2 = mysql_query("SELECT * FROM users WHERE name LIKE '%$q%'");
while($data2 = mysql_fetch_array($query2)){
extract($data2);
echo "
			<tr id='$id' class=\"data\">
				<td class=\"data\" width=\"30px\">1</td>
				<td class=\"data\">$name</td>
				<td class=\"data\">$phone</td>
				<td class=\"data\">$email</td>
				<td class=\"data\" width=\"75px\">
				<center>
				<a href=\"#\" onclick=\"delAcc('$id')\" title=\"delete Player\"><img src=\"mos-css/img/delete.png\"></a>&nbsp;&nbsp;&nbsp;
				<a href=\"profile.php?id=$id\" title=\"View Profile\"><img src=\"mos-css/img/detail.png\"></a>&nbsp;&nbsp;&nbsp;
				</center>
				</td>
			</tr>
";
$sn++;
}
}
?>