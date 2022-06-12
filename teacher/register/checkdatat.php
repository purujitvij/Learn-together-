<?php


$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db='teacher_regis';


$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);

$first=mysqli_real_escape_string($mysql_connect1,strtolower($_POST['first']));
$last=mysqli_real_escape_string($mysql_connect1,strtolower($_POST['last']));
$ref=mysqli_real_escape_string($mysql_connect1,$_POST['ref']);
$phone=mysqli_real_escape_string($mysql_connect1,$_POST['phone']);

if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}else{

     $my_sql='SELECT `firstname`, `lastname`, `phoneno`, `ref_id`, `verified_no_yes` FROM `teacher_regis_office` WHERE phoneno=?';
				$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"s",$phone);
					 mysqli_stmt_execute($stmt);
					 $res=mysqli_stmt_get_result($stmt);
					 $result=mysqli_fetch_array($res);
					 if($result==null){
						 echo 'phone';// phone no wrong/not same as provided to office/contact office
					 }else{
						// echo $result['firstname'];
						 if($first==strtolower( $result['firstname'])&&$last==strtolower($result['lastname'])&&$ref==$result['ref_id']){
							 if($result['verified_no_yes']){
								  echo 'userregis';// userregistered
							 }else{
								 echo 'verified';//
							 }
							
						 }else{
							 if($first==strtolower( $result['firstname'])&&$last==strtolower($result['lastname'])){
								 if($ref==$result['ref_id']){
									  echo 'fine';
								 }else{
									 echo 'ref_id';
								 }
							 }else{
								 echo 'name';
							 }
							 //echo 'wrong';
						 }
						 
					 }
					 
					 
				    
				}else{
					echo 'error';
				}
	}
	


?>