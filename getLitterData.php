<?php
/**
 * application/getLitterData.php
 * Date: 2017-05-09 
 * author: Yaein Jung 
 * project: Cat Litter Box
 * 
 * This php file includes 'litter_info' table from 'catlitterbox' database.
 * This file returns all datas from 'litter_info' table by json data type.
 * To use data, you should parse json data.
 */

	include_once("./dbConnect.php"); 

	function unistr_to_xnstr($str){
		return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str);
	}
	
	if (mysqli_connect_errno($conn))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	mysqli_set_charset($conn,"utf8");


	$res = mysqli_query($conn,"select * from litter_info");

	$result = array();

	while($row = mysqli_fetch_array($res)){
		array_push($result,
				array(
						'litter_id'=>$row[0],
						'enter_time'=>$row[1],
						'exit_time'=>$row[2],
						'total_time'=>$row[3],
						'poop_weight'=>$row[4],
						'cat_weight'=>$row[5]
				));
	}


	$json = json_encode(array("result"=>$result));
	//echo unistr_to_xnstr($json);
	
	echo $json;


	mysqli_close($conn);
?>