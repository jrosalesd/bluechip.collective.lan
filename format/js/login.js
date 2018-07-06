function Access(){
	var user = document.getElementById('username');
	var pass = document.getElementById('password');
	var role = document.getElementById('role');
	
	var coruser = user.value;
	var corpass = "Honduras2017";
	var selRole;
	
	if  (role.value == "Relationship Manager"){
		selRole ="cs";
	}else if (role.value == "Collection Manager"){
		selRole ="col";
	}else if (role.value == "Special Team"){
		selRole ="special_team";
	}else if (role.value == "Supervisor"){
		selRole ="supervisor";
	}else{
		selRole ="";
	}
	
	if(user.value == coruser){
		
		if(pass.value == corpass){
			
			document.write("<iframe frameborder= '0' scrolling='Auto' width='100%' height='98%' src='http://zest.collective.lan/Zest/"+ selRole +"/"+coruser+"/home.htm'" + "/>");
		}else{
			window.alert("Incorrect Username or Password");
			
	}
	}else{
		window.alert("Incorrect Username or Password");
	}
}