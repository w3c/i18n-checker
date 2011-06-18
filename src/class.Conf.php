<?php

class Conf {

	static private $logger;
	static private $configuration;
	
	static function init() {
		define("PATH_SRC", realpath(dirname(__FILE__)));
		define("PATH_CONF", realpath(dirname(dirname(__FILE__)).'/conf'));
		$confFile = PATH_CONF.'/i18n.conf';
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
				self::$configuration[$key] = realpath(dirname(__FILE__).'/../'.$value);
				define(strtoupper($key), self::get($key));
			}
		}
		require_once(PATH_LIB.'/log4jphp/Logger.php');
		Logger::configure(PATH_CONF.'/log4php.properties');
		self::$logger = Logger::getLogger('Configuration');
		if (self::$logger->isDebugEnabled())
			self::$logger->debug("Loaded configuration file: ".$confFile."\n".print_r(self::$configuration, true));
	}
	
	static function get($key) {
		if (array_key_exists($key, self::$configuration)) {
			return self::$configuration[$key];
		} else {
			self::$logger->warn("Unknow configuration key: ".$key.". Look for Conf::get('".$key."') or add that key to the configuration file.");
			return null;
		}
	}
	
	static function set($key, $value) {
		self::$configuration[$key] = $value;
	}
}

Conf::init();