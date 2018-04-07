<?php
// START INITIATE
	include ("db.php");
	// var_dump($_SERVER["REQUEST_METHOD"]);
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if(isset($_POST['action']))
		{
			$_POST['action']();
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
		$query = $investDb->query("SELECT F.id forumId, F.title, F.subtitle, IFNULL((SELECT M.mine FROM forummember M WHERE M.memberId = '$memberId' AND M.forumId = F.id),'YES') AS mine  FROM forums F WHERE archive <> 'YES'")or die(mysqli_error($investDb));
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
		    $forums[] = array(
				"forumId"		=> $forum['forumId'],
				"forumTitle"	=> $forum['title'],
				"forumSubtitle"	=> $forum['subtitle'],
				"joined"		=> $joined
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

// END FORUMS
?>
