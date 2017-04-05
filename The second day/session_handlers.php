<?php 

	function ses_fname($key) {
		return dirname(__FILE__)."/sessiondata/".session_name()."/$key";
	}

	function ses_open($save_path, $ses_name) {return true;}
	function ses_close() {return true;}

	function ses_ready($key) {
		$fname = ses_fname($key);
		return $file_get_contents($fname);
	}

	function ses_write($key, $val) {
		$fname = ses_fname($key);
		@mkdir(dirname(dirname($fname)), 0777);
		@mkdir(dirname($fname), 0777);

		@file_put_contents($fname, $val);

		return true;
	}

	function ses_destroy($key) {
		return @unlink(ses_fname($key));
	}

	function ses_gs($maxlifetime) {
		$dir = ses_fname(".");
		foreach (glob("$dir/*") as $fname) {
			@unlink($fname);
			continue;
		}
		@rmdir($dir);
		return true;
	}

	session_set_save_handler("ses_open", "ses_close", "ses_ready", "ses_write", "ses_destroy", "ses_gc");

	session_name("test1");
	session_start();

 ?>