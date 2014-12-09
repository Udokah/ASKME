<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Copyright" content="UD IT SOLUTIONS">
<meta name="description" content="Hatlabs Game App Developed by UD IT SOLUTIONS">
<meta name="keywords" content="games, hatlabs, icecream,web applications">
<meta name="author" content="UD IT SOLUTIONS">
<meta name="language" content="ENGLISH">
<meta http-equiv="Cache-control" content="no-cache">
<link rel="icon" href="http://www.hatlabicecream.com/wp-content/assets/favicon.ico" type="image/x-icon" />
<script src="jscript/jquery.js"></script>
<script src="jscript/jquery-ui-1.8.23.custom.min.js"></script>
<script src="jscript/script.js"></script>
<script src="jscript/questioner.js"></script>
<!–[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]–>
<link rel="stylesheet" href="css/style.css">
<title>Hatlabs Ice-Creame Game Zone</title>
<!--[if IE 9]>
<style type="text/css">
    #footer {top:583px;}
	#instruction input{ background-color:#000;}
</style>
<![endif]-->
<script type="text/javascript">
// function to detect when browser window is being closed
window.onbeforeunload = function(){ myUnloadEvent(); }
function myUnloadEvent(){
 Resetall();
}

// function to check if javascript is enabled
$(document).ready(function(){
$('#alert').hide();
});

// function to prevent user from opening another page or program
$(document).ready(function(){
$(window).blur(function() {

if($('#questionframe').is(':visible')){  // check when answering questions
    var cheat = $('#cheat').text();
	if(cheat == 2){
	Resetall();
	alert("You attempted cheating !, game has been reset");
	window.location = "index.php" ;
	}
	else{
	if(cheat != 101){
	alert("You cant open any other programs or tabs,if you try more than 2 times the game will be reset");
	cheat++
	$('#cheat').text(cheat);
	}
	}
	}
});
});
</script>
</head>
<body onload="UpdateHighScores()">
<div id="container">
<div id="alert">
<b style="font-size:25px;">JavaScript is not enabled, it is important that you enable It.</b>
</div>
<span id="cheat"></span>
<div id="home">
<a href="index.php"><img width="32px" height="32px" src="img/home.png"/><br>HOME</a>
</div>
<div id="header">
<img src="img/banner.png" width="80%" />
</div>

<!-- div that displays main page functions ----->

<div id="middlebar">

<!-- div that displays result instructions for playing ----->
<div id="instruction">
<h2>Welcome to Hatlabs Ice-cream Game Zone</h2>
<p>
This is an educational games zone
designed with pupils in mind. 
</p>
<p><strong>How to play</strong></p>
<p>
Playing the game is easy,
a question will appear and you just select the 
right answer. You will also be given a time limit
to answer each question.
</p>
<p><strong>Instructions</strong></p>
<ul>
<li>Do not attempt to open a new browser or check google for answers the game wil stop automatically.</li>
<li>When playing the game you are not allowed to open any other program or tabs until the game is over, if you do the game will stop automatically.</li>
<li>Do not refresh this page.</li>
<li>Make sure that cookies and javascript is enabled</li>
</ul>
<p><strong>Terms & Conditions</strong></p>
<ul>
<li>Player must be between the ages of 6-13 yrs old</li>
<li>All player winnings is determined by Hatlabs icecream</li>
<li>Hatlabs system determines the correct answer for each questions</li>
<li>Players cant question the decision of the system</li>
<li>Rewards can be withheld if Our system feel there is a discrepancy regarding winnings</li>
</ul>
<p align=center>By playing this game you are accepting our terms and conditions</p>
<p align=center><input id="instOK" type="button" value="Ok I Agree" /></p>
</div>
<!-- end of div that displays result instructions for playing ----->

<!-- Div to sign up ----->
<div class="info" id="info">
<h2>Sign Up is free and easy !</h2>
<p align=center>
<form name="form">
<table cellspacing=5 cellpadding=5>
<tr><td><input type="textbox" id="name" value="Full Name" onblur="if(this.value=='')this.value='Full Name'" onfocus="if(this.value=='Full Name')this.value=''" /></td></tr>
<tr><td><input type="textbox" id="Phone" value="Phone e.g 08135143089" onblur="if(this.value=='')this.value='Phone e.g 08135143089'" onfocus="if(this.value=='Phone e.g 08135143089')this.value=''" /></td></tr>
<tr><td><input type="textbox" id="email" value="Email" onblur="if(this.value=='')this.value='Email'" onfocus="if(this.value=='Email')this.value=''" /></td></tr>
<tr>
<td>
<input type="textbox" id="password" value="Password"/>
<input type="password" id="realpass" value="" />
</td>
</tr>
<tr><td><input type="button" id="saveinfo" value="Create My Account" /></td></tr>
<tr><td><input type="button" id="regBack" value="&laquo; Back" /></td></tr>
</table>
</form>
</p>
</div>
<!-- end of div to sign up ----->

