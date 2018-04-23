<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1 ,maximum-scale=1, user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>google location</title>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQR6Szd2sBV2-1MQXmdAKRHWHa3tNnuH8" type="text/javascript"></script>
	</head>
	<body>
		<div id="clientLocation">
			<?php
				if($_SERVER['REQUEST_METHOD'] == 'POST' || 1){
					var_dump($_FILES);
				}
			?>
			<form method="POST" enctype="multipart/form-data">
				<div>
					<input type="file" id="file1" name="file1">
					<input type="file" id="file2" name="file2">
					<input type="file" id="file3" name="file3">
					<input type="submit" id="subt">
				</div>
			</form>
		</div>
		<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script type="text/javascript">
			
		</script>

		
	</body>
</html>