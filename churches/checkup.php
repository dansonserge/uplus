<!DOCTYPE html>
<html>
<head>
	<title>Here</title>
	<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
</head>
<body>

<input type="file" id="uploadMediaInput" name="filepond" multiple data-max-file-size="102MB" data-max-files="3">

<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
	const inputElement = document.querySelector('#uploadMediaInput');
	const pond = FilePond.create( inputElement );

	FilePond.setOptions({
	    server: 'uploadTest.php'
	});
</script>
</body>
</html>
