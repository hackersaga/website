<!DOCTYPE html>
<html lang="en">

<head>
	<link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
</head>

<body>
	<div class="row">
	<div class="account">
		<div class="left">
			
				<li><a href="#" class="btn-link">Personal Information</a></li>
				<li><a href="#" class="btn-link">Account Settings</a></li>
				<li><a href="#" class="btn-link">Address</a></li>
				<li><a href="#" class="btn-link">Favourites</a></li>
				<li><a href="#" class="btn-link">Order history</a></li>
				<li><a href="#" class="btn-link">Reward Points</a></li>
				<li><a href="#" class="btn-link">Notification</a></li>
			
		</div>
		<div id="profile_right" class="right">

			<div class="title">Personal Information</div>
			<hr>

				<div class="control-group">
					<label class="control-label" for="inputFirstname">First name</label>
					<div class="controls">
						<input type="text" name="firstname" id="inputFirstname" class="span4" placeholder="First name"  autocomplete="off">
					</div>
				</div>
				
				<div class="control-group">
					<label class="control-label" for="inputLastname">Last name</label>
					<div class="controls">
						<input type="text" name="lastname" id="inputLastname" class="span4" placeholder="Last name"  autocomplete="off">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputMobile">Mobile</label>
					<div class="controls">
						<input type="text" name="mobile" id="inputMobile" class="span4" placeholder="Mobile number"  autocomplete="off">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputMobile">Email</label>
					<div class="controls">
						<input type="text" name="email" id="inputMobile" class="span4" placeholder="My Email address"  autocomplete="off" disabled>
					</div>
				</div>

				<div class="footer">
					<button type="button" id="button_profile_save" class="btn btn-primary btn-large" onclick="">Save</a>
				</div>
				
		</div>
	</div>
	</div>			
	
	<script type="text/javascript" src="jquery.js"></script>		
	<script type="text/javascript" src="../js/common.js"> </script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>


</body>

</html>