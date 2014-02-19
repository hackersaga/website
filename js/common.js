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

$('#search').bind("enterKey",function(e){
   alert(1);
});
$('#search').keyup(function(e){
    if(e.keyCode == 13)
    {
        $(this).trigger("enterKey");
    }
});