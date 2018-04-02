<?php
include 'db.php';
$sql = $conn->query("SELECT * FROM members");
$data= array();
while ($row = mysqli_fetch_array($sql)) {
	$data[] = array(
				"name" 	=> $row ['name'],
				"phone" => $row ['phone']
	    	);
}
shuffle($data);
var_dump($data);
foreach ($data as $key => $value) {
	$name = $value['name'];
	$phone = $value['phone'];
	$sql2 = $conn->query("INSERT INTO `testarray`(`name`, `phone`) VALUES ('$name','$phone')");
}

?>