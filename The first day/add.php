<?php
	if(count($_POST)>0) {
		$name = trim($_POST['name']);
		$phone = trim($_POST['phone']);
		$dt = date("Y-m-d H:i:s");

		mail('admin@shool.com', 'hello', "$dt $name $phone \n");
		file_put_contents('apps.txt', "$dt $name $phone \n", FILE_APPEND);

		$msg = 'The order was accepted, wait, we would call you';

	} else {
		$msg = 'Put, send, buy'; 
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Submit form</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Call order</h1>
	<form method="post">
		Name<br>
		<input type="text" name="name"><br>
		Phone<br>
		<input type="text" name="phone"><br>
		<input type="submit" value="Send">
	</form>
	<?php echo $msg; ?>
</body>
</html>