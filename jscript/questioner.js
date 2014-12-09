
// function to load first question and start timer
function LoadQuestions(){
$('#alert').html("<center><img src='img/loading2.gif'/></center>").fadeIn('fast'); // show loading
            $.ajax({
			type: "POST",
			url: "processor/LoadQuestion.php",
			cache: false,
			data: "action=FirstLoad",
			success: function(data){
			eval(data);
			}
		    });
}

// function to insert questions in right places
function ShowTest(name,serial,question,options){
$(document).ready(function(){
$('#playername').val(name);
$('#qno').val(serial);
$('#questionbar').html(question);
$('#optionbar').html(options);
$('#alert').fadeOut('fast');
Timer(600,0);
});
}

// function to show next test
function ShowNextTest(serial,question,options){
$(document).ready(function(){
$('#qno').val(serial);
$('#questionbar').html(question);
$('#optionbar').html(options);
$('#alert').fadeOut('fast');
});
}

function Timer(time,sec){

var minuteTime = time/60 ; // convert to minutes

if(sec == 61){
minuteTime--;
sec = 1 ;
}

var secTime = 60 - sec ;

sec++ ; // increase seconds by one

// on time up
if(minuteTime == -1){
alert('TIME UP !');
$('#cheat').text("101");
Answer('force_submit') ;
exit();
}

if(minuteTime == 5){
$('#time').css('border','2px dashed red');
$('#time').css('color','red');
}

if(minuteTime < 10){
if(secTime < 10){
$('#time').val('00:0'+minuteTime+':0'+secTime); // add 0 in front of integer
}
else{
$('#time').val('00:0'+minuteTime+':'+secTime);
}
}
else if(secTime < 10){
if(minuteTime < 10){
$('#time').val('00:0'+minuteTime+':0'+secTime); // add 0 in front of integer
}
else{
$('#time').val('00:'+minuteTime+':0'+secTime);
}
}
else{
$('#time').val('00:'+minuteTime+':'+secTime);
}


var counter = minuteTime * 60 ; // convert back to seconds

setTimeout('Timer(' + counter + ',' + sec + ')',1000);
}

// function to process when answer is clicked
function Answer(special){

// get answer from checkboxes
var ans1 = $('#opt1').val() ;
var ans2 = $('#opt2').val() ;
var ans3 = $('#opt3').val() ;
var ans4 = $('#opt4').val() ;

var qid = $('#quid').val() ; // question id

var opt1 = document.getElementById('opt1').checked ;
var opt2 = document.getElementById('opt2').checked ;
var opt3 = document.getElementById('opt3').checked ;
var opt4 = document.getElementById('opt4').checked ;

//SET ANSWER
if(opt1 == 1) {
var answer = ans1 ;
}
if(opt2 == 1) {
var answer = ans2 ;
}
if(opt3 == 1) {
var answer = ans3 ;
}
if(opt4 == 1) {
var answer = ans4 ;
}

            $.ajax({
			type: "POST",
			url: "processor/LoadQuestion.php",
			cache: false,
			data: "action=AnswerOld_LoadNew" + "&Answer=" + answer + "&special=" + special,
			success: function(data){
			eval(data);
			}
		    });

}

function showResult(name,score,comment,reward){
$('#questionframe').fadeOut('fast', function(){
$('#result').fadeIn('fast', function(){
$('#Rname').html(name);
$('#Rscore').html(score);
$('#Rcomment').html(comment);
$('#Rreward').html(reward);
UpdateHighScores();
});
});
}

function UpdateHighScores(){
$.ajax({
			type: "POST",
			url: "processor/HighScoreUpdate.php",
			cache: false,
			data: "action=HighScoreUpdate",
			success: function(dataBack){
			$('#scores').html(dataBack);
			}
		    });
}

// function to delete all sessions and reset on windows close and tab loose focus
function Resetall(){
$.ajax({
			type: "POST",
			url: "processor/resetall.php",
			cache: false,
			data: "action=HighScoreUpdate",
			success: function(){
			}
		    });
}

