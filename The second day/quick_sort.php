<?php

	function partition(&$mas, $s, $f) {
		$q = $s;
		for ($i=$s; $i < $f; $i++) { 
			if($mas[$i] <= $mas[$f]) {
				$buf = $mas[$i];
				$mas[$i] = $mas[$q];
				$mas[$q] = $buf;
				$q++;
			}
		}

		$buf = $mas[$q];
		$mas[$q] = $mas[$f];
		$mas[$f] = $buf;

		return $q;
	}

	function quickSort(&$mas, $s, $f) {
		if($s < $f) {
			$q = partition($mas, $s, $f); 
			//var_dump($q);echo "<br>";
			quickSort($mas, $s, $q-1);
			quickSort($mas, $q+1, $f);
		}
	}

	//echo "<br>";
	//echo "<br>";

	$array = array(1, 0, 6, 9, 4, 5, 2, 3, 8, 7);

	echo "<br>";
	var_dump($array);

	quickSort($array, 0, 9);

	echo "<br>";
	var_dump($array);

?>