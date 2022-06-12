<?php

$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db='users';

$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
$user=mysqli_real_escape_string($mysql_connect1,$_POST['user']);
$pass=mysqli_real_escape_string($mysql_connect1,$_POST['pass']);
$name=mysqli_real_escape_string($mysql_connect1,$_POST['name']);
$phoneno=mysqli_real_escape_string($mysql_connect1,$_POST['phone']);
$pass_hashed=password_hash($pass,PASSWORD_DEFAULT);
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
						 $my_sql1='INSERT INTO `teac_user`(`user_name_t`, `user_pass`, `teach_name`, `phoneno`) VALUES (?,?,?,?)';
				         $stmt1=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				         if(mysqli_stmt_prepare($stmt1,$my_sql1)){
					     mysqli_stmt_bind_param($stmt1,"ssss",$user,$pass_hashed,$name,$phoneno);
					     mysqli_stmt_execute($stmt1);
						 
                          $mysql_db2='teacher_regis';
                         $v=1;
                         $mysql_connect2=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db2);
						 
						 $my_sql2='UPDATE `teacher_regis_office` SET `verified_no_yes`= ? WHERE `phoneno`=?';
				         $stmt2=mysqli_stmt_init($mysql_connect2); 				 // sql work started
				         if(mysqli_stmt_prepare($stmt2,$my_sql2)){
					     mysqli_stmt_bind_param($stmt2,"is",$v,$phoneno);
					     mysqli_stmt_execute($stmt2);
						 
						 echo 'success';
						 }else{
							 echo 'fail';
						 }
				         }
						 
						// echo 'avail';
						 
						 // username doesnot exist
					 }
				 }
		//echo 'sucess';
	}

?>