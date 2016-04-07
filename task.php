
<?php 
	include_once "tool/common.php";  
	include_once "load_task.php";
	
//if(options("login_exit")){
if(isset($_POST['label'])&&$_POST['label'] == "login_exit"){
	session_unset();
}
?>
<!DOCTYPE html>
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
			common_header();
	?>
	<div class="task_background">
		
		<div class="task_frame">
	<?php
			stuff_list();
	?>
			<div class='task_list_frame'>
	<?php
				task_search();
				
				task_list_title();

				task_list_content();
	?>			
				</div>
			</div>
		</div>
	</div>
</body>
</html>