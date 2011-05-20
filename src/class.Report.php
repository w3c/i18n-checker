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
	
	private static function filterReports($severity) {
		$callBack = function($report) use ($severity) {
			if ($report->severity == $severity)
				return true;
			return false;
		};
		return array_filter(self::$reports, $callBack);
	}
	
	public static function getCount() {
		return count(self::$reports);
	}
	
	public static function getErrorCount() {
		return count(self::filterReports(REPORT_LEVEL_ERROR));
	}
	
	public static function getWarningCount() {
		return count(self::filterReports(REPORT_LEVEL_WARNING));
	}
	
	public static function getInfoCount() {
		return count(self::filterReports(REPORT_LEVEL_INFO));
	}
	
	public static function getErrors() {
		return self::filterReports(REPORT_LEVEL_ERROR);
	}
	
	public static function getWarnings() {
		return self::filterReports(REPORT_LEVEL_WARNING);
	}
	
	public static function getInfos() {
		return self::filterReports(REPORT_LEVEL_INFO);
	}
	
	public static function getReportsSorted() {
		$logger = &self::$logger;
		$sortedReports = self::$reports; // copy before, sorting is done in place
		$sort = function($first, $second) use (&$logger) {
			if ($first->severity == $second->severity)
				return 0;
			if ($first->severity == REPORT_LEVEL_ERROR) // ERROR lower than all
				return -1;
			if ($second->severity == REPORT_LEVEL_ERROR)
				return 1;
			if ($first->severity == REPORT_LEVEL_INFO) // INFO higher than all
				return 1;
			if ($second->severity == REPORT_LEVEL_INFO)
				return -1;
		};
		if (usort($sortedReports, $sort)) 
			return $sortedReports;
		return self::$reports; // if sorting failed
	}
	
}

Report::init();