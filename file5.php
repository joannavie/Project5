<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>	
</head>
<body>
	<?php
	
		function writeToFile($name, $email, $position)
		{
			$handle = fopen('candidates.txt', 'a');
			fwrite($handle, "$name, $email, $position\n");
			fclose($handle);
			echo "<h2>Υποβολή στοιχείων</h2>";
			echo "κ. $name η αίτηση σας για την θέση '$position' καταχωρήθηκε με επιτυχία στο σύστημα.<br>";
		}

		function readFromFile()
		{
			$lines = file('candidates.txt');
			echo "<h1>Λίστα υποψηφίων</h1>";
			echo "<ol>";
			foreach($lines as $value)
			{
				echo "<li>$value</li>";
			}
			echo "</ol>";
		}

		function uploadFile()
		{
			if ( is_uploaded_file($_FILES["file"]["tmp_name"]) ) 
				rename($_FILES["file"]["tmp_name"], "cvs/".$_FILES["file"]["name"]);			
		}
		
		if ( !empty($_POST['name']) && !empty($_POST['mail']) )
		{
			writeToFile($_POST['name'], $_POST['mail'], $_POST['position'] );
			uploadFile();
			readFromFile();
		}
		else
		{
			echo "Επιστρέψτε στη φόρμα και συμπληρώστε:<ul>";
			if ( empty($_POST['name']) )
				echo "<li>το ονοματεπώνυμό σας</li>";
			if ( empty($_POST['mail']) )
				echo "<li>το email σας</li>";	
			echo "</ul>";
		}	
	?>
</body>
</html>