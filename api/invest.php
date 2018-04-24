<?php
// START INITIATE
	include ("db.php");

	//return JSON Content-Type
    header('Content-Type: application/json');

    //hostname for file referencing
    $hostname = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/";

    //keep api request log for debuggin
    $f = fopen("investapilog.txt", 'a+');
    fwrite($f, json_encode($_POST)."\n\n");
    fclose($f);

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(isset($_POST['action']))
		{
			//check if the function is defined
			if(function_exists($_POST['action'])){
				$_POST['action']();
			}else{
				echo 'Make sure you understand';
			}
		}
		else
		{
			echo 'Please read the API documentation';
		}
	}
	else
	{
		echo 'UPLUS API V02';
	}
// END INITIATE

// START FORUMS
	function listForums()
	{
		require('db.php');
		$memberId		= mysqli_real_escape_string($db, $_POST['memberId']);
		$query = $investDb->query("SELECT F.id forumId, F.title, F.subtitle, F.icon, IFNULL((SELECT M.mine FROM forummember M WHERE M.memberId = '$memberId' AND M.forumId = F.id),'YES') AS mine  FROM forums F WHERE archive <> 'YES'")or die(mysqli_error($investDb));
		$forums = array();
		while ($forum = mysqli_fetch_array($query))
		{
			if($forum['mine'] == 'YES')
			{
				$joined = '0';
			}
			else
			{
				$joined = '1';
			}
			$forumId = $forum['forumId'];
			
			$countQuery = $investDb->query("SELECT * FROM forummember WHERE forumId = '$forumId' AND mine = 'NO'")or die(mysqli_error($investDb));
		   	$joinedCount = mysqli_num_rows($countQuery);
		    $forums[] = array(
				"forumId"		=> $forumId,
				"forumTitle"	=> $forum['title'],
				"forumSubtitle"	=> $forum['subtitle'],
				"forumIcon"		=> $forum['icon'],
				"joined"		=> $joined,
				"joinedCount"	=> $joinedCount
			);
		}
		header('Content-Type: application/json');
		$forums = json_encode($forums);
		echo $forums;
	}

	function joinForum()
	{
		require('db.php');
		$memberId	= mysqli_real_escape_string($db, $_POST['memberId']);
		$forumId	= mysqli_real_escape_string($db, $_POST['forumId']);
		if(mysqli_num_rows($investDb->query("SELECT * FROM forumuser WHERE forumCode = '$forumId' AND (userCode = '$memberId' AND archive <> 'YES')"))>0)
		{
			echo "User Already In with memberId (".$memberId.") And forumId: (".$forumId.")";
		}
		elseif (mysqli_num_rows($investDb->query("SELECT * FROM forumuser WHERE forumCode = '$forumId' AND (userCode = '$memberId' AND archive = 'YES')"))>0) {
			$query 		= $investDb->query("UPDATE forumuser SET archive = 'NO' WHERE forumCode = '$forumId' and userCode = '$memberId'")or die(mysqli_error($investDb));
			echo "User Brought back in, with memberId (".$memberId.") And forumId: (".$forumId.")";
		}
		else
		{
			$query 		= $investDb->query("INSERT INTO forumuser (forumCode, userCode, createdBy) VALUES ('$forumId','$memberId','$memberId')")or die(mysqli_error($investDb));
			echo "Done with memberId (".$memberId.") And forumId: (".$forumId.")";
		}	
	}

	function exitForum()
	{
		require('db.php');
		$memberId	= mysqli_real_escape_string($db, $_POST['memberId']);
		$forumId	= mysqli_real_escape_string($db, $_POST['forumId']);
		if(mysqli_num_rows($investDb->query("SELECT * FROM forumuser WHERE forumCode = '$forumId' AND userCode = '$memberId'"))>0)
		{
			$query 		= $investDb->query("UPDATE forumuser SET archive = 'YES' WHERE forumCode = '$forumId' and userCode = '$memberId'")or die(mysqli_error($investDb));
			echo "Done user exited the forum with memberId (".$memberId.") And forumId: (".$forumId.")";
		}
		else
		{
			echo "User wasent in the forum With memberId: (".$memberId.") And forumId: (".$forumId.")";
		}
	}

	function loopFeeds()
	{
		require('db.php');
		require_once('../invest/admin/db.php');
		require_once('../invest/admin/functions.php');
		$memberId	= mysqli_real_escape_string($db, $_POST['memberId']??"");

		$all_feeds = listFeeds($memberId);

		// $sql = $investDb->query("SELECT F.id feedId, F.feedForumId, (SELECT COUNT(*) FROM feed_likes WHERE feedCode = F.id) as nlikes, (SELECT COUNT(*) FROM feed_likes WHERE feedCode = F.id AND userCode = '$memberId') as liked, (SELECT COUNT(*) FROM feed_comments  WHERE feedCode = F.id) as comments, F.feedTitle, U.name feedBy, U.userImage feedByImg, F.createdDate feedDate,F.feedContent FROM investments.feeds F INNER JOIN uplus.users U ON F.createdBy = U.id")or die(mysqli_error($investDb));
		$feeds = array();

		for ($n=0; $n<count($all_feeds); $n++)
		{
			$row = $all_feeds[$n];
			//liked status of the user
			$liked = $row['liked']==0?"NO":"YES";
			$feeds[] = array(
				"feedId"		=> $row['id'],
				"feedForumId"	=> $row['feedForumId'],
				"feedTitle"		=> $row['feedTitle']??"",
				"feedBy"		=> $row['feedByName'],
				"feedByImg"		=> $row['feedByImg']??"",
				"feedLikes"		=> $row['nlikes'],
				"feedLikeStatus"=> $liked, 
				"feedComments" 	=> $row['ncomments'],
				"feedDate"		=> $row['createdDate'],
				"feedContent"	=> $row['feedContent'],
			);
		}

		//getting forum images
		foreach ($feeds as $i => $feed) 
		{
			$feedId 	= $feed['feedId'];
			$images 	= array();
            $sql 		= $investDb->query("SELECT `imgUrl` FROM `investmentimg` WHERE `investCode` = '$feedId'")or die (mysqli_error($investDb));
            while($rowImage = mysqli_fetch_array($sql))
            {
                $images[]  = array(
                    "imgUrl"         => $rowImage['imgUrl']
                );
            }
            $feeds[$i]['feedImage'] = $images;
		}
		
        mysqli_close($db);
        mysqli_close($eventDb);
        header('Content-Type: application/json');
		$feeds = json_encode($feeds);
		echo $feeds;
	}

	function likeFeed()
	{
		require('db.php');
		$userId		= mysqli_real_escape_string($db, $_POST['userId']);
		$feedId		= mysqli_real_escape_string($db, $_POST['feedId']);

		//check if the user has liked the feed
		$query = $investDb->query("SELECT * FROM feed_likes WHERE feedCode = \"$feedId\" AND userCode = \"$userId\" ");
		if($query->num_rows){
			//here user already liked
			echo json_encode("skipped");
		}else{
			//make the user like
			$investDb->query("INSERT INTO feed_likes(feedCode, userCode) VALUES(\"$feedId\", \"$userId\")");
			echo json_encode("Done");
		}
		
		
	}

	function listCommentsFeed()
	{
		require('db.php');
		$feedId		= mysqli_real_escape_string($db, $_POST['feedId']);
		"Done";
		//$sql = $investDb->query("")or die (mysqli_error());
	}

	function commentFeed()
	{
		require('db.php');
		$userId		 = mysqli_real_escape_string($db, $_POST['userId']);
		$feedId		 = mysqli_real_escape_string($db, $_POST['feedId']);
		$feedComment = mysqli_real_escape_string($db, $_POST['feedComment']);

		$investDb->query("INSERT INTO feed_comments(feedCode, userCode, comment) VALUES(\"$feedId\", \"$userId\", \"$feedComment\")");

		echo json_encode("Done");
	}

	function postFeed()
	{
		require('db.php');
		global $hostname;
		$request = $_POST;
		// /post feeds
        $userId = $request['memberId']??"";
        $post_content = $request['feedContent']??"";

        //type of the post
        $type = $request['type']??"";

        //target forum
        $target_audience = $request['targetForum']??$request['feedId'];

        // title
        $title = $request['title']??"";

        //attachments link
        $attachments = json_decode($request['attachments']??"", true);

        //the type of person who posted - admin or member if empty it'll be elisa app
        $userType = $request['userType']??'member';        

        $sql = "INSERT INTO feeds(feedContent, createdBy, feedForumId) VALUES(\"$post_content\", \"$userId\", \"$target_audience\")";
        $query = $investDb->query($sql) or trigger_error($investDb->error);

        if($query){
            $feed_id = $investDb->insert_id;
            //checking sent attachments

            if(!empty($attachments)){
            	//already uploaded attachments
	            for($n=0; $n<count($attachments); $n++){
	                $att = $attachments[$n];
	                $sql = "INSERT INTO investmentimg(imgUrl, investCode) VALUES(\"$att\", $feed_id) ";
	                $investDb->query($sql) or trigger_error($investDb->error);
	            }
	        }else if(!empty($request['feedAttachements'])){
	        	//attachments from Android
	        	$attachments = (array)$request['feedAttachements'];
	        	
	        	if(is_array($attachments)){
	        		//looping through image
	        		foreach ($attachments as $key => $value) {
	        			echo "string kk ";
		        		$filename = "invest/gallery/feeds/";
					    $image_parts = explode(";base64,", $value);
					    $image_type_aux = explode("image/", $image_parts[0]);
					    $image_type = $image_type_aux[1];
					    $image_base64 = base64_decode($image_parts[1]);
					    $file = $filename . uniqid() . '.png';
					    file_put_contents("../".$file, $image_base64);

					    //storing in the database
					    $sql = "INSERT INTO investmentimg(imgUrl, investCode) VALUES(\"$hostname$file\", $feed_id) ";
	                	$investDb->query($sql) or trigger_error($investDb->error);
		        	}
	        	}else{
	        		die("Failed");
	        	}
	        }else if(!empty($_FILES) ){
	        	//here we've to upload these files, this oftenly happens for android requests
	        	$attachments = $_FILES;
	        	foreach ($attachments as $handlename => $attachment) {
	        		$sent_file_name = $attachment['name'];

	        		$ext = strtolower(pathinfo($sent_file_name, PATHINFO_EXTENSION)); //extension

	        		//forumlating how the file will be names
	        		$filename = "invest/gallery/feeds/".substr($sent_file_name, 0, -4)."_".time().".".$ext;
	        		

	        		$allowed_extensions = array('preventerrorsguys_dont remove please', 'jpg', 'png', 'mp3', 'aac', 'mp4');

	        		//checking extension
	        		if(array_search($ext, $allowed_extensions)){
			            //we can now upload
			            
			            if(move_uploaded_file($attachment['tmp_name'], "../".$filename)){
			            	$sql = "INSERT INTO investmentimg(imgUrl, investCode) VALUES(\"$hostname$filename\", $feed_id) ";
	                		$investDb->query($sql) or trigger_error($investDb->error);
			            }
			        }else{
			            $response = array('status'=>false, 'msg'=>"Invalid file type");
			        }
	        	}
	        }
            $response = 'Done';
        }else{
            $response = 'Failed';   
        }
        echo json_encode($response);
	}
// END FORUMS


// START INVESTMENT
	function requestCSD()
	{
		// user requesting CSD account
		require 'db.php';
		$request = $_POST;
		$title = $request['tilte']??'';

		$userId = $request['userId']??"";
		if($userId){
			//here we fetch details from app
			$query = $db->query("SELECT * FROM uplus.users WHERE id = \"$userId\" ");
			$userData = $query->fetch_assoc();

			$names = $userData['name']??"ASSS";
			$gender = $userData['gender']??"Male";
			$phone = $userData['phone']??"01";

		}else{
			$names = $request['names']??"";
			$phone = $request['phone']??"";
			$gender = $request['gender']??"";
		}
		
		$dob = date("Y-m-d", strtotime($request['dateOfBirth']??""));
		$nationality = $request['nationality']??"";
		$NID = $request['NID']??"";
		$passport = $request['passport']??"";
		$country = $request['country']??"";
		$city = $request['city']??"";

		if($names && $phone && $gender && $dob && $nationality){
			$query = $investDb->query("INSERT INTO clients(names, dob, gender, NID, residentIn, country, city, statusOn) VALUES(\"$names\", \"$dob\", \"$gender\", \"$NID\", \"$nationality\", 'Rwanda', 'Kigali', NOW()) ") OR trigger_error($investDb->error);
			$response = 'Done';
		}else{
			$response =  "Failed";
		}
		echo json_encode($response);
	}
// END INVESTMENT
?>
