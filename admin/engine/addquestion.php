<?php
// script to handle adding of questions
if(!isset($_POST)){
header("location: ../../index.php");
}

include("../../processor/functions.php");
include("../../processor/connect.php");
extract($_POST);

// run through clean and check if empty
foreach($_POST as $value)
{
$value = clean($value);
if(empty($value)){
echo "Invalid Input !" ;
exit();
}
}

// clean inputs
$question = mysql_real_escape_string(clean($question));
$ans1 = mysql_real_escape_string(clean($ans1));
$ans2 = mysql_real_escape_string(clean($ans2));
$ans3 = mysql_real_escape_string(clean($ans3));
$ans4 = mysql_real_escape_string(clean($ans4));

// check if question exists before
$check = mysql_query("SELECT qid FROM questions WHERE question='$question'");
$data = mysql_fetch_array($check);
if(isset($data['qid']) and is_numeric($data['qid']) and !empty($data['qid'])){
echo "AddError('Question already exists')" ;
exit();
}

// format inputs
$options = "$ans1|$ans2|$ans3|$ans4" ;  // put all options in one variable
$day = date("d");
$month = date("m");
$year = date("Y");

$query = "INSERT INTO questions SET question='$question',options='$options',answer='$answer',day='$day',month='$month',year='$year'" ;

if(mysql_query($query)){
$status = "AddSuccess()" ;
}
else{
$status = "AddError('Unable to add question to DB')" ;
}

echo $status;

?>