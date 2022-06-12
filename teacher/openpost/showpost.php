<?php
require "db_connec1.php";
if(isset($_GET['id'])){
$id=$_GET['id'];
$req=$_GET['req1'];
}
$session_user=$_SESSION['user_name'];
?>

<html>
<head>
<link href="./openpost/openpost.css?ts=<?=time()?>" rel="stylesheet">
<link href="./openpost/jquery.js">

<script src="./openpost/jquery.js">
</script>


<script>

  function fanceditcomment(iddata,cid,ccomment){ // update comment / edit comment
	   
	   
	  
	  document.getElementById(iddata).innerHTML='<div id="alphacomment">'+
'<form method="POST" action="#" onsubmit=" return commentupdatea('+cid+','+iddata+');">'+
'<textarea rows="3" cols="80" placeholder="Write your comment..." style="resize: none;" id="aacomment">'+ccomment+'</textarea>'+
'<br>'+
'<input type="submit" value="update Comment" id="aasubmit">'+
'</form>'+
'</div>'; 

	     
	  return false;
  }
  
  function commentupdatea(cida,idata) {			 // to comment posted get
	      
	  var upcomment=document.getElementById('aacomment').value; 
	  if(upcomment){
	  $.ajax({
		  
		    type: 'post',
			url: './openpost/upcomment.php',
			data:{
				user_commenta:upcomment,
				reply_id:cida
			},success: function(response){
				//document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
				//document.getElementById("alphacomment").style.display="none";
				//document.getElementById("alphacomment").style.visibility="hidden";
				window.location.reload(true); 
			}
		  });
	  
	  }else{} 
	  return false;
	  
	   
   } 
  
  function fanccommentdel(betab){                  // to delete  comment
			$("#delcomment").load("./openpost/delcomment.php",{
				idpro: betab
			});
			window.location.reload(true); 
			return false;
		}
		
	function fanc(beta){           // to   delete  post
			$("#dela").load("./openpost/del.php",{
				idpro: beta
			});
			return true;
		}

   function commentup() {           // to comment posted get
	  var comment=document.getElementById('acomment').value; 
	  if(comment){
	  $.ajax({
		  
		    type: 'post',
			url: './openpost/postcomment.php',
			data:{
				user_comment:comment,
				user_name:'<?php echo $session_user;?>',
				discussion_id:<?php echo $id;?>
			},success: function(response){
				document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
				document.getElementById("acomment").value="";
			}
		  });
	  
	  }else{
		  return false;
	  }
	  
	   return false;
   }



</script>
</head>

<body>
<!--upper menu part-->	
  <div class="bar">
  <p> University Institute Of Information Technology</p>
  <div class="nav">
        <a href="./main.php">Home</a>
        <a href="../teacher/main.php?reques=5112">My Profile</a>
        <a href="../teacher/main.php?reques=5113">About</a>
      </div>
    </div>
      <div class="dropdown">
      <img src="./openpost/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
	
	
	
	
<!--create disscussion part-->	
<div class="new">
  <p> To start new Discussion</p>
  <button type="button" onclick="location.href='../teacher/main.php?req1=2112'"> <!--onclick location.href-->Create Discussion</button>
</div>


<!--post discussion-->	
<?php
$my_sql1="SELECT *FROM `disscussions_t`  WHERE `descussiont_id` = $id";
     $sql_query1=mysqli_query($mysql_connect1,$my_sql1);
	 if($sql_query1){
		  $query_execute1=mysqli_fetch_assoc($sql_query1);
		  
		  
		  
		  $des_user_idb=$query_execute1['descussiont_id'];
	      $des_user_nameb=$query_execute1['authort'];
	      $des_user_dateb=$query_execute1['date_postedt'];
	      $des_user_titleb=stripslashes($query_execute1['titlet']);
		  $des_user_desb=stripslashes($query_execute1['contentt']);
		  $des_user_addrb=$query_execute1['file_addr'];
?>
<div class="inpost">
		<p class="title"><?php echo $des_user_titleb;?></p>
		<p class="by"> Posted By:<?php echo $des_user_nameb;?></p>
		<p class="date">Date: <?php echo $des_user_dateb;?></p>
		<p class="desc">  <?php echo $des_user_desb;?></p>
		<?php if($des_user_addrb!=null){  ?>
    <div class="dlink">
    <a class="delete" href="<?php echo  '../login/'.$des_user_addrb;?>" download="attachedfile">Download attached files</a>
    </div> <?php 
		}?>
    <div class="cpng">
      <img src="./openpost/comment.png" onclick="show()">
</div>
<div id="visible">
<form method="POST" action="" onsubmit="return commentup();">
<textarea rows="3" cols="80" placeholder="Write your comment..." style="resize: none;" id="acomment"></textarea>
<br>
<input type="submit" value="Post Comment" id="asubmit">
</form>
</div>


<div id="all_comments"><!--this is purposely here to increase comments-->

<?php

 $sqlquery3="SELECT `replyt_id`, `disscusiont_id`, `authort`, `commentt`, `date_postedt` FROM `replies_t` WHERE `disscusiont_id`=? ORDER BY `replyt_id` DESC";
	 $stmt3=mysqli_stmt_init($mysql_connect1); 
	  if(mysqli_stmt_prepare($stmt3,$sqlquery3)){
	   mysqli_stmt_bind_param($stmt3,"i",$id);
	   mysqli_stmt_execute($stmt3);
	   $result_comment=mysqli_stmt_get_result($stmt3);
       while($result_comment1=mysqli_fetch_assoc($result_comment)){
		   $get_id1=$result_comment1['replyt_id'];
		   $get_user1=$result_comment1['authort'];
		   $get_comment1=stripslashes($result_comment1['commentt']);
		   $get_date1=$result_comment1['date_postedt'];
  
  ?>
<div class="comments" id="<?php echo 'comid'.$get_id1;?>">
  <p><?php echo $get_comment1;?></p>
  <span class="min"> Posted by:<?php echo $get_user1;?> </span>
  <span class="min"> Date:<?php echo $get_date1;?></span>
  
  <?php if($session_user==$get_user1){ // to check if the posted comment is of given user if yes the give access him to edit and delete?>
  <div class="options">
    <a class="edit" href="<?php echo $current_page.'?req1='.$req.'&&id='.$id?>" onclick="return fanceditcomment('<?php echo 'comid'.$get_id1;?>',<?php echo $get_id1; ?>,'<?php echo $get_comment1;?>');">Edit Comment</a>
    <a class="delete" href="" onclick="return fanccommentdel(<?php echo $get_id1; ?>);" id="delcomment">Delete Comment</a>
  </div> <?php }?>
</div>
<?php
	  }
	  }
          ?>
</div>

</div>

<?php if($session_user==$des_user_nameb){ // here is the if to check if the showed post if of user then give acess to edit and delete?>
<div class="dropdown2">
<img src="./openpost/dots.png">
<div class="drop2">
  <a href="./main.php?req1=2115&&bd=<?php if(isset($des_user_idb)){echo $des_user_idb;}?>">Edit Post</a>
  <a href="./main.php?req1=2113" onclick="return fanc(<?php echo $des_user_idb; ?>);" id="dela">Delete Post</a>
</div>
</div>
<?php
}
	 }else{
		 echo "no success";
	 }
?>


</body>
<script>
  function show(){
    document.getElementById("visible").style.display="block";
  }
</script>
</html>