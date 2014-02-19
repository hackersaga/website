<!DOCTYPE html>
<html lang="en">
<head>

	<link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet">
	

</head>
<body>
	<div>
		<h4>Welcome&nbsp;<span id="username">Guest</span></h4>
	</div>
	<a href="#login_box" id="signin" role="button" class="btn" data-toggle="modal">Sign in</a>
	

	<!--Body Sign-in / Sign-up-->
	<div id="login_box" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<!-- header of the login box -->
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<div id="login_title"><h3 class="login_form">Sign in</h3></div>
		</div>
		<!-- Body of the login box -->
		<div id="loginBody" class="modal-body form-horizontal">
			<div id="inputForm">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Email</label>
					<div class="controls">
						<input type="email" name="email" id="inputEmail" placeholder="Email address"  autocomplete="on">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="inputPassword">Password</label>
					<div class="controls">
						<input type="password" name="passwd" id="inputPassword" placeholder="Password" >
						
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox"> Remember me
					</label>
				</div>
			</div>
		</div>
		<!-- footer element of the login box-->
		<div class="modal-footer">
			<button type="submit" id="button_sign_in" class="btn btn-primary btn-large" onclick="userLogin()">Sign in</a>
				<button type="submit" id="button_sign_up" class="btn btn-primary btn-large" onclick="userRegister()">Sign up</a>
				</div>

			</div>
			<!-- login body ends here -->
			
			<!-- Mentioning javascript files. Added at the bottom of the page so that the page is loaded fast.-->
			<script type="text/javascript" src="../js/jquery.js"></script>		
			<script type="text/javascript" src="../js/common.js"> </script>
			<script type="text/javascript" src="../js/login.js"></script>
			<script type="text/javascript" src="../js/bootstrap.js"></script>

</body>
</html>
