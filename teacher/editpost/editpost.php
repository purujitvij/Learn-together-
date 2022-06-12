<?php
require "db_connec1.php";
// this page used to post
$getidtoup1=$_GET['bd'];

if(isset($_POST['subpost'])){

	if(isset($_POST['title'])&&isset($_POST['description'])){ // getting values of title and description 
	 $post_title=$_POST['title'];
	 $post_title=mysqli_real_escape_string($mysql_connect1,$post_title); 
	 
     $post_description=$_POST['description'];
	 $post_description=mysqli_real_escape_string($mysql_connect1,$post_description);
	 
	                                      
	  
      if(isset($_FILES['fileattach'])){  // to check if file is uploaded or not if uploaded then this statement otherwise
		  if($_FILES['fileattach']['size']!=0){//to check if filee is empty or not if empty then this
		  
		  // to delete the previous file attached from database
		  $my_sql2="SELECT `file_addr` FROM `disscussions_t`  WHERE `descussiont_id` = ?";
		  $stmt2=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				    if(mysqli_stmt_prepare($stmt2,$my_sql2)){
					 mysqli_stmt_bind_param($stmt2,"i",$getidtoup1);
					 mysqli_stmt_execute($stmt2);
					 $result_filea=mysqli_stmt_get_result($stmt2);
					 if($result_file1=mysqli_fetch_assoc($result_filea)){
						$deladdr='D:programs/xampp/htdocs/project1/login/'.$result_file1['file_addr']; 
                         if(unlink($deladdr)){echo "success";}
		 					
					}
					}
		  
		  
		  
		  $file=$_FILES['fileattach'];
		  $fileName=$_FILES['fileattach']['name'];
		  $fileTmpName=$_FILES['fileattach']['tmp_name'];
		  $fileSize=$_FILES['fileattach']['size'];
		  $fileError=$_FILES['fileattach']['error'];
		  $fileType=$_FILES['fileattach']['type'];
		  
		  $fileExt=explode('.',$fileName);
		  $fileActualExt=strtolower(end($fileExt));
		  
		  $allowedExt=array('jpg','jpeg','png','gif','pdf','txt','doc','docx');
		  if(in_array($fileActualExt,$allowedExt)){ 
		     if($fileError==0){
				 $fileNewName=uniqid('',true).'.'.$fileActualExt;
				 $fileDestination='/forum/uploads/'.$fileNewName;
				 move_uploaded_file($fileTmpName,'../login/'.$fileDestination);
				 
				$my_sql='UPDATE `disscussions_t` SET `titlet`=?,`contentt`=?,`file_addr`=?,`date_postedt`=NOW() WHERE `descussiont_id`=?';
				$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"sssi",$post_title,$post_description,$fileDestination,$getidtoup1);
					 mysqli_stmt_execute($stmt);
					 
					 
					 
					 header('location:'.$current_page.'?req=2111');
				
				 }else{
					echo "sql error"; 
				 }
			 }
		  }
		  
		  
		  
		  
	    }else{ // if file not uloaded
			
			$my_sql='UPDATE `disscussions_t` SET `titlet`=?,`contentt`=?,`date_postedt`=NOW() WHERE `descussiont_id`=?';
			       $stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				    if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"ssi",$post_title,$post_description,$getidtoup1);
					 mysqli_stmt_execute($stmt);
					 header('location:'.$current_page.'?req=2111');
				
				 }else{
					echo "sql error"; 
				 }
		  
	    }
	}
    }
}


if(isset($_GET['bd'])){
	if(!empty($_GET['bd'])){
		$getidtoup=$_GET['bd'];
	
?>
<html>
<head>
  <link href="./editpost/queryfirst.css?ts=<?=time()?>" rel="stylesheet">
</head>
<body>
 <header> <div class="bar">
  <p> University Institute Of Information Technology</p>
  <div class="nav">
        <a href="../teacher/main.php">Home</a>
        <a href="../teacher/main.php?reques=5112">My Profile</a>
        <a href="../teacher/main.php?reques=5113">About</a>
      </div>
    </div>
      
      <div class="dropdown">
      <img src="./forum/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
    </header>
<link href="./forum/querynew.css?ts=<?=time()?>" rel="stylesheet">





<script>

function myfunc() {
	var alp1=document.getElementById("a11");
	var alp2=document.getElementById("a12");
	var alp3=document.getElementById("file1");
	var filePath=alp3.value;
	var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf|\.txt|\.doc|\.docx)$/i;
	
if(alp1.value.trim()==""||alp1.value.trim()==null) {
    document.getElementById("alpha1").style.visibility="visible";
	 return false;
}else{
	if(alp2.value.trim()==""||alp2.value.trim()==null) {
    document.getElementById("alpha2").style.visibility="visible";
	 return false;
	}else{ if(alp3.files.length!=0){
		if(!allowedExtensions.exec(filePath)){
        
		document.getElementById("abd").style.color="red";
        alp3.value = '';
        return false;
            }else{ 
				  return true;  
				}			
	      }else{
	        return true;
			}
	}	
}

	
	
}


function fxn(){
	var alp4=document.getElementById("file1");
	var filePatha=alp4.value;
	var filePATHA=filePatha.split("\\").pop();
	 if(alp4.files.length!=0){
		 document.getElementById("abe").innerHTML=filePATHA;
		 document.getElementById("abe").style.visibility="visible";
		 document.getElementById("abee").style.visibility="hidden";
	 }
	
}

</script>


<?php

$mysql2="SELECT `descussiont_id`, `authort`, `titlet`, `contentt`, `file_addr` FROM `disscussions_t` WHERE `descussiont_id`=?";

$stmt2=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt2,$mysql2)){
					 mysqli_stmt_bind_param($stmt2,"i",$getidtoup);
					 mysqli_stmt_execute($stmt2);
	   $result_post=mysqli_stmt_get_result($stmt2);
	     if($result_post1=mysqli_fetch_assoc($result_post)){
		   $get_id1=$result_post1['descussiont_id'];
		   $get_user1=$result_post1['authort'];
		   $get_title1=stripslashes($result_post1['titlet']);
		   $get_post1=stripslashes($result_post1['contentt']);
		   $get_addr1=$result_post1['file_addr'];
		   
		   
?>


<div class="abc">
<p> Start new disscussion</p>
<form   onsubmit="return myfunc();" method="post" action="<?php echo $current_page.'?req1=2115&&bd='.$getidtoup; ?>" enctype="multipart/form-data">

<p>Title:<label id="alpha1" style="color:red; visibility:hidden;">please fill </label></p>
<input type="text" name="title" placeholder="Write here" value="<?php echo $get_title1; ?>"id="a11">

<p>Description:<label id="alpha2" style="color:red; visibility:hidden;">please fill </label></p>
<textarea name="description" placeholder="Descibe here" id="a12"><?php echo  $get_post1;?></textarea><br>

<h1 id="abd">only images,pdf,text files,docx<label id="abee" style="color:red; visibility:visible;">(attached file:<?php if($get_addr1==null){echo "no file attached";}else{ echo "file attached you can rechange it";} ?> )</label><p id="abe" style="color:red; visibility:hidden;"></p></h1>





<div class="fileinputs">
<input type="file"  id="file1" name="fileattach" onchange="fxn();" accept="image/*,.pdf,text/*">
<div class="fakefile">
		<img src="./forum/uploadnew.png" />
	</div>
</div>
 


<input type="submit" name="subpost" value="RePost"> 
 </form>

</div>
		 <?php }}?>
<!--  this division will be used to get titles from the server-->



</body>
 </html>
 <?php }else{
		echo "url incorrect";
	}
}?>