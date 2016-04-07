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
	
}
