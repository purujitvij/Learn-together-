<html>
<head>
<link href="./tsquery/newquery/querypost.css" rel="stylesheet">
<link href="jquery.js">
<script src="jquery.js">
</script>
<script>
function fanc(beta){
			$("#dela").load("./tsquery/newquery/del.php",{
				idp: beta
			});
			location.reload(false);
			return true;
		}
</script>

</head>
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
      <img src="./tsquery/newquery/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
<p class="titlep">My Queries</p>


<?php

 $mysql_host='localhost';
	  $mysql_user='abhishek';
	  $mysql_password='1234567890';
	  $mysql_db='tsquery';
	  
	  $mysql_connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	  
	     $user=$_SESSION['user_name'];
		
	  
	  if (@mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
	    }else{
	       $sql="SELECT `queryid`, `title`, `query`, `askedfrom`, `askedby`, `datetime`, `reply` FROM `query` WHERE `askedfrom`='$user'";
	       $sqlrun=mysqli_query($mysql_connect,$sql);
		   while($res=mysqli_fetch_assoc($sqlrun)){
	?>


  <a href="./main.php?requ=3112&&id=<?php echo $res['queryid'];?>"><div class="inpost">
		<p class="title"><?php echo stripslashes($res['title']); ?></p>
		<p class="date"> <?php echo $res['datetime']; ?></p>
		<p class="desc"><?php echo stripslashes($res['query']); ?> </p>
		<p class="by">Sent by:<?php echo $res['askedby'];?></p>
    <div class="options">
      <a class="delete" href="./main.php?requ=3111" onclick="return fanc(<?php echo $res['queryid']; ?>);" id='dela'>Delete Query</a>
</div>
<div class="dlink">
</div>
</div>
</a>
<br>
<br>
<?php
		}}
?>
</body>
</html>
