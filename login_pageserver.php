<?php

session_start();

$current_page=$_SERVER['SCRIPT_NAME'];


function loggedin() {
if(isset($_SESSION['user_name_office'])&&!empty($_SESSION['user_name_office'])){
	return true;
}else{
	return false;
}
	}

?>