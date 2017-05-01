<?php

	function myErrorHandler($errno, $msg, $file, $line) {
		if(error_reporting() == 0) {
			return;
		}

		echo '<div style="border-style:inset; border-width:2">';
		echo "there is error <b>$errno</b><br>";
		echo "File: <tt>$file</tt>, line is $line <br>";
		echo "the text: <i>$msg</i>";
		echo "</div>";
	}

	set_error_handler("myErrorHandler", E_ALL);

	filemtime("sppon");

	echo "<br>";

	try {
		echo "start <br>";
		throw new Exception("Error Processing Request", 1);
		
	} catch (Exception $e) {
		echo "an Exception: {$e->getMessage()}<br>";
	}

	echo "End";

	echo "<br>";

	class Orator {

			private $name;
			function __construct($name) {
				$this->name = $name;
				echo "it was creating {$this->name} <br>";
			}
			function __destruct() {
				echo "it was killing {$this->name} <br>";
			}

		}

		function outer() {
			$obj = new Orator(__METHOD__);
			inner();
		}

		function inner() {
			$obj = new Orator(__METHOD__);
			echo "Warning, an exeption <br>";
			
			trigger_error("Error");

			throw new Exception("Hello, i am an exeption", 1);
		}

		echo "the start <br>";

		try {
			echo "start the try block <br>";
			outer();
			echo "end the try block <br>";
		} catch (Exception $e) {
			echo "an exeption {$e->getMessage()} <br>";
		}

		echo "the end <br>";

	

?>