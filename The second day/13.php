<?php

	list ($name, $surname, $age) = $list;

	list (, $surname, $age) = $list;

	$ref = &$dossier["one"]["name"]; //there is hard link

	count($a);
	array_merge($a, $b);

	$birth = array(
		"one" => "2017-01-01",
		"two" => "2017-02-02",
	);

	for (reset($birth); ($k=key($birth)) ; next($birth)) { 
		echo = "$k was born {$birth[$k]}<br>";
	}

	for (end($birth); ($k=key($birth)) ; prev($birth)) { 
		echo = "$k was born {$birth[$k]}<br>";
	}

	current($birth);

	for (reset($birth); ($k=key($birth)) != false ; next($birth)) { 
		echo = "$k was born {$birth[$k]}<br>";
	}

	for (reset($birth); list($k, $v)=each($birth) ; ) { 
		echo = "$k was born $v<br>";
	}

	foreach ($birth as $key => $value) {
		echo = "$key was born $value<br>";
	}

	$numbers = array(100, 313, 605);
	foreach ($numbers as &$v) { //there is simbol & which afford us change the array
		$v++;
	}

	explode();
	implode();
	join();

	$st = serialize($birth);
	$$birth = unserialize($st);


?>