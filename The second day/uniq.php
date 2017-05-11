<?php

	function getUniques($text, &$OrigWords=false) {
		$words = preg_split("/([^[:alnum:]]|['-])+/s", $text);
		$OrigWords = count($words);
		$words = array_map("strtolower", $words);
		$words = array_unique($words);
		return $words;
	}

	setlocale(LC_ALL, '');
	$fname = "gibraltar.txt";
	$text = file_get_contents($fname);
	$uniq = getUniques($text, $nOrig);

	foreach (preg_grep('/^ex\d/s', glob("*")) as $value) {
		echo "the file: $value <br>";
	}

	echo "words were: $nOrig <br>";
	echo "words are: ".count($uniq)."<hr>";
	echo join(" ", $uniq);

?>