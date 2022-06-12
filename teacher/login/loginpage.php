<html>
<head>
<title>Teacher login</title>
<link rel="stylesheet" type="text/css" href="./login/loginpage1.css?ts=<?=time()?>">
<link href="../login/jquery.js">
<script src="./login/jquery.js">
</script>




<?php 
$mysql_host='localhost';
$mysql_user='abhishek';
$mysql_password='1234567890';
$mysql_db='users';
   $mysql_connect=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
   if(isset($_POST['submit'])){     // to check if form is submitted or not
   if(isset($_POST['username'])&&isset($_POST['password'])){ // to check usrname and check password are recieved or not
  ?>
  <script>
  //  alert('hahaha');
  </script>
  <?php
    $user_name=$_POST['username'];
	$user_name=mysqli_real_escape_string($mysql_connect,$user_name); 
    $user_pass=$_POST['password'];
	$user_pass=mysqli_real_escape_string($mysql_connect,$user_pass);
     
     
	 if(!empty($user_name)&&!empty($user_pass)){  // to check if they empty in any case
		$my_sql='SELECT `user_name_t` , `user_pass`, `teach_name`, `phoneno` FROM `teac_user` WHERE `user_name_t`= ?';
				$stmt=mysqli_stmt_init($mysql_connect); 				 // sql work started
				 if(mysqli_stmt_prepare($stmt,$my_sql)){
					 mysqli_stmt_bind_param($stmt,"s",$user_name);
					 mysqli_stmt_execute($stmt);
					 $res=mysqli_stmt_get_result($stmt);
					 $no= mysqli_num_rows($res);
					 //echo $no['user_name_t'];
					 if($no){
						 if($row=mysqli_fetch_assoc($res)){
							// echo $row['user_name_t'];
							 //echo $row['user_pass'];
							 //echo $row['teach_name'];
							 $password_check=password_verify($user_pass,$row['user_pass']);
							 if($password_check==false){
								  ?>
							 <script>
							 alert('username/password wrong');
							 </script>
							 <?php
							 }else{
								 
								 $_SESSION['user_name']=$row['user_name_t'];
								 $_SESSION['name']=$row['teach_name'];
								 $_SESSION['phoneno']=$row['phoneno'];
								 
								 ?>
							 <script>
							    location.reload();
							 </script>
							 <?php
							 }
						 }else{
							 ?>
							 <script>
							 alert('server unreachable');
							 </script>
							 <?php
						 }
						
					 }else{
						 ?>
							 <script>
							 alert('username/password wrong');
							 </script>
							 <?php
					 }
		   
				 }else{}
	 
}else{   if(empty($user_name)&&empty($user_pass)){    // if username or password are empty then
	         ?>
    <script>
	    $('#pass-label').text('fill');
        $('#pass-label').css({'visibility':'visible','color':'red'});
		$('#user-label').text('fill');
        $('#user-label').css({'visibility':'visible','color':'red'});	
	</script>
	
	<?php
			}
		  }
	 }else{
		?>
    <script>
	    $('#pass-label').text('fill');
        $('#pass-label').css({'visibility':'visible','color':'red'});
		$('#user-label').text('fill');
        $('#user-label').css({'visibility':'visible','color':'red'});	
	</script>
	
	<?php
	 }
}else{?>
    <script>
	//alert('hh');
	// here to put something before the loading of page
	</script>
	
	<?php
}
   unset($_POST['submit']);
?>



<body>

<script>
$(document).ready(function(){
 $('#user,#pass').on('change',function(){
	   $('#pass-label').css({'visibility':'hidden'});
	   $('#user-label').css({'visibility':'hidden'});
    });	
 });
 
 function onsub(){
	 //return true;
	 var user=$("#user").val();
	 if(user.trim()!=''){
		 var pass=$('#pass').val();
		if(pass.trim()!=''){
		    return true;	
		}else{
		$('#pass-label').text('fill');
        $('#pass-label').css({'visibility':'visible','color':'red'});	
		} 
	 }else{
	     $('#user-label').text('fill');
         $('#user-label').css({'visibility':'visible','color':'red'});		
	 }
	 return false;
 }
 
 

</script>
     <div class="loginbox"> 
	 <img src="./login/loginuser-min.jpg" class="avatar">
	  <h1>Teacher Log In </h1>
	  <form method="POST" action="<?php echo $current_page; ?>" onsubmit="return onsub()">
	       <p>Username <label id='user-label'></label></p>
		   <input type="text" name="username" id="user">
		   
		   <p>Password <label id='pass-label'></label></p>
		   <input type="password" name="password" id="pass">
		   
		   <input type="submit" name="submit" value="Log In">
		   
		   <a href="">Lost your password?</a> </br>
		   <a href="http://localhost/project1/teacher/register/tregistration.php">Don't have an account?</a>
	  </form>	   
	 </div>

</body>
</head>
</html>
