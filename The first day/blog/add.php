<?php
	if(count($_POST)>0) {
		$fname = trim($_POST['title']);
		$content = trim($_POST['content']);
		
		file_put_contents("data/$fname", $content);

		$msg = 'The order was accepted, wait, we would call you';

		header('Location: index.php');
		exit();
	} else {
		$msg = 'text and enter'; 
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add article</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Call order</h1>
	<form method="post">
		Title<br>
		<input type="text" name="title"><br>
		Text<br>
		<textarea name="content"></textarea><br>
		<input type="submit" value="Save">
	</form>
</body>
</html>