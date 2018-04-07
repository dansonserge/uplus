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
		$query = $investDb->query("SELECT id forumId, title, subtitle, IFNULL((SELECT mine FROM forummember WHERE memberId = '$memberId'),'YES') AS mine  FROM forums WHERE archive <> 'YES' OR isnull(archive)")or die(mysqli_error($investDb));
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
		
			$countrow= $investDb->query("SELECT * FROM forumuser WHERE forumCode = '$forumId' AND userCode = '$memberId'");
$counts = mysqli_num_rows($countrow);if($counts > 0){ echo $counts;
		}
		else
		{
			$query 		= $investDb->query("INSERT INTO forumuser (forumCode, userCode, createdBy) VALUES ('$forumId','$memberId','$memberId')")or die(mysqli_error($investDb));
		}
		echo "Done";
	}

	function exitForum()
	{
		require('db.php');
		$memberId	= mysqli_real_escape_string($db, $_POST['memberId']);
		$forumId	= mysqli_real_escape_string($db, $_POST['forumId']);
		$query 		= $investDb->query("UPDATE forumuser SET archive = 'YES' WHERE forumCode = '$forumId' and userCode = '$memberId')")or die(mysqli_error($investDb));
		echo "Done";
	}

// END FORUMS
?>
