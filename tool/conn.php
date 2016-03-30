<?php
/*
 ******************************************************************************
 * Copyright (c) 2014 Chongqing MySHworks Technology Co., Ltd. 
 * All rights reserved.
 *
 * File		$RCSfile: conn.php,v $
 * Author	$Author: zhaozuojun $
 * Version	$Revision: 1.3 $
 * Date		$Date: 2015/05/27 17:12:15 $
 * Description	
	Mysql connect.
****************************************************************************** 
*/
?>
<?php
/* DESCRIPTION
 * 	Connect MySQL.
 * ARGUMENTS
 *  $sql	Database query.
 * RETURN
 * 	Query result.
 * NOTES
 */
function conn($sql)
{
	// MySQL Config
	// 数据库配置信息
	$username = "root";
	$userpass = "root";
	$dbhost   = "localhost";
	$dbdatabase = "taskmanage";

	// $sql is an error message.
	// 在通过array_sql和operate_sql访问时，对应的错误处理
	if(is_array($sql)){
		return $sql;
	}
	// $sql is a query.
	// 参数为一个sql字符串
	$data = explode(" ", $sql);
	$firststr = trim($data[0]);
	// 判断是否为查询语句
	if((strcasecmp($firststr, "SELECT")==0)){
		// Create mysql connect
		$db_connect = mysql_connect($dbhost, $username, $userpass) or die("Unable to connect to the MySQL!");
		mysql_set_charset("utf8", $db_connect);
		mysql_select_db($dbdatabase, $db_connect);
		// Operate MySQL
		$query = mysql_query($sql);
		// Query falied.
		if(!$query){
			mysql_close($db_connect);
			$msg = array(
				array(
					"Error"=>"You have an error in your SQL syntax.",
					"Code"=>604,
				),
			);
			return $msg;
		}
		// Converted to a two-dimensional array.
		$result = array();
		while($row=mysql_fetch_array($query, MYSQL_ASSOC)){
			$result[] = $row;
		}
		# Close mysql connect.
		mysql_close($db_connect);
		return $result;	
	}else{
		// Create mysql connect
		$db_connect = mysql_connect($dbhost, $username, $userpass) or die("Unable to connect to the MySQL!");
		mysql_set_charset("utf8", $db_connect);
		mysql_select_db($dbdatabase, $db_connect);
		// Operate MySQL
		$query = mysql_query($sql);
		// Query falied.
		if($query){
			mysql_close($db_connect);
			$msg = array(
				array(
					"OK"=>"Operate sucess.",
					"Code"=>200,
				),
			);
			return $msg;
		}else{
			mysql_close($db_connect);
			$msg = array(
				array(
					"Error"=>"You have an error in your SQL syntax.",
					"Code"=>604,
				),
			);
			return $msg;
		}
	}
}

/* DESCRIPTION
 * 	Create SQL by array.
 * ARGUMENTS
 *  	$sqlstruct	SQL name and parameters.
 * RETURN
 * 	SQL.
 * NOTES
 */
function SQLname($sqlstruct)
{
	
	if(!is_array($sqlstruct)){
		$msg = array(
			array(
				"Error"=>"array_sql:Parameters must be array type.",
				"Code"=>600,
			),
		);
		return $msg;
	}
	$funcinfo = require("sql.php");	
	// Whether the SQL is existed.
	if(array_key_exists($sqlstruct[0],$funcinfo)){
		if($funcinfo[$sqlstruct[0]][1]==0){

			return $funcinfo[$sqlstruct[0]][0];

		// Whether the number of parameters is legal.
		}elseif((count($sqlstruct)-1)==$funcinfo[$sqlstruct[0]][1]){
			$sqlstr = $funcinfo[$sqlstruct[0]][0];
			array_shift($sqlstruct);
			// Format sql.
			$sqlstr = vsprintf($sqlstr, $sqlstruct);

			// 根据参数中给出的sql语句名字和参数，返回相应sql语句
			return $sqlstr;

		}else{
			$msg = array(
				array(
					"Error"=>"Inconsistent number of parameters.",
					"Code"=>601,
				),
			);
			return $msg;

		}
	}else{
		$msg = array(
			array(
				"Error"=>"Assigned the SQL statement does not exist.",
				"Code"=>602,
			),
		);
		return $msg;	
	}
}

/* DESCRIPTION
 * 	Create SQL by name.
 * ARGUMENTS
 *  	$sqlname	SQL name of sql.php.
 * RETURN
 * 	SQL.
 * NOTES
 */
function GETSQLname($sqlname)
{
	$funcinfo = require("sql.php");
	if(!array_key_exists($sqlname, $funcinfo)){
		$msg = array(
			array(
				"Error"=>"Assigned the SQL statement does not exist.",
				"Code"=>602,
			),
		);
		return $msg;	
	}
	if($funcinfo[$sqlname][1]==0){
		return $funcinfo[$sqlname][0];	
	}else{
		if((count($funcinfo[$sqlname])-2)!=$funcinfo[$sqlname][1]){
			$msg = array(
				array(
					"Error"=>"SQL query error or the query can not access through API.",
					"Code"=>"605",
				),
			);
			return $msg;
		}
		$sqlstruct = array();
		for($i=0;$i<$funcinfo[$sqlname][1];$i++){
			if(isset($_GET[$funcinfo[$sqlname][$i+2]])){
				$sqlstruct[] = $_GET[$funcinfo[$sqlname][$i+2]];
			}else{
				$msg = array(
					array(
						"Error"=>"The required parameter does not exist.",
						"Code"=>"603",
					),
				);
				return $msg;
			}
		}
		$sqlstr	= $funcinfo[$sqlname][0];
		$sqlstr = vsprintf($sqlstr, $sqlstruct);
		return $sqlstr;
	}
}
/* DESCRIPTION
 * 	Query MySQL.
 * ARGUMENTS
 *  	$sqlname	SQL name of sql.php.
 * RETURN
 * 	Query result.
 * NOTES
 */
function operate_sql($sqlname)
{
	return conn(GETSQLname($sqlname));
}

/* DESCRIPTION
 * 	Query MySQL.
 * ARGUMENTS
 *  	$sqlstruct	SQL name and parameters.
 * RETURN
 * 	Query result.
 * NOTES
 */
function array_sql($sqlstruct)
{
	return conn(SQLname($sqlstruct));
}

/************************************* Permission *************************************/

/* DESCRIPTION
 * 	Get permission values by user_id.
 * ARGUMENTS
 *  	$user_id	Staff ID and the parameter is int.
 * RETURN
 * 	Permission values.
 * NOTES
 */
function permissionvalues($user_id)
{
	// Check parameters.
	if((!is_int($user_id))||$user_id==0){
		return False;
	}

	$sqlstruct = array(
		"staff_permission",
		$user_id,
	);
	// Query MySQL
	$data = array_sql($sqlstruct);
	$data = explode(" ", $data[0]["Permission"]);
	for($i=0;$i<count($data);$i++){
		$data[$i]=(int)$data[$i];
	}
	
	return $data;
}
function is_boss($user_id)
{
	$data = permissionvalues($user_id);
	return in_array(1, $data);
}
function is_staff($user_id)
{
	$data = permissionvalues($user_id);
	return in_array(2, $data);
}
function is_asset($user_id)
{
	$data = permissionvalues($user_id);
	return in_array(3, $data);
}
function is_finance($user_id)
{
	$data = permissionvalues($user_id);
	return in_array(4, $data);
}

/************************************* Authentication *************************************/
function is_exist($user){
	$sqlstruct = array(
		"staff_username",
	);
	$data = array_sql($sqlstruct);
	for($i=0;$i<count($data);$i++){
		if(in_array($user, $data[$i])){
			return True;
		}
	}
	return False;
}

function register($regstruct)
{
	$sqlstruct = array(
		"add_user",
	);
	// TODO	
}
function activeuser($user_id)
{
	// TODO
}
function is_active($user_id)
{
	if((!is_int($user_id))||$user_id==0){
		return False;
	}
	$sqlstruct = array(
		"staff_status",
		$user_id,
	);
	$data = array_sql($sqlstruct);
	$data = (int)$data[0]["Status"];
	if($data==0){
		return True;
	}
	return False;
}
function unactive($user_id)
{
	// TODO	
}
function is_login()
{
	// TODO
}
function changepassword()
{
	// TODO
}
function changeusername()
{
	// TODO
}
?>

