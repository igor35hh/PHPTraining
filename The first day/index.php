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

	$name = trim($_POST['name']);
	$phone = trim($_POST['phone']);

	$name_correct = strlen($name) > 1;
	$phone_correct = is_numeric($phone);

	$db = new PDO('mysql:host=localhost;dbname=site', 'root', '');
	$db->exec("SET NAMES UTF8");
	$query = $db->prepare("Insert Into apps (name, phone) Values(:name, :phone)");
	$values = ['name' => $name, 'phone' => $phone];
	$query->execute($values);
	//
	$query = $db->prepare("Select * from apps");
	$query->execute();
	$apps = $query->fetchAll(PDO::FETCH_ASSOC);

	//session

	session_start();
	if(!isiset($_SESSION['counter']) $_SESSION['counter']=0;
	echo "you have update this page ".$_SESSION['counter']++." times";
	echo "<br><a href=".$_SERVER['PHP_SELF']."> update";

	session_start();
	if($_SESSION['authorized']<>1) {
		header("Location: /auth.php");
		header("Location: /script.php?".session_name().'='.session_id());
		exit;
	}

	//if you have register_globals=off
	unset($_SESSION['var']);
	//if no
	session_unregister('var');

	if(isset($_REQUEST[session_name()])) session_start();

	//session.save_patch = c:\windows\temp

	ini_set('display_errors', 1);
	error_reporting(E_ALL);

	session_write_close();

	session_cache_limiter("private");

	

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