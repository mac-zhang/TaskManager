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
		
		$("#login_check").load("/ajax", {"Func": "login_check", "login_account": login_account});
		
//		alert(login_account+"\n密码："+login_password);
		
//		return location.assign('task.php');
	});
}
