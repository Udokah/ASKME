
//// POST.PHP // FUNCTION TO ADD QUESTION TO DATABASE //
$(document).ready(function(){
$('#add').click(function () {

var question = $('#question').val() ;
// get answer from checkboxes
var ans1 = $('#ans1').val() ;
var ans2 = $('#ans2').val() ;
var ans3 = $('#ans3').val() ;
var ans4 = $('#ans4').val() ;
var time = $('#time').val() ;

var opt1 = document.getElementById('opt1').checked ;
var opt2 = document.getElementById('opt2').checked ;
var opt3 = document.getElementById('opt3').checked ;
var opt4 = document.getElementById('opt4').checked ;

// check if question is set
if(question == ''){
alert("enter the question");
exit();
}

// check for empty option boxes
if(ans1 == '' || ans2 == '' || ans3 == ''|| ans4 == ''){
alert("some options are empty");
exit();
}

// check if some options are the same
if(ans1 == ans2 || ans3 == ans4 || ans1 == ans3 || ans1 == ans4 || ans2 == ans3 || ans2 == ans4){
alert("some options are the same");
exit();
}

// check if no answer was selected
if(opt1 != 1 && opt2 != 1 && opt3 != 1 && opt4 != 1){
alert("You must select the correct answer");
exit();
}


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
// send to PHP
$.ajax({
			type: "POST",
			cache: false,
			url: "engine/addquestion.php",
			data: "&question="+ question + "&ans1="+ ans1 + "&ans2="+ ans2 + "&ans3=" + ans3 + "&ans4=" + ans4 + "&ans4=" + ans4 + "&answer=" + answer,
			success: function(data){
				eval(data) ;
			}
		});
});
});

function AddSuccess(){
document.form.reset();
$('#alert').html("Question has been added")
}

function AddError(error){
alert(error);
}
//// END OF POST.PHP // FUNCTION TO ADD QUESTION TO DATABASE //

//// FUNCTIONS FOR VIEW.PHP //////////////////
//function to delete questions
function delQ(qid){
var verify = confirm("sure ?");
 if(verify == true){   
            $.ajax({
			type: "POST",
			cache: false,
			url: "engine/deletequestion.php",
			data: "questionID=" + qid + "&action=remove_question",
			success: function(){
				$('#' + qid).fadeOut('slow',function(){
				$(this).remove();
				});
			    }
		        });
        }
}

// function to search for questions
$(document).ready(function(){
$('#findQ').click(function () {
var q = $('#Qbox').val();

if(q == ''){
alert("enter the question to search for");
exit();
}

var load = "<tr><td colspan=5 align=center><img src='../img/loading2.gif' /></td></tr>";
$('#spread').html(load);

$.ajax({
			type: "POST",
			cache: false,
			url: "engine/findquestion.php",
			data: "q=" + q,
			success: function(data){
				$('#spread').html(data);
			}
		});

});
});
//// END OF FUNCTIONS FOR VIEW.PHP //////////////////

///// FUNCTIONS FOR SMS AND EMAIL SMS.PHP //////////
// function to send sms to all users
$(document).ready(function(){
$('#sendsms').click(function () {
var textmsg = $('#smsText').val();
var phone = $('#PhoneNumbers').val();
var sendtoall = $('#sendtoall').val();
if(textmsg == ''){
alert("write text message");
$('#smsText').focus();
exit();
}
if(phone == ''){
alert("enter at least one phone number");
$('#PhoneNumbers').focus();
exit();
}

$('#sendsms').hide(); // hide button to prevent double clicking
$('#loading').fadeIn('slow');
// send to php
$.ajax({
			type: "POST",
			cache: false,
			url: "engine/mailer.php",
			data: "action=sms" + "&textmsg=" + textmsg + "&phone=" + phone + "&toall=" + sendtoall,
			success: function(data){
				$('#loading').fadeOut('slow', function(){
				$('#smsText').val('');
				$('#PhoneNumbers').val('');
				$('#sendtoall').show();
				alert('message sent');
				$('#sendsms').show(); // hide button to prevent double clicking
				});
			}
		});


});
});

//function for sending email
$(document).ready(function(){
$('#sendMail').click(function () {
var subject = $('#subject').val();
var message = $('#message').val();

if(subject == ''){
alert("Write Subject");
$('#subject').focus();
exit();
}

if(message == ''){
alert("message field is empty");
$('#message').focus();
exit();
}

$('#sendMail').hide(); // hide button to prevent double clicking

// show loading while message is sent
                $('#loading').fadeIn('fast');
// send to php
$.ajax({
			type: "POST",
			cache: false,
			url: "engine/mailer.php",
			data: "action=email" + "&subject=" + subject + "&message=" + message,
			success: function(data){
			    $('#loading').fadeOut('slow', function(){
				$('#subject').val('');
                $('#message').val('');
				$('#sendMail').show();
				alert(data);
				});
			}
		});
});
});
///// END OF FUNCTIONS FOR SMS AND EMAIL SMS.PHP //////////

//// FUNCTION TO CHANGE USERNAME AND PSWD SETTINGS.PHP ////
// function to hide and show username tab
$(document).ready(function(){
$('#usernameTog').click(function () {
$('#usernameTab').slideToggle('slow');
});

$('#pswdTog').click(function () {
$('#pswdTab').slideToggle('slow');
});
});

// function to change username
$(document).ready(function(){
$('#savename').click(function () {
var newname = $('#uname').val();
var pass = $('#unamepass').val();

if(newname == ''){
alert('enter new username');
$('#uname').focus();
exit();
}

if(pass == ''){
alert('enter password to save');
$('#unamepass').focus();
exit();
}

$('#savename').hide(); // hide button to prevent double clicking
$.ajax({
			type: "POST",
			cache: false,
			url: "engine/security.php",
			data: "action=username" + "&newname=" + newname + "&password=" + pass,
			success: function(data){
			$('#unamepass').val('');
			$('#uname').val('');
			alert(data);
			$('#savename').show();
			}
			});
});
});

