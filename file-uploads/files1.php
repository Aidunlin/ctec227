<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Files and Directories</title>
</head>
<body>
	<?php 

		// magic constant __FILE__
		// full path to get to the file we loaded up
		echo "<p>" . __FILE__ . "</p>";

		// what line are we on in the script
		// be carefull with includes
		echo "<p>" . __LINE__ . "</p>";

		// What directory are we in?
		echo "<p>" . dirname(__FILE__) . "</p>";

		// this magic constant also has this info as well

		echo "<p>" . __DIR__ . "</p>";

		echo file_exists(__FILE__) ? "yes the file exists" : "no the file does not exist";
		// file_exists() works on file names and Directories

		// is_file()
		// is_dir()

		echo is_dir('..') ? "Yes it's a directory" : "No it's not a directory";

	?>
</body>
</html>