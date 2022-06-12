<?php

$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db='users';


$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);

$name=mysqli_real_escape_string($mysql_connect1,$_POST['name']);
$user=$_POST['user'];
$pass=mysqli_real_escape_string($mysql_connect1,$_POST['pass']);
$pass_hashed=password_hash($pass,PASSWORD_DEFAULT);


if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}else{

     $my_sql='INSERT INTO `users`(`username`, `password`, `Name`) VALUES (?,?,?)';
				$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"sss",$user,$pass_hashed,$name);
					 mysqli_stmt_execute($stmt);
				    echo 'success';
				}else{
					echo 'error';
				}
	}
//echo $pass_hashed;
?>
