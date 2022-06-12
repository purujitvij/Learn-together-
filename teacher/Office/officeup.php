<?php

      $mysql_host='localhost';
	  $mysql_user='abhishek';
	  $mysql_password='1234567890';
	  $mysql_db='office';
	  
	  $mysql_connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	  	  if (@mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
	    }else{
		$user=$_POST['user'];
		$to=mysqli_real_escape_string($mysql_connect,$_POST['to']);
		$sub=mysqli_real_escape_string($mysql_connect,$_POST['sub']);
		$text=mysqli_real_escape_string($mysql_connect,$_POST['text']);
				
				
				$my_sql="INSERT INTO `application`(`to_`, `sub`, `apppart`, `sendby`, `date_`) VALUES (?,?,?,?,NOW())";
				$stmt=mysqli_stmt_init($mysql_connect); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"ssss",$to,$sub,$text,$user);
					 mysqli_stmt_execute($stmt);
				     echo 'success';
				 }else{
					 echo 'wrong';
				 }
		}
	  



?>
