<html>
<head>
  <link href="./notificationsupload/style.css" rel="stylesheet">
<title></title>
<link href="./notificationsupload/jquery.js">
<script src='./notificationsupload/jquery.js'></script>


<?php


$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db='office';
 $mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
if(isset($_POST['sub'])){

	if(isset($_POST['text'])){ // getting values of text

	 $title=$_POST['text'];
	 $title=mysqli_real_escape_string($mysql_connect1,$title);

      if(isset($_FILES['fileattach'])){  // to check if file is uploaded or not if uploaded then this statement otherwise
		  if($_FILES['fileattach']['size']!=0){//to check if filee is empty or not if empty then this
		  $file=$_FILES['fileattach'];
		  $fileName=$_FILES['fileattach']['name'];
		  $fileTmpName=$_FILES['fileattach']['tmp_name'];
		  $fileSize=$_FILES['fileattach']['size'];
		  $fileError=$_FILES['fileattach']['error'];
		  $fileType=$_FILES['fileattach']['type'];

		  $fileExt=explode('.',$fileName);
		  $fileActualExt=strtolower(end($fileExt));

		  $allowedExt=array('jpg','jpeg','png','pdf');
		  if(in_array($fileActualExt,$allowedExt)){
		     if($fileError==0){
				 $fileNewName=uniqid('',true).'.'.$fileActualExt;
				 $fileDestination='uploads/'.$fileNewName;
				 move_uploaded_file($fileTmpName,$fileDestination);

				$my_sql="INSERT INTO `notifications`( `textnote`, `fileaddr`, `date`) VALUES (?,?,NOW())";
				$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"ss",$title,$fileDestination);
					 mysqli_stmt_execute($stmt);
					 ?>
					 <script>
					   $('#res').text('notification uploaded');
	                   $('#res').css({'visibility':'visible','color':'red','font-size':'20px'});
					 </script>
					 
					 <?php

				 }else{
					echo "sql error";
				 }
			 }
		  }




	    }else{ // if file not uloaded

			$my_sql="INSERT INTO `notifications`(`textnote`,`date`) VALUES (?,NOW())";
			       $stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				    if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"s",$title);
					 mysqli_stmt_execute($stmt);
				    ?>
					 <script>
					    alert('notification uploaded');
					 </script>
					 
					 <?php

				 }else{
					echo "sql error";
				 }

	    }
	}
    }
}
?>

<script>
$(document).ready(function(){
$('#text').on('change',function(){
	$('#text-label').css({'visibility':'hidden'});
});
});

function upload(){

var text=$('#text').val();
if(text!=''){
	var file=$('#file').val();
	if(file.length!=0){
		var formData = new FormData($('#form'));
		alert('file attached');// file attached
		return true;
	}else{
		alert('No file attached');
		return true;
	}
}else{
	$('#text-label').text('Please fill');
	$('#text-label').css({'visibility':'visible','color':'red','font-size':'20px'});

}

return false;

}
</script>
</head>
<body>
  <div class="bar">
  <p> University Institute Of Information Technology</p>
  <div class="nav">
        <a href="./main.php">Home</a>
        <a href="#">About</a>
      </div>
    </div>
      <div class="dropdown">
      <img src="./notificationsupload/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
      </div>
    </div>

<h1>Notification upload</h1>
<form method='POST' onsubmit="return upload();" enctype='multipart/form-data' id='form' action="./main.php?request=1111">
<textarea rows='10' cols='100' style="resize:none;" id='text' name="text" placeholder="Enter notification here">
</textarea><label id="text-label"></label>
<br><br>
<input type='file' id='file' name="fileattach"><label id="file-label"></label>
<br><br><br>
<input type="submit" id="sub" name='sub'>
</form>
<center><p id="resshow"></p></center>
</body>
</html>
