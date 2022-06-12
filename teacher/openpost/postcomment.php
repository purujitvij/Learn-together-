<link href="./openpost/openpost.css?ts=<?=time()?>" rel="stylesheet">


<?php
require "db_connec1.php";

if(isset($_POST['user_comment'])&&isset($_POST['user_name'])&&isset($_POST['discussion_id'])){
	$comment=$_POST['user_comment'];
	$comment=mysqli_real_escape_string($mysql_connect1,$comment);
	$user= $_POST['user_name'];
	$idaa=$_POST['discussion_id'];
	
	$sqlquery="INSERT INTO `replies_t`(`disscusiont_id`, `authort`, `commentt`, `date_postedt`) VALUES (?,?,?,NOW())";
	$stmt=mysqli_stmt_init($mysql_connect1); 
	 if(mysqli_stmt_prepare($stmt,$sqlquery)){
	   mysqli_stmt_bind_param($stmt,"sss",$idaa,$user,$comment);
	   mysqli_stmt_execute($stmt);
	 }
	 
	 $sqlquery1="SELECT `replyt_id` , `authort`, `commentt`, `date_postedt` FROM `replies_t` WHERE `commentt`=?";
	 $stmt1=mysqli_stmt_init($mysql_connect1); 
	  if(mysqli_stmt_prepare($stmt1,$sqlquery1)){
	   mysqli_stmt_bind_param($stmt1,"s",$comment);
	   mysqli_stmt_execute($stmt1);
	   $result=mysqli_stmt_get_result($stmt1);
	   
	   if($result1=mysqli_fetch_assoc($result)){
		    $get_id=$result1['replyt_id'];
		   $get_user=$result1['authort'];
		   $get_comment=stripslashes($result1['commentt']);
		   $get_date=$result1['date_postedt'];
		   
		  ?>
		  <div class="comments" id="<?php echo 'comid'.$get_id;?>">
  <p><?php echo $get_comment;?></p>
  <span class="min"> Posted by:<?php echo $get_user;?> </span>
  <span class="min"> Date:<?php echo $get_date;?></span>
  <div class="options">
    <a class="edit" href=""onclick="return fanceditcomment('<?php echo 'comid'.$get_id;?>',<?php echo $get_id; ?>,'<?php echo $get_comment;?>');">Edit Comment</a>
    <a class="delete" href="" onclick="return fanccommentdel(<?php echo $get_id1; ?>);" id="delcomment">Delete Comment</a>
</div>
</div>
		  
		  
<?php 
		   
	   }else{}
	   
	   
	 } 
    
}

?>
