<html>
<link href="./forum1/layout.css" rel="stylesheet">
<?php 
require "db_connec1.php";

$postNewLimit=$_POST['postnewcount'];

$my_sql2='SELECT MAX(`descussiont_id`) FROM `disscussions_t`'; // this query is to fetch highest desscussion id to be displayed
     $result=mysqli_query($mysql_connect1,$my_sql2);
	 $row = mysqli_fetch_row($result);
    $highest_id = $row[0];
	
	
     $my_sql3="SELECT * FROM `disscussions_t` ORDER BY `descussiont_id` DESC LIMIT $postNewLimit";
     $sql_query=mysqli_query($mysql_connect1,$my_sql3);
	 if($sql_query){
		 
		  
	 while($query_execute2=mysqli_fetch_assoc($sql_query)){
	 $des_user_ida=$query_execute2['descussiont_id'];
	 $des_user_namea=$query_execute2['authort'];
	 $des_user_datea=$query_execute2['date_postedt'];
	 $des_user_titlea=$query_execute2['titlet'];
		/*echo $des_user_ida; 
		echo $des_user_namea;
		echo $des_user_datea;
		echo $des_user_titlea; */
		
?>
  

  <a href="./main.php?req1=2114&&id=<?php echo $des_user_ida;?>"><div class="inpost">
		<p class="title">Title:<?php echo $des_user_titlea; ?></p>
		<p class="by"> Posted by:<?php  echo $des_user_namea;?> </p>
		<p class="date"> Date:<?php echo $des_user_datea; ?></p>
		<p class="desc"> Description: <?phpecho $query_execute2['contentt'];?></p>
</div></a>
<?php
     if($des_user_ida==1){
		 echo "<script>document.getElementById('btnm1').style.visibility = 'hidden';</script>";
		 echo "<center>you have reached end of the posts</center>";
	    }
	   }// end of while
		   
   }

?>
</html>