<!-- div to log in and play ----->
<div class="info" id="login">
<h2>Player Login</h2>
<form name="form">
<table cellspacing=5 cellpadding=5>
<tr><td>Email</td></tr>
<tr><td><input type="textbox" id="Lemail" value=""/></td></tr>
<tr><td>Password</td></tr>
<tr><td><input type="password" id="Lpass" value=""/></td></tr>
<tr><td><input type="button" id="signIn" value="Log in" /></td></tr>
</table>
</form>
</div>
<!-- end of div to log in and play ----->

<!-- div that displays menu ----->
<div id="menu">
<table border=0 cellpadding=5 cellspacing=5>
<caption><img src="img/askme.gif" /></caption>
<tr><td><input type="button" id="playgame" value="Play Game" /></td>
<td rowspan=3><img src="img/anime.gif" width="110px" height="200px" /></td></tr>
<tr><td><input type="button" id="showReg" value="Signup to play" /></td></tr>
<tr><td><input type="button" id="showinst" value="Instructions" /></td></tr>
<tr></tr>
</table>
</div>
<!-- end of div that displays menu ----->

<!-- div that displays loading knowledge is power ----->
<div id="loading">
<img src="img/knowledge.gif" /><br>
<img src="img/loading.gif" width="100px" height="100px" />
</div>
<!-- end of  div that displays loading knowledge is power ----->

<!-- div that displays questions ----->
<div id="questionframe">
<table>
<tr>
<td><input type="text" disabled id="playername" value="Player Name"/></td>
<td>Question <input disabled id="qno" style="width:20px;" type="text" value="0"/>of 10</td>
<td>Time <input type="text" id="time" disabled value="time" /></td>
</tr>
</table>
<p id="questionbar">
Questions here
</p>
<form>
<b class="notch"></b>
<table id="optionbar" class="options" cellpadding=4 cellspacing=4>
<tr>
<td><label><input type="radio" value="op1" name="answer"/>Answer1</label></td>
<td><label><input type="radio" value="op2" name="answer"/>Answer2</label></td>
</tr>
<tr>
<td><label><input type="radio" value="op3" name="answer"/>answer3</label></td>
<td><label><input type="radio" value="op4" name="answer"/>answer4</label></td>
</tr>
</table>
<p align=center><input type="button" value="Answer" onclick="Answer('none')"/></p>
</form>
</div>
<!-- end of div that displays questions ----->

<!-- div that displays result after playing ----->
<div id="result">
<table border=0 cellpadding=5 cellspacing=5>
<caption>Result</caption>
<tr><td>Name:</td><td id="Rname">Name here</td></tr>
<tr><td>Score:</td><td id="Rscore">score here</td></tr>
<tr><td>Comment:</td><td id="Rcomment">comment here</td></tr>
<tr><td>Rewards:</td><td id="Rreward">rewards here</td></tr>
</table>
<form action="index.php" method="GET">
<p align=center><input type="submit" value="Replay" id="answerbut"/></p>
</form>
</div>
<!-- end of div that displays result after playing ----->

</div>
<!-- end of div that displays main page functions ----->

<!-- div that displays high scores ----->
<div id="rightbar">
<h2><img src="img/star.png" width="18" height="18" align=inline> <blink>High Scores</blink> <img width="18" height="18" align=bottom src="img/star.png"></h2>
<div id="scores">
<div class="Hscore">
<p>Player name</p>
<span>Points: </span>
<b>Rating:</b>
</div>
</div>
</div>
<!-- end of div that displays high scores ----->

<!-- div below where adverts can be placed ----->
<div id="footbar">
</div>
<!-- end of div where adverts can be placed ----->

</div>
<div id="midground">
</div>
<div id="foreground">
</div>
<div id="footer">
<p>Devloped by <a href="http://www.udonline.net">UD IT SOLUTIONS</a> copyright &copy; <?php echo date("Y"); ?></p>
</div>
</body>