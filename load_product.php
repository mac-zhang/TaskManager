<!DOCTYPE html>
<!--
 ******************************************************************************
 * Copyright (c) 2014 Chongqing MySHworks Technology Co., Ltd.
 * All rights reserved.
 *
 * File         $RCSfile: load_product.php,v $
 * Author       $Author: zhoutaishun $
 * Version      $Revision: 1.1.1.1 $
 * Date         $Date: 2014/12/16 03:55:09 $
 * Description
        Load file file for product.php
 ******************************************************************************
-->

 
<?php 
 	include_once "load_exon.php"; 


	// define global variable
	// $price: The price of product;
	// $description: The description of product
	
	$price		= array(	"DCM301"	=>"2000.00" ,
				"DC8000"	=>"4000.00" ,
				"Taxol"		=>"100.00"
				);
				
	$description	=array(	"DCM301"	=>"DCM301显控模块。本产品是以STM32F407为主控芯片的自主研发液晶屏显示模块,5V电压供电，集成MAX232硬件串口UART电路，可进行串口通信。
						配置：主控芯片：STM32F407、SRAM：1024*16bit、LCD：天马原装3.5寸液晶屏、接口：DB9串口接口、JTAG调试接口和Mini-USB接口。
						" ,
				"DC8000"	=>"DC8000显控模块。本产品以STM32F407作为主控芯片，SPARTAN-6 作为FPGA图像处理芯片的自主研发的显控模块，可进行USART和CAN通信,5V电压供电。
						工作机制：STM32F407将需要绘制的图像信息发送给FPGA，由FPGA进行图像的绘制，再通过VGA将图像传输到显示屏。
						图像分辨率可调，有800*600、1024*768和1280*720三档分辨率。
						配置：主控芯片：STM32F407+SPARTAN-6 、SRAM：2048*8bit（x2）、接口：VGA、USART、CAN和JTAG等。
						", 
				"Taxol"		=>"SWD仿真器。本产品为自主研发的软件仿真器，可进行SWD模式下的程序仿真，可兼容JTAG和SWD接口。本仿真器为5线制接口，嵌入有A型USB接口，
						可直接与电脑连接，同时本品外壳为自主3D打印产品，形状可任意定制。本产品小巧、方便、易携带。
						"
				);	

/* DESCRIPTION
 * 	Product show
 * ARGUMENTS
 *	$product_name: The name of product
 * RETURN
 * NOTES
 */
 function product_show($product_name){
 	
	echo "	<div  id='product_view_div_".$product_name."' class='product_view_div' onmouseover=\"product_view_mouseover(this);\">
			<div class='preview'>
				<div class='jqzoom' id='spec-n1-".$product_name."'>
					<img class='zoom-img-".$product_name." product_big_img'  src='image/product/".$product_name."_1.png' jqimg='image/product/".$product_name."_1.png' >
				</div>
				<div id='spec-n5-".$product_name."' class='spec-n5'>
					
					<div class='spec-list'  id='spec-list-".$product_name."'>
						<ul class='list-h'>
							<li><img class='li-img-".$product_name."' src='image/product/".$product_name."_1.png' onmouseover=\"product_list_mouseover(this);\" onmouseout=\"product_list_mouseout(this);\"> </li>
							<li><img class='li-img-".$product_name."' src='image/product/".$product_name."_2.png' onmouseover=\"product_list_mouseover(this);\" onmouseout=\"product_list_mouseout(this);\"> </li>
							<li><img class='li-img-".$product_name."' src='image/product/".$product_name."_3.png' onmouseover=\"product_list_mouseover(this);\" onmouseout=\"product_list_mouseout(this);\"> </li>
							<li><img class='li-img-".$product_name."' src='image/product/".$product_name."_4.png' onmouseover=\"product_list_mouseover(this);\" onmouseout=\"product_list_mouseout(this);\"> </li>
							<li><img class='li-img-".$product_name."' src='image/product/".$product_name."_5.png' onmouseover=\"product_list_mouseover(this);\" onmouseout=\"product_list_mouseout(this);\"> </li>		
						</ul>
					</div>
					
		
   				 </div>
			</div>
			<div class='product_detail_div'>
 				<div  class='product_describ_div'>
 					<table class='product_describ_table'>
 						<tr><td class='product_describ_title'>产品描述</td></tr>
 						<tr><td >	
 							<div class='product_describ_content'>";
 								global	$description;	
 								echo $description[$product_name];
 			echo "				</div>
 							</td>
 						</tr>
 					</table>
 				</div>
 				<div class='product_price'>
 					<table>
 						<tr><td>价格: ￥</td><td class='product_amount'>";
 							global	$price;	
 							echo $price[$product_name];
 			echo "			</td></tr>
 					</table>
 				</div>
 				<div class='product_number'>
 					<table class='product_number_table'>
 						<tr>
	 						<td>数量</td>
	 						<td><a class='product_num_reduce_default_button' id='num_reduce_default_a_".$product_name."'><a class='product_num_reduce_button' id='num_reduce_a_".$product_name."'  onclick=\"num_reduce_button_click(this); \"></a></td>
	 						<td><input  id='num_input_".$product_name."' class='product_num_input' type='text' value='1' title='请输入购买量' onchange=\"num_input_change(this); \"></td>
	 						<td><a id='num_add_a_".$product_name."'  class='product_num_add_button' onclick=\"num_add_button_click(this); \"></a></td>
	 						<td>套</td>
	 					</tr>
 					</table>
 				</div>
 				<div class='product_buy'>
 					<a herf='#' title='点击此按钮，到下一步确认购买信息' id='product_buy_now'>立即购买</a>
 				</div>
 			</div>
		</div>
 	";
 }
?>
