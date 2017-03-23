<?php
	session_start();
	include 'safemysql.calss.php';
	$db = new safemysql(['db' => 'test']);
	include 'auth.php';
?>

secret<br>
<a href="?action=logout">Logout</a>