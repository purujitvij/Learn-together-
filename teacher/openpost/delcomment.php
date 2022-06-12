<?php 
require "db_connec1.php";
$iddel=$_POST['idpro'];
$my_sql2="DELETE FROM `replies_t` WHERE `replyt_id`= $iddel";
     $sql_query1=mysqli_query($mysql_connect1,$my_sql2);
	 if($sql_query1){
		 echo 'success';
	 }
	 ?>