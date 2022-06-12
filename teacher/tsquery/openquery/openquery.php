<html>
<head>
<link href="./tsquery/openquery/openquery.css?ts=<?=time()?>" rel="stylesheet">
<link href="jquery.js">
<script src="jquery.js">
</script>
<script>
function fanc(beta){
			$("#dela").load("./tsquery/openquery/del.php",{
				idp: beta
			});
			return true;
		}
		
 function comup(id){
	    var comment=$('#text-c').val();
		if(comment.trim()!=''){
			$.ajax({
				type:'post',
				url:'./tsquery/openquery/com.php',
				data:{
					comment: comment,
					id:id
				},success: function(response){
					//alert(response);
					if(response=='success'){
						location.reload(false);
					}else{
						$('#text-label').text('something is wrong');
			            $('#text-label').css({'visibility':'visible','color':'red'});
					}
				}
				
				
			});
		}else{
			$('#text-label').text('please fill');
			$('#text-label').css({'visibility':'visible','color':'red'});
		}
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
      <img src="./tsquery/openquery/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
    <input type="button" class="myq" value="My Queries" onclick="location.href='./main.php?requ=3111'"> <!--onclick="window.location.href=''"-->
<?php	
	 $id=$_GET['id'];
     $mysql_host='localhost';
	  $mysql_user='abhishek';
	  $mysql_password='1234567890';
	  $mysql_db='tsquery';
	  
	  $mysql_connect=mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	  
	     $user=$_SESSION['user_name'];
	  
	  if (@mysqli_connect_errno()) {
         printf("Connect failed: %s\n", mysqli_connect_error());
	    }else{
	       $sql="SELECT `queryid`, `title`, `query`, `askedfrom`, `askedby`, `datetime`, `reply` FROM `query` WHERE  `queryid`=".$id." AND `askedfrom`= '$user'";
	       $sqlrun=mysqli_query($mysql_connect,$sql);
		   $res=mysqli_fetch_assoc($sqlrun);
		   if($res){ 
		   ?>
<div class="inpost">
		<p class="title"><?php echo stripslashes($res['title']); ?></p>
		<p class="by"> Sent By:<?php echo $res['askedby'];?></p>
		<p class="date"<?php echo $res['datetime']; ?>></p>
		<p class="desc"><?php echo stripslashes($res['query']); ?></p>
    <div class="options">
      <a class="delete" href="../main.php?requ=3111" onclick="return fanc(<?php echo $res['queryid']; ?>);" id='dela'>Delete Query</a>
	  
</div>

<?php
if($res['reply']){
 $sql1="SELECT `queryreplyid`, `queryid`, `content`, `datetime` FROM `queryreply` WHERE `queryid`=".$id;
	       $sqlrun1=mysqli_query($mysql_connect,$sql1);
		   $res1=mysqli_fetch_assoc($sqlrun1);	

?> 
<div class="comments">
  <p><?php echo stripslashes($res1['content']); ?> </p>
  <span class="min">Replied To :<?php echo $res['askedby'];?></span>
  <span class="min"><?php echo $res1['datetime']; ?></span>
</div>
<?php
    }else{
	?>
  <div class="comments">
  <p>No reply yet</p>
  <span class="min"></span>
  <span class="min"></span>
  </div>
  
<div id="visible">
<textarea rows="4" cols="80" style="resize:none" id="text-c"></textarea><label id="text-label"></label>
<br>
<input type="button" value="Reply" id='com' onclick="comup(<?php echo $res['queryid']; ?>);">
</div>
</div>
<?php
    }

		}else{
			echo'url not found';
			}
		}
?>
</body>
</html>
