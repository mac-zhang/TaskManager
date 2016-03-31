<?php
/*
 ******************************************************************************
 * Copyright (c) 2014 Chongqing MySHworks Technology Co., Ltd. 
 * All rights reserved.
 *
 * File		$RCSfile: common.php,v $
 * Author	$Author: zhaozuojun $
 * Version	$Revision: 1.4 $
 * Date		$Date: 2015/05/14 08:42:44 $
 * Description	
	Ajax.
****************************************************************************** 
*/
?>
<?php
session_start();

/* DESCRIPTION
 *	Check for label value in POST
 * ARGUMENTS
 *	$value	lable name
 * RETURN
 * NOTES 
 */
function options($value){
	if(isset($_POST['label'])&&$_POST['label'] == $value){
		return true;
	}else{
		return false;
	}
}

function common_header()
{
	echo "
		<div class='header_frame'>
			<div class='header_img'></div>
			<div class='logined_name'>
				<p>当前用户:</p>
				<h4>张蒙川</h4>
			</div>
		</div>
	";
}

?>
