function checkUsername() {
	var reg = /[0-9a-zA-Z._\-]{3,15}/;
    if (reg.test(username.value) != true) {
    	document.getElementById('usernameWarn1').style.display='inline';
	}
	else{
		document.getElementById('usernameWarn1').style.display='none';
		document.getElementById('usernameWarn2').style.display='inline';
	}
}

function checkPassword() {
	var reg = /.{6,20}/;
    if (reg.test(password.value) != true) {
    	document.getElementById('passwordWarn1').style.display='inline';
	}
	else{
		document.getElementById('passwordWarn1').style.display='none';
		document.getElementById('passwordWarn2').style.display='inline';
	}
}



function checkemail() {
	var reg = /[0-9a-zA-Z._\-]{1,20}@[0-9a-zA-Z._\-]{1,20}\.[0-9a-z]{2,6}/;
    if (reg.test(email.value) != true) {
    	document.getElementById('emailWarn1').style.display='inline';
	}
	else{
		document.getElementById('emailWarn1').style.display='none';
		document.getElementById('emailWarn2').style.display='inline';
	}
}

function checkAlias() {
	var reg = /.{6,20}/;
    if (reg.test(alias.value) != true) {
    	document.getElementById('aliasWarn1').style.display='inline';
	}
	else{ 
		document.getElementById('aliasWarn1').style.display='none';
		document.getElementById('aliasWarn2').style.display='inline';
	}
}

function checkPasswordAgain(txt) {
	var tip = document.getElementById('checkPasswordTip');
	var psw = document.getElementById('password').value;
	if(txt.value==psw) {
		tip.innerHTML="密码正确";
		return true;
	}
	else{
		tip.innerHTML="两次输入的密码不相同";
		return false;
	}
}
