function addItem(pid,pcolor,pname,plikes,pdescription){
	var str = '<div id="img1" class="item"><div><a href="item.php" onclick="set_session_elements('+pid+')"><div id="to_append_'+pid+'"></div></a></div><div class="color_like"><div class="colors"><div class="available_colors">';

	var arr = pcolor.split(",");
	for(var j1=0;j1<arr.length-1;j1++){
		str += '<div class="circle" style="background-color:'+arr[j1]+'"></div>&nbsp;';
	}
	str +=	'</div></div>';
	str+= '<div class="like"><div class="heart"><img src="../layout/heart.png"/></div><div>'+plikes+' People like this</div></div></div><div class="description">'+pdescription+'</div>	</div>';

	$('<img id="img_'+pid+'" src="../img/large/'+pname+'" class="img">').load(function(){
		var left_ht = $("#cat_left").height();
		var mid_ht = $("#cat_middle").height();
		var right_ht = $("#cat_right").height();
		if(left_ht<=mid_ht && left_ht<=right_ht){
			$(str).appendTo("#cat_left");
			$(this).appendTo("#to_append_"+pid).hide().fadeIn(560);
		}
		else if(mid_ht<=left_ht && mid_ht<=right_ht){
			$(str).appendTo("#cat_middle");
			$(this).appendTo("#to_append_"+pid).hide().fadeIn(560);
		}
		else{
			$(str).appendTo("#cat_right");
			$(this).appendTo("#to_append_"+pid).hide().fadeIn(560);
		}
		
	});
	
}

function loadItems(nextX,total){
	for(i;i<total && i<nextX;i++){
		addItem(data.data[i]['pid'],data.data[i]['color'],data.data[i]['pname'],data.data[i]['likes'],data.data[i]['description']);

	if(i>=n){
		$("#loadmoreitems").addClass("disabled");
	}

	}
}


var data = JSON.parse(data1);
var n = 0;
if(data.success==1){
	 n = data.data.length;
	var i =0;
	loadItems(i+9,n);
	
}

function more(){
		loadItems(i+9,n);
}