// function to change password
$(document).ready(function(){
$('#savepass').click(function () {

var oldpass = $('#oldpass').val();
var newpass1 = $('#newpass1').val();
var newpass2 = $('#newpass2').val();

if(oldpass == '' || newpass1 == '' || newpass2 == ''){
alert("some fields are empty");
exit();
}

if(newpass1 != newpass2){
alert("new passwords do not match");
$('#newpass1').focus();
exit();
}

$('#savepass').hide(); // hide button to prevent double clicking

$.ajax({
			type: "POST",
			cache: false,
			url: "engine/security.php",
			data: "action=password" + "&oldpass=" + oldpass + "&newpass=" + newpass2,
			success: function(data){
			$('#oldpass').val('');
			$('#newpass1').val('');
			$('#newpass2').val('');
			alert(data);
			$('#savepass').show();
			}
			});

});
});
//// END FUNCTION TO CHANGE USERNAME AND PSWD SETTINGS.PHP ////

//// FUNCTION TO PROCESS LOGIN LOGIN.PHP///
$(document).ready(function(){
$('#loginbutton').click(function (){

var username = $('#username').val();
var password = $('#password').val();

if(username == ''){
$('#error').html("username field is empty !");
$('#username').focus();
exit();
}

if(password == ''){
$('#error').html("password field is empty !");
$('#password').focus();
exit();
}

$('#loginbutton').hide(); // hide button to prevent double clicking
$('#error').html("authenticating....");

$.ajax({
			type: "POST",
			cache: false,
			url: "engine/login.php",
			data: "action=login" + "&username=" + username + "&password=" + password,
			success: function(data){
			eval(data);
			}
			});

});
});

// Login is successful
function LoginTrue(){
$(document).ready(function(){
$('#error').html("Login successful..");
document.getElementById("LoginMainForm").submit();
});
}

// login is false
function LoginFalse(){
$(document).ready(function(){
$('#loginbutton').show();
$('#error').html("wrong username or password");
});
}
//// FUNCTION TO PROCESS LOGIN LOGIN.PHP///


//// FUNCTION FOR PLAYERS.PHP ////
// Function to delete player
//function to delete questions
function delAcc(pid){
var verify = confirm("sure ?");
if(verify == true){   
$.ajax({
			type: "POST",
			cache: false,
			url: "engine/deleteaccount.php",
			data: "UID=" + pid + "&action=delete_account",
			success: function(){
				$('#' + pid).fadeOut('slow',function(){
				$(this).remove();
				});
			}
		});
}
}

//// function to search for user
$(document).ready(function(){
$('#playerbutton').click(function () {
var q = $('#searchPlayer').val();

if(q == ''){
alert("enter the account name to search for");
exit();
}

var load = "<tr><td colspan=5 align=center><img src='../img/loading2.gif' /></td></tr>";
$('#spread').html(load);

$.ajax({
			type: "POST",
			cache: false,
			url: "engine/finduser.php",
			data: "q=" + q,
			success: function(data){
				$('#playerlist').html(data);
			}
		});

});
});

//// END OF FUNCTION FOR PLAYERS.PHP ////

///// FUNCTION FOR PROFILE.PHP///////
//// function to hide and show password option
$(document).ready(function(){
$('#changepass').click(function () {
$('#passbox').slideToggle('fast',function (){
$('#savepassedit').slideToggle('fast');
});
});
});

// function to save name,phone and email edits
$(document).ready(function(){
$('#savedits').click(function(){
var name = $('#editname').val();
var phone = $('#editphone').val();
var email = $('#editemail').val();
var uid = $('#userid').val();

if(name == '' || phone == '' || email == ''){
alert("some fields are empty");
exit();
}
            $.ajax({
			type: "POST",
			cache: false,
			url: "engine/profileEdit.php",
			data: "action=savedits" + "&id=" + uid + "&name=" + name + "&email=" + email + "&phone=" + phone,
			success: function(data){
			alert(data);
			}
		    });
});
});

// Function to change password
$(document).ready(function(){
$('#savepassedit').click(function(){

var pass = $('#passbox').val();
var uid = $('#userid').val();

if(pass == ''){
alert("enter new password");
$('#passbox').focus()
exit();
}

            $.ajax({
			type: "POST",
			cache: false,
			url: "engine/profileEdit.php",
			data: "action=savepass" + "&id=" + uid + "&pass=" + pass,
			success: function(data){
			alert(data);
			}
		    });

});
});
///// FUNCTION FOR PROFILE.PHP///////

//// FUNCTION FOR WINNINGS.PHP ///////
// functions to search for winnings
$(document).ready(function(){
$('#winnerbut').click(function () {
var q = $('#winnername').val();

if(q == ''){
alert("enter the name of the winner");
exit();
}

var load = "<tr><td colspan=6 align=center><img src='../img/loading2.gif' /></td></tr>";
$('#winspread').html(load);

$.ajax({
			type: "POST",
			cache: false,
			url: "engine/findwinner.php",
			data: "q=" + q,
			success: function(data){
				$('#winspread').html(data);
			}
		});

});
});

//// function to pay winner
function Pay(gid){
var verify = confirm("sure ?");
if(verify == true){   
$.ajax({
			type: "POST",
			cache: false,
			url: "engine/paywinner.php",
			data: "GID=" + gid + "&action=paywinner",
			success: function(data){
				$('#stat').html(data);
			}
		});
}
}

//// END OF FUNCTION FOR WINNINGS.PHP ///////