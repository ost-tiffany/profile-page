
// function validate() {
//   var x = document.forms["signupform"]["nickname"].value;
//   if (x == "") {
//   document.getElementById("error").innerHTML = "abs";
  
//   }
// //}
function validate() {
	document.getElementById("signupform").addEventListener("submit", function(event){
  		event.preventDefault();

  		var x = document.getElementById("nickname").value;

  		var regex = /^[a-zA-Z]+$/;


  		if (x == "" ) {
  			document.getElementById("error").innerHTML =  "please input your name";
  			return false;
  		}

  		if(regex.test(x) == false){
		  document.getElementById("error").innerHTML =  "format must be alphabet";
		  return false;
		} 
		else {
			return true;
  		}
	});
}


