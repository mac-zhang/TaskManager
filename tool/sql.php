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
		
	"person_info_for_check"=>array(
		"SELECT * FROM person_info where User_account = '%s' && Password = '%s'",
		2,
		"user_account",
		"user_password",
	),
	
	"person_info_by_account"=>array(
		"SELECT * FROM person_info where User_account = '%s'",
		1,
		"user_account",
	),
	
	"stuff_name_by_office"=>array(
		"SELECT * FROM person_info where Office = '%s' Order By Level ASC",
		1,
		"user_office",
	),
	
	"task_info_by_stuff_id"=>array(
		"SELECT * FROM `task_info` WHERE Stuff_id = '%s' Order By ID ASC",
		1,
		"stuff_id",
	),
	
	"task_info_search_all"=>array(
		"SELECT * FROM `task_info` Order By ID DESC",
		0,
	),
);
?>
