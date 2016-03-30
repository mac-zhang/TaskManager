/*
 ******************************************************************************
 * Copyright (c) 2014 Chongqing MySHworks Technology Co., Ltd. 
 * All rights reserved.
 *
 * File     $RCSfile: product.js,v $
 * Author   $Author: zhoutaishun $
 * Version  $Revision: 1.1.1.1 $
 * Date     $Date: 2014/12/16 03:55:09 $
 * Description  
    Javascript for product.php
 ******************************************************************************
 */
$(function(){
    	// Exon header click callback
	exon_header_initial();
	
	// Product page callback
	product_page_callback();
	
	// Product preview callback
	product_preview_callback();
})

/* DESCRIPTION
 *	 Product preview div mouseover callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
function product_view_mouseover(obj){
	var product_id		= obj.id;
	product_div_name		= product_id.substring(17,product_id.length);

}

/* DESCRIPTION
 *	 Product preview callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
function product_preview_callback(){
	$(".jqzoom").jqueryzoom({
			xzoom:400,
			yzoom:400,
			offset:10,
			position:"right",
			preload:1,
			lens:1
	});
}

/* DESCRIPTION
 *	 Product small image mouseover callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
function product_list_mouseover(obj){
	var src=obj.src;
	$(".zoom-img-"+product_div_name).eq(0).attr({
		src:src.replace("\/n5\/","\/n1\/"),
		jqimg:src.replace("\/n5\/","\/n0\/")
	});
	$(obj).css({
		"border":"2px solid #ff6600",
		"padding":"1px"
	});
}

/* DESCRIPTION
 *	 Product small image mouseout callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
function product_list_mouseout(obj){
	$(obj).css({
			"border":"1px solid #ccc",
			"padding":"1px"
	});
}

/* DESCRIPTION
 *	 Product page callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
 var num_add_counter	= 1;
function  product_page_callback(){
	$(".product_num_reduce_button").hide();
}

/* DESCRIPTION
 *	 Reduce number button click callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
function num_reduce_button_click(obj){
	var product_id	= obj.id;
	var product_name	= product_id.substring(13,product_id.length);

	num_add_counter--;
	document.getElementById('num_input_'+product_name).value =num_add_counter;
	if(num_add_counter==1){
		$("#num_reduce_a_"+product_name).hide();
		$("#num_reduce_default_a_"+product_name).show();
	}
}

/* DESCRIPTION
 *	 Add number button click callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
function num_add_button_click(obj){
	var product_id	= obj.id;
	var product_name	= product_id.substring(10,product_id.length);

	$("#num_reduce_a_"+product_name).show();
	$("#num_reduce_default_a_"+product_name).hide();
		
	num_add_counter++;
	document.getElementById('num_input_'+product_name).value =num_add_counter;
}

/* DESCRIPTION
 *	 Number input changed callback
 * ARGUMENTS
 * RETURN
 * NOTE
 */
function num_input_change(obj){
	var product_id	= obj.id;
	var product_name	= product_id.substring(10,product_id.length);
	
	if(document.getElementById('num_input_'+product_name).value ==1){
			$("#num_reduce_a_"+product_name).hide();
			$("#num_reduce_default_a_"+product_name).show();
	}else if(document.getElementById('num_input_'+product_name).value ==0){
			alert("Please input number of products");
			document.getElementById('num_input_'+product_name).value= 1;
	}else{
			$("#num_reduce_a_"+product_name).show();
			$("#num_reduce_default_a_"+product_name).hide();
	}	
}