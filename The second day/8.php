<?php
	/* possible types

	integer
	double
	string
	array
	object
	resourse
	boolean
	null

	*/

	$myvar = "2";

	echo isset($myvar);

	unset($myvar); //delete var

	echo isset($myvar);

	$arr = array('1' => 'w', '2' => 'q' );

	print_r($arr);

	unset($arr['1']);

	print_r($arr);

	echo '<br>';

	$a = 100;

	echo is_integer($a);
	echo is_double($a);
	echo is_string($a);
	echo is_numeric($a);
	echo is_bool($a);
	echo is_scalar($a);
	echo is_null($a);
	echo is_array($a);
	echo is_object($a);
	echo gettype($a);
	echo settype($a, "string");

	echo '<br>';

	$a = 10;
	$b =& $a; //hard link
	$b = 0;
	echo $a;
	echo $b;

	echo '<br>';

	$right = "red";
	$wrong = "blue";
	$color = "right";
	echo $$color;			//symbolic link
	$$color = "not blue";
	echo $right;
	echo $color;

	echo '<br>';

	class ASww {}
	$first = new ASww();
	$first->mind = 0.123;
	$second = $first;
	$second->mind = 100;
	echo "first mind: {$first->mind}, second: {$second->mind}";
	//that's way objects have saved only links at onther objects

	echo "<br>";

	/* possible types of functions

		string
		int, long
		double, float
		bool
		array
		list (it is ordered array)
		object
		void
		mixed (it is anything above)
		resourse

	*/

	function say($arg1, $arg2) {
		return "okey"; //function always return something, if it is without "return", it will return void
	}

	echo "<br>";

	/* predefined constatns
	
		__FILE__
		__LINE__ (current line of code that interpretator does)
		PHP_VERSION
		PHP_OS
		TRUE or true
		FALSE or false
		NULL or null

	*/

	define ("pi", 3.14);
	define("str", "Test string");
	echo sin(pi/4);
	echo str;
	echo defined("pi");

	echo "<br>";

	//debugging functions

	$a = array(
		'a' => 'apple',
		'b' => 'banana',
		'c' => array(
				'x',
				'y',
				'z'
			)
	);

	echo "<pre>"; print_r($a); echo "</pre>";

	echo "<br>";

	$b = array('a', 'b' => 2);
	echo "<pre>"; var_dump($b); echo "</pre>";

	echo "<br>";

	class SomeClass {
		private $x = 100;
	}	

	$c = array(
		1 => array("Programs haking programs. Wh?", "d'Artanian") 

	);
	echo "<pre>"; var_export($c); echo "</pre>";
	$obj = new SomeClass();
	echo "<pre>"; var_export($obj); echo "</pre>";

?>