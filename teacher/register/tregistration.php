<html>
<head>
  <link rel="stylesheet" href="style.css">
  <link href="jquery.js">
  <script src="jquery.js"></script>
  <script>
   $(document).ready(function(){
      $("#first-n").on('change', function() { // on change of everything
	      $("#first-label").css({'visibility':'hidden'});
        });
		
		$("#last-n").on('change', function() { // on change of everything
	      $("#last-label").css({'visibility':'hidden'});
        });
		
		$("#ref-id").on('change', function() { // on change of everything
	      $("#ref-label").css({'visibility':'hidden'});
        });
		
		$("#user-n").on('change', function() { // on change of username
		   
	      $("#user-label").css({'visibility':'hidden'});
		  var user_value=$('#user-n').val();
		  if(user_value.trim()!=''){
			  if(user_value.trim().split(" ").join("").length>8||user_value.trim().split(" ").join("").length<6){
				  $("#user-label").text('use only 6-8 characters no spaces any spaces will automatically removed');
	              $("#user-label").css({'visibility':'visible','color':'red'});
				  //alert('no 1');
			  }else{
				  user_value=user_value.trim().split(" ").join("");
				 // var show_user=user_value+' jdjj skd';
				  //alert(show_user);
				    //alert(user_value);
				   // alert('no 2');
				  $.ajax({
					type:'post',
                    url:'useavail.php',
                    data:{
						user:user_value
					},success:function(response2){
						if(response2=='exist'){
							var show_user=user_value+' not available';
							 $("#user-label").text(show_user);
	                         $("#user-label").css({'visibility':'visible','color':'red'});
							 $("#pass").prop('disabled',true);
						     $("#cpass").prop('disabled',true);
							 $("#sub").prop('disabled',true);
						}else{
							if(response2=='avail'){
								 var show_user=user_value+' available';
								 $("#user-label").text(show_user);
	                             $("#user-label").css({'visibility':'visible','color':'red'});
								 $("#pass").prop('disabled',false);
						          $("#cpass").prop('disabled',false);
								  $("#sub").prop('disabled',false);
							}else{
								$("#user-label").text('something wrong');
	                            $("#user-label").css({'visibility':'visible','color':'red'});  
							}
							
						}
						//alert(response2);
					}					
				  });
				
			  }
			  
		  }else{
		  $("#user-label").text('please fill');
	      $("#user-label").css({'visibility':'visible','color':'red'});  
		  }
		  
		  
		  
		  
        });
		$("#phone-no").on('change', function() { // on change of everything
	      $("#phone-label").css({'visibility':'hidden'});
        });
		$("#pass").on('change', function() { // on change of everything
	      $("#pass-label").css({'visibility':'hidden'});
        });
		$("#cpass").on('change', function() { // on change of everything
	      $("#cpass-label").css({'visibility':'hidden'});
        });
		
		$("#user-n").on('click', function() { // on click of username
		  // alert('esf');
		  var user_value=$('#user-n').val();
		   if(user_value.trim().split(" ").join("").length>8||user_value.trim().split(" ").join("").length<6){
				  $("#user-label").text('use only 6-8 characters no spaces any spaces will automatically removed');
	              $("#user-label").css({'visibility':'visible','color':'red'});
				  //alert('no 1');
			  }
		
        });
		
		});
  
    
		function oncnfrm(){
	    $("#first-label").css({'visibility':'hidden'});
		$("#last-label").css({'visibility':'hidden'});
		$("#phone-label").css({'visibility':'hidden'});
		$("#ref-label").css({'visibility':'hidden'});
	      var first_value=$("#first-n").val();
	      if(first_value.trim()!=''){
		    var last_value= $("#last-n").val();
	         if(last_value.trim()!=''){
				var ref_value=$("#ref-id").val();
				if(ref_value.trim()!=''){
				  var phone_value= $("#phone-no").val();
			       if(phone_value.trim()!=''){
					 if (isNaN(phone_value)){
                      	$("#phone-label").text('wrong no');
						$("#phone-label").css({'visibility':'visible','color':'red'});
                       }else{
						if(phone_value.length==10){
						$.ajax({
		  
		                 type: 'post',
			             url: 'checkdatat.php',
			             data:{
							 first:first_value,
							 last:last_value,
							 ref:ref_value,
							 phone:phone_value
				
			            },success: function(response){
						if(response=='verified'){
							//register the user
							$("#response").text('register yourself');
			                $("#response").css({'visibility':'visible','color':'blue'});
							
							
						    $("#user-n").prop('disabled',false);
							$("#first-n").prop('disabled',true);
						    $("#last-n").prop('disabled',true);
						    $("#ref-id").prop('disabled',true);
						    $("#phone-no").prop('disabled',true);
						    $("#confrm").prop('disabled',true);
						    
							
							
						}else{
							if(response=='userregis'){
								// user registered
								$("#response").text('already registered');
			                    $("#response").css({'visibility':'visible','color':'red'});
							}else{
								if(response=='phone'){
									$("#response").text('phone no wrong/not same as provided to office/contact office');
			                        $("#response").css({'visibility':'visible','color':'red'});
									// phone no wrong/not same as provided to office/contact office
								}else{
									if(response=='ref_id'){
										$("#response").text('wrong refid');
			                            $("#response").css({'visibility':'visible','color':'red'});
										// wrong ref id 3 chances left
									}else{
										if(response=='name'){
											$("#response").text('wrong name');
			                                 $("#response").css({'visibility':'visible','color':'red'});
											// name is incorrect
										}else{
											if(response=='error'){
												$("#response").text('server error');
			                                    $("#response").css({'visibility':'visible','color':'red'});
												//sever error
											}else{
												$("#response").text('something wrong try again later');
			                                    $("#response").css({'visibility':'visible','color':'red'});
												// something wrong try again later
											}
										}
									}
								}
							}
						}
							//alert('aa');
							//alert(response);
			            }
		                });
						}else{
							 $("#phone-label").text('phone no length (10)');
				            $("#phone-label").css({'visibility':'visible','color':'red'});	
						}
						}
				}else{
					 $("#phone-label").text('Please fill');
				    $("#phone-label").css({'visibility':'visible','color':'red'});			
				}
		     
				 
			    }else{
				$("#ref-label").text('Please fill');
				$("#ref-label").css({'visibility':'visible','color':'red'});
			   				
				}
			 
		 
		   }else{
			 $("#last-label").text('please fill');
			$("#last-label").css({'visibility':'visible','color':'red'});
		   }
    }else{
		$("#first-label").text('please fill');
		$("#first-label").css({'visibility':'visible','color':'red'});
	}
}
     
 function onsub(){
	 
	var user_value=$('#user-n').val();
		  if(user_value.trim()!=''){
			  if(user_value.trim().split(" ").join("").length>8||user_value.trim().split(" ").join("").length<6){
				  $("#user-label").text('use only 6-8 characters no spaces any spaces will automatically removed');
	              $("#user-label").css({'visibility':'visible','color':'red'});
				  //alert('no 1');
			  }else{
				  
				  
				  // after checking username value is filled and not changed
				  var user_pass_value=$('#pass').val();
				  user_pass_value=user_pass_value.trim().split(" ").join("");
			  if(user_pass_value.length>8&&user_pass_value.length<12){
					 
                    var user_cpass_value=$('#cpass').val();
					user_cpass_value=user_cpass_value.trim().split(" ").join("");
                     if(user_cpass_value==user_pass_value){
						 
					 user_value=user_value.trim().split(" ").join("");
					 var first_value=$("#first-n").val();
		             var last_value=$("#last-n").val();
				    var name_value=first_value+' '+last_value;
					var phone_value= $("#phone-no").val();
					
				  $.ajax({
					type:'post',
                    url:'userregis.php',
                    data:{
						user:user_value,
						pass:user_pass_value,
						name: name_value,
						phone: phone_value
					},success:function(response2){
						alert(response2);
						if(response2=='exist'){
							var show_user=user_value+' not available';
							 $("#user-label").text(show_user);
	                         $("#user-label").css({'visibility':'visible','color':'red'});
							 $("#pass").prop('disabled',true);
						     $("#cpass").prop('disabled',true);
							 $("#sub").prop('disabled',true);
						}else{
							if(response2=='success'){
								 $("#result").text('registered');
	                             $("#result").css({'visibility':'visible','color':'red'});
								 $("#user-n").prop('disabled',true);
								 $("#pass").prop('disabled',true);
						         $("#cpass").prop('disabled',true);
								 $("#sub").prop('disabled',true);
                                 $("#link").css({'visibility':'visible','color':'red'});  							
								  
								  
							}else{
								$("#result").text('something wrong');
	                            $("#result").css({'visibility':'visible','color':'red'});  
							}
							
						}
						//alert(response2);
					}					
				  }); 
					 }else{
						$('#cpass-label').text('not match');
					    $('#cpass-label').css({'visibility':'visible','color':'red'});						
					 }


				  }else{
					 $('#pass-label').text('pass length should be >8 and <12 no');
					 $('#pass-label').css({'visibility':'visible','color':'red'});
				  }
				 
				
			  }
			  
		  }else{
		  $("#user-label").text('please fill');
	      $("#user-label").css({'visibility':'visible','color':'red'});  
		  }
	return false;
} 
</script>
</head>
<body>
  <form method="post" action="#" onsubmit="return onsub();">
