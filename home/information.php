<?php if(session_id() == '') {
    session_start();
}
?>
<html language="en">
	<head>
		<?php 
			include_once("head.php"); 
			include_once('../backend/get_order_data.php');
		?>		
		<link href="information.css" rel="stylesheet">
		<script type="text/javascript">
			$(document).ready(function(){
				$("#instruction").hide();
				$("#total_money").html($("#subtotal").html());
				$(".response").hide();
				$(".gif").hide();
			});
		</script>
	</head>	

	<body>
		
		
		
		<div id="container">
			<center>
				<div id="logo_site"><a href="index.php"><img src="../img/logo/dd.png" width="39%"></a></div>
				<br>
				<div class="title1">Return & Exchange Policy</div>
				<br>
			</center>
			
			
			<div class="details">
				<p>BeyondPink Return and Exchange Policy offers you the option to return or exchange items purchased on BeyondPink within 30 days of the receipt. In case of returns, we will credit the amount you paid for the products as cash back into your BeyondPink cashback account.</p>
				<p>If you choose to exchange the item for reason of mismatch of size or receipt of a defective item, you will be provided with a replacement of the item, free of cost. However an exchange is subject to availability of the item in our stock.</p>
				<p>The following EXCEPTIONS and RULES apply to this Policy:</p>
				<p>
					<ol>
						<li>We do not accept return or exchange requests for free items.</li>
						<li>All items to be returned or exchanged must be unused and in their original condition with all original tags and packaging intact (for e.g. Shirts must be packed in the original box as well and returned), and should not be broken or tampered with.</li>
						<li>Only size exchanges are allowed. Items can be exchanged for a similar size or a different size.</li>
						<li>Exchanges are allowed only if your address is serviceable for an Exchange by our logistics team.</li>
						<li>In case you had purchased an item which had a free gift associated with it and you wish to return the item, please also return the free gift.</li>
						<li>If you choose to self-ship your returns, kindly pack the items securely to prevent any loss or damage during transit. For all self-shipped returns, we recommend you use a reliable courier service.</li>
						<li>Once your return is received by us, you will be reimbursed Rs 100/- towards shipping costs, if self-shipped. This is subject to your return having met the requirements of this Policy.</li>
					</ol>
				</p>
			</div>

			<hr>
			
		</div>

	</body>
</html>