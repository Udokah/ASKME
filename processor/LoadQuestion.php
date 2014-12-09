<?php
session_start();
$action = $_POST['action']; // get particular action from post
include("functions.php");
include("connect.php");
extract($_POST);

if($action == 'FirstLoad'){
// function to get the highes occuring question
$high = mysql_query("SELECT MAX(frequency) AS highest FROM questions");
$highdata = mysql_fetch_array($high);
extract($highdata);
// Function to load first question
$no = 1;

$getquery = "SELECT qid FROM questions ORDER BY frequency" ;

$query = mysql_query($getquery);

while($nos = mysql_fetch_array($query)){
extract($nos);
$chars[$no] = $qid ;
$no++;
}


$keys = array();
while(count($keys) < 10){              // select a maximum of 10 question ID
    $x = mt_rand(1, count($chars));    // get random question id from them
    if(!in_array($x, $keys)){          // make sure a number is not selected more than once
	if(in_array($x, $chars)){          // make sure no selected is a question id
       $keys[] = $x ;
	   }
    }
}

// get first question and send to page
$que1 = $keys[0];
unset($keys[0]); // remove first answered question from array

// store qll remaining question array in session cookie
$_SESSION['questions'] =  $keys ;
$_SESSION['sn'] =  0 ;  /// show that this is first questions
$_SESSION['que_id'] =  $que1 ;  /// show that this is first questions

$getquestion = mysql_query("SELECT * FROM questions WHERE qid='$que1'");
$quedata = mysql_fetch_array($getquestion);
extract($quedata);

$OPT = explode("|" ,$options);  // explose options
$opt1 = $OPT[0] ;
$opt2 = $OPT[1] ;
$opt3 = $OPT[2] ;
$opt4 = $OPT[3] ;

// formulate options
$selections = "
<tr><td><label><input id='opt1' type='radio' value='$opt1' name='answer'/>$opt1</label></td><td><label><input id='opt2' type='radio' value='$opt2' name='answer'/>$opt2</label></td></tr><tr><td><label><input id='opt3' type='radio' value='$opt3' name='answer'/>$opt3</label></td><td><label><input id='opt4' type='radio' value='$opt4' name='answer'/>$opt4</label></td></tr>
" ;

$name = rep_char($name);
$selections = rep_char($selections);
$question = rep_char($question);


$selections = trim($selections);
// get users name form session
$uname = $_SESSION['name'] ;
$serial = $_SESSION['sn'] + 1 ; // to be displayed as no; remember former is 0 which is begining of array


echo "ShowTest(\"$uname\",$serial,\"$question\",\"$selections\")";
exit();
}

// FUNCTION TO ANSWER OLD QUESTION AND LOAD NEW
if($action == 'AnswerOld_LoadNew'){

// if time is up before user clicks answer then compute result
if($special == 'force_submit'){
$uname = $_SESSION['name'] ;
$score = score($_SESSION['answered_correctly']) ;   // get total score
$comment = "You did not finish on time !" ;
$reward = "You havent qualified" ;
$message = "showResult(\"$uname\",\"$score\",\"$comment\",\"$reward\")" ;
unset_session(); // function to destroy all created sessions
echo $message;
exit();
}

// first answer old question
// get id,serial and questions array from stored session
$que_id = $_SESSION['que_id'] ;
$serial = $_SESSION['sn'] ; 
$keys = $_SESSION['questions'] ;


//// EXIT WHEN PLAYER COMPLETES 10 QUESTIONS
if($serial == 9){
// enter score into gaming database database
$score = score($_SESSION['answered_correctly']) ;   // get total score
/// determing winning
if($score == 100){
$winning = 1;
$reward = "Brilliant Kid you have qualified for an ice-cream from Hatlab Ice-cream" ;
$code = get_random();  // generate random verify winning code
}
else{
$winning = 0;
$code = '0';
$reward = "You havent qualified" ;
}
// format insert data
$day = date("d");
$month = date("m");
$year = date("Y");
$Pid = $_SESSION['id'] ;
$uname = $_SESSION['name'] ;
$query = mysql_query("INSERT INTO gaming SET PlayerName='$uname',pid='$Pid', score='$score',winner='$winning',day='$day',month='$month',year='$year',code='$code'");

/// get users data
$user = mysql_query("SELECT * FROM users WHERE id='$Pid'");
$userrow = mysql_fetch_array($user);
extract($userrow);
// if user has won more than 10 time user cant win again
if($winnings == 10){
$reward = "You Have exceeded the winnings rate,brilliant but you cant get any rewards." ;
}

$total_played++; // increase total played by one
if($winning == 1){
$winnings++; /// increase winnings if user won
// send email to user to notify winning and code
$subject = "Hatlab Ice-Cream Winner Notifications";
$mes = "Hello $name,<br> You have qualified for an icecream reward visit any Hatlab vendor near you and collect you ice-cream with this code: $code . <br>Best Regards<br>Hatlaba Ice-cream." ;
mail_user($email,$subject,$mes);
}

// update user account with winnings and total played
$acc = mysql_query("UPDATE users SET total_played='$total_played',winnings='$winnings' WHERE id='$id'");

// set comments according to score
$comment = comment($score) ;
$message = "showResult(\"$name\",\"$score\",\"$comment\",\"$reward\")" ;
unset_session(); // function to destroy all created sessions
echo $message;
exit();
}
/////////////////////////////////////////////////////////////////////////////////////////////////
$check = mysql_query("SELECT answer,frequency,pass,fail FROM questions WHERE qid='$que_id'");
$data = mysql_fetch_array($check);
if($data['answer'] == $Answer){  // if answer is correct, update question frequency
// first current frequency
$pass = $data['pass'] ;
$pass++ ;
$fail = 0;
$score = 1 ;
}
else{
$pass = 0;
$fail = $data['fail'] ;
$fail++ ;
$score = 0 ;
}
//// question update
$frequency = $data['frequency'] ;
$frequency++;  // increase by one
mysql_query("UPDATE questions SET frequency='$frequency',pass='$pass',fail='$fail' WHERE qid='$que_id'");  // update frequency
//// update question
// update correct answer session
if(!isset($_SESSION['answered_correctly'])){
$_SESSION['answered_correctly'] = $score;
}
else{
$_SESSION['answered_correctly'] += $score;
}

// function to select another question from the list
$serial++; // increase serial by 1 so we know we are asking next question
$nextquestion = $keys[$serial]; // get next question from array of questions stored
unset($keys[$serial]);  // remove selected question from array

// store qll remaining question array in session cookie
$_SESSION['questions'] =  $keys ;
$_SESSION['sn'] =  $serial;  /// show that this is nth questions
$_SESSION['que_id'] =  $nextquestion;  /// show that this is first questions

// now get next question and go on son !!!
/////////////////////////////////////////////////////////////
$getquestion = mysql_query("SELECT * FROM questions WHERE qid='$nextquestion'");
$quedata = mysql_fetch_array($getquestion);
extract($quedata);

$OPT = explode("|" ,$options);  // explose options
$opt1 = $OPT[0] ;
$opt2 = $OPT[1] ;
$opt3 = $OPT[2] ;
$opt4 = $OPT[3] ;

// formulate options
$selections = "
<tr><td><label><input id='opt1' type='radio' value='$opt1' name='answer'/>$opt1</label></td><td><label><input id='opt2' type='radio' value='$opt2' name='answer'/>$opt2</label></td></tr><tr><td><label><input id='opt3' type='radio' value='$opt3' name='answer'/>$opt3</label></td><td><label><input id='opt4' type='radio' value='$opt4' name='answer'/>$opt4</label></td></tr>
" ;

$selections = rep_char($selections);
$question = rep_char($question);
$selections = trim($selections);
$serial++; // to show correct no of question

echo "ShowNextTest($serial,\"$question\",\"$selections\")";
exit();
}
?>