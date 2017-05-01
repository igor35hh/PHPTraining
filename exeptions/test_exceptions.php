<?php

	require_once "exceptions.php";

	try {
		printDocument();
	} catch (IFileException $e) {
		echo "file error {$e->getMessage()} <br>";
	} catch (Exception $e) {
		echo "unknown error <pre> $e </pre> <br>";
	}

	function printDocument() {
		$printer = "//.printer/printer";
		if(!file_exists($printer)) {
			throw new NetPrinterWriteException($printer);
		}
	}

?>