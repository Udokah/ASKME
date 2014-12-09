<?php

// function to find question

// security **
if(!isset($_POST)){
header("location: ../../index.php");
}

include("../../processor/connect.php");
extract($_POST);
$sn = 1;
$query = mysql_query("SELECT question,qid,frequency FROM questions WHERE question LIKE '%$q%'");
$data = mysql_fetch_array($query);
if(!isset($data['qid']) or empty($data['qid']) or !is_numeric($data['qid'])){
echo "<tr><td colspan=5 align=center><h2>Question Not found !</h2></td></tr>";
}
else{
$query2 = mysql_query("SELECT question,qid,frequency FROM questions WHERE question LIKE '%$q%'");
while($data2 = mysql_fetch_array($query2)){
extract($data2);
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
}
}
?>