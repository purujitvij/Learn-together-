<?php
// this one is to upload student data



$sheetdata=$_POST['sheetdata'];
$batch=$_POST['batch'];
$branch=$_POST['branch'];
$purpose=$_POST['purpose'];
$month=$_POST['month'];
$sem=$_POST['sem'];

$dbname='batch_'.$batch.'_'.$branch;
$tablename=$purpose.'_'.$branch.'_'.$batch.'_'.$sem.'_'.$month;


$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db=$dbname;
$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$dbname);


if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}else{	 //database connected
	 
	   $sqlcommand="select 1 from '$tablename'";
	   $sqlcommandrun=mysqli_query($mysql_connect1,$sqlcommand);
	       if($sqlcommandrun==false){
	       $sqlcommand2="CREATE TABLE $tablename (stu_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,firstname VARCHAR(30) NOT NULL,lastname VARCHAR(30) NOT NULL,rollno VARCHAR(50),sub1 VARCHAR(50) NULL,sub2 VARCHAR(50) NULL,sub3 VARCHAR(50) NULL,sub4 VARCHAR(50) NULL)";
			$sqlcommandrun2=mysqli_query($mysql_connect1,$sqlcommand2); 
        			if($sqlcommandrun2!=false){
					$i=0;
		          foreach($sheetdata as $value){
					  if($i>0){
						$fn=$sheetdata[$i][1];
						$ln=$sheetdata[$i][2];
						$rn=$sheetdata[$i][3];
						$sb1=$sheetdata[$i][4];
						$sb2=$sheetdata[$i][5];
						$sb3=$sheetdata[$i][6];
						$sb4=$sheetdata[$i][7];
					  
					 $my_sql="INSERT INTO $tablename (`firstname`, `lastname`, `rollno`, `sub1`, `sub2`, `sub3`, `sub4`) VALUES (?,?,?,?,?,?,?)";
				         $stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				          if(mysqli_stmt_prepare($stmt,$my_sql)){
					      mysqli_stmt_bind_param($stmt,"sssssss",$fn,$ln,$rn,$sb1,$sb2,$sb3,$sb4);
					      mysqli_stmt_execute($stmt);
				           }else{
							echo'something wrong';
							}
					  }
					  $i=$i+1;
				  }
				  $my_sql2="INSERT INTO $dbname (`tablename`, `purpose`, `sem` , `month`) VALUES (?,?,?,?)";
				         $stmt2=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				          if(mysqli_stmt_prepare($stmt2,$my_sql2)){
					      mysqli_stmt_bind_param($stmt2,"ssss",$tablename,$purpose,$sem,$month);
					      mysqli_stmt_execute($stmt2);
				           }
                unset($value);
				unset($i);
				echo 'success';
				 }else{
				echo 'data already present if not use update';
				 }

		   }else{
				echo 'data already present if not use update';
			}
	    
	}
	


//echo $batch.$branch.$purpose.$month;
//print_r($sheetdata); 


?>