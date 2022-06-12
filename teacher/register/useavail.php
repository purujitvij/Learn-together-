<?php

$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db='users';

$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
$user=mysqli_real_escape_string($mysql_connect1,$_POST['user']);

if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}else{
		$my_sql='SELECT `user_name_t` FROM `teac_user` WHERE `user_name_t`= ?';
				$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"s",$user);
					 mysqli_stmt_execute($stmt);
					 $res=mysqli_stmt_get_result($stmt);
					$no= mysqli_num_rows($res);
					 //echo $no['user_name_t'];
					 if($no){
						 echo 'exist';
						// username exist
					 }else{
						 echo 'avail';
						 // username doesnot exist
					 }
				 }
		//echo 'sucess';
	}

?>