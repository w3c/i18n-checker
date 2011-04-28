<?php 
function getListOfAvailableLanguages($dir) {
	$langFiles = scandir($dir);
	
	foreach ($langFiles as $fileName) {
		if ($fileName != "." && $fileName != "..") {
			$langCode = preg_split('/\./', $fileName);
			$languages[$langCode[0]] = Locale::getDisplayLanguage($langCode[0], $langCode[0]);
		}
	}
	return $languages;
}

function resolveLanguage() {
	global $conf, $languages;
	if (isset($_REQUEST['lang'])) {
		if (array_key_exists($_REQUEST['lang'], $languages)) {
			return $_REQUEST['lang'];
		} else {
			// TODO Add that message to en.properties or remove altogether
			//$_REQUEST['messages'][] = new Message(Message::error, lang(message_requested_language_not_available));
			return $conf['default_language'];
		}
	} else {
		return $conf['default_language'];
	}
}

// $dir: directory where languages files are located
function loadLanguage($lang, $dir) {
	global $conf;
	$language = parse_ini_file($dir.'/'.$lang.'.properties');
	if ($lang != $conf['default_language']) {
		$defaultLanguage = parse_ini_file($dir.'/'.$conf['default_language'].'.properties');
		foreach ($defaultLanguage as $i => $str) {
			if (!isset($language[$i]) || $language[$i] == "")
				$language[$i] = $defaultLanguage[$i];
		}
	}
	return $language;
}

function lang($str) {
	global $language, $conf;
	$result = '';
	if (isset($language[$str])) {
		$result = $language[$str];
	} else if (isset($conf['debug']) && $conf['debug'] == true) {
		$result = "[[[".$str."]]]";
	} else {
		$result = $str;
	}
	$numargs = func_num_args();
    if ($numargs >= 2) {
        $arg_list = func_get_args();
	    for ($i = 1; $i < $numargs; $i++) {
	        $result = str_replace("%".$i, func_get_arg($i), $result);
	    }
    }
    return $result;
}

function _lang($str) {
	print call_user_func_array('lang', func_get_args());
}