/*
var APIKEY = "e7f03adf030542b59677beaa9b11a5be";
var AUTHENTICATESERVICEKEY = "8c058ad29a157815bc745e5d06a92f46";
*/

var initiateLogin = function (){
	$.ajax({
		  type: "GET",
		  url: 'login',
		  success: function(result){
			  console.log(result);
			  resobj = jQuery.parseJSON(result);
			  window.location.replace(resobj.redirectUrl);
		  },
		  error: function(err){
			  console.log(err);
		  }
	});
};


$("#Login").on("click", initiateLogin);



var initiateLogout = function (){
	let redirecturl = $(this).data('redirecturl');
	$.ajax({
		  type: "GET",
		  url: 'apicallLogout.php?sessionId='+$(this).data('sessionid'),
		  success: function(result){
			  console.log(result);//{"sessionDeleted":1}
			  resobj = jQuery.parseJSON(result);
			  console.log(resobj);
			  window.location.replace(redirecturl+'?sessionDeleted='+resobj.sessionDeleted);
		  },
		  error: function(err){
			  console.log(err);
		  }
	});
};



$("#Logout").on("click", initiateLogout);



/*$.ajax({
  type: "POST",
  url: 'https://client.grandid.com/json1.1/FederatedLogin?apiKey='+APIKEY+'&authenticateServiceKey='+AUTHENTICATESERVICEKEY,
  data: {"callbackUrl":"https://ki.se"},
  success: function(result){
    console.log(result);}
});*/