<?php

mysql_connect();

	mysql_select_db("nwe");
	$table = "test";
	if($_SERVER['REQUEST_METHOD']=='POST') {
		$name = mysql_real_escape_string($_POST['name']);
		if($id = intval($_POST['id'])) {
			$query = "UPDATE $table SET name='$name' WHERE id=$id";
		} else {
			$query = "INSERT INTO $table SET name='$name'";
		}
		mysql_query($query) or trigger_error(mysql_error()." in ".$query);
		header("Location: http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
		exit;
	}

	if(!isset($_GET['id'])) {
		$LIST=array();
		$query="SELECT * FROM $table";
		$res = mysql_query($query);
		while($row=mysql_fetch_assoc($res)) {
			$LIST[]=$row;
		}
		include 'list.php';
	} else {
		if($id=intval($_GET['id'])) {
			$query = "SELECT * FROM $table WHERE id=$id";
			$res = mysql_query($query);
			$row = mysql_fetch_assoc($res);
			foreach ($row as $key => $value) {
				$row[$key] = htmlspecialchars($value);
			}
		} else {
			$row['name'] = '';
			$row['id'] = 0;
		}
		include 'form.php';
	}

?>