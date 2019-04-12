
function checkRegister(){
    var username = document.getElementById('username').value;
    var email = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    var repass = document.getElementById("passwordConfirm").value;

    var reg_user=/^[\w\s\/\.\_\d]{4,20}$/;
   	var reg_email=/^[\w\.]+[\d]*@[\w]+\.\w{2,3}(\.[\w]{2})?$/;
    var reg_pass=/^[\w\s\/\.\_\d]{4,}$/;
    
    var greske=0; 

    if(!reg_user.test(username)){
		document.getElementById("username").style.border = "3px solid #a94442";
		greske++;
	}else{
		document.getElementById("username").style.border = "none";
    }

    if(!reg_email.test(email)){
		document.getElementById("email").style.border = "3px solid #a94442";
		greske++;
	}else{
		document.getElementById("email").style.border = "none";
    }
    
    if(!reg_pass.test(pass)) {
		document.getElementById("password").style.border = "3px solid #a94442";
		greske++;
	}else{
		document.getElementById("password").style.border = "none";
    }
    
    if(reg_pass.test(repass) && pass==repass){
		document.getElementById("passwordConfirm").style.border = "none";
	}else{
		document.getElementById("passwordConfirm").style.border = "3px solid #a94442";
		greske++;
    }
    if(greske==0){
		return true;
	}else{
		return false;
	}
}

function checkLogin(){
    var username = document.getElementById('username1').value;
    var pass = document.getElementById("password1").value;

    var reg_user=/^[\w\s\/\.\_\d]{4,20}$/;
    var reg_pass=/^[\w\s\/\.\_\d]{4,}$/;

    var greske=0; 

    if(!reg_user.test(username)){
		document.getElementById("username1").style.border = "3px solid #a94442";
		greske++;
	}else{
		document.getElementById("username1").style.border = "none";
    }

    if(!reg_pass.test(pass)) {
		document.getElementById("password1").style.border = "3px solid #a94442";
		greske++;
	}else{
		document.getElementById("password1").style.border = "none";
    }
    if(greske==0){
		return true;
	}else{
		return false;
	}
}
