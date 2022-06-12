<?php
// this php file is to check if database exists is yes then what will happen nxt is decided by this page
require "db.connect.php";
$branch=$_POST['branch'];
$batch=$_POST['batch'];

$dbname='batch_'.$batch.'_'.$branch;
$sqlcommand="CREATE DATABASE IF NOT EXISTS $dbname"; // to create database if not exist
if(mysqli_query($mysql_connect1,$sqlcommand)){
	$mysql_host='localhost';
    $mysql_user='abhishek';
    $mysql_password='1234567890';
	$mysql_db=$dbname;
    $mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	if($mysql_connect1){
	$sqlcommand2="CREATE TABLE IF NOT EXISTS $dbname ( table_id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,tablename VARCHAR(30) NOT NULL,purpose VARCHAR(30) NOT NULL,sem VARCHAR(30) NULL,month VARCHAR(30) NOT NULL)";
	    if(mysqli_query($mysql_connect1,$sqlcommand2)){
	    echo 'success';
	    }
	
	}
}else
	echo 'no success';

?>