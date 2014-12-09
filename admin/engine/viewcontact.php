<?php
include("../../processor/connect.php");

$query = mysql_query("SELECT phone FROM contacts");
while($data = mysql_fetch_array($query)){
extract($data);
echo "$phone <br>" ;
}
?>