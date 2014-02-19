// Individual cart element

<div class="cart_item">
	<div class="cart_image">
		<img src ="../img/large/BeyondPink_1006_image6.jpg">
		
	</div>
	<div class="cart_price">
		Rs. <span>1,200</span>
	</div>	
	<div class="cart_specs">
		size S | quantity 4
	</div>
	<div class="cart_edit cursor">
		EDIT
	</div>	
</div>

// =>    '<div class="cart_item"><div class="cart_image"><img src ="../img/large/BeyondPink_1006_image6.jpg"></div><div class="cart_price">Rs. <span>1,200</span></div><div class="cart_specs">size S | quantity 4</div><div class="cart_edit cursor">EDIT</div></div>'

/*---------------------------------------------------------------------------------------------------------------------------------*/

// Layer element

	<div class="layer">
	
		<div class="cart_edit_hover1">
		</div>
	
		<div class="cart_edit_hover2">
			<div class="cart_edit_option">
				<div>
					<select id="select_size">
						<option selected="true" style="display:none;">Select size</option>
						<option>S</option>
						<option>M</option>
						<option>L</option>
						<option>X</option>
					</select>	
				</div>
				<div>
					<select id="select_qty">
						<option selected="true" style="display:none;">Select quantity</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					</select>	
				</div>
				<div class="buttons">
					<div class="hover_button1 cursor" > Done
					</div>
					<div class="hover_button2 cursor" > Cancel
					</div>
				</div>	
			</div>
		
		</div>
</div>