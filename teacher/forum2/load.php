<html>
<link href="./forum2/mydisscussion2.css?ts=<?=time()?>" rel="stylesheet">
<link href="./forum2/jquery.js">

<script src="./forum2/jquery.js">
</script>

<script>  // here is jquery code to load more posts
     function fanc(beta){
			$("#dela").load("./forum2/del.php",{
				idpro: beta
			});
			return true;
		} 
		</script>
<?php 
require "db_connec1.php";

$postNewLimit=$_POST['postnewcount'];
$session_user=$_POST['sessionuser'];
	
     $my_sql3="SELECT * FROM `disscussions_t` WHERE authort = '$session_user' ORDER BY `descussiont_id` DESC LIMIT $postNewLimit";
     $sql_query=mysqli_query($mysql_connect1,$my_sql3);
	 if($sql_query){
		 
		  
	 while($query_execute2=mysqli_fetch_assoc($sql_query)){
	 $des_user_ida=$query_execute2['descussiont_id'];
	 $des_user_namea=$query_execute2['authort'];
	 $des_user_datea=$query_execute2['date_postedt'];
	 $des_user_titlea=$query_execute2['titlet'];

		
?>
  

  <a href="./main.php?req1=2114&&id=<?php echo $des_user_ida;?>"><div class="inpost">
		<p class="title">Title:<?php echo $des_user_titlea; ?></p>
		<p class="by"> Posted by:<?php  echo $des_user_namea;?> </p><br>
		<p class="date"> Date:<?php echo $des_user_datea; ?></p>
		<p class="desc"> Description:<?php echo $query_execute2['contentt']; ?></p>
		 <div class="options">
      <a class="edit" href="./main.php?req1=2115&&bd=<?php if(isset($des_user_ida)){echo $des_user_ida;}?>">Edit Post</a>
      <a class="delete" href="./main.php?req1=2113" onclick="return fanc(<?php echo $des_user_ida?>);" id="dela">Delete Post</a>
</div>
</div></a>


<?php
     if($des_user_ida==1){
		 echo "<script>document.getElementById('btnm1').style.visibility = 'hidden';</script>";
		 echo "<center>you have reached end of the posts</center>";
	    }
	   }// end of while
		   
   }

?>
</div>

</html>