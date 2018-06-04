<?php
/**
 * Contains the Report class.
 * @package i18nChecker
 */
/**
 * Information severity level for a report message
 */
define("REPORT_LEVEL_INFO", "info");
/**
 * Warning severity level for a report message
 */
define("REPORT_LEVEL_WARNING", "warning");
/**
 * Error severity level for a report message
 */
define("REPORT_LEVEL_ERROR", "error");
/**
 * Report class
 * 
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Report {
	
	public static $reports;
	
	public $id;
	public $category;
	public $severity;
	public $title;
	public $explanation;
	public $whattodo;
	public $further;
	
	private function __construct($id, $category, $severity, $title, $explanation, $whattodo, $further) {
		$this->id = $id;
		$this->category = $category;
		$this->severity = $severity;
		$this->title = $title;
		$this->explanation = $explanation;
		$this->whattodo = $whattodo;
		$this->further = $further;
	}
	
	public static function addReport($id, $category, $severity, $title, $explanation, $whattodo, $further) {
		self::$reports[$id] = new Report($id, $category, $severity, $title, $explanation, $whattodo, $further);
	}
	
	private static function filterReports($severity) {
		if (self::$reports == null)
			return null;
		return array_filter(self::$reports, function($report) use ($severity) {
					if ($report->severity == $severity)
						return true;
					return false;
				});
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
		$sortedReports = self::$reports; // copy before, sorting is done in place
		$sort = function($first, $second) {
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
	
	public static function clear() {
		self::$reports = array();
	}
	
	public static function getReportsStartingWith($name) {
		if (self::$reports == null)
			return null;
		$keys = array_keys(self::$reports);
		foreach ($keys as $key)
			if (preg_match('/^'.$name.'/', $key))
				$result[] = self::$reports[$key];
		return isset($result) ? $result : null; 
	}
	
}