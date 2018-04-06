<?php  

$db = new mysqli("localhost", "clement", "clement123" , "investments");
	
	if($db->connect_errno){
		die('Sorry we have some problem with the Database!');
	}             
?>