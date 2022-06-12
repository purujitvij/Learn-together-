<html>
<head>
  <link href="./dataupload/style.css" rel="stylesheet">
<link href="./dataupload/jquery.js">
<script src='./dataupload/jquery.js'></script>
<script>
/* to reuse scripts
1.if(){//do something}else{//dosomething}
2.$("#batch-label").css({});
	3.	$.ajax({

		    type: 'post',
			url: './openpost/upcomment.php',
			data:{

			},success: function(response){

			}
		  });
*/
   function onsub(){  // on submit this function tregars
        $("#batch-label").css({'visibility':'hidden'});
		$("#branch-label").css({'visibility':'hidden'});
		$("#purpose-label").css({'visibility':'hidden'});
		$("#sem-label").css({'visibility':'hidden'});
		$("#month-label").css({'visibility':'hidden'});
		$("#file-label").css({'visibility':'hidden'});

		var batch_value= $("#batch").val();// taking values from batch
		if(batch_value!=''){
			 var branch_value= $("#branch").val();
			 if(branch_value!=''){
				 var purpose_value= $("#purpose").val();
				 if(purpose_value!=''){
					 if(purpose_value=='studata'){
					   var month_value=$("#month").val();
					    if(month_value!=''){
						var file_value =$('#file-input').val();
						    if(file_value!=''){
								var form = $('#form-1')[0];

								var data = new FormData(form);
							
								$.ajax({

		                        type: 'post',
			                    url: './dataupload/excelstudata.php',
								cache: false,
								enctype:'multipart/form-data',
								dataType:'JSON',
                                contentType: false,
                                processData: false,
                                method: 'POST',
			                    data:data,
								success: function(response){
									if(response=='wrong'){
										alert('something wrong');
									}else{
										var resultArray=response;
										// here now we have excel sheets data in array nxt we have to do as we please using nxt ajax
										$.ajax({

		                                 type: 'post',
			                             url: './dataupload/upstudata.php',
			                             data:{
											 sheetdata:resultArray,
											 batch:batch_value,
											 branch:branch_value,
											 purpose:purpose_value,
											 month:month_value,

			                                },success: function(response2){
												alert(response2);

			                              }
		                                });
									}

	                               		}
		                             });
						    }else{
							$("#file-label").css({'visibility':'visible'});
						    }
						}else{
							$("#month-label").css({'visibility':'visible'});
						}


					 }else{
						var sem_value= $("#sem").val();
						  if(sem_value!=''){
							  var month_value=$("#month").val();
							  if(month_value!=''){
						        var file =$('#file-input').val();
						          if(file!=''){
							        var form = $('#form-1')[0];
									
								    var data = new FormData(form);
								   $.ajax({

		                           type: 'post',
			                       url: './dataupload/excelstudata.php',
				  				   cache: false,
								   enctype:'multipart/form-data',
								   dataType:'JSON',
                                   contentType: false,
                                   processData: false,
                                   method: 'POST',
			                       data:data,
								   success: function(response){
									if(response=='wrong'){
										alert('something wrong');
									}else{
										var resultArray=response;

										// here now we have excel sheets data in array nxt we have to do as we please using nxt ajax
										$.ajax({

		                                 type: 'post',
			                             url: 'upacemark.php',
			                             data:{
											 sheetdata:resultArray,
											 batch:batch_value,
											 branch:branch_value,
											 purpose:purpose_value,
											 month:month_value,
											 sem:sem_value
			                                },success: function(response2){
												alert(response2);

			                              }
		                                });
									}

	                               		}
		                             });

						           }else{
							        $("#file-label").css({'visibility':'visible'});
						          }
						        }else{
							      $("#month-label").css({'visibility':'visible'});
						        }
						    }else{
							$("#sem-label").css({'visibility':'visible'});
						    }

                        }
				  }else{
					  var ex = $("#branch-label").text();
				      if(ex=='success'){
					  $("#branch-label").css({'visibility':'visible'});
				      }
					 $("#purpose-label").css({'visibility':'visible'});
				  }

			  }else{

				  $("#branch-label").css({'visibility':'visible'});

			  }
		}else{
			$("#batch-label").css({'visibility':'visible'});
		}


	return false;
	}

$(document).ready(function (){



	$("#batch").on('change', function() { // on change of batch
		$("#batch-label").css({'visibility':'hidden'});
		var batch_value= $("#batch").val();
        });

		$("#branch").on('change', function() { // on change of branch
		$("#branch-label").css({'visibility':'hidden'});
		var batch_value= $("#branch").val();
        });

	$("#branch,#batch").on('change', function() { // for both values when appears then check for database


		$("#branch-label").text("please fill");
		$("#batch-label").css({'visibility':'hidden'});

		var branch_value= $("#branch").val();
		var batch_value=$("#batch").val();// this specific command gets value of the batch option. val()fxn is usedsss


		if(branch_value!=''){  // to check any branch is selected or not if yes then

			if(batch_value!=''){  // to check if batch selected or not if yes then

				$.ajax({

		              type: 'post',
			          url: './dataupload/dt.php',
		              data:{
				        branch:branch_value,
						batch:batch_value

			            },success: function(response){

						if(response=='success'){// that means if database exist
						    $("#branch-label").text("success");
							$("#branch-label").css({'color':'green','visibility':'visible'});
							$("#div-work").css({'visibility':'visible','display':'inline-block'});
							alert(response);
						}else{
							  $("#branch-label").text("contact to server manager");
							  $("#branch-label").css({'color':'blue','visibility':'visible'});
							 // we will add later for here
						    }
			        }
		        });

				}else{  // to check if batch not  selected then
					 $("#batch-label").css({'visibility':'visible'});
				    }


			}else{ // if branch not selected then
		         $("#branch-label").css({'visibility':'visible'}); // if branch value is not selected
		        }






        });

	$("#purpose").on('change', function() { // on change of purpose what happens
	   $("#purpose-label").css({'visibility':'hidden'});
		var purpose_value= $("#purpose").val();
		if(purpose_value=='attendence'||purpose_value=='academic'){
        
		$("#sem-work").css({'visibility':'visible','display':'block'});
		}else{
			$("#sem-work").css({'visibility':'hidden','display':'none'});
			$("#sem-work").replaceWith($("#sem-work").val('').clone(true));
		}
        });

    $("#sem").on('change', function() { // on change of  sem this happens
		$("#sem-label").css({'visibility':'hidden'});
		var sem_value= $("#sem").val();
        });

	$("#month").on('change', function() { // onchange of month this happens
		$("#month-label").css({'visibility':'hidden'});
		var month_value=$("#month").val();
        });

	$("#file-input").on('change', function(){ // trigered when the file is inputed
		$("#file-label").css({'visibility':'hidden'});
		var ext = $('#file-input').val().split('.').pop().toLowerCase();
		var file =$('#file-input').val();
		var allowedExt=new Array('xls','xlsx');
		if($.inArray(ext,allowedExt)==-1){
		 alert('only excel files are allowed please see file clearly');
		$('#file-input').replaceWith($('#file-input').val('').clone(true));
		}else{

	    alert("file uploaded please check previouse values before submit");
		}
    });
});


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
        <img src="./dataupload/dropArrow.png">
        <div class="drop">
          <a href="logout.php">Sign Out</a>
        </div>
      </div>
  <!-- this form will take input from office to uploaded to database-->
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
</select><label style="visibility:hidden; color:red;" id="batch-label">&nbsp please fill</label>  </p>

	<p>Branch:
	<select name="branch" id="branch">
	<option value=''>--Select branch--</option>
	<option value="it">IT</option>
    <option value="cse">CSE</option>
	</select> <label style="visibility:hidden; color:red;" id="branch-label">please fill</label></p>



 <div id="div-work" style="visibility:hidden; display:none;" >  <!-- this division is here for the response for the nxt work depends on this one style="visibility:hidden; display:none;"-->

	<p>Purpose:
	<select name="purpose" id="purpose">
	<option value=''>--Select purpose--</option>
	<option value="studata">Student-data</option>
    <option value="attendence">Attendence</option>
	<option value="academic">Academics</option>
	</select> <label style="visibility:hidden; color:red;" id="purpose-label">please fill</label></p>

	<p id="sem-work" style="visibility:hidden; display:none;">Sem:
	<select id='sem' name="sem">
    <option value=''>--Select sem--</option>
    <option value='sem_1'>sem-1</option>
    <option value='sem_2'>sem-2</option>
    <option value='sem_3'>sem-3</option>
    <option value='sem_4'>sem-4</option>
    <option value='sem_5'>sem-5</option>
    <option value='sem_6'>sem-6</option>
    <option value='sem_7'>sem-7</option>
    <option value='sem_8'>sem-8</option>
  </select><label style="visibility:hidden; color:red;" id="sem-label">&nbsp please fill</label></p>

	<p>Month current:
	<select id='month' name="month">
    <option value=''>--Select Month--</option>
    <option value='january'>January</option>
    <option value='february'>February</option>
    <option value='march'>March</option>
    <option value='april'>April</option>
    <option value='may'>May</option>
    <option value='june'>June</option>
    <option value='july'>July</option>
    <option value='august'>August</option>
    <option value='september'>September</option>
    <option value='october'>October</option>
    <option value='november'>November</option>
    <option value='december'>December</option>
  </select><label style="visibility:hidden; color:red;" id="month-label">&nbsp please fill</label></p>







        <label class="file" for="exampleInputFile">File Upload:&nbsp</label><br><br>

        <input type="file" name="file" class="form-control" id="file-input" accept=".xls,.xlsx">
		<label style="visibility:hidden; font-size:13px;font-family: sans-serif;color:red;" id="file-label">Please Upload</label>
		<br><br><br>

         <button type="submit" class="btn btn-primary" id="submit">Submit</button><br><br>
	</div>


	</div>
	</fieldset>

</form>
<center><p id="result" style="visibilty :hidden;"></p><center>
</body>
</html>
