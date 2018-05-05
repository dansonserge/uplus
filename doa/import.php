<?php
	include 'db.php';
	$userQ = $db->query("SELECT * FROM edoricac_2017.6marks LIMIT 150") or trigger_error($db->error);
	while ($user = $userQ->fetch_assoc()) {
		//check
		$name = $user['name'];
		$gender = $user['gender'];

		$check = $db->query("SELECT * FROM doa.nida where names  =\"$name\" ") or trigger_error($db->error);
		if($check->num_rows<1){
			//generate id
			$gender = $gender == 'M'?'MALE':'FEMALE';
			$genderNum = $gender == 'MALE'?8:7;

			$byear = rand(1950, 2000);
			$bdate = date("Y-m-d", strtotime($byear."-".rand(1,12)."-".rand(1,28)));
			$nid = '1'.$byear.$genderNum.'00'.rand(18360077, 399999999);

			$sql = "INSERT INTO doa.nida(names, gender, nid, dob, createdBy) VALUES('$name', '$gender', '$nid', '$bdate', 1)";
			echo "$sql<br />";
			$db->query($sql);
			// echo "$name $gender $nid<BR />";
		}

	}
?>