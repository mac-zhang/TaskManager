<!DOCTYPE html>

<?php 
	include_once "load_task.php";
			
if(options("login_exit")){
	session_unset();
}

?>

<html lang="zh-CN" class="uk-height-1-1">
<head>
	<meta charset="utf-8" />
	<title>科室任务管理系统</title>
	<link rel="stylesheet" href="css/common.css"/>
	<link rel="stylesheet" href="css/task.css"/>
	<link rel="shortcut icon" type="img/ico" href="img/logo_gree.ico"/>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/task.js"></script>
	</head>

<body>

	<?php
			// 显示头部
			common_header();
	?>
	<div class="task_background">
		
		<div class="task_frame">
	<?php
			// 显示用户所在科室人员列表
			stuff_list();
	?>
			<div class='task_list_frame'>
	<?php
				// 显示查询按钮和搜索框
				task_search();
				
				// 登录后的默认页面显示
				// 如果登录权限=0，则显示全部内容，否则只显示对应登录名的内容
				if($_SESSION['login_level']==0){
					task_search_all();
				}else{				
					$task_content_default_cgi = array(
						"task_info_by_stuff_id",
						$_SESSION['login_account'],
					);
				
					$task_content_default_data = array_sql($task_content_default_cgi);
					
					task_list_content($task_content_default_data);
				}
	?>			
				</div>
			</div>
		</div>
	</div>
</body>
</html>