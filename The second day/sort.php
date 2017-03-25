<?php

	$array = array(1, 0, 6, 9, 4, 5, 2, 3, 8, 7);
	for ($i=0; $i < count($array) -1 ; $i++) { 
		for ($j=0; $j < count($array) - $i -1; $j++) { 
			//current element more then next
			if($array[$j] > $array[$j + 1]) {
				//let's change their places
				$tmp_var = $array[$j + 1];
				$array[$j + 1] = $array[$j];
				$array[$j] = $tmp_var;
			}
		}

	}

	echo "<br>";

	var_dump($array);

?>