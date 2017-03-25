<?php

	$memcache = new Memcache;
	$memcache->connect('localhost', 11211);
	$vRevision = 1;

	$getResult = $memcache->get('key_'.$vRevision);
	if($getResult) {
		$resultData = array();
		$resultData = $getResult;
	} else {
		$sql = mysql_query("Select * from users") or die(mysql_error());
		$resultData = array();
		while($r = mysql_fetch_array($sql, MYSQL_ASSOC)) {
			$resultData = $r;
		}
		$memcache->set('key_'.$vRevision, $resultData, false, 86400);
	}

	var_dump($resultData);

?>