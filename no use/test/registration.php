<html>
<head>
<link href="style.css" rel="stylesheet">
<link href="jquery.js">
<script src="jquery.js"></script>
<script>
$("#batch,#roll-no,#branch,#phone-no,#pass-user,#cpass-user").on('change', function() { // on change of batch
		$("#batch-label").css({'visibility':'hidden'});
		$("#branch-label").css({'visibility':'hidden'});
		$("#roll-label").css({'visibility':'hidden'});
		$("#phone-label").css({'visibility':'hidden'});
		$("#pass-label").css({'visibility':'hidden'});
		$("#cpass-label").css({'visibility':'hidden'});
        });


function oncnfrm(){
	
	$('#div-check').text('');
	var batch_value=$("#batch").val();
	if(batch_value!=''){
		var branch_value= $("#branch").val();
	    if(branch_value!=''){
		  var roll_value= $("#roll-no").val();
		  if(roll_value.trim()!=''){
			  if (isNaN(roll_value)){
				  $("#roll-label").text('wrong');
                   $("#roll-label").css({});
              }else{
				 var phone_value= $("#phone-no").val();
			    if(phone_value.trim()!=''){
					if (isNaN(phone_value)){
                      //alert("wrong phone no.");
                    }else{
						if(phone_value.length==10){
						$.ajax({
		  
		                 type: 'post',
			             url: 'checkdata.php',
			             data:{
							 batch:batch_value,
							 branch:branch_value,
							 rollno:roll_value,
							 phoneno:phone_value
				
			            },success: function(response){
							if(response=='user'){
								// username existed
                             $('#div-check').text('Already registered go to login page');								
							}else{
								if(response=='sql'){
							      $('#div-check').text('contact office something wrong');
									// contact office
								}else{
									if(response=='rollno'){
									 $('#div-check').text('Either you are not a student or your data not uploaded contact office');
									  // contact office your data not found	
									}else{
										if(response=='phoneno'){
										$('#div-check').text("Phone no do not match");	
										//no do not match	
										}else{
										$('#div-check').text('confirmed: put your password to register');
										$("#batch").prop('disabled',true);
										$("#branch").prop('disabled',true);
										$("#phone-no").prop('disabled',true);
										$("#roll-no").prop('disabled',true);
										$("#confirm-user").prop('disabled',true);
										
										$('#name-user').text(response);
										$('#roll-no1').val(roll_value);
										$("#pass-user").prop('disabled',false);
										$("#cpass-user").prop('disabled',false);
										$("#sub-user").prop('disabled',false);
										
										}
									}
								}
							}
				           alert(response);
			            }
		                });
						}else{
							$("#phone-label").text('wrong no');
							$("#phone-label").css({'visibility':'visible'});
						}  
				     }
				 
			    }else{
			    $("#phone-label").text('Please fill');
				$("#phone-label").css({'visibility':'visible'});				}
			  }
			 
		  }else{
			  $("#roll-label").text('Please fill');
			  $("#roll-label").css({'visibility':'visible'});
		  }
		   }else{
			$("#branch-label").css({'visibility':'visible'});
		   }
    }else{
		$("#batch-label").css({'visibility':'visible'});
	}
}

