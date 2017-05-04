<?php

	require_once "FS.php";

	$d = new FS_Directory("C:/windows");
	foreach ($d as $key => $value) {
		if($value instanceof FS_File) {
			echo "<tt>$key</tt>: " . $value->getSize() . "<br>";
		}
	}

?>