<html>
<head>
  <link href="./academics/query.css" rel="stylesheet">
  <link href="./academics/jquery.js">
  <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;    
}
</style>
<script src="./academics/jquery.js">
</script>

<script>
$(document).ready(function(){
	    $("#sem").on('change', function() { // on change of  sem this happens
		$("#sem-label").css({'visibility':'hidden'});
        });
		
		$("#branch").on('change', function() { // on change of  this happens
		$("#branch-label").css({'visibility':'hidden'});
        });
		
		$("#batch").on('change', function() { // on change of   this happens
		$("#batch-label").css({'visibility':'hidden'});
        });
		
		$("#month").on('change', function() { // on change of   this happens
		$("#month-label").css({'visibility':'hidden'});
        });
		
		$("#roll").on('change', function() { // on change of  this happens
		$("#roll-label").css({'visibility':'hidden'});
        });
		
		$("#purpose").on('change', function() { // on change of   this happens
		$("#purpose-label").css({'visibility':'hidden'});
        });

 $('#work').click(function(){
	   $("#batch-label").css({'visibility':'hidden'});
		$("#branch-label").css({'visibility':'hidden'});
		$("#purpose-label").css({'visibility':'hidden'});
		$("#sem-label").css({'visibility':'hidden'});
		$("#month-label").css({'visibility':'hidden'});
		$("#roll-label").css({'visibility':'hidden'});
		
		var batch_value= $("#batch").val();// taking values from batch
		if(batch_value!=''){
			 var branch_value= $("#branch").val();
			 if(branch_value!=''){
				 var purpose_value= $("#purpose").val();
				 if(purpose_value!=''){
					 var sem_value= $("#sem").val();
						  if(sem_value!=''){
					   var month_value=$("#month").val();
					    if(month_value!=''){
							var roll_value=$("#roll").val();
							if(roll_value.trim()!=''){
						$.ajax({
		 
	                	 type:'post',
	                	 url:'./academics/getdata.php',
	                 	 data:{
                            batch:batch_value,
							branch:branch_value,
							sem:sem_value,
							purpose:purpose_value,
							month:month_value,
							roll:roll_value
			              
		                },success: function(response){
			              $('#result').html(response);
		                }
		 
	                      });
	                       
							}else{
								$("#roll-label").css({'visibility':'visible'});
							}
						          
						        }else{
							      $("#month-label").css({'visibility':'visible'});
						        }
						    }else{
							$("#sem-label").css({'visibility':'visible'});
						    }
						
                        
				  }else{
					 $("#purpose-label").css({'visibility':'visible'});
				  }
		         
			  }else{

				  $("#branch-label").css({'visibility':'visible'}); 
			      
			  }
		}else{
			$("#batch-label").css({'visibility':'visible'});
		}
	   
		

	

	 
	
 });
	
});
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
      <img src="./academics/dropArrow.png">
      <div class="drop">
        <a href="logout.php">Sign Out</a>
        <a href="../teacher/main.php.php?reque=4111">Contact Office</a>
      </div>
    </div>
	<p> data available :</p>
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
	
	<p>Branch:
	<select name="branch" id="branch">
	<option value=''>--Select branch--</option>
	<option value="it">It</option>
    <option value="cse">Cse</option>
	</select> <label style="visibility:hidden; color:red;" id="branch-label">please fill</label></p>
	
	
	
 <div id="div-work" >  <!-- this division is here for the response for the nxt work depends on this one style="visibility:hidden; display:none;"-->	
	
	<p>purpose:
	<select name="purpose" id="purpose">
	<option value=''>--Select purpose--</option>
    <option value="attendence">attendence</option>
	<option value="academic">academics</option>
	</select> <label style="visibility:hidden; color:red;" id="purpose-label">please fill</label></p>
	
	<p id="sem-work">sem:
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
     </select><label style="visibility:hidden; color:red;" id="sem-label">please fill</label></p>
	
	<p>month:
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
    </select><label style="visibility:hidden; color:red;" id="month-label">please fill</label></p>
	<p>Rollno:
	<textarea id="roll" placeholder="class roll no.." rows="1" cols="18" style="resize:none"></textarea><label style="visibility:hidden; color:red;" id="roll-label">please fill</label>
	</p>
<button id="work">FETCH</button>
<center><div><label id="result"> </label><div></center>
	
    </body>
    </html>