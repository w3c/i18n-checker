<?php 

class Language {
	
	static private $logger;
	
	// Current language code
	static public $lang;
	
	// Current language array
	static public $language;
	
	// Available languages (code => displayName) 
	static public $languages = array(); 
	
	public static function init() {
		self::$logger = Logger::getLogger('Language');
		self::$languages = self::getListOfAvailableLanguages(Conf::get('path_languages'));
		self::$logger->debug("Found languages: ".print_r(self::$languages, true));
		self::$lang = self::resolveLanguage();
		self::$logger->info("Current language resolved to: ".self::$lang);
		self::$language = self::loadLanguage(self::$lang, Conf::get('path_languages'));
		self::$logger->debug("- Loaded strings: ".print_r(self::$language, true));
	}
	
	private static function getListOfAvailableLanguages($dir) {
		self::$logger->debug("Scanning language directory: ".$dir);
		$langFiles = scandir($dir);
		foreach ($langFiles as $fileName) {
			if ($fileName == "." || $fileName == "..")
				continue;
			if (!preg_match("/[^\.]+\.properties/", $fileName)) {
				self::$logger->warn("Invalid language filename syntax: ".$fileName);
				continue;
			}
			$langCode = preg_split('/\./', $fileName);
			$languages[$langCode[0]] = Locale::getDisplayLanguage($langCode[0], $langCode[0]);
		}
		return $languages;
	}
	
	private static function resolveLanguage() {
		if (isset($_REQUEST['lang'])) {
			self::$logger->debug("Found lang parameter: ".$_REQUEST['lang']);
			if (array_key_exists($_REQUEST['lang'], self::$languages)) {
				return $_REQUEST['lang'];
			} else {
				// TODO Add that message to en.properties or remove altogether
				//Message::addMessage(MSG_LEVEL_WARNING, lang(message_requested_language_not_available));
				self::$logger->debug("Language ".$_REQUEST['lang']." is not available");
				return Conf::get('default_language');
			}
		} else {
			return Conf::get('default_language');
		}
	}
	
	// $dir: directory where languages files are located
	private static function loadLanguage($lang, $dir) {
		self::$logger->debug("Loading language file: ".$dir.'/'.$lang.'.properties');
		$language = parse_ini_file($dir.'/'.$lang.'.properties');
		if ($lang != Conf::get('default_language')) {
			$defaultLanguage = parse_ini_file($dir.'/'.Conf::get('default_language').'.properties');
			$n = 0;
			foreach ($defaultLanguage as $i => $str) {
				if (!isset($language[$i]) || $language[$i] == "") {
					$language[$i] = $defaultLanguage[$i];
					$n++;
				}
			}
			if ($n !== 0)
				self::$logger->debug("- The language file lacks ".$n." strings");
			else
				self::$logger->debug("- The language file is complete");
		}
		return $language;
	}
	
	public static function lang($str) {
		$result = '';
		$str = (string) $str;
		if (array_key_exists($str, self::$language)) {
			$result = self::$language[$str];
		} else if (Conf::get('debug') == true) {
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
	
	public static function _lang($str) {
		print call_user_func_array('lang', func_get_args());
	}
}

Language::init();