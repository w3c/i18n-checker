<?php

class Conf {

	static private $logger;
	static private $configuration;
	
	static function init() {
		self::$logger = Logger::getLogger('Configuration');
		$confFile = realpath(dirname(__FILE__).'/../conf/i18n.conf');
		self::$logger->info("Loading configuration file: ".$confFile);
		self::$configuration = parse_ini_file($confFile);
		foreach (self::$configuration as $key => $value) {
			if (strpos($key, "path_") === 0 && strpos($value, "/") !== 0) {
				self::$configuration[$key] = realpath(dirname(__FILE__).'/../'.$value);
				self::$logger->debug("- Found path property: ".$key." = ".$value." -> resolved to ".self::get($key));
				define(strtoupper($key), self::get($key));
			}
		}
		define("PATH_SRC", realpath(dirname(__FILE__)));
		self::$logger->debug("- Loaded configuration: ".print_r(self::$configuration, true));
	}
	
	static function get($key) {
		if (array_key_exists($key, self::$configuration)) {
			return self::$configuration[$key];
		} else {
			self::$logger->warn("Unknow configuration key: ".$key.". Look for Conf::get('".$key."') in the code or add that key to the configuration file.");
			return null;
		}
	}
}

Conf::init();