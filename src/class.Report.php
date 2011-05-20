<?php

define("REPORT_LEVEL_INFO", "info");
define("REPORT_LEVEL_WARNING", "warning");
define("REPORT_LEVEL_ERROR", "error");

class Report {
	
	private static $logger;
	public static $reports;
	
	public $category;
	public $severity;
	public $title;
	public $explanation;
	public $whattodo;
	public $further;
	
	public static function init() {
		self::$logger = Logger::getLogger('Report');
	}
	
	private function __construct($category, $severity, $title, $explanation, $whattodo, $further) {
		$this->category = $category;
		$this->severity = $severity;
		$this->title = $title;
		$this->explanation = $explanation;
		$this->whattodo = $whattodo;
		$this->further = $further;
	}
	
	public static function addReport($category, $severity, $title, $explanation, $whattodo, $further) {
		self::$reports[] = new Report($category, $severity, $title, $explanation, $whattodo, $further);
	}
	
	public static function getCount() {
		return count(self::$reports);
	}
	
	public static function getCountFor($severity) {
		$callBack = function($report) use ($severity) {
			if ($report->severity == $severity)
				return true;
			return false;
		};
		return count(array_filter(self::$reports, $callBack));
	}
	
	public static function getErrorCount() {
		return self::getCountFor(REPORT_LEVEL_ERROR);
	}
	
	public static function getWarningCount() {
		return self::getCountFor(REPORT_LEVEL_WARNING);
	}
	
	public static function getInfoCount() {
		return self::getCountFor(REPORT_LEVEL_INFO);
	}
	
	private static function filterReports($severity) {
		
	}
	
}

Report::init();