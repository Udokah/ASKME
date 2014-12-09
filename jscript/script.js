// function to handle options such that
// when name is clicked radio button is selected 
$(document).ready(function(){
$('.options label').live('click', function(){

});
});


// function to handle password changing attribute
$(document).ready(function(){
$('#password').focus(function(){
$(this).hide();
$('#realpass').val('');
$('#realpass').show().focus();
});


$('#realpass').blur(function(){
var value = $(this).val();
if(value == ''){ // if no password is entered
$(this).hide();   // hide box
$('#password').show();
} 
});
});

///// DISPLAY FUNCTIONS /////////////
// show instructions
$(document).ready(function(){
$('#showinst').click(function(){
$('#menu').hide('slide',function(){
$('#instruction').show('slide');
});
});
});

// show menu after reading instructions
$(document).ready(function(){
$('#instOK').click(function(){
$('#instruction').hide('slide',function(){
$('#menu').show('slide');
});
});
});

// play game
$(document).ready(function(){
$('#playgame').click(function(){
$('#menu').slideUp('fast',function(){
$('#login').slideDown('fast');
});
});
});

// show registeration
$(document).ready(function(){
$('#showReg').click(function(){
$('#menu').hide('slide',function(){
$('#info').show('slide');
$('#footbar').fadeOut('fast');
$('#realpass').val(''); // empty hidden password field
});
});
});

// navigate back from regiseration
$(document).ready(function(){
$('#regBack').click(function(){
$('#info').hide('slide',function(){
$('#menu').show('slide');
$('#footbar').fadeIn('fast');
});
});
});

// function to clear info boxes
function clear(){
$(document).ready(function(){
$('#name').val('Full Name');
$('#Phone').val('Phone e.g 08135143089');
$('#email').val('Email');
$('#realpass').val('');
$('#realpass').hide();
$('#password').show();
});
}

// function to Register new user
$(document).ready(function(){
$('#saveinfo').click(function(){

var name = $('#name').val();
var Phone = $('#Phone').val();
var email = $('#email').val();
var pass = $('#realpass').val();

// check for empty fields
if(name == '' || name == 'Full Name'){
var error = "oops! you haven't entered your name." ;
$('#alert').html(error).fadeIn('fast').delay(1500).fadeOut('fast',function(){
$('#name').focus();
});
exit();
}

if(Phone == '' || Phone == 'Phone e.g 08135143089'){
var error = "oops! you haven't entered your Phone number" ;
$('#alert').html(error).fadeIn('fast').delay(1500).fadeOut('fast',function(){
$('#Phone').focus();
});
exit();
}

if(email == '' || email == 'Email'){
var error = "oops! you haven't entered your email address" ;
$('#alert').html(error).fadeIn('fast').delay(1500).fadeOut('fast',function(){
$('#email').focus();
});
exit();
}

if(pass == ''){
var error = "oops! you haven't entered your password" ;
$('#alert').html(error).fadeIn('fast').delay(1500).fadeOut('fast',function(){
$('#password').focus();
});
exit();
}

$('#alert').html("<center><img src='img/loading2.gif'/></center>").fadeIn('fast');
$('#info').fadeTo(400, 0.5);
// send to php script
$.ajax({
type: 'POST',
cache: false,
url: 'processor/register.php',
data: 'action=signup' + '&name=' + name + '&Phone=' + Phone + '&email=' + email + '&pass=' + pass,
success: function(returnedData){
$('#alert').html(returnedData).fadeIn('fast').delay(2000).fadeOut('fast');
$('#info').fadeTo(400, 1);
eval(returnedData);
}
});
});
});

function signUpSuccess(){
$(document).ready(function(){
var content = "<h2>Your account has been created !</h2><br><center><input type='button' id='regOK' value='Play Game' /></center>" ;
$('#info').css('height','200px');
$('#info').html(content);
clear();
});
}

$(document).ready(function(){
$('#regOK').live('click', function(){
$('#info').fadeOut('fast', function(){
$('#login').fadeIn('slow');
});
});
});
// end of function to register new user

// function to load game
function LoadGame(){
$(document).ready(function(){
$('#alert').fadeOut('fast',function(){
$('#info').fadeOut('fast',function(){
$('#loading').fadeIn('fast').delay(3500).effect("puff").fadeOut('fast', function(){
$('#questionframe').fadeIn('fast');
  LoadQuestions();
// THIS IS WHERE QUESTIONS ARE LOADED FROM DATABASE
});
});
});
});
}
///// END OF DISPLAY FUNCTIONS /////////////

// FUNCTION TO PERFORM LOGIN ////
$(document).ready(function(){
$('#signIn').click(function(){

var email = $('#Lemail').val();
var pass = $('#Lpass').val();

if(email == ''){
var error = "oops! you haven't entered your email" ;
$('#alert').html(error).fadeIn('fast').delay(1500).fadeOut('fast',function(){
$('#Lemail').focus();
});
exit();
}

if(pass == ''){
var error = "oops! you haven't entered your password" ;
$('#alert').html(error).fadeIn('fast').delay(1500).fadeOut('fast',function(){
$('#Lpass').focus();
});
exit();
}

$('#login').fadeTo(400, 0.5, function(){
$('#alert').html("<center><img src='img/loading2.gif'/></center>").fadeIn('fast');
$('#signIn').hide(); // hide button
});

// send to php script
$.ajax({
type: 'POST',
cache: false,
url: 'processor/login.php',
data: 'action=login' + '&email=' + email + '&pass=' + pass,
success: function(returnedData){
$('#alert').html(returnedData);
$('#alert').hide();
$('#login').fadeTo(400, 1, function(){
$('#signIn').show(); // hide button
eval(returnedData);
});
}
});
});
});

function LoginFalse(){
alert("wrong username or password");
$('#alert').hide();
}

function LoginTrue(){
$(document).ready(function(){
$('#Lemail').val('');
$('#Lpass').val('');
$('#login').effect("puff").fadeOut('fast',function(){
LoadGame();
});
});
}
// END OF FUNCTION TO PERFORM LOGIN ////
