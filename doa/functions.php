<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") 
{
	if(isset($_GET['action']))
	{
		$_GET['action']();
	}
	else
	{
		echo 'Please read the API documentation';
	}
}
else
{
	echo 'DOA API V 0.1.0';
}


// START NID
function createNidHandle()
{
	require('db.php');
	echo $img 		= $_GET['img'];
	echo $names 	= $_GET['names'];
	echo $gender 	= $_GET['gender'];
	echo $dob 		= $_GET['dob'];
	echo $nid 		= $_GET['nid'];

	//	START GENERATE A HANDLE
		$handleId = '25.001/NIDA/'.$nid;
		sleep(1);
	//	END GENERATE A HANDLE

	//	START SAVE THE HANDLE ID
		$sql = $db->query("UPDATE nida SET handleId = '$handleId' WHERE nid = '$nid'");
	//	END SAVE THE HANDLE ID
}

function loopHandles()
{
	?>
	<table class="table table-striped ">
		<thead>
			<tr>
				<th>Handle ID</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				include 'db.php';
				$sqlDoa = $db->query("SELECT IF(handleId IS NULL OR handleId ='','-', handleId) handleId FROM nida")or die(mysqli_error($db));
					
				while($rowDoa = mysqli_fetch_array($sqlDoa))
				{
					echo '<tr><td>'.$rowDoa['handleId'].'</td></tr>';
				}
			?>
		</tbody>
	</table>
	<?php
}
// END NID
?>
