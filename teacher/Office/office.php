<html>
<head>
  <link href="./office/office.css" rel="stylesheet">
  <link href="jquery.js">
<script src="jquery.js">
</script>
<script>
 function application(){
	    var to=$('#to').val();
		if(to.trim()!=''){
			var sub=$('#subject').val();
			if(sub.trim()!=''){
				var text=$('#text').val();
				if(text.trim()!=''){
					$.ajax({
				type:'post',
				url:'./office/officeup.php',
				data:{
					to:to,
                    sub:sub,
					text:text,
					user:'<?php echo $_SESSION['user_name'];?>'
				},success: function(response){
					alert(response);
					if(response=='success'){
			          $('#result').text('application sent');
			           $('#result').css({'visibility':'visible','color':'red'});
					   $('#to').prop('disabled',true);
					   $('#subject').prop('disabled',true);
					   $('#text').prop('disabled',true);
					   $('#subm').prop('disabled',true);
					   
					}else{
						$('#result').text('something is wrong');
			            $('#result').css({'visibility':'visible','color':'red'});
						$('#result').css({'visibility':'visible','color':'red'});
					    $('#to').prop('disabled',true);
					    $('#subject').prop('disabled',true);
					    $('#text').prop('disabled',true);
					    $('#subm').prop('disabled',true);
					}
				}
				
				
			});
				}else{
					$('#textlabel').text('please fill');
			        $('#textlabel').css({'visibility':'visible','color':'red'});
				}
			
			}else{
				$('#sublabel').text('please fill');
			    $('#sublabel').css({'visibility':'visible','color':'red'});
			}
			
		}else{
			$('#tolabel').text('please fill');
			$('#tolabel').css({'visibility':'visible','color':'red'});
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
      <img src="./office/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php?reque=4111">Contact Office</a>
      </div>
    </div>
<fieldset><legend> Contact Office</legend>
<p class="title"> If you have any Query then feel free to share with us</p>
<div class="content">
<input type="text" placeholder="To" id="to"><label id="tolabel"></label><br><br>
<input type="text" placeholder="Subject" id="subject"><label id="sublabel"></label><br><br>
<textarea rows="8" cols="50" placeholder="Query" id="text"></textarea><label id="textlabel"></label>
</div>
<br>
<input type="submit" value="Submit" onclick="application();"id="subm">
<label id='result'></label>
</fieldset>

    </body>
    </html>
