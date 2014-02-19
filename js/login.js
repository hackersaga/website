function userlogin1(){
	if(isLoggedin=="0"){
		$('#login_box').modal('show');
	}
	else{
		window.location.href = "profile.php" ;
	}

}

function set_email(email){

}

function loadsignup(){
	$("#loginBodysignin").hide();
	$("#loginBodysignup").fadeIn();
	$("#login_title h3").text("Sign up");
}

function loadsignin(){
	$("#loginBodysignup").hide();
	$("#loginBodysignin").fadeIn();
	$("#login_title h3").text("Sign in");
}

function signin(){
	var inputUsername = $.trim($("#inputEmail").val());
	var inputPasswd = $.trim($("#inputPassword").val());
	if(inputUsername.length>0 && inputPasswd.length>0){
		$("#button_sign_in img").attr('src','../img/ajax_loader.gif');
		$("#signin_error").text("Processing...");
		$("#signin_error").css('color','gray');
		$.ajax({
			type:"POST",
			url:"../backend/login.php",
			async:false,
			data:"email="+inputUsername+"&passwd="+inputPasswd,
			success:function(json){
				var jobj = JSON.parse(json);
				$("#button_sign_in img").attr('src','../img/item/sign_in_button.png');
				if(jobj.success==1){
					$('#login_box').modal('hide');
					$('body').prepend('<div id="profile_header"><div id="profile_header1"><div class="profile_header"><a href="index.php">Home</a></div><div class="separator">&nbsp;</div><div class="profile_header" style="padding-right:6px;"><a href="profile.php">Profile</a></div><div class="profile_header_settings" ><div id="settings" style="display:inline-block"><img src="../img/item/settings.jpg" height="25" style="pointer:cursor;" onclick="settings_dropdown()"></div><div id="settings_drop"><center><div><a href="account.php">Account&nbsp;settings</a></div><div><a href="logout.php">Log out</a></div></center></div></div></div></div>');
					$("#profile_header1").hide();
					$("#profile_header1").slideDown();
					$("#signin_error").text("");
					isLoggedin = "1";
				}
				else{
					$("#signin_error").text(jobj.message).show();
					$("#signin_error").css('color','red');
				}
			}
		});
	}
	else{
		$("#signin_error").text('Please fill all fields.').show();
	}
}

function signup(){
	var inputfirstName = $.trim($("#sinputfirstName").val())
	var inputlastName = $.trim($("#sinputlastName").val())
	var inputEmail = $.trim($("#sinputEmail").val());
	var inputPasswd = $.trim($("#sinputPassword").val());
	var confirmPass = $.trim($("#sinputConfirmPassword").val());
	var gender = "Female";
	if($("#optionsRadios2").is(":checked")){
		gender = "Male";
	}
	if(inputPasswd.length>0 && inputEmail.length>0 && confirmPass.length>0 && inputfirstName.length>0 && inputlastName.length>0){
		if(inputPasswd==confirmPass){
			$("#button_sign_in img").attr('src','../img/ajax_loader.gif');
			$("#signin_error").text("Processing...");
			$("#signin_error").css('color','gray');
			$.ajax({
				type:"POST",
				url : "../backend/register.php",
				async:false,
				data: "fname="+inputfirstName+"&lname="+inputlastName+"&gender="+gender+"&email="+inputEmail+"&passwd="+inputPasswd,
				success:function(json){
					var response = JSON.parse(json);
					$("#button_sign_in img").attr('src','../img/item/sign_up_button.png');
					if(response['success']==1){
						$('#login_box').modal('hide');
						$('body').prepend('<div id="profile_header"><div id="profile_header1"><div class="profile_header"><a href="index.php">Home</a></div><div class="separator">&nbsp;</div><div class="profile_header" style="padding-right:6px;"><a href="profile.php">Profile</a></div><div class="profile_header_settings" ><div id="settings" style="display:inline-block"><img src="../img/item/settings.jpg" height="25" style="pointer:cursor;" onclick="settings_dropdown()"></div><div id="settings_drop"><center><div><a href="account.php">Account&nbsp;settings</a></div><div><a href="logout.php">Log out</a></div></center></div></div></div></div>');
						$("#profile_header1").hide();
						$("#profile_header1").slideDown();
						isLoggedin = "1";
						$("#signin_error").text("");
					}
					else{
						$("#signup_error").text(response.message).show();
						$("#signin_error").css('color','red');
					}
				}
			});   
	}
	else{
		  $("#signup_error").text('Password doesn`t match!');
	}
}
else{
  $("#signup_error").text('Please fill all fields.');
}



}