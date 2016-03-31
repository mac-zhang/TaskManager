<?php
/*
 ******************************************************************************
 * Copyright (c) 2014 Chongqing MySHworks Technology Co., Ltd. 
 * All rights reserved.
 *
 * File		$RCSfile: sql.php,v $
 * Author	$Author: zhouchenglin $
 * Version	$Revision: 1.22 $
 * Date		$Date: 2015/06/02 04:02:00 $
 * Description	
	Mysql connect.
****************************************************************************** 
*/
?>

<?php
return array(
/*************************************** Login SQL *************************************************/
		
	"person_info_by_account"=>array(
		"SELECT * FROM person_info where User_account = '%s' && Password = '%s'",
		2,
		"user_account",
		"user_password",
	),
);
?>
