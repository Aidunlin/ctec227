<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>File Uploads Part 3</title>
</head>
<body>
	<h1>File Upload Demo - Part 3</h1>
	<h2>Error Codes</h2>

	<?php 

	// Error Codes
	// See http://www.php.net/manual/en/features.file-upload.errors.php

	// UPLOAD_ERR_OK			0 No errors
	// UPLOAD_ERR_INI_SIZE  	1 Larger than upload_max_filesize
 	// UPLOAD_ERR_FORM_SIZE 	2 Larger than form MAX_FILE_SIZE
 	// UPLOAD_ERR_PARTIAL 		3 Partial upload
	// UPLOAD_ERR_NO_FILE 		4 No file
	// UPLOAD_ERR_CANT_WRITE    6 Can't write file
	// UPLOAD_ERR_NO_TMP_DIR	7 No temporary directory
	// UPLOAD_ERR_EXTENSION     8 File upload stopped by extension


	// Define these errors in an array
	$upload_errors = array(
							UPLOAD_ERR_OK 				=> "No errors.",
							UPLOAD_ERR_INI_SIZE  		=> "Larger than upload_max_filesize.",
							UPLOAD_ERR_FORM_SIZE 		=> "Larger than form MAX_FILE_SIZE.",
							UPLOAD_ERR_PARTIAL 			=> "Partial upload.",
							UPLOAD_ERR_NO_FILE 			=> "No file.",
							UPLOAD_ERR_NO_TMP_DIR 		=> "No temporary directory.",
							UPLOAD_ERR_CANT_WRITE 		=> "Can't write to disk.",
							UPLOAD_ERR_EXTENSION 		=> "File upload stopped by extension.");

	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$error = $_FILES['file_upload']['error'];
		$message = $upload_errors[$error];

		// $_FILES[] super global
		// not stored in $_POST[]
		echo "<pre>";
		print_r($_FILES['file_upload']);
		echo "</pre>";
	} // end of if

	?>

	<?php if(!empty($message)) {echo "<p>{$message}</p>";} ?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
		<label for="file_upload">Select a file</label><br>
		<input type="file" name="file_upload" id="file_upload" accept=".png">
		<input type="submit" name="submit" value="Upload">
	</form>


</body>
</html>