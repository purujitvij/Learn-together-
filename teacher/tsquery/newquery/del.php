<?php

  $idd=$_POST['idp'];
 $mysql_host='localhost';
	  $mysql_user='abhishek';
	  $mysql_password='1234567890';
	  $mysql_db='tsquery';
	  
	  $mysql_connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	  
	  
	  if (@mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
	    }else{






    $my_sql="DELETE FROM `query` WHERE `queryid`=$idd";
	$sql_query=mysqli_query($mysql_connect,$my_sql);
	 if($sql_query){
	   echo 'done';
	 }

    $my_sql1="DELETE FROM `queryreply` WHERE `queryid`=$idd";
	$sql_query1=mysqli_query($mysql_connect,$my_sql1);
	 if($sql_query1){
	   echo 'done';
	 }


		}
		
		
		
?>