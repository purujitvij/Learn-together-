<?php
// to generate a ref id for to cnfirm that teacher is the one who has registered

?>
<html>
<head>
	<link href="./teacherregis/style.css" rel="stylesheet">
<title></title>

<link href="./teacherregis/jquery.js">
<script src="./teacherregis/jquery.js"></script>
<script>
$("#first-n,#last-n,#phone").on('change', function() { // on change of everything
		$("#first-label").css({'visibility':'hidden'});
		$("#last-label").css({'visibility':'hidden'});
		$("#phone-label").css({'visibility':'hidden'});
		$("#result").css({'visibility':'hidden'});
        });

function onsub(){
	var first_value=$("#first-n").val();
	if(first_value.trim()!=''){
		var last_value= $("#last-n").val();
	    if(last_value.trim()!=''){
		  var phone_value= $("#phone").val();
		  if(phone_value.trim()!=''){
			  if (isNaN(phone_value)){
				  $("#phone-label").text("wrong phone");
				  $("#phone-label").css({'visibility':'visible','color':'red'}); 
			  }else{
				  if(phone_value.length==10){
					  $.ajax({
						  type:'post',
						  url:'./teacherregis/uploadregis.php',
						  data:{
							  first:first_value,
							  last:last_value,
							  phone:phone_value
						  },success: function(response){
                             $("#result").text("wrong phone");
					         $("#result").css({'visibility':'visible','color':'red'});
							  alert(response);
						  }

					  });
				  }else{
					   $("#phone-label").text("wrong phone");
					   $("#phone-label").css({'visibility':'visible','color':'red'}); 
				  }
				  
			  }
		    }else{
				$("#phone-label").text("please fill");
			    $("#phone-label").css({'visibility':'visible','color':'red'}); 
			}
		}else{
			$("#last-label").text("please fill");
			 $("#last-label").css({'visibility':'visible','color':'red'}); 
		}
	}else{
		$("#first-label").text("please fill");
		 $("#first-label").css({'visibility':'visible','color':'red'}); 
	}
	return false;
}
</script>
</head>
<body>
	<div class="bar">
<p> University Institute Of Information Technology</p>
<div class="nav">
			<a href="./main.php">Home</a>
			<a href="#">About</a>
		</div>
	</div>
		<div class="dropdown">
		<img src="./teacherregis/dropArrow.png">
		<div class="drop">
			<a href="logout.php">Sign Out</a>
		</div>
	</div>
    <form method="post" onsubmit="return onsub();" method="#">
	<h1>Teacher's ID Registration</h1>

    <p>First Name:
    <input type="text" placeholder="First Name" id="first-n"><label id="first-label"><label></p>

     <p>Last Name:
     <input type="text" placeholder="Last Name" id="last-n"><label id="last-label"></label></p>

	 <p>Your Phone Number:
     <input type="text" placeholder="Phonenumber" id="phone"><label id="phone-label"></label></p>
<br>
	 <input type="submit" value="Generate ID" id="sub">
	 <span><label id="result"></label></span>
	</form>
</body>
</html>
