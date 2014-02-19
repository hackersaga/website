<div id="footer">
	<div id="footer_menu">
		<ul>
			<li><a onclick="userlogin1()" class="cursor" data-toggle="modal">MY ACCOUNT</a></li>
			<li><a href="information.php">INFORMATION</a></li>
			<li><a href="#">CUSTOMER SERVICE</a></li>
			<li><a href="#">EXTRAS</a></li>
		</ul>	
	</div>	
	<div id="copyright">
		Beyond Pink | Unique Women Clothing &copy 2013.
	</div>	
</div>

<script type="text/javascript">	
	var isLoggedin = 
	<?php if(isset($_SESSION['email'])){
			echo "1";
		}
		else{
			echo "0";
		}	
	?> ;

</script>