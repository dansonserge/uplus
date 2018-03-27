<?php
	//uploading podcast
	print_r($_FILES);
	$podcastFile = $_FILES['file'];
	$ext = strtolower(pathinfo($podcastFile['name'], PATHINFO_EXTENSION));

	$filename = "gallery/podcasts/$name"."_".time().".$ext";
?>