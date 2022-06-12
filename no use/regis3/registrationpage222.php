<?php

$stud_username=$_POST["name"];
$stud_pass=$_POST["pass"];

echo $stud_username;
echo $stud_pass;
$stud_pass1=md5($stud_pass);
echo $stud_pass1;

$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_database='registration';

$mysql_connect=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);

if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}
	else{ 
      $sql_query= "INSERT INTO `registrationpage2data`(`username`, `password`) VALUES ($stud_username,$stud_pass1)";
	  if(@mysqli_query($mysql_connect, "INSERT INTO `registrationpage2data`(`username`, `password`) VALUES ($stud_username,md5($stud_pass))")) { 
	  header("location: http://localhost/project1/login/loginpage.php");
	  }
	}

?>