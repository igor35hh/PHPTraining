<?php

	class HeadshotException extends Exception {}

	function eatThis() {
		throw new HeadshotException("it is Exception");
	}

	function action() {
		echo "start <br>";

		try {
			eatThis();
		} catch (Exception $e) {
			echo "and end <br>";

			throw $e;
		}
	}

	try {
		action();
	} catch (HeadshotException $e) {
		echo "Sorry, it is died";
	}

?>