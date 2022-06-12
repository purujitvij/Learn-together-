<?php




$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db='teacher_regis';

$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
$first=mysqli_real_escape_string($mysql_connect1,$_POST['first']);
$last=mysqli_real_escape_string($mysql_connect1,$_POST['last']);
$phone=mysqli_real_escape_string($mysql_connect1,$_POST['phone']);

$firstl=strtolower($first);
$lastl=strtolower($last);

$random=array('x','ab','dj','hd','wd','st');
$ref='';
for($i=0;$i<6;$i++){
	//echo rand(1,9).$random[rand($i,5)];
	$ref=$ref.rand(1,9).$random[rand($i,5)];
}
 echo $ref;
if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}else{

     $my_sql='SELECT `firstname`, `lastname`, `phoneno`, `ref_id`, `verified_no_yes` FROM `teacher_regis_office` WHERE phoneno=?';
				$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"s",$phone);
					 mysqli_stmt_execute($stmt);
					 $res=mysqli_stmt_get_result($stmt);
					 $result=mysqli_fetch_array($res);
					 $resultf=strtolower($result['firstname']);
					 $resultl=strtolower($result['lastname']);
					 if($resultf==$firstl&&$resultl==$lastl&&$result['phoneno']==$phone){
						 if($result['verified_no_yes']){
							 echo 'verified user';
						 }else{
							 echo 'data already entered ';
						 }
						 
					 }else{
						 if($resultf==$firstl&&$resultl==$lastl){
							 echo 'confirm name is already with another phno';
						 }else{
							 if($phone==$result['phoneno']){
								 echo 'phone already used';
							 }else{
								
								 
                           $my_sql1='INSERT INTO `teacher_regis_office` (`firstname`, `lastname`, `phoneno`, `ref_id`) VALUES (?,?,?,?)';
				          $stmt1=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				          if(mysqli_stmt_prepare($stmt1,$my_sql1)){
					     mysqli_stmt_bind_param($stmt1,"ssss",$first,$last,$phone,$ref);
					      mysqli_stmt_execute($stmt1);
						   echo 'success'.$ref; 
						  }
						  
							 }
							 
						 }
						
					 }
				    
				}else{
					echo 'error';
				}
	}
//print_r($random);
?>