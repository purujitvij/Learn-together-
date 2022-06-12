<?php
    $stud_name=$_GET["stu_name"];
    $stud_rollno=$_GET["stu_rollno"];
    $stud_phoneno=$_GET["stu_phoneno"];
	if(!empty($stud_name)&&!empty($stud_rollno)&&!empty($stud_phoneno)){
		echo $stud_name;
		echo $stud_rollno;
		echo $stud_phoneno;

$flag=0;
$status1=0;


$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_database='registration';

$mysql_connect=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_database);


if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}
	else{ 
$sql_name= "SELECT * FROM `registrationdata`";
if(@mysqli_query($mysql_connect, "SELECT * FROM `registrationdata`")){
	$sql_query=mysqli_query($mysql_connect, "SELECT * FROM `registrationdata`");
	while($query_execute=mysqli_fetch_assoc($sql_query)){
	 if($stud_name==$query_execute['name']&&$stud_rollno==$query_execute['roll_no']&&$stud_phoneno==$query_execute['phoneno']){
	   $flag=1;
	   $stud_status=$query_execute['status'];
	   if($stud_status==1){
		   $status1=12;
		   }
	 
	}
}
        if($status1==12){ 
		  header("location: http://localhost/project1/login2/loginpage.html");// when some one is already in the having a  account
		   }
         else{ if($flag==1){
	   
           header("location: http://localhost/project1/regis3/registrationpage2.html"); // when someone details are matched
            } 
            else{
	         header("location: http://localhost/project1/regis2/registration2.html"); // when details are no matched
          }
		 } 
		 
} 
	} 
	}
	else{ 
	    header("location: http://localhost/project1/registration.html");
    }
?>