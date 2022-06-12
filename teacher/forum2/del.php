<?php
require "db_connec1.php";

$iddel=$_POST['idpro'];
$my_sql3="SELECT `file_addr` FROM `disscussions_t`  WHERE `descussiont_id` = $iddel";
     $sql_query3=mysqli_query($mysql_connect1,$my_sql3);
	 if($sql_query3){
		 $query_execute3=mysqli_fetch_assoc($sql_query3);
		// echo 'success';
		 
	 }
	 
	 $my_sql4="DELETE FROM `replies_t` WHERE `disscusiont_id`=$iddel";
	$sql_query4=mysqli_query($mysql_connect1,$my_sql4);
	 if($sql_query4){
	   echo 'done';
	 }
	 
$my_sql2="DELETE FROM `disscussions_t` WHERE `descussiont_id`=".$iddel;
     $sql_query1=mysqli_query($mysql_connect1,$my_sql2);
	 echo $sql_query1;
	 if($sql_query1){
		 echo 'success';
		   if($query_execute3['file_addr']!=null){ 
		    $deladdr='D:programs/xampp/htdocs/project1/login/'.$query_execute3['file_addr'];
			if(unlink($deladdr)){echo "success";}
		 
	 }}
?>