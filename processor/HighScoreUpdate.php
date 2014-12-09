<?php
include("connect.php");
include("functions.php");

/// UPDATE HOW MANY TIMES SITE HAS BEEN VISITED AND TRACK VISITORS
if(!isset($_COOKIE['hitcount'])){
$hit = mysql_query("SELECT hitcount FROM admin");
$data = mysql_fetch_array($hit);
extract($data);
$hitcount++;
mysql_query("UPDATE admin SET hitcount='$hitcount'"); // update hit count
setcookie("hitcount","$hitcount",time()+(24*3600)); // set cookie to expire in one day
}

$query = "SELECT DISTINCT pid,PlayerName,score FROM gaming ORDER BY score DESC" ;
$call = mysql_query($query);
$no = 0 ;

while($data = mysql_fetch_array($call) and $no <= 5){
extract($data);
$rating = get_rating($score);
echo "<div class='Hscore'><p>$PlayerName</p><span>Points: $score</span><b>Rating:$rating</b></div>" ;
$no++;
}
exit();

?>