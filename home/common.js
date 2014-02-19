/* HTTP Request */

function createRequest() {
  try {
    request = new XMLHttpRequest();
  } catch (tryMS) {
    try {
      request = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (otherMS) {
      try {
        request = new ActiveXObject("Microsoft.XMLHTTP");
      } catch (failed) {
        request = null;
      }
    }
  }
  return request;
}

/* --------HTTP Request----- */

/* footer.php */



/* ---------footer.php--------- */

function moneyString(money){
				var money_len = money.length;
				if(money_len<=3){
					return money;
				}
				else if(money_len==4) {
					return (money.substr(0,1)+","+money.substr(1));
				}
				else{
					return (money.substr(0,2)+","+money.substr(2));
				}
}

function GetUrlValue(VarSearch){
    var SearchString = window.location.search.substring(1);
    var VariableArray = SearchString.split('&');
    for(var i = 0; i < VariableArray.length; i++){
        var KeyValuePair = VariableArray[i].split('=');
        if(KeyValuePair[0] == VarSearch){
            return KeyValuePair[1];
        }
    }
}

function addParameterToURL(param){
    _url = location.href;
    _url += (_url.split('?')[1] ? '&':'?') + param;
    return _url;
}


function bindSearchEvent(){
$('#search').bind("enterKey",function(e){
	//alert(1)
	var q = $("#search").children('input').val();
   //window.location.href = "http://"+localhost/bpink_final/dir/bp/bpink/home/search.php?q="+q;
   var temp1 = (window.location.pathname).split("/");
   temp1 = temp1.slice(0,temp1.length-1);
   temp = temp1.join("/");
   window.location.href = "http://"+window.location.hostname+""+temp+"/search.php?q="+q;
});
$('#search').keyup(function(e){
    if(e.keyCode == 13)
    {
        $(this).trigger("enterKey");
    }
});
}

function addItemToFav(product_id){
		
	if(isLoggedin==1){
		
		if($("#heart_"+product_id+" > img").attr('src')=='../layout/heart.png'){
			$("#heart_"+product_id+" > img").attr('src','../layout/ajax_loader.gif')
			
			$.ajax({
				type:"POST",
				url:"session.php",
				data:"item_like_id="+product_id,
				success:function(json){				
					var json_arr = JSON.parse(json);
					if(json_arr.success==1){
						$("#heart_"+product_id+" > img").attr('src','../layout/heart_gray.png');
						$("#countlike_"+product_id).text(parseInt($("#countlike_"+product_id).text())+1);
					}
					else{
						$("#heart_"+product_id+" > img").attr('src','../layout/heart.png');
					}
				}
			});
		}
		else if($("#heart_"+product_id+" > img").attr('src')=='../layout/heart_gray.png'){
			$("#heart_"+product_id+" > img").attr('src','../layout/ajax_loader.gif')
			$.ajax({
				type:"POST",
				url:"session.php",
				data:"item_dislike_id="+product_id,
				success:function(json){				
					var json_arr = JSON.parse(json);
					if(json_arr.success==1){
						$("#heart_"+product_id+" > img").attr('src','../layout/heart.png');
						$("#countlike_"+product_id).text(parseInt($("#countlike_"+product_id).text())-1);
					}
					else{
						$("#heart_"+product_id+" > img").attr('src','../layout/heart_gray.png');
					}
				}
			});
		}
		
	}

	else{
		$('#login_box').modal('show');
		//alert(2);
	}
}

function settings_dropdown(){
	$("#settings_drop").css("visibility","visible");
	$("#settings_drop").hide();
	$("#settings_drop").slideDown();
	
}