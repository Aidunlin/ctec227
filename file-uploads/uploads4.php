<!DOCTYPE html>
<html lang="en">
<!-- CTEC 127 / Bruce Elgort / February 2015 -->
<head>
	<meta charset="UTF-8">
	<title>File Uploads Part 4</title>
</head>
<body>
	<h1>File Upload Demo - Part 4</h1>
	<h2>Moving the File to a New Folder</h2>
	<h3>Create an "uploads" folder in the folder you are working with this code in</h3>

	<?php 

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

		// what file do we need to move?
		$tmp_file = $_FILES['file_upload']['tmp_name'];

		// set target file name
		// basename gets just the file name
		$target_file = basename($_FILES['file_upload']['name']);

		// set upload folder name
		$upload_dir = 'uploads';

		// Now lets move the file
		// move_uploaded_file returns false if something went wrong
		if(move_uploaded_file($tmp_file, $upload_dir . "/" . $target_file)){
			$message = "File uploaded successfully";
		} else {
			$error = $_FILES['file_upload']['error'];
			$message = $upload_errors[$error];
		} // end of if
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