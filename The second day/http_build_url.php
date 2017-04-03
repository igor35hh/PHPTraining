<?php
	function http_build_url($parsed) {
		if(!is_array($parsed)) {
			return false;
		}

		if(isset($parsed['scheme'])) {
			$sep = (strtolower($parsed['scheme']) == 'mailto' ? ':' : '://');
			$url = $parsed['scheme'] . $sep;
		} else {
			$url = '';
		}

		if(isset($parsed['pass'])) {
			$url .= "$parsed['user']:$parsed[pass]@";
		} elseif(isset($parsed['user'])) {
			$url .= "$parsed[user]@";
		}

		if(@!is_scalar($parsed['query'])) {
			$parsed['query'] = http_build_query($parsed['query']);
		}

		if(isset($parsed['host'])) {
			$url .= $parsed['host'];
		}

		if(isset($parsed['port'])) {
			$url .= ":".$parsed['port'];
		}

		if(isset($parsed['path'])) {
			$url .= $parsed['path'];
		}

		if(isset($parsed['query'])) {
			$url .= "?".$parsed['query'];
		}

		if(isset($parsed['fragment'])) {
			$url .= "#".$parsed['fragment'];
		}

		return $url;

	}
?>