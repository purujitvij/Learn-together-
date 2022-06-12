<?php
// this one is to upload student data



$sheetdata=$_POST['sheetdata'];
$batch=$_POST['batch'];
$branch=$_POST['branch'];
$purpose=$_POST['purpose'];
$month=$_POST['month'];

$dbname='batch_'.$batch.'_'.$branch;
$tablename=$purpose.'_'.$branch.'_'.$batch;


$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db=$dbname;
$mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$dbname);


if (@mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
	}else{
	 //echo 'db connect';	 database connected
	   $sqlcommand="select 1 from '$tablename'";
	   $sqlcommandrun=mysqli_query($mysql_connect1,$sqlcommand);
	       if($sqlcommandrun==false){
	       $sqlcommand2="CREATE TABLE $tablename (stu_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,firstname VARCHAR(30) NOT NULL,lastname VARCHAR(30) NOT NULL,rollno VARCHAR(50),phoneno VARCHAR(50) NOT NULL)";
			$sqlcommandrun2=mysqli_query($mysql_connect1,$sqlcommand2);
			if($sqlcommandrun2!=false){
				  $i=0;
		          foreach($sheetdata as $value){
					  if($i>0){
						$fn=$sheetdata[$i][1];
						$ln=$sheetdata[$i][2];
						$rn=$sheetdata[$i][3];
						$pn=$sheetdata[$i][4];
						
					  
					 $my_sql="INSERT INTO $tablename (`firstname`, `lastname`, `rollno`, `phoneno`) VALUES (?,?,?,?)";
				         $stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				          if(mysqli_stmt_prepare($stmt,$my_sql)){
					      mysqli_stmt_bind_param($stmt,"ssss",$fn,$ln,$rn,$pn);
					      mysqli_stmt_execute($stmt);
				           }else{
							echo'something wrong';
							}
					  }
					  $i=$i+1;
				  }
				  $my_sql2="INSERT INTO $dbname (`tablename`, `purpose`, `month`) VALUES (?,?,?)";
				         $stmt2=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				          if(mysqli_stmt_prepare($stmt2,$my_sql2)){
					      mysqli_stmt_bind_param($stmt2,"sss",$tablename,$purpose,$month);
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