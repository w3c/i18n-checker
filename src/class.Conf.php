<?php
/**
 * Contains and initializes the Conf class.
 * @package i18nChecker
 */
/**
 * Configuration loading
 * 
 * This class is in charge of:
 * - loading the configuration file located by default in ../conf/i18n.conf.
 * - initializing log4php using the properties file located in ../conf/log4php.properties.
 * Log4php classes must be present in a directory named log4php under the library folder defined in i18n.conf. 
 * 
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Conf {
	
	/**
	 * Relative path to the configuration folder
	 */
	const CONF_FOLDER = '../conf';
	/**
	 * I18n checker configuration file name
	 */
	const CONF_I18N_NAME = 'i18n.conf';
	/**
	 * log4php configuration file name
	 */
	const CONF_LOG4_NAME = 'log4php.properties';
	/**
	 * Logger for this class
	 */
	static private $logger;
	/**
	 * Parsed configuration array
	 */
	static private $configuration;
	/**
	 * Loads the configuration file in $configuration and initializes log4php. Exits the script on failure.
	 */
	static function _init() {
		define("PATH_SRC", realpath(dirname(__FILE__)));
		define("PATH_CONF", realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.self::CONF_FOLDER));
		$confFile = PATH_CONF.DIRECTORY_SEPARATOR.self::CONF_I18N_NAME;
		if (!file_exists($confFile)) {
			echo 'Configuration file not found. '.$confFile;
			exit(1);
		}
		self::$configuration = parse_ini_file($confFile);
		if (!self::$configuration) {
			echo 'Error parsing configuration file.';
			exit(1);
		}
		foreach (self::$configuration as $key => $value) {
			if (strpos($key, "path_") === 0 && strpos($value, "/") !== 0) {
				self::$configuration[$key] = realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$value);
				define(strtoupper($key), self::get($key));
			}
		}
		require_once(PATH_LIB.'/log4php/Logger.php');
		Logger::configure(PATH_CONF.DIRECTORY_SEPARATOR.self::CONF_LOG4_NAME);
		self::$logger = Logger::getLogger('Configuration');
		if (self::$logger->isDebugEnabled())
			self::$logger->debug("Loaded configuration file: ".$confFile."\n".print_r(self::$configuration, true));
	}
	/**
	 * Returns the value associated with the key passed as parameter or log a warning if non existent
	 * @param string $key
	 * @return string the associated configuration value
	 */
	static function get($key) {
		if (array_key_exists($key, self::$configuration)) {
			return self::$configuration[$key];
		} else {
			self::$logger->warn("Unknow configuration key: ".$key.". Look for Conf::get('".$key."') or add that key to the configuration file.");
			return null;
		}
	}
	/**
	 * Dynamically change a configuration value
	 * @param string $key the key to change
	 * @param string $value the new value
	 */
	static function set($key, $value) {
		self::$configuration[$key] = $value;
	}
}

Conf::_init();