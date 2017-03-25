<?php

	if(1>2) {echo "some";}
	elseif (2>3) {echo "yet";}
	else {print "the end";}

	/*the one option yet between <? ?>

	<? if(): ?>

	<? elseif(): ?>

	<? else: ?>

	<? enfif ?>

	*/

	$i=1; $p=1;

	while ($i < 32) {
		echo "hello";
	}

	do {
		echo "hello Do";
	} while(0);

	for ($i=0; $i < ; $i++) { 
		# code...
	}

	for ($i=0, $j=0, $k="Test"; $i < 10; $i++) { 
		$k = "." . $k;
		$k .= ".";
		break; break(2);
		continue; continue(2);
	}

	foreach ($_SERVER as $key => $value) {
		echo "<b>$key</b> => <tt>$value</tt><br>\n";
	}

	foreach ($_SERVER as $value) {
		echo "<tt>$value</tt><br>\n";
	}

	foreach ($_SERVER as $key => &$value) {
		// & hence that the $value is possible change 
	}

	switch($a) {
		case 1: echo '1'; break;
		case 2: echo '2';
		default: echo 'end';
	}


	require, include
	require_once, include_once
	throw


?>