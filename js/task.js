$(function()
{
	task_callback();
})

function task_callback(){
	$("#login_exit").click(function(){
		$.ajax({
					url:"task.php",
					type:"POST",
					dataType:"html",
					async:false,
					data:{"label": "login_exit"},
					error: function(xhr, data, error){
						alert(error);
					},
					success: function(){
						location.assign('login.php');
					}
		});
	});
	
	$("#search_all").click(function(){
		$("#task_list_content_div").load("load_task.php", {"label": "search_all"});
	});
	
}

function stuff_name_click(obj){
	var stuff_id = obj.id;
//	alert(obj.id);
//	$.ajax({
//					url:"task.php",
//					type:"POST",
//					dataType:"html",
//					async:false,
//					data:{"label": "stuff_click","stuff_id":stuff_id},
//					error: function(xhr, data, error){
//						alert(error);
//					},
//					success: function(){
////						alert("Yes");
//					}
//		});
	$("#task_list_content_div").load("load_task.php", {"label": "stuff_click","stuff_id":stuff_id});
}
