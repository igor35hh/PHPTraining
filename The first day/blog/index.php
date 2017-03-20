<?php 
	$list = scandir('data');
?>

<!DOCTYPE html>
<html>
<head>
	<title>The Blog</title>
</head>
<body>
	<a href="add.php">Add article</a>
	<ul>
		<?php
			foreach($list as $fname) {
				if ($fname != '.' && $fname != '..') {
					echo "<li><a href=\"article.php?fname=$fname\">News $fname</a></li>";
				}
			}	
		?>
	</ul>
</body>
</html>
