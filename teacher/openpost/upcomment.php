<link href="./openpost/openpost.css?ts=<?=time()?>" rel="stylesheet">


<?php
require "db_connec1.php";

if(isset($_POST['user_commenta'])&&isset($_POST['reply_id'])){
	$comment=$_POST['user_commenta'];
	$comment=mysqli_real_escape_string($mysql_connect1,$comment);
	$user_id= $_POST['reply_id'];
	
	$sqlquery="UPDATE `replies_t` SET `commentt`=?,`date_postedt`=NOW() WHERE `replyt_id`=?";
	$stmt=mysqli_stmt_init($mysql_connect1); 
	 if(mysqli_stmt_prepare($stmt,$sqlquery)){
	   mysqli_stmt_bind_param($stmt,"si",$comment,$user_id);
	   mysqli_stmt_execute($stmt);
	 }
	 
	 $sqlquery1="SELECT `replyt_id` , `authort`, `commentt`, `date_postedt` FROM `replies_t` WHERE `replyt_id`=?";
	 $stmt1=mysqli_stmt_init($mysql_connect1); 
	  if(mysqli_stmt_prepare($stmt1,$sqlquery1)){
	   mysqli_stmt_bind_param($stmt1,"i",$user_id);
	   mysqli_stmt_execute($stmt1);
	   $result=mysqli_stmt_get_result($stmt1);
	   
	   if($result1=mysqli_fetch_assoc($result)){
		    $get_id=$result1['replyt_id'];
		   $get_user=$result1['authort'];
		   $get_comment=$result1['commentt'];
		   $get_date=$result1['date_postedt'];
		   
		  ?>
		  <div class="comments" id="<?php echo 'comid'.$get_id;?>">
  <p><?php echo $get_comment;?></p>
  <span class="min"> Posted by:<?php echo $get_user;?> </span>
  <span class="min"> Date:<?php echo $get_date;?></span>
  <div class="options">
    <a class="edit" href="" onclick="return fanceditcomment('<?php echo 'comid'.$get_id;?>',<?php echo $get_id; ?>,'<?php echo $get_comment;?>');">Edit Comment</a>
    <a class="delete" href="" onclick="return fanccommentdel(<?php echo $get_id1; ?>);" id="delcomment">Delete Comment</a>
</div>
</div>
		  
		  
<?php 
		   
	   }else{}
	   
	   
	 } 
    
}

?>
