<?php
	include_once "tool/common.php";  

if(options("stuff_click")){
	stuff_name_click_show($_POST['stuff_id']);
}else if(options("search_all")){
	task_search_all();
}	
/*
 * 显示用户所在科室人员列表
 */
function stuff_list(){
	
	echo"
		<div class='stuff_frame'>
			<div class='stuff_office'>
				<h4>".$_SESSION['login_office']."</h4>
			</div>
			<div class='stuff_name_list'>
				<ul>";
			$stuff_name_cgi = array(
				"stuff_name_by_office",
				$_SESSION['login_office'],
			);
			
			$stuff_name_data = array_sql($stuff_name_cgi);
			
			for($i=0; $i< count($stuff_name_data);$i++){
				$stuff_name = $stuff_name_data[$i]["User_account"];
				echo"
					<li id='$stuff_name' onclick=\"stuff_name_click(this)\">
						<h6 class='stuff_name'>".$stuff_name_data[$i]["User_name"]."</h6>
					</li>
				";				
			}
	echo"		</ul>
			</div>
		</div>
	";
	
}

/*
 * 显示查询按钮和搜索框
 */
function task_search(){
	echo"
	<div class='task_search_frame'>
		<div class='task_search_button_div'>
			<table class='task_search_table'>
				<tr>
					<td id='search_all' class='task_search_button' title='点击查看全部任务'>全    部</td>
					<td id='search_weak' class='task_search_button' title='点击查看近一周任务'>近一周</td>
					<td id='search_month' class='task_search_button' title='点击查看近一月任务'>近一月</td>
				</tr>
			</table>
		</div>
		<div class='task_search_bord'>
			<div  class='task_search_input_div'>
				<input id='task_search_input' type='text' placeholder='任务、责任人'/>
			</div>
			<div id='task_search_button'>
				搜  索
			</div>			
		</div>
		<div class='task_add_div'>
				<a class='task_add_icon'></a>
				<a class='task_add_button'>新增任务</a>
		</div>
	</div>
	";
	
}

/*
 * 人员列表点击响应
 */
function stuff_name_click_show($stuff_id){
		$task_content_cgi = array(
					"task_info_by_stuff_id",
					$stuff_id,
				);
			
		$task_content_data = array_sql($task_content_cgi);
		
		task_list_content($task_content_data);
}

/*
 * 显示全部任务内容
 */
function task_search_all(){
		$task_search_all_cgi = array(
					"task_info_search_all",
				);
			
		$task_content_all_data = array_sql($task_search_all_cgi);
		
		task_list_content($task_content_all_data);
}

/*
 * 根据输入条件显示对应任务内容
 */
function task_list_content($task_content_data){
		
		echo"
			<div id='task_list_content_div' class='task_info_title_div'>
				<table id='task_info_title_table'>
					<tr>
						<th class='task_number'>任务号</th>
						<th class='task_name'>任务名称</th>
						<th class='project_name'>所属项目</th>
						<th class='task_manager'>责任人</th>
						<th class='task_status'>状态</th>
						<th class='task_progress'>进度</th>
						<th class='task_opereation'>操作</th>
						<th class='task_attachment'>附件</th>
					</tr>
			";
			

		for($i=0; $i< count($task_content_data);$i++){
	echo"
			<tr>
				<td class='task_number'>".$task_content_data[$i]["ID"]."</td>
				<td class='task_name'>".$task_content_data[$i]["Task_title"]."</td>
				<td class='project_name'>".$task_content_data[$i]["Project_name"]."</td>
				<td class='task_manager'>".$task_content_data[$i]["User_name"]."</td>
				<td class='task_status'>".$task_content_data[$i]["Task_Status"]."</td>
				<td class='task_progress'>/</td>";
				if($task_content_data[$i]["Task_Status"]=='进行'&&($task_content_data[$i]["Stuff_id"]==$_SESSION['login_account'] || $_SESSION['login_level']==0)){
	echo"			<td class='task_opereation task_modify'>更改</td>";
				}else{
	echo"			<td class='task_opereation task_no_modify'>不可更改</td>";
				}
	echo"			<td class='task_attachment'>无</td>
			</tr>
	";
		}
	echo"
			</table>
		</div>
	";
	
}


?>