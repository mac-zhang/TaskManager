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
//						addCookie("userName", login_account, 7, "/");
//						addCookie("userPass", login_password, 7,"/");  
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
