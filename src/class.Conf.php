<?php

class Conf {

	static private $logger;
	static private $configuration;
	
	static function init() {
		Conf::$logger = Logger::getLogger('Configuration');
		$confFile = realpath(dirname(__FILE__).'/../conf/i18n.conf');
		Conf::$logger->info("Loading configuration file: ".$confFile);
		Conf::$configuration = parse_ini_file($confFile);
		foreach (Conf::$configuration as $key => $value) {
			if (strpos($key, "path_") === 0 && strpos($value, "/") !== 0) {
				Conf::$configuration[$key] = realpath(dirname(__FILE__).'/../'.$value);
				Conf::$logger->debug("Found path property: ".$key." = ".$value." -> resolved to ".Conf::get($key));
			}
		}
	}
	
	static function get($key) {
		if (array_key_exists($key, Conf::$configuration)) {
			return Conf::$configuration[$key];
		} else {
			Conf::$logger->warn("Unknow configuration key: ".$key.". Look for Conf::get('".$key."') in the code or add it to the configuration file.");
			return null;
		}
	}
	
}