<fieldset>
    <div class="form-group">


	<p>First Name
    <input type="text" placeholder="First Name" id="first-n"><label id="first-label"></label></p>
	
	<p>Last Name
    <input type="text" placeholder="Last Name" id="last-n"><label id="last-label"></label></p>
    
	<div class="abc">*Provided by office</div>
	
	<p>Refer Id:
	<input type='text' id="ref-id"><label id="ref-label"></label></p>
	
	<p>Your Phone Number:
	<input type='text' id="phone-no"><label id="phone-label"></label></p>
<br>
	<input type="button" value="Confirm" onclick="oncnfrm();" id="confrm"><br><br>
	
	<div><label id="response"></label><div>
	
	
	
    <p>username:
	<input type="text" name="user-n" id="user-n" disabled="disabled"><label id="user-label"></label>
    </p>
	
	<div class="abc">*Password should be more than 8 characters</div>
	<p>Password:
	<input type="password" name="pass" id="pass" disabled="disabled"><label id="pass-label"></label></p>

     <div class="abc">*Confirm your password</div>
    <p>Confirm Password:
    <input type="password" name="cpass" id="cpass" disabled="disabled"><label id="cpass-label"></label>
    </p>

    <input type="submit" value="Register" id="sub" disabled="disabled">
     <br> 
	 <div><label id="result"></label><a href="#" id="link" style="visibility:hidden;">click here to login</a></div>

</fieldset>
</form>
</body>
<html>
