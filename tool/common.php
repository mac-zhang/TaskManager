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

require_once("conn.php");
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
		$person_info_by_account = array(
			"person_info_by_account",
			$_SESSION['login_account'],
		);
		$login_person_data = array_sql($person_info_by_account);
	echo "
		<div class='header'>
			<div class='header_frame'>
				<div class='header_logo'>
					<a class='header_img_a'></a>
					<div class='header_logo_words'>
						<h3>珠海格力电器股份有限公司</h3>
						<h4>标准管理部</h4>
					</div>
				</div>
				<div class='gree_words'>
					<a class='gree_words_common'></a>
				</div>
				<div class='logined_name'>
					<table>
						<tr>
							<td><p>当前用户:</p></td>
							<td><h4>".$login_person_data[0]['User_name']."</h4></td>
							<td><input id='login_exit' class='login_exit' type='button' value='退 出'/></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	";
}

?>