function onsub(){
	$("#pass-label").css({'visibility':'hidden'});
	$("#cpass-label").css({'visibility':'hidden'});
	var pass_value=$('#pass-user').val();
	var cpass_value=$('#cpass-user').val();
	var roll_user=$('#roll-no1').val();
	var name_user=$('#name-user').text();
	 if(pass_value.trim()!=''){
		 if(pass_value.length>=8){
		    if(cpass_value.trim()!=''){
			  if(pass_value==cpass_value){
			//alert(name_user);
	        //  alert(roll_user);
            //alert(pass_value);
	        //alert(cpass_value);
			alert(roll_user);
			$.ajax({
				type:'post',
				url:'regisuser.php',
				data:{
				 name:name_user,
				 user:roll_user,
				 pass:pass_value
				},success:function(response1){
					alert(response1);
					if(response1=='success'){
						$("#regis").text("registered succesfully");
					    $("#regis").css({'visibility':'visible'});
						$("#pass-user").prop('disabled',true);
						$("#cpass-user").prop('disabled',true);
						$("#sub-user").prop('disabled',true);
						$('#link').css({'visibility':'visible'});
					}else{
						$("#regis").text('something went wrong try later');
					    $("#regis").css({'visibility':'visible','color':'red'});
						$("#pass-user").prop('disabled',true);
						$("#cpass-user").prop('disabled',true);
						$("#sub-user").prop('disabled',true);
					}
				}
			});
		}else{
			$("#cpass-label").text('password value do not match');
			$("#cpass-label").css({'visibility':'visible','color':'red'});
			//alert('password value not match');
			//password value do not match
			
		}	
			}else{
				$("#cpass-label").css({'visibility':'visible','color':'red'});
				//alert('please fill2');
			}
	    
	 }else{
		 $("#pass_label").text('password length(>8)');
		 $("#pass-label").css({'visibility':'visible','color':'red'});
		// alert('');
		 // if pass not length greater than 8
	 }
	 }else{
		 $("#pass-label").css({'visibility':'visible','color':'red'});
		 //alert('please fill');
		 // please fill password
	 }
	

	return false;
	
}
</script>
</head>
<body>
<form id="form-1" method="post" enctype="multipart/form-data" action="#" onsubmit="return onsub();">
<fieldset>
    <div class="form-group">
	
	
	<p>Batch:
	<select name="batch-year" id='batch'> <!--to select batch year --> 
    <option value=''>--Select year--</option>
	<option value="2015">2015</option>
    <option value="2016">2016</option>
    <option value="2017">2017</option>
    <option value="2018">2018</option>
    <option value="2019">2019</option>
    <option value="2020">2020</option>
    <option value="2021">2021</option>
    <option value="2022">2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
    <option value="2026">2026</option>
    <option value="2027">2027</option>
    <option value="2028">2028</option>
    <option value="2029">2029</option>
    <option value="2030">2030</option>
</select><label style="visibility:hidden; color:red;" id="batch-label">please fill</label>  </p>
	
	<p>
	<p>Branch:
	<select name="branch" id="branch">
	<option value=''>--Select branch--</option>
	<option value="it">It</option>
    <option value="cse">Cse</option>
	</select> <label style="visibility:hidden; color:red;" id="branch-label">please fill</label></p></p>
	
	<p>
	<p>Your rollno:
	<input type='text' style="width:70px;" id="roll-no"></input>
	<label style="visibility:hidden; color:red;" id="roll-label">please fill</label></p></p>
	
	<p>
	<p>your phoneno:
	<input type='text' style="width:150px;" id="phone-no"></input>
	<label style="visibility:hidden; color:red;" id="phone-label">please fill</label></p></p>
	
	<input type="button" value="confirm" onclick="oncnfrm();" id="confirm-user">
	
	<div><p class="" id="div-check"></p></div>
	
	<p>Name:<label class="" id="name-user" style="color:black;"></label>
	<input type='hidden' id="roll-no1" value="">
	</p>
	
	<p>
	<div class="abc">*Password should be more than 8 characters</div>
    <p>Password:
	<input type="password" name="pass" disabled='disabled' id="pass-user">
    <label style="visibility:hidden; color:red;" id="pass-label">please fill</label></p></p>
	 
	 <p>
     <div class="abc">*Confirm your password</div>
    <p>Confirm Password:
    <input type="password" name="cpass" disabled='disabled' id="cpass-user">
    <label style="visibility:hidden; color:red;" id="cpass-label">please fill</label></p></p>
	
    <input type="submit" value="Register" disabled="disabled" id="sub-user">
	<div><p id='regis'></p><a href="#" id="link" style="visibility:hidden;">click here to login</a></div>
	
</fieldset>
</form>
<body>

</html>
