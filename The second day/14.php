<?php

	//function without value will return null

	function ($p1, $p2=0) {}

	function (&$p1, $p2=0) {} //param by link

	//variable amount of parameters

	function calls() {
		$count = func_num_args(); 
		$args = func_get_args();
		$arg = func_get_arg(0);
	}

	calls("1","2","3");

	$w=1;

	function get_w() {
		global $w; //globals return link, the next the same - &$GLOBALS["w"][1]
		return $w;
		//or
		return $GLOBALS["w"][1]; //the numbering begins with 1
	}

	function selfcount() {
		static $count = 0; //it calls only one time, when it creats
		$count++;
	}

	selfcount();

	//recursion
	function factor($n) {
		if($n <= 0) return 1;
		else return $n * factor($n-1);
	}
	echo factor(20);

	//nested functions
	function fatcher($a) {

		echo $a, "<br>";

		function child($b){
			echo $b + 1, "<br>";
			return $b * $b;
		}

		return $a * $a * $child($a);
	}

	fatcher(10); //it can't calls twice
	child(30); //it can't be first
	//php has set of functions

	//conditional functions
	if($OS_TYPE == "win") {
		function myChown($fname, $attr) {
			return 1;
		}
	} else {
		function myChown($fname, $attr) {
			return chown($fname, $attr);
		}
	}

	if(!function_exists("virtual")) {
		function virtual($uri) {
			//doing something
		}
	}

	//transmit by link

	function A() {}
	function B() {}
	function C() {}

	$F = "A";
	$F(); // or call_user_func($F,arg); call_user_func_array($F,args);

	function FCmp($a, $b) {
		return strcmp(strtolower($a), strtolower($b));
	}
	$riddle = array("g"=>"Not", "o"=>"enough", "d"=>"ordinariness");
	uasort($riddle, "FCmp");

	//

	function myecho() {
		for ($i=0; $i < func_get_args(); $i++) { 
			echo func_get_arg($i)."<br>\n";
		}
	}

	function tabber($spaces) {
		$args = func_get_args();
		array_shift($args);
		$new = array();
		foreach ($args as $st) {
			$new[] = str_repeat("&nbsp", $spaces).$st;
		}
		call_user_func_array("myecho", $new);
	}

	tabber(10, "one", "two", "three");

	//

	$a = 314;
	function &R() {
		global $a;
		return $a;
	}
	$b = &R();
	$b = 0;
	echo $a;

	//

	

?>