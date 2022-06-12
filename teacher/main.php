<?php


require "login_pageserver.php";



if(loggedin()){
	
	  if(isset($_GET['request'])){ // for office query
		   if($_GET['request']==6111){
			   include 'academics/acedemics.php';
		   }
	  }else{
		  if(isset($_GET['reques'])){ // for office query
		   if($_GET['reques']==5111){
			   include 'notifications/mynotifications.php';
		   }else{
			   if($_GET['reques']==5112){
			   include 'my profile/profile.php';
		   }else{
			    if($_GET['reques']==5113){
			   include 'team/team.php';
				}
		     }
		   }
	  }else{
		 if(isset($_GET['reque'])){ // for office query
		   if($_GET['reque']==4111){
			   include 'office/office.php';
		   }
	  }else{
		  if(isset($_GET['requ'])){
		  if($_GET['requ']==3111){
			 include 'tsquery/newquery/querypost.php'; 
		  }else{
			 if($_GET['requ']==3112){
				include 'tsquery/openquery/openquery.php';
			 }else{
				if($_GET['requ']==3113){
				include '';
			 } }
		  }
	  
      }else {if(isset($_GET['req'])){
		    if($_GET['req']==2111){               //  forum part included
		     include 'forum1/forum1.php'; 
		   }
			   
			
	     }else{ if(isset($_GET['req1'])){       // to create discussions
		        if($_GET['req1']==2112){
				  include 'forum/include.php';   
	                                }else{if($_GET['req1']==2113){         // to access my disscussions
		                                   include 'forum2/mydiscussion.php';
	                                                         }else{
		                                                           if($_GET['req1']==2114){         // to show post
				                                                  include 'openpost/showpost.php';
			                                                      }else{
				                                                        if($_GET['req1']==2115){ // to edit post
					                                                    include 'editpost/editpost.php';
				                                                      }
				
			                                                      }
	                                                            }
	                                    }
	                                 }else{
		                          include 'home/home.php';}                                         	//this part is used when user is logged in
	
	                             }
	  }
	  } 
	  }
	  }
	  
	
	 

		
	  
	 }else{                                                                 // this part is used when user is not logged in
include "login/loginpage.php";
		  
	}








?>