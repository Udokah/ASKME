<?php
// function to delete question

// security **
if(!isset($_POST) or $_POST['action'] !== 'remove_question'){
header("location: ../../index.php");
}

include("../../processor/connect.php");
extract($_POST);

mysql_query("DELETE FROM questions WHERE qid='$questionID'");

?>