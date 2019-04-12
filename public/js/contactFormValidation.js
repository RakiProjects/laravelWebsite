
function checkContactForm(){

    var name = document.getElementById("name").value;
    var phone = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    var headline = document.getElementById("headline").value;
    var message = document.getElementById("message").value;

    var reg_name = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
    var reg_phone = /^[0-9\/\-\s]+$/;
    var reg_email=/^([a-z0-9_\.-]{3,50})@([a-z0-9]{2,20}.){1,5}[a-z]{2,8}$/;
    var reg_headline = /^[A-Za-z0-9\/\-\s]{3,}$/;

    var greske=0; 

    if(!reg_name.test(name)){
		document.getElementById("name").classList.add("is-invalid");  
		greske++;
	}else{
		document.getElementById("name").classList.remove("is-invalid");
    }

    if(!reg_phone.test(phone)){
		document.getElementById("phone").classList.add("is-invalid");  
		greske++;
	}else{
		document.getElementById("phone").classList.remove("is-invalid");
    }

    if(!reg_email.test(email)){
		document.getElementById("email").classList.add("is-invalid");  
		greske++;
	}else{
		document.getElementById("email").classList.remove("is-invalid");
    }

    if(!reg_headline.test(headline)){
		document.getElementById("headline").classList.add("is-invalid");  
		greske++;
	}else{
		document.getElementById("headline").classList.remove("is-invalid");
    }

    if(greske==0){
		return true;
	}else{
		return false;
	}
}