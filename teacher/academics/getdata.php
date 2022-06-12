<?php
$branch=$_POST['branch'];
$batch=$_POST['batch'];
$sem=$_POST['sem'];
$purpose=$_POST['purpose'];
$month=$_POST['month'];
$roll=$_POST['roll'];

$db='batch_'.$batch.'_'.$branch;
$tablename=$purpose.'_'.$branch.'_'.$batch.'_'.$sem.'_'.$month;
$mysql_host='localhost';
	  $mysql_user='abhishek';
	  $mysql_password='1234567890';
	  $mysql_db=$db;
	   $mysql_connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password);
	  if(mysqli_select_db($mysql_connect,$db)==false){ 
	  echo '<p>no data found</p>';
	  }else{
	 $mysql_connect1=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	  	 
				$my_sql="SELECT * FROM `$tablename` WHERE `rollno`=?";
				$stmt=mysqli_stmt_init($mysql_connect1); 					// sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,'s',$roll);
					 mysqli_stmt_execute($stmt);
					 $res=mysqli_stmt_get_result($stmt);
					 if($res1=mysqli_fetch_assoc($res)){
						 echo "<table><tr><th>firstname</th><th>lastname</th><th>sub1</th><th>sub2</th><th>sub3</th><th>sub4</th></tr>
					<tr><td>".$res1['firstname']."</td><td>".$res1['lastname']."</td><td>".$res1['sub1']."</td><td>".$res1['sub2']."</td><td>".$res1['sub2']."</td><td>".$res1['sub2']."</td></tr></table>";
				
					 }else{
						 echo 'no data found'; 
					 }
					 //print_r($res1);
		             }
			
		}
?>