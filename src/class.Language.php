<?php 
/**
 * Contains and initializes the Checker class.
 * @package i18nChecker
 */
/**
 * Format modifier to use for lists
 */
define("LANG_FORMAT_OL", 0);
/**
 * Format modifier to use for lists that contain escaped <<code>> elements
 */
define("LANG_FORMAT_OL_CODE", 1);
/**
 * Language class
 * 
 * This class is in charge of:
 * - loading all language files from the language directory defined in the checker configuration file
 * - deciding which available language serve to a client based on request headers or parameters
 * - generating language strings based on parameters
 * 
 * @todo lang negociation
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Language {
	/**
	 * Logger for this class
	 * @var Logger
	 */
	static private $logger;
	/**
	 * Resolved language code for current request
	 * @var string
	 */
	static public $lang;
	/**
	 * Loaded language array for current request
	 * @var array
	 */
	static public $language;
	/**
	 * Available languages found in the language directory in the form: array(langCode => displayName)
	 * @var array
	 */
	static public $languages; 
	/**
	 * Finds all available languages, determines the language for the current requests and load its language file
	 */
	public static function _init() {
		self::$logger = Logger::getLogger('Language');
		self::$languages = self::getListOfAvailableLanguages(PATH_LANGUAGES);
		self::$logger->debug("Found languages: ".print_r(self::$languages, true));
		self::$lang = self::resolveLanguage();
		self::$logger->info("Current language resolved to: ".self::$lang);
		self::$language = self::loadLanguage(self::$lang, PATH_LANGUAGES);
		self::$logger->debug("- Loaded strings: ".print_r(self::$language, true));
	}
	/**
	 * Scan the directory passed as parameter to find language files
	 * @param string $dir path to the directory to scan
	 * @return array an array with the keys being the language codes and the values the display name in the considered language
	 */
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
	/**
	 * Determines the language to use with the current request based on the parameter 'lang' if present
	 * and set to an available language or returns the default language defined in the configuration file
	 * @todo language negociation
	 * @return string the resolved language code
	 */
	private static function resolveLanguage() {
		if (isset($_REQUEST['lang'])) {
			self::$logger->debug("Found lang parameter: ".$_REQUEST['lang']);
			if (array_key_exists($_REQUEST['lang'], self::$languages)) {
				return $_REQUEST['lang'];
			} else {
				// TODO Add that message to en.properties or remove altogether
				// Message::addMessage(MSG_LEVEL_WARNING, lang(message_requested_language_not_available));
				self::$logger->debug("Language ".$_REQUEST['lang']." is not available");
				return Conf::get('default_language');
			}
		} else {
			return Conf::get('default_language');
		}
	}
	/**
	 * Loads a specific language files and completes it with the default language file values if
	 * keys are missing.
	 * @param string $lang the language to load
	 * @param string $dir the directory where the language file is located
	 * @return array the loaded language file
	 */
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
	/**
	 * Returns the language string associated with $key. If other parameters are passed to this function
	 * they will be used in place of the '%<<i>>' values inside the string.
	 * For instance if the language file contains: mykey="This string contained a dynamic parameter: %1"<br>
	 * Calling lang('mykey', 'param1') will return "This string contained a dynamic parameter: param1".
	 * 
	 * @param string $key the key used in the language file
	 * @param string $param (optional) other string parameters can be passed to this function
	 * @return string the generated internationalized string
	 */
	public static function lang($key) {
		$key = (string) $key;
		if (Conf::get('debug_lang') || !array_key_exists($key, self::$language) || self::$language[$key] == "") {
			if (!Conf::get('debug_lang'))
				self::$logger->warn("Unknown language key or value is empty: ".$key);
			return "[".$key."]";
		}
		$result = self::$language[$key];
		$numargs = func_num_args();
	    if ($numargs >= 2) {
	        $arg_list = func_get_args();
		    for ($i = 1; $i < $numargs; $i++) {
		        $result = str_replace("%".$i, func_get_arg($i), $result);
		    }
	    }
	    return $result;
	}
	/**
	 * Equivalent to 'echo lang($key)'
	 * @param string $key the key used in the language file
	 */
	public static function _lang($key) {
		echo call_user_func_array('lang', func_get_args());
	}
	
	public static function format($value, $type) {
		switch ($type) {
			case LANG_FORMAT_OL:
				$result = '<ol>';
				foreach ((array) $value as $val)
					$result .= '<li>'.$val.'</li>';
				$result .= '</ol>';
				return $result;
			case LANG_FORMAT_OL_CODE:
				$result = '<ol class="code">';
				foreach ((array) $value as $val)
					$result .= '<li><code>'.htmlspecialchars($val).'</code></li>';
				$result .= '</ol>';
				return $result;
			default:
				self::$logger->error("Unknown format modifier: ".$type);
				return self::lang($value);
		}
	}
}

Language::_init();
/**
 * Convenient shortcut to Language::$lang
 * @see Language::$lang
 */
$lang = Language::$lang;
/**
 * Convenient shortcut to Language::lang($arr)
 * @see Language::lang
 * @param mixed $arr
 * @return string
 */
function lang($arr) {
	return call_user_func_array('Language::lang', func_get_args());
}
/**
 * Convenient shortcut to Language::_lang($arr)
 * @see Language::lang
 * @param mixed $arr
 * @return string
 */
function _lang($arr) {
	echo call_user_func_array('Language::lang', func_get_args());
}