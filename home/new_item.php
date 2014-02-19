<?php

function add($img_name){

	$output =  '<div id="img1" class="item">
						<div>
							<img src="../img/small/'.$img_name.'" class="img">
						</div>	
						<div class="title">
							<img src="../layout/heart.png"/>
						</div>
						<hr>
						<div class="description">
							<div class="colors">
								<div class="circle" style="background-color:#F26836"></div>
								<div class="circle" style="background-color:#95948F"></div>
								<div class="circle" style="background-color:#F86FED"></div>
								<div class="circle" style="background-color:#E4E13F"></div>
							</div>
						</div>	
					</div>';

	

	echo $output;			

}

?>