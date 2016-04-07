$(function()
{
	login_callback();
})

function login_callback()
{
	$("#login_button").click(function(){
		var login_account	= $("#user_input").val();
		var login_password	= $("#password_input").val();
		
		if(login_account==""){
					alert("请输入用户名");
					return false;
				}
		if(login_password==""){
			alert("请输入密码");
			return false;
		}
		
//		$("#login_check").load("login.php", {"label": "login_check", "Login_account": login_account, "Login_password": login_password});
		$.ajax({
					url:"login.php",
					type:"POST",
					dataType:"html",
					async:false,
					data:{"label": "login_check", "Login_account": login_account, "Login_password": login_password},
					error: function(){
						alert("用户名或密码错误");
						return false;
					},
					success: function(){
//						alert("登录成功");
						addCookie("userName", login_account, 7, "/");
						addCookie("userPass", login_password, 7,"/");  
						location.assign('task.php');
//						if(checked){
//							location.assign('task.php');
//						}else{
//							location.assign(location);
//						}
					}
		});
		
		
//		alert(login_account+"\n密码："+login_password);
		
//		return location.assign('task.php');
	});
	
	
}

function login_keydown(){
	if(event.keyCode==13){
		document.getElementById("login_button").click();
	}
}

/* DESCRIPTION
 * 	Add cookie
 * ARGUMENTS
 * RETURN
 * NOTES
 */
function addCookie(name, value, days, path){    
    	var name 	= escape(name);  
    	var value 	= escape(value);  
    	var expires = new Date();  
    
    	expires.setTime(expires.getTime() + days * 3600000 * 24);  
      
    	path = path == "" ? "" : ";path=" + path;  
     
    	var _expires = (typeof days) == "string" ? "" : ";expires=" + expires.toUTCString();  
    	document.cookie = name + "=" + value + _expires + path;  
}  

/* DESCRIPTION
 * 	Get value from cookie
 * ARGUMENTS
 * RETURN
 * NOTES
 */
function getCookieValue(name){
	var name 	= escape(name);
	var allcookies 	= document.cookie;
	name += "=";
	var pos = allcookies.indexOf(name);
	if (pos != -1){                                             
	 	var start	= pos + name.length;                   
	 	var end 	= allcookies.indexOf(";",start);         
	 	if (end == -1) end = allcookies.length;          
		 	var value = allcookies.substring(start,end); 
	 	return (value);                              
	}else{    
	 	return "";  
	}  
}

// onlode
window.onload = function(){  
    	var userNameValue = getCookieValue("userName");  
    	document.getElementById("user_input").value = userNameValue;
    	var userPassValue = getCookieValue("userPass");  
    	document.getElementById("password_input").value = userPassValue;  
    	
    	document.onkeydown = function(event){
    		if(event.keyCode==13){
				document.getElementById("login_button").click();
			}
    	};
}  
