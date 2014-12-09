<?php set_time_limit(0); ?>
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
<script src="jscript/script.js"></script>
<script src="jscript/questioner.js"></script>
<link href="css/ticker-style.css" rel="stylesheet" type="text/css" />
<script src="jscript/jquery.ticker.js" type="text/javascript"></script>
<script type="text/javascript" src="jscript/crawler.js"></script>
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
	/*
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
}); */
});

// fade image
$(document).ready(function(){

$(function () {
        $('#js-news').ticker();
    });

$("#footbar img").fadeTo("fast", 0.8, function(){
});

$("#footbar img").hover(function(){
$(this).fadeTo("slow", 1, function(){
});
});

$("#footbar img").mouseout(function(){
$(this).fadeTo("fast", 0.8, function(){
});
});
});
</script>

<!-- the CSS for Smooth Div Scroll -->
	<link rel="Stylesheet" type="text/css" href="css/smoothDivScroll.css" />
	
	<!-- Styles for my specific scrolling content -->
	<style type="text/css">

		#footbar
		{
			width:100%;
			height: 90px;
			position: relative;
		}
	</style>

</head>
<body onload="UpdateHighScores()">
<div id="container">
<div id="alert">
<b style="font-size:25px;">JavaScript is not enabled, it is important that you enable It.</b>
</div>
<span id="cheat"></span>
<div id="home">
<a href="index.php"><img width="32px" height="32px" src="img/home.png"/><br>HOME</a><br><br>
<a href="http://www.hatlabicecream.com" style="margin-left:-14px;"> <img width="90px" height="100px" src="img/hatlab.jpg"/><br>
Get an Ice-cream</a>
</div>
<div id="header">
<img src="img/banner.png" width="80%" />
</div>

<!-- div that displays main page functions ----->

<div id="middlebar">

<!-- div that displays result instructions for playing ----->
<div id="instruction">
<h2>Welcome to Hatlabs Ice-cream's Game Zone</h2>
<p>
This is a fun and educational games zone designed to stimulate your mind while winning great prizes along the way.
</p>
<p><strong>How to play</strong></p>
<p>
Playing the game is easy, a question will appear and you just select the right answer. Each question has a set time
limit to be answered.
</p>
<p><strong>Instructions</strong></p>
<ul>
<li>While playing the game you are not allowed to open any other program, tabs, or browsers, until the game is over,
if you do the game will stop automatically.
</li>
<li>Do not refresh this page.</li>
<li>Make sure that cookies and Javascript is enabled</li>
</ul>
<p><strong>Terms & Conditions</strong></p>
<ul>
<li>Only winners below 14years of age would be given free ice cream</li>
<li>All player winnings are determined by Hatlab.</li>
<li>Hatlab's system determines the correct answer for each question.</li>
<li>Players agree to not question the decision of the system.</li>
<li>Rewards can be withheld if our system feel there is a discrepancy regarding winnings.</li>
</ul>
<p align=center>By playing this game you are accepting our Terms and Conditions.</p>
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
<tr><td><input type="textbox" id="Phone" value="Phone e.g 080XXXXXXXX" onblur="if(this.value=='')this.value='Phone e.g 080XXXXXXXX'" onfocus="if(this.value=='Phone e.g 080XXXXXXXX')this.value=''" /></td></tr>
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
<!-- end of div to log in and play --->

<!-- div that displays menu ---->
<div id="menu">
<table border=0 cellpadding=5 cellspacing=5>
<caption><ul style="width:300px;!important" id="js-news" class="js-hidden">
    <li class="news-item"><a href="#">Hatlab Ice Cream - The pleasure to select, life is sweet!</a></li>
    <li class="news-item"><a href="#">Hatlab is the place to be.</a></li>
    <li class="news-item"><a href="#">Hatlab Ice Cream makes you happy all day long.</a></li>
    <li class="news-item"><a href="#">Hatlab is at every event.</a></li>
    <li class="news-item"><a href="#">Try HATLAB GAME, its FUN and EDUCATIONAL.WINNERS! Get free Ice Cream.</a></li>
</ul></caption>
<tr><td><input type="button" id="playgame" value="Play Game" /></td>
<td rowspan=3><img src="img/anime.gif" width="110px" height="200px" /></td></tr>
<tr><td><input type="button" id="showReg" value="Sign Up to Play" /></td></tr>
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
	  <?php
				  error_reporting(0);
		  //path to directory to scan
$directory = "img/pic/";
 
//get all image files with a .jpg extension.
$images = glob($directory . "*.jpg");
 
//print each file name
foreach($images as $image)
{
echo "<a href='http://www.hatlabicecream.com'><img src='$image' alt='' /></a>" ;
}
echo "
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/ice(1).jpg\" alt=\"\" /></a>
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/ice(2).jpg\" alt=\"\" /></a>
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/ice(3).jpg\" alt=\"\" /></a>
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/ice(4).jpg\" alt=\"\" /></a>
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/ice(5).jpg\" alt=\"\" /></a>
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/ice(6).jpg\" alt=\"\" /></a>
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/3_resize.jpg\" alt=\"\" /></a>
<a href=\"http://www.hatlabicecream.com\"><img src=\"img/pic/3_resize.jpg\" alt=\"\" /></a>
" ;
		  ?>

</div>


<!-- load scroller ----->
<!-- LOAD JAVASCRIPT LATE - JUST BEFORE THE BODY TAG 
	     That way the browser will have loaded the images
		 and will know the width of the images. No need to
		 specify the width in the CSS or inline. -->

	<!-- jQuery UI Widget and Effects Core (custom download)
	     You can make your own at: http://jqueryui.com/download -->
	<script src="js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
	
	<!-- Latest version (3.0.6) of jQuery Mouse Wheel by Brandon Aaron
	     You will find it here: http://brandonaaron.net/code/mousewheel/demos -->
	<script src="js/jquery.mousewheel.min.js" type="text/javascript"></script>

	<!-- jQuery Kinectic (1.5) used for touch scrolling -->
	<script src="js/jquery.kinetic.js" type="text/javascript"></script>

	<!-- Smooth Div Scroll 1.3 minified-->
	<script src="js/jquery.smoothdivscroll-1.3-min.js" type="text/javascript"></script>

	<!-- If you want to look at the uncompressed version you find it at
	     js/jquery.smoothDivScroll-1.3.js -->

	<!-- Plugin initialization -->
	<script type="text/javascript">
		// Initialize the plugin with no custom options
		$(document).ready(function () {
			// None of the options are set
			$("div#footbar").smoothDivScroll({
				autoScrollingMode: "onStart"
			});
		});
	</script>
<!-- load scroller ----->



<!-- end of div where adverts can be placed ----->
</div>
<div id="midground">
</div>
<div id="foreground">
</div>
<div id="footer">
<p><span align=right>Powered By <a href="http://www.vanatugroup.com">VANATU GROUP</a></span></p>
</div>
</body>