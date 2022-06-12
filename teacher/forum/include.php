<?php
require "db_connec1.php";
// this page used to post

if(isset($_POST['subpost'])){

	if(isset($_POST['title'])&&isset($_POST['description'])){ // getting values of title and description 
	 $post_title=$_POST['title'];
	 $post_title=mysqli_real_escape_string($mysql_connect1,$post_title); 
	 
     $post_description=$_POST['description'];
	 $post_description=mysqli_real_escape_string($mysql_connect1,$post_description);
	  
      if(isset($_FILES['fileattach'])){  // to check if file is uploaded or not if uploaded then this statement otherwise
		  if($_FILES['fileattach']['size']!=0){//to check if filee is empty or not // if  not empty then this
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
				 move_uploaded_file($fileTmpName,'../login'.$fileDestination);
				 
				$my_sql='INSERT INTO `disscussions_t`(`authort`, `titlet`, `contentt`, `file_addr`, `date_postedt`) VALUES (?,?,?,?,NOW())';
				$stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"ssss",$_SESSION['user_name'],$post_title,$post_description,$fileDestination);
					 mysqli_stmt_execute($stmt);
					 header('location:'.$current_page.'?req=2111');
				
				 }else{
					echo "sql error"; 
				 }
			 }
		  }
		  
		  
		  
		  
	    }else{ // if file not uloaded
			
			$my_sql='INSERT INTO `disscussions_t`(`authort`, `titlet`, `contentt`, `date_postedt`) VALUES (?,?,?,Now())';
			       $stmt=mysqli_stmt_init($mysql_connect1); 				 // sql work started
				    if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"sss",$_SESSION['user_name'],$post_title,$post_description);
					 mysqli_stmt_execute($stmt);
					 header('location:'.$current_page.'?req=2111');
				
				 }else{
					echo "sql error"; 
				 }
		  
	    }
	}
    }
}

?>
<html>
<head>
  <link href="./forum/queryfirst.css?ts=<?=time()?>" rel="stylesheet">
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
		 document.getElementById("abe").style.visibility="visible"
	 }
	
}

</script>





<div class="abc">
<p> Start new disscussion</p>
<form   onsubmit="return myfunc();" method="post" action="<?php echo $current_page.'?req1=2112'; ?>" enctype="multipart/form-data">

<p>Title:<label id="alpha1" style="color:red; visibility:hidden;">please fill </label></p>
<input type="text" name="title" placeholder="Write here" id="a11">

<p>Description:<label id="alpha2" style="color:red; visibility:hidden;">please fill </label></p>
<textarea name="description" placeholder="Descibe here" id="a12"></textarea><br>

<h1 id="abd">only images,pdf,text files<p id="abe" style="color:red; visibility:hidden;"></p></h1>





<div class="fileinputs">
<input type="file"  id="file1" name="fileattach" onchange="fxn();" accept="image/*,.pdf,text/*">
<div class="fakefile">
		<img src="./forum/uploadnew.png" />
	</div>
</div>
 


<input type="submit" name="subpost" value="Post"> 
 </form>

</div>

<!--  this division will be used to get titles from the server-->



</body>
 </html>


