<!--
 ******************************************************************************
 * Copyright (c) 2016 Zhuhai GREE Co., Ltd. 
 * All rights reserved.
 *
 * File		$RCSfile: common.php,v $
 * Author	$Author: 张蒙川 $
 * Version	$Revision: 0.1 $
 * Date		$Date: 2016/03/28 00:17:31 $
 * Description	
	Function for all Web 
 ******************************************************************************
 -->

<?php
session_start();
// php include path.
$selfpath = dirname(__FILE__);
// debug
$DEBUG	= True;
if($DEBUG){
	ini_set("display_errors", "On");
	error_reporting(E_ALL | E_STRICT);
}
/* DESCRIPTION
 *	Analysis path and Corresponding web page.
 * ARGUMENTS
 * 	$path REQUEST_URL
 * RETURN
 * 	Functions or php files.
 * NOTES
 */
function analysisURL($path)
{
	
	// Distribution URL
	switch($path){
		
		case "/login":
			require_once("/login.php");
			break;
					
		case "/task":
			require_once("/task.php");
			break;
					
		case "/ajax":
			require_once("/tool/common.php");
			ajax();
			break;
			
		// $path no corresponding item, default 404 Not Found.
		default:
			header("HTTP/1.1 404 Not Found");
			break;
	}
	return True;
}
/* DESCRIPTION
 *	If the last char is "/", delete it.
 * ARGUMENTS
 * 	$path A string.
 * RETURN
 *  A string.
 * NOTES
 */
function cleanpath($path)
{
	if(substr($path,-1)=="/"){
		$path = substr($path, 0, strlen($path)-1);	
	}
	return $path;
}
/* DESCRIPTION
 *	Whether a string contains the keyword.
 * ARGUMENTS
 * 	$path A string.
 * RETURN
 *  	True or False.
 * NOTES
 */
function matchpath($keyword, $path)
{
	if(strlen($keyword)>strlen($path)){
		return False;
	}else{
		$path = substr($path, 0, strlen($keyword));
		if(strcmp($path, $keyword)==0){
			return True;
		}
	}
	return False;
}
/* DESCRIPTION
 *	Redirect url.
 * ARGUMENTS
 * 	$url	Redirect url.
 * RETURN
 * NOTES
 *  Status:301 
 */
function redirect($url)
{
	header("Location: ".$url, TRUE, 301);
}

// Run web
$request_path = cleanpath(isset($_SERVER["REDIRECT_URL"])?$_SERVER["REDIRECT_URL"]:"/");
require_once("/tool/common.php");
analysisURL($request_path);

	
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