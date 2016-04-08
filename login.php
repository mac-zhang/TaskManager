<!DOCTYPE html>

<?php
	require_once("tool/conn.php");
	require_once("tool/common.php");
	
if(options("login_check")){
//	login_check($_POST['Login_account'], $_POST['Login_password']);
//}

//if(isset($_POST['label'])&&$_POST['label'] == "login_check"){
	login_check($_POST['Login_account'], $_POST['Login_password']);
}

function login_check($login_account, $login_password){
//					echo $login_account."+".$login_password;
//					echo $_POST['login_check']."&&".$_POST['Login_account']."&&".$_POST['Login_password'];
					$person_info_sql = array(
							"person_info_for_check",
							$login_account,
							$login_password,
					);
					$person_info_data = array_sql($person_info_sql);
					
					if(count($person_info_data)==1){
						$_SESSION['login_account']		= $login_account;
						$_SESSION['login_password']		= $login_password;
						$_SESSION['login_office']		= $person_info_data[0]["Office"];
						$_SESSION['login_level']		= $person_info_data[0]["Level"];

						
						header("HTTP/1.0 200 OK");
						return true;
					}else{
						header("HTTP/1.0 402 Unauthorized");
						return false;
					}
					
//	    			for($i=0;$i < count($person_info_data);$i++){
//	    				echo "
//	    				<tr><td>".$person_info_data[$i]["User_account"]."</td>
//	    					<td>".$person_info_data[$i]["Password"]."</td>
//	    					<td>".$person_info_data[$i]["Office"]."</td>
//	    				</tr>
//	    				";						
//	    			}
}
?>

<html lang="zh-CN" class="uk-height-1-1">
<head>
	<meta charset="utf-8" />
	<title>科室任务管理系统</title>
	<link rel="stylesheet" href="css/login.css"/>
	<link rel="shortcut icon" type="img/ico" href="img/logo_gree.ico"/>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/login.js"></script>
	</head>

<body>
    <div id="login_background">
    	<div class="login_frame">
    		<div class="logo_div">
	
    		</div>
    		<div class="login_title">
    			科室任务管理系统
    		</div>
    		<div class="login_input_div">
    			<p class="login_username_input">
    				<span class="user_ico_span">
    					<label class="user_ico_img"></label>
    				</span>
    				<span class="user_input_span">
    					<input  id="user_input" class="user_input" type="text" name="user_account" placeholder="用户名" autocomplete="off"/>
    				</span>
    			</p>
    			<p class="login_username_input">
    				<span class="user_ico_span">
    					<label class="password_ico_img"></label>
    				</span>
    				<span class="user_input_span">
    					<input id="password_input" class="user_input" type="password" name="password" placeholder="密码" autocomplete="off" onkeydown="login_keydown()"/>
    				</span>
    			</p>
    			<input id="login_button" class="login_button" type="button" name="login_button" value="登          录"/>			
    		</div>
    		
    		<div id='login_check'>
    				<table>
    			
    				<?php					
//    					echo $_POST['Login_account']."&&".$_POST['Login_password'];
//						login_check("130099", "xiaolizi");
//						login_check($_POST["Login_account"], $_POST["Login_password"]);
    				?>
    			
    				</table>
    		</div>   
    		
    			
    			
    	</div>
    </div>
</body>
</html>
