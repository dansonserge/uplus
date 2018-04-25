<?php
	include_once("db.php");

	$standard_date = "d F Y";

	function total_users()
	{
		//returns all the users of church system
		global $db;

		$query = $db->query("SELECT COUNT(*) as count FROM uplus.users") or trigger_error($db->error);
		return $query->fetch_assoc()['count'];
	}

	function forum_users($forumId)
	{
		//function to return all the users of the forum
		global $conn;
		$forumId = $conn->real_escape_string($forumId);
		$query = $conn->query("SELECT * FROM forumuser WHERE forumCode = \"$forumId\" and archive = 'NO' ") or trigger_error($conn->error);

		$users = array();
		while ($data = $query->fetch_assoc()) {
			$users[] = $data;
		}
		
		return $users;
	}

	function forumn_non_users($forumId)
	{
		//function to return all the users of the forum
		global $conn;
		$forumId = $conn->real_escape_string($forumId);
		$query = $conn->query("SELECT * FROM users WHERE id NOT IN (SELECT userCode FROM forumuser WHERE forumCode = \"$forumId\" and archive = 'NO') ") or trigger_error($conn->error);

		$users = array();
		while ($data = $query->fetch_assoc()) {
			$users[] = $data;
		}
		
		return $users;
	}

	function n_forum_users($forumId)
	{
		//function to return number of the users in forum
		global $conn;
		$forumId = $conn->real_escape_string($forumId);
		$query = $conn->query("SELECT COUNT(*) as num FROM forumuser WHERE forumCode = \"$forumId\" and archive = 'NO' LIMIT 1 ") or trigger_error($conn->error);
		$data = $query->fetch_assoc();
		$n_user = $data['num'];
		
		return $n_user;
	}

	function user_details($userid)
	{
		//Function to get user's details
		global $db;
		$user = $db->query("SELECT * FROM uplus.users WHERE id = \"$userid\" LIMIT 1 ") or trigger_error("Errror getting user's details $db->error");

		$user = $user->fetch_assoc();
		return $user;
	}

	function staff_details($staff){
		//returns staff
		global $conn;
		return user_details($staff);
	}

	function clean_string($string)
	{
		$string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

		return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	 }

	function getFeeds($user)
	{
		//function to return the posts from $user
		global $db;
		$query = $db->query("SELECT *, feeds.id as fid, (SELECT COUNT(*) FROM feed_likes WHERE feedCode = feeds.id) as nlikes, (SELECT COUNT(*) FROM feed_comments  WHERE feedCode = feeds.id) as ncomments FROM feeds JOIN users ON feeds.createdBy = users.Id  WHERE users.id = \"$user\" ORDER BY createdDate DESC ") or trigger_error("sdsd".$db->error, E_USER_ERROR);

		$posts = array();

		while ($data = $query->fetch_assoc()) {

			//getting post attachments
			$attq = $db->query("SELECT imgUrl FROM investmentimg WHERE investCode = $data[fid]") or trigger_error($conn->error);

			$att = array();
			while ( $attData = $attq->fetch_assoc()) {
				$att[] = $attData['imgUrl'];
			}

			$data['feedAttachments'] = $att;

			$posts[] = $data;
		}
		return $posts;
	}

	function listFeeds($memberId='')
	{
		//function to return the posts from $user
		global $db;
		$query = $db->query("SELECT F.*, F.id as fid, u.userImage as feedByImg, COALESCE(u.name, u.phone) as feedByName, (SELECT COUNT(*) FROM investments.feed_likes WHERE feedCode = F.id) as nlikes, (SELECT COUNT(*) FROM investments.feed_comments  WHERE feedCode = F.id) as ncomments, (SELECT COUNT(*) FROM investments.feed_likes WHERE feedCode = F.id AND userCode = '$memberId') as liked FROM investments.feeds as F JOIN uplus.users AS u ON u.id = F.createdBy WHERE archive = 'NO' OR ISNULL(archive) ORDER BY createdDate DESC") or trigger_error($db->error, E_USER_ERROR);

		$posts = array();

		while ($data = $query->fetch_assoc()) {

			//getting post attachments
			$attq = $db->query("SELECT imgUrl FROM investments.investmentimg WHERE investCode = $data[fid]") or trigger_error($db->error);

			$att = array();
			while ( $attData = $attq->fetch_assoc()) {
				$att[] = $attData['imgUrl'];
			}
			$liked = $data['liked']==0?"NO":"YES";
			$data["feedLikeStatus"] = $liked;
			$data['feedAttachments'] = $att;

			$posts[] = $data;
		}
		return $posts;
	}

	function brokerMessages($broker, $client)
	{
		//return s messages between broker to $client
		global $conn;
		$query = $conn->query("SELECT * FROM clients_messaging WHERE userCode = \"$client\" AND messageBy = \"$broker\" ") or trigger_error($conn->error);
		$messages = array();
		while ($data = $query->fetch_assoc()) {
			$messages[] = $data;
		}
		return $messages;
	}

	function getForums(){
		//returns all the forums
		global $conn;

		$query = $conn->query("SELECT * FROM forums WHERE archive = 'NO' ") or trigger_error($conn->error);
		$forums = array();
		while ($data = $query->fetch_assoc()) {
			$forums[] = $data;
		}
		return $forums;
	}

	function forumFeeds($forum)
	{
		//function to return the posts in the forum
		global $db;
		$query = $db->query("SELECT *, feeds.id as fid, (SELECT COUNT(*) FROM feed_likes WHERE feedCode = feeds.id) as nlikes, (SELECT COUNT(*) FROM feed_comments  WHERE feedCode = feeds.id) as ncomments FROM feeds WHERE feeds.feedForumId= \"$forum\" ORDER BY createdDate DESC ") or trigger_error("sdsd".$db->error, E_USER_ERROR);

		$posts = array();

		while ($data = $query->fetch_assoc()) {

			//getting post attachments
			$attq = $db->query("SELECT imgUrl FROM investmentimg WHERE investCode = $data[fid]") or trigger_error($conn->error);

			$att = array();
			while ( $attData = $attq->fetch_assoc()) {
				$att[] = $attData['imgUrl'];
			}

			$data['feedAttachments'] = $att;

			$posts[] = $data;
		}
		return $posts;
	}

	function feedComments($feedId){
		//returns the comments on the feed
		global $conn;

		$query = $conn->query("SELECT C.*, U.name as commentByName, U.userImage as commentByImg FROM feed_comments as C JOIN uplus.users as U ON C.userCode = U.id WHERE C.feedCode = \"$feedId\" ORDER BY commentDatetime DESC ") or trigger_error($conn->error);
		$comments = array();

		while ($data = $query->fetch_assoc()) {
			$comments[] = $data;
		}

		return $comments;
	}

	function getForum($forumId)
	{
		//returns forum data
		global $db;
		$query = $db->query("SELECT * FROM forums WHERE id = \"$forumId\" ") or trigger_error($db->error);

		return $query->fetch_assoc();
	}

	function sendsms($phone, $message, $subject="", $smsName="Uplus")
	{
		$recipients     = $phone;
		global $churchID;

		// $smsName = !empty( churchSMSname($churchID) )?churchSMSname($churchID):"Uplus";
		$data = array(
				"sender"        =>$smsName,
				"recipients"    =>$recipients,
				"message"       =>$message,
		);
		$url = "https://www.intouchsms.co.rw/api/sendsms/.json";
		$data = http_build_query ($data);
		$username="cmuhirwa";
		$password="clement123";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
						
		if($httpcode == 200)
		{
				return "Yes";
		}
		else
		{
				return "No";
		}
	}


	function Semail($email, $subject, $body, $header='')
	{
			require_once 'mailer/PHPMailerAutoload.php';
			$email = "info@edorica.com";
			$server = "mail.edorica.com:465";
			$headers  = $header.= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;

			$mail->smtpdbect(
					array(
							"ssl" => array(
									"verify_peer" => false,
									"verify_peer_name" => false,
									"allow_self_signed" => true
							)
					)
			);

			//Enable SMTP debugging.
			$mail->Host = '$server';
			$mail->Port = 587;
			$mail->Username = $email;
			$mail->Password = 'laa1001laa';
			$mail->setFrom($email);
			$mail->addAddress($email);
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->addCustomHeader($headers);

			$data = "";

			//send the message, check for errors
			if (!$mail->send())
			{
				 //Sending with traditional mailer
				 // $header = "From: $email";
				 // if(mail($email, $subject, $body, $headers."From:$email")){
				 //     $data = true; //Here the e-mail was sent
				 //     }
				 //  else{
				 //      $data = false;
				 //  }

					$data = false;
			}
			else
			{
				 $data = true;
			}

			echo json_encode($data);
	}

	function send_notification ($tokens, $message)
	{
			$url = 'https://fcm.googleapis.com/fcm/send';
			$fields = array(
					 'registration_ids' => $tokens,
					 'data' => $message
					);
			$headers = array(
					'Authorization:key = AIzaSyCVsbSeN2qkfDfYq-IwKrnt05M1uDuJxjg',
					'Content-Type: application/json'
					);
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_URL, $url);
		 curl_setopt($ch, CURLOPT_POST, true);
		 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		 $result = curl_exec($ch);           
		 if ($result === FALSE) {
				 die('Curl failed: ' . curl_error($ch));
		 }
		 curl_close($ch);
		 return $result;
	}
?>