<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Files and Directories</title>
</head>
<body>
	<?php 
		// get current working directory
		echo getcwd();

		// create a directory
		// try creating a directory a second time. What happens?
		mkdir('new');

		// view contents of Directories
		// opendir()
		// readdir()
		// closedir()

		// start at current directory
		$dir = ".";
		if(is_dir($dir)){
			if($dir_handle = opendir($dir)){
				while($filename = readdir($dir_handle)){
					echo "filename: {$filename} <br/>";
				} // end while

				// you can rewind the directory if you need to
				// rewinddir($dir_handle);

				// close the directory now that we are done with it
				closedir($dir_handle);
			} // end if
		} // end if


		// another approach is to read in contents of directory to an array
		if(is_dir($dir)){
			$dir_array = scandir($dir);
			foreach ($dir_array as $file) {
				// don't display the . and .. directories. Using the strpos() for this.
				if(strpos($file,'.') > 0){
					echo "filename: {$file}<br/>";
				}
			}
		} // end of if
	?>
</body>
</html>