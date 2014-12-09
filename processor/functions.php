<?php
// function to destroy known sessions
function unset_session(){
unset($_SESSION['name'],$_SESSION['id'],$_SESSION['questions'],$_SESSION['sn'],$_SESSION['que_id'],$_SESSION['answered_correctly']);
}

// function to get rating 
function get_rating($scores){
if($scores == 10){
$rating = "Thats really poor try study more" ;
}
elseif($scores == 20){
$rating = "<img src='img/star.png'/>" ;
}
elseif($scores == 30){
$rating = "<img src='img/star.png'/>" ;
}
elseif($scores == 40){
$rating = "<img src='img/star.png'/> <img src='img/star.png'/> " ;
}
elseif($scores == 50){
$rating = "<img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> " ;
}
elseif($scores == 60){
$rating = "<img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> " ;
}
elseif($scores == 70){
$rating = "<img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> " ;
}
elseif($scores == 80){
$rating = "<img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> " ;
}
elseif($scores == 90){
$rating = "<img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> " ;
}
elseif($scores == 100){
$rating = "<img src='img/star.png'/><img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> <img src='img/star.png'/> " ;
}
return $rating ;
}

// BASIC FUNCTION
function comment($scores){
if($scores == 10){
$comment = "Thats really poor try study more" ;
}
elseif($scores == 20){
$comment = "Not a very good score but you can do better" ;
}
elseif($scores == 30){
$comment = "Well, not too good for someone like you" ;
}
elseif($scores ==  40){
$comment = "Average score but you can do better" ;
}
elseif($scores == 50){
$comment = "Nice one but the top is never crowded" ;
}
elseif($scores == 60){
$comment = "Very good but you can still try harder" ;
}
elseif($scores == 70){
$comment = "Brilliant kid, you will be great !" ;
}
elseif($scores == 80){
$comment = "Wonderful score, its in you" ;
}
elseif($scores == 90){
$comment = "Excellent performance, kudos!" ;
}
elseif($scores == 100){
$comment = "Thats it kid, you have qualified for a reward" ;
}
return $comment;
}

// function to compute scores
function score($score){
$result = $score * 10 ;
return $result ;
}

// function to escape " characters
function rep_char($string){
$data = str_replace('"','\"',$string); 
$data = str_replace('  ',' ',$data); 
return $data;
}

// function to generate random numbers
function get_random(){
/// get unique code 
//To Pull 8 Unique Random Values Out Of AlphaNumeric

//removed number 0, capital o, number 1 and small L
//Total: keys = 32, elements = 33
$characters = array(
"A","B","C","D","E","F","G","H","J","K","L","M",
"N","P","Q","R","S","T","U","V","W","X","Y","Z",
"2","3","4","5","6","7","8","9","0");

//make an "empty container" or array for our keys
$keys = array();

//first count of $keys is empty so "1", remaining count is 1-7 = total 8 times
while(count($keys) < 10) {
    //"0" because we use this to FIND ARRAY KEYS which has a 0 value
    //"-1" because were only concerned of number of keys which is 32 not 33
    //count($characters) = 33
    $x = mt_rand(0, count($characters));
    if(!in_array($x, $keys)) {
       $keys[] = $x ;
    }
}

foreach($keys as $key){
   $random_chars .= $characters[$key];
}
return $random_chars;
}

// clean user input
function clean($data){
if(!empty($data)) {
$data = htmlspecialchars(strip_tags(trim($data))) ;
}
return $data ;
}

function checkEmail($email){
$format = '\.com|\.net|\.org|\.de|\.com.ng|\.au|\.ng|\.co|\.uk|\.ca|\.info|\.tv|\.me|\.edu|\.edu.ng|\.gov|\.co.uk' ;
if(@ereg("^.+@.+($format)$",$email)){
return $email ;
}
else {
return false ;
} 
}

function checkPhone($phone){
if (!is_numeric($phone)) {
$status = false;
}
else{
$status = $phone;
}
return $status ;
}

// function to send message to user 
function mail_user($email,$subject,$message){
// compose headers
$mailheaders = "MIME-Version:1.0\r\n";
$mailheaders .= "Content-type:text/html; charset=ISO-8859-1\r\n";
$mailheaders .= "<b>From:</b>HatLabIce-Cream <info@hatlabicecream.com><br>\r\n";
$mailheaders .= "<b>Reply To:</b>HatLabIce-Cream <info@hatlabicecream.com>\r\n";
// send message
@mail($email,$subject,$message,$mailheaders);
}
?>