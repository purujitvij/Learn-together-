<html>
<head>
  <link href="./notifications/notifications.css" rel="stylesheet">
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
      <img src="./notifications/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
    <p class="title"> My Notifications</p>
    <div class="bar2"></div>
    <br><br>
	<?php
	$session_user=$_SESSION['user_name'];
	$mysql_host='localhost';
    $mysql_user='abhishek';
    $mysql_password='1234567890';
    $mysql_db='office';
    $mysql_connect1=@mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	$my_sql="SELECT * FROM `notifications` ORDER BY `id` DESC LIMIT 5";
     $sql_query=mysqli_query($mysql_connect1,$my_sql);
	 if($sql_query){
		 while($query_execute2=mysqli_fetch_assoc($sql_query)){
			 $title=stripslashes($query_execute2['textnote']);
			 $addr=$query_execute2['fileaddr'];
	?>
	<?php  if(isset($addr)){?><a href='<?php if(isset($addr)){echo '../office/notificationsupload/'.$addr; } ?>' download><?php }?>
    <div class="noti">
      <p><?php echo $title; ?>
      </p>
        <p class="date"><?php echo $query_execute2['date']; ?></p>
	</div></a><?php ?>
		<br>
		<?php
	 } }
		?>
    </body>
    </html>
