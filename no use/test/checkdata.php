<?php

$batch=$_POST['batch'];
$branch=$_POST['branch'];
$rollno=$_POST['rollno'];
$phoneno=$_POST['phoneno'];

$dbname='batch_'.$batch.'_'.$branch;

$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db=$dbname;
$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);



$mysql_db2='users';
$mysql_connect2=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db2);



if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}else{
	 	// database connected
	/*	$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
		  if(mysqli_stmt_prepare($stmt,$my_sql)){
     		 mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['user_name'],$post_title,$post_description,$fileDestination);
			 mysqli_stmt_execute($stmt);
				 }
				 */
				 
		
		// first one to check if username exist or notif exists tell the user and otherwise go ahead  
				 
		$my_sql="SELECT `username` FROM `users` WHERE `username` = ?";		 
		$stmt=mysqli_stmt_init($mysql_connect2); 				 // sql work started
		  if(mysqli_stmt_prepare($stmt,$my_sql)){
			 mysqli_stmt_bind_param($stmt,"s",$rollno);
			 mysqli_stmt_execute($stmt);
			 mysqli_stmt_store_result($stmt);
			 $result=mysqli_stmt_num_rows($stmt); 
			 if($result){ 
			  echo 'user';
			  //when user already registered 
			  }else{ 
			  
			  // this one is to get the name of table in which particular batch data held
			  $my_sql1="SELECT `tablename` FROM $dbname WHERE `purpose` = 'studata'";		 
		     $stmt1=mysqli_stmt_init($mysql_connect1); 				 // sql work started
		     if(mysqli_stmt_prepare($stmt1,$my_sql1)){
			  mysqli_stmt_execute($stmt1);
			  $res1=mysqli_stmt_get_result($stmt1);
			  $result1=mysqli_fetch_array($res1);
			  $stutable=$result1['tablename'];
			  
			  // this one is to check  roll no is in database  or not
			   $my_sql2="SELECT  `firstname`, `lastname`, `rollno`, `phoneno` FROM $stutable WHERE `rollno`=?";		 
		       $stmt2=mysqli_stmt_init($mysql_connect1); 				 // sql work started
		       if(mysqli_stmt_prepare($stmt2,$my_sql2)){
		        mysqli_stmt_bind_param($stmt2,"s",$rollno);
        		mysqli_stmt_execute($stmt2);
				mysqli_stmt_store_result($stmt2);
			    $result2x=mysqli_stmt_num_rows($stmt2);
				if($result2x){
					
					// if roll no is in database  then check phone no matches or not
				    $my_sql3="SELECT  `firstname`, `lastname`, `rollno`, `phoneno` FROM $stutable WHERE `rollno`=?";
			        $stmt3=mysqli_stmt_init($mysql_connect1); 				 // sql work started
		            if(mysqli_stmt_prepare($stmt3,$my_sql3)){
				     mysqli_stmt_bind_param($stmt3,"s",$rollno);
			          mysqli_stmt_execute($stmt3);
			          $res3=mysqli_stmt_get_result($stmt3);
			          $result3=mysqli_fetch_array($res3);
				  
			             $frstname=$result3['firstname'];
			             $lastname=$result3['lastname'];
				          $name=$frstname.' '.$lastname;
				          $phoneno2=$result3['phoneno'];
						  
						  
				            if($phoneno==$phoneno2){
							  echo $name;
							  //if everything was good
						    }else{
								echo 'phoneno';
							 }
							
				     }else{
						echo 'sql'; 
					 }
				   }else{
					echo 'rollno';   
				    }
				 }else{ 
				   echo 'sql';
				   }
			  
				 }else{
					 echo 'sql';
				    }
			  
			  }// else finished
			
				 }else{
					 echo 'sql';
				 }
				 
		
	}
?>