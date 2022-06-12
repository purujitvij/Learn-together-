<?php
require "db_connec1.php";
//this page is used to retrive posts
?>



<html>
<head>
<link href="./forum1/layout.css?ts=<?=time()?>" rel="stylesheet">
<link href="./forum1/jquery.js">
<script src="./forum1/jquery.js">
</script>

<script>  // here is jquery code to load more posts
     
    $(document).ready(function (){
		var postcount = 2;
		$("#btnm1").click(function(){
			postcount = postcount +2;
			$("#posts1").load("./forum1/load.php", {
				postnewcount: postcount
				
			});
		});
	});
	
</script>


</head>
<body>
  <body>
  <div class="bar">
  <p> University Institute Of Information Technology</p>
  <div class="nav">
        <a href="../teacher/main.php">Home</a>
        <a href="../teacher/main.php?reques=5112">My Profile</a>
        <a href="../teacher/main.php?reques=5113">About</a>
      </div>
    </div>
     
      <div class="dropdown">
      <img src="./forum1/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
	
	
<p class="titlep"> Welcome to Forums</p>
<button class="btnmy" type="button" onclick="location.href='../teacher/main.php?req1=2113'"> <!--onclick location.href-->My Discussions</button>
<div class="new">
  <p> To start new Discussion</p>
  <button type="button" onclick="location.href='../teacher/main.php?req1=2112'"> <!--onclick location.href-->Create Discussion</button>
  </div>
  
<div class="postss" id="posts1">  
<?php 
$my_sql2='SELECT MAX(`descussiont_id`) FROM `disscussions_t`'; // this query is to fetch highest desscussion id to be displayed
     $result=mysqli_query($mysql_connect1,$my_sql2);
	 $row = mysqli_fetch_row($result);
    $highest_id = $row[0];
	
	
     $my_sql3='SELECT * FROM `disscussions_t` ORDER BY `descussiont_id` DESC LIMIT 2';
     $sql_query=mysqli_query($mysql_connect1,$my_sql3);
	 if($sql_query){
		 
			 
		  
	 while($query_execute2=mysqli_fetch_assoc($sql_query)){
	 $des_user_ida=$query_execute2['descussiont_id'];
	 $des_user_namea=$query_execute2['authort'];
	 $des_user_datea=$query_execute2['date_postedt'];
	 $des_user_titlea=stripslashes($query_execute2['titlet']);
		/*echo $des_user_ida; 
		echo $des_user_namea;
		echo $des_user_datea;
		echo $des_user_titlea; */
		
?>
  

  <a href="./main.php?req1=2114&&id=<?php echo $des_user_ida;?>"><div class="inpost">
		<p class="title">Title:<?php echo $des_user_titlea; ?></p>
		<p class="by"> Posted by:<?php  echo $des_user_namea;?> </p>
		<p class="date"> Date:<?php echo $des_user_datea; ?></p>
		<p class="desc"> Description:</p>
</div></a>
<?php
     if($des_user_ida==1){
		 
		 echo "<center>you have reached end of the posts</center>";
	    }
	   }// end of while
		   
   }

?>
</div>
<button type="button" id="btnm1" class="btnm11">show more posts</button>
 
</body>
</html>
