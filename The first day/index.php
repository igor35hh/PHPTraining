<?php 

	$currentDir = dirname(__File__);

	require_once($currentDir.'/classes/MyClass.php');

	$a = 50;
	$b = 50.5;
	$c = 'hello';
	$d = true;

	const PI = 3.14;
	define("PI2", 5.15);

	echo PI;
	echo PI2;

	$srt1 = '$a one more time hello';
	$srt2 = "$a times hello";

	echo "$str1<br>$str2";

	echo "<div class=\"$c\">1</div>";

	$testMyClass = new MyClass();
	$testMyClass->One()->Two()->Three();

	echo MyClass::MyConst;

	$cache = [
		"foo" => "bar",
		"bar" => "foo",
	];

	echo $cache["foo"];
	echo @$cache["key"]; /*if there isn't key simbol @ will ignore or suppress error*/

	$f = fopen('1.txt', 'r');

	while(!feof($f)) {
		$str1 = fread($f, 1);
		echo $str1;
	}

	$length = filesize('1.txt');
	$str1 = fread($f, $length);
	echo n12br($str1);

	fclose($f);

	/*
		r read - to read
		r+ read & write
		w write - create and record
		w+ write & read
		a append - add into file
		a+ append & read
	*/

	$app = date("Y-m-d H:i:s") . "!!!Dmitro!!!707070\n";
	$f = fopen('apps.txt', 'a');
	fwrite($f, $app);
	fclose($f);

	$a1 = file_get_contents('1.txt'); //just string
	var_dump($a1); 

	$a2 = file('1.txt'); //array os strings

	echo '<pre>';
	print_r($a2);
	echo '</pre>';

	file_put_contents('1.txt', '1\n2\n3');
	file_put_contents('1.txt', '1\n2\n3', FILE_APPEND);

	echo '<pre>';
	print_r($_SERVER);
	echo '</pre>';

	$log = date("Y-m-d H:i:s");
	$log .= '<@>' . $_SERVER['REMOTE_ADDR'];
	$log .= '<@>' . $_SERVER['PHP_SELF'];
	$log .= '<@>' . $_SERVER['HTTP_REFERER'];

	echo $log;

	file_put_contents('log.txt', "$log\n", FILE_APPEND);

	$lines = file('1.txt');

	$k = $lines[1];
	$log = explode('<@>', $k);
	echo '<pre>';
	print_r($log);
	echo '</pre>';

	echo '<table>';

	foreach($lines as $line) {
		echo '<tr>';
		$log = explode('<@>', $line);
		foreach($log as $item) {
			echo "<td>$item</td>";
		}
		echo '</tr>';
	}

	echo '</table>';

	$list = scandir('.');
	echo '<pre>';
	print_r($list);
	echo '</pre>';

	echo '<ul>';
	foreach($list as $fname) {
		if ($fname != '.' && $fname != '..') {
			echo "<li><a href=\"article.php?fname=$fname\">News $fname</a></li>";
		}
	}
	echo '</ul>';

	$fname = (int)$_GET['fname'];
	$content = file_get_contents("data/$fname");
	echo n12br($content);


	/*
	phpinfo();
	*/ 

?>

<style>
	table, td {
		border: 1px solid black;
		padding: 10px;
	}
</style>