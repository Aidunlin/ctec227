<!DOCTYPE html>
<html lang="en">
<!-- CTEC 127 / Bruce Elgort / February 2015 -->

<head>
	<meta charset="UTF-8">
	<title>File Uploads Part 2</title>
</head>

<body>
	<h1>File Upload Demo - Part 2</h1>
	<h2>Files Super Global</h2>

	<?php
	// check to see if form is being POSTed
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		// $_FILES[] super global
		// not stored in $_POST[]
		echo "<pre>";
		print_r($_FILES['file_upload']);
		echo "</pre>";
	} // end of if
	?>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
		<label for="file_upload">Select a file</label><br>
		<input type="file" name="file_upload" id="file_upload" accept=".png">
		<input type="submit" name="submit" value="Upload">
	</form>

</body>

</html>