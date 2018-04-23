<?php
// START INITIATE
	include ("db.php");

	//return JSON Content-Type
    // header('Content-Type: application/json');

    //hostname for file referencing
    $hostname = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/";

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
		$memberId	= mysqli_real_escape_string($db, $_POST['memberId']??"");
		$sql = $investDb->query("SELECT F.id feedId, F.feedForumId, (SELECT COUNT(*) FROM feed_likes WHERE feedCode = F.id) as nlikes, (SELECT COUNT(*) FROM feed_comments  WHERE feedCode = F.id) as comments, F.feedTitle, U.name feedBy, U.userImage feedByImg, F.createdDate feedDate,F.feedContent FROM investments.feeds F INNER JOIN uplus.users U ON F.createdBy = U.id")or die(mysqli_error($investDb));
		$feeds = array();
		while ($row = mysqli_fetch_array($sql))
		{
			$feeds[] = array(
				"feedId"		=> $row['feedId'],
				"feedForumId"	=> $row['feedForumId'],
				"feedTitle"		=> $row['feedTitle']??"",
				"feedBy"		=> $row['feedBy'],
				"feedByImg"		=> $row['feedByImg'],
				"feedLikes"		=> $row['nlikes'],
				"feedLikeStatus"=> 'NO', 
				"feedComments" 	=> $row['comments'],
				"feedDate"		=> $row['feedDate'],
				"feedContent"	=> $row['feedContent']
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
			echo "skipped";
		}else{
			//make the user like
			$investDb->query("INSERT INTO feed_likes(feedCode, userCode) VALUES(\"$feedId\", \"$userId\")");
			echo "Done";
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

		echo "Done";
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
            if(is_array($attachments)){
            	//already uploaded attachments
	            for($n=0; $n<count($attachments); $n++){
	                $att = $attachments[$n];
	                $sql = "INSERT INTO investmentimg(imgUrl, investCode) VALUES(\"$att\", $feed_id) ";
	                $investDb->query($sql) or trigger_error($investDb->error);
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

            $response = array('status'=>true, 'msg'=>array('postId'=>$investDb->insert_id));
        }else{
            $response = array('status'=>false, 'msg'=>"Error $investDb->error");   
        }
        echo json_encode($response);
	}
// END FORUMS
?>
