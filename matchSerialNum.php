<?php
/**
 * application/matchSerialNum.php
 * Date: 2017-05-11
 * author: Yaein Jung
 * project: Cat Litter Box
 *
 * This php file includes 'user_info' table from 'catlitterbox' database.
 * After getting data(by post) from android app, 
 * 		it returns	0(when serial number does not match)
 * 					1(when serial number matches)
 * 					2(when serial number already registered)
 */

	include_once("./dbConnect.php"); 
	
	if (mysqli_connect_errno($conn))
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$serial_num = $_POST['seiral_num'];
	
	$query = 'SELECT user_id, is_registered FROM user_info WHERE serial_num='.$serial_num;
	
	$result = mysqli_query($conn, $query);
	
	if ($result->num_rows > 0) { //시리얼넘버가 user_info 테이블에 있을 경우
		$row = mysqli_fetch_row($result);
		
		if ($row[1] == 0) //등록이 안된 기기
			echo 1;
		else
			echo 2;
	}
	else { //시리얼 넘버 없을 경우
		echo 0;
	}
	
	mysqli_close($conn);
?>