<?php
$mysql_host='localhost';
	  $mysql_user='abhishek';
	  $mysql_password='1234567890';
	  $mysql_db='tsquery';
	 
	  
	  
	  $mysql_connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	   $id=$_POST['id'];
	  $com=mysqli_real_escape_string($mysql_connect,$_POST['comment']);
      if (@mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
	    }else{
	       $my_sql="INSERT INTO `queryreply`(`queryid`, `content`, `datetime`) VALUES (?,?,NOW())";
	    	$stmt=mysqli_stmt_init($mysql_connect); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"is",$id,$com);
					 mysqli_stmt_execute($stmt);
					 $io=1;
					 $my_sql2="UPDATE `query` SET `reply`=? WHERE `queryid` =?";
	    	         $stmt2=mysqli_stmt_init($mysql_connect); 				 // sql work started
				      if(mysqli_stmt_prepare($stmt2,$my_sql2)){
					 mysqli_stmt_bind_param($stmt2,"si",$io,$id);
					 mysqli_stmt_execute($stmt2);
				     echo 'success';
				 }
					 
		    }
		
		}
?>