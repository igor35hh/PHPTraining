<?php

	require_once "http_build_url.php";

	$url = "http://someway.com:80";

	$parsed = parse_url($url);

	parse_str(@$parsed['query'], $query);

	$query['names']['read'] = 'tom';

	$parsed['query'] = http_build_query($query);

	$newurl = http_build_url($parsed);

	echo "Old url: $url<br>";
	echo "New: $newurl";

?>