<?php
require '../db.php';
//get all users who came into evet
$users = $eventDb->query("SELECT * FROM free_tickets_buy");
while ($userData  = $users->fetch_assoc()) {
	$userphone = $userData['phone'];

	//check if user belongs into uplus
	$exiq = $db->query("SELECT * FROM users WHERE phone = '$userphone' ");
	if($exiq->num_rows){
		$uplusdata = $exiq->fetch_assoc();
		$userId = $uplusdata['id'];
		echo "$userphone found";
	}else{
		//here we have to insert the user
		$name = $userData['name'];
		$email = $userData['email'];
		$gender = $userData['gender']??"Male";
		$db->query("INSERT INTO users(name, phone, email, gender) VALUES(\"$name\", \"$userphone\", \"$email\", \"$gender\")") or trigger_error($db->error);
		echo "$userphone inserted as user";
		$userId = $db->insert_id;
	}

	//checking he belongs in a forum
	$forumCheck = $investdb->query("SELECT * FROM forumuser WHERE userCode = $userId AND forumCode = 27 ");
	if($forumCheck->num_rows){
		echo "Already existsed";
	}else{
		$investdb->query("INSERT INTO `forumuser` (`id`, `forumCode`, `userCode`, `createdBy`, `createdDate`, `updatedBy`, `updatedDate`, `archive`, `archivedBy`, `archivedDate`) VALUES (NULL, '27', '$userId', '11', '2018-04-23 06:34:27', NULL, NULL, 'NO', NULL, NULL);");
		echo "User inserted";
	}
}
?>

