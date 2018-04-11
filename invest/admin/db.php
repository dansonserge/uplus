<?php  

$db = $conn = new mysqli("localhost", "clement", "clement123" , "investments");
	
	if($db->connect_errno){
		die('Sorry we have some problem with the Database!');
	} 
$uplusdb = new mysqli("localhost", "clement", "clement123" , "uplus");
	
	if($uplusdb->connect_errno){
		die('Sorry we have some problem with the central Database!');
	}             
?>

