<?php

	$a = ($b = 10);
	echo $a;

	echo "<br>";

	$a = 10*20;
	$b = "" . (10*20);
	echo "$a:".gettype($a).", $b:".gettype($b);

	echo "<br>";

	/*transwormation to other type
		$a = intval($b) or $a = (int)$b
		$a = doubleval($b) or $a = (double)$b
		$a = strval($b) or $a = (string)$b
		$a = (bool)$b
	*/

	/* logical expressions
		$less = 10 < 5
		$equals = $b == 1
		$between = $b >= 1 && $b <= 10
		$x = !($b || $c) && $d
	*/

	/* string expressions
		\' - is interpreted like apostrophe - 'd\'Artanian'
		\\ - is interpreted like one backslash - 'C:\\textdoc.txt'
		\n - simbol new line
		\r - simbol return
		\t - symbol tabulation
		\$ - is symbol $
		\" - is quote
		\xNN - hexadecimal symbol 
	*/

	$some = "Hell";
	echo $some."o world";
	echo "{$some}o world";
	echo "${some}o world";
	echo "<br>";
	$action = array("left"=>"survive", "right"=>"kill'em all");
	echo "Entered element is: {$action['left']}";

	echo "<br>";

	/*
	$name = "My";
	$text = <<<MARKER
	Hello $name! How are you?
	What are you doing?
	Have a nice day!
	MARKER;

	echo $text;
	*/

	$st = `command.com/c dir`;
	echo "<pre>$st</pre>";

	echo "<br>";

	//operations

	$a = "wwwww";
	echo strlen($a);
	echo substr($a, 2);

	echo "<br>";

	$a = 2;
	$b = 4;

	echo $a & $b;
	echo $a | $b;
	echo ~ $a;
	echo "<br>";
	echo $a << $b;
	echo $a >> $b;
	echo "<br>";

	$hundred = 100;
	if ($hundred == 1) echo "is it 1?";
	if ($hundred == true) echo "it is true";
	if ("" == 0) echo "coincidence";
	if ("Un" == 0) echo "coincidence";
	if ((int)"Un" == 0) echo "coincidence";
	echo "<br>";

	$x = array(1,2,"3");
	$y = array(1,2,3);
	echo "that two arrays are equal? " . ($x == $y);
	echo "<br>";

	$x = array(1,2,true);
	$y = array(1,2,3);
	echo "that two arrays are equal? " . ($x == $y);

	echo "<br>";

	class newX {};
	class newY {};

	$x = new newX();
	$y = new newX();
	echo "that two objects are equal? " . ($x == $y);
	echo "that two objects are equal? " . ($x === $y);

	echo "<br>";

	$x = 10;
	$y = "10";
	echo "that two variables are equal? " . ($x == $y);
	echo "that two variables are equal? " . ($x === $y);

	echo "<br>";

	$x = array(1,2,3);
	$y = array(1,2,3);
	echo "that two arrays are equal? " . ($x == $y);
	echo "that two arrays are equal? " . ($x === $y);

	echo "<br>";

	$a = 0;
	$b = 1;
	echo !$a;
	echo $a && $b;
	echo $a || $b;

	echo "<br>";

	echo @!$p; //suppression of errors
	if(isset($p)) echo !$p;

?>