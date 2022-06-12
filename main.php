<?php

    require "login_pageserver.php";
	
	
	
	
	
	
	
if(loggedin()){
	
	if(isset($_GET['request'])){
		if($_GET['request']==1111){
	     include "notificationsupload/notifiication.php";
		}else{
			if($_GET['request']==1112){
	     include "dataupload/office1.php";
		}else{
			if($_GET['request']==1113){
	     include "teacherregis/techeregis.php";
		     }else{
				 if($_GET['request']==1114){
	             include "applications/myapplications.php";
		     }else{
				  if($_GET['request']==1115){
	             include "applications/showapp.php";
		     }
			 }
			 }
		   }
		}
		
		
	}else{
		include "Officehomepage/home.php";
	}

	     
      
	        }else{                                                                 // this part is used when user is not logged in
	
	
		  include "login/loginpage.php";
		  
	
}

  

?>