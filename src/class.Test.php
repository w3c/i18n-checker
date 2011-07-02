<?php 
/**
 * Contains the Test class.
 * @package w3Checker
 */
/**
 * Test class
 * 
 * Contains functions used by the test page.
 * 
 * @package w3Checker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Test {

	private static $logger;
	
	public static function _init() {
		self::$logger = Logger::getLogger('TestClass');
	}
	
	static function load() {
		$testConf = array();
		$testFiles = scandir(PATH_TEST);
		foreach ($testFiles as $fileName) {
			if (is_dir($fileName))
				continue;
			if (!preg_match("/.+\.properties/", $fileName))
				continue;
			self::$logger->info("Parsing ".$fileName);
			$testFileConf = parse_ini_file($fileName);
			if (!$testFileConf) {
				Message::addMessage(MSG_LEVEL_ERROR, "Failed to parse test file: ".$fileName);
				self::$logger->error("Failed to parse test file: ".$fileName);
				continue;
			}
			$testConf = array_merge($testConf, $testFileConf);
		}
		return empty($testConf) ? null : $testConf;
	}
	
	static function loadRemote($url) {
		$file = Net::fetchDocument($url);
		if ($file[2]['http_code'] != 200) {
			self::$logger->error("Failed to load submitted url: ".$url.". Error is: ".$file[4]);
			Message::addMessage(MSG_LEVEL_ERROR, "Failed to load submitted url: ".$url.". Error is: ".$file[4]);
			return null;
		}
		$tmpfname = tempnam(".", "TEST_");
		$handle = fopen($tmpfname, "w");
		fwrite($handle, $file[1]);
		fclose($handle);
		$testConf = parse_ini_file($tmpfname);
		unlink($tmpfname);
		if ($testConf == null) Message::addMessage(MSG_LEVEL_ERROR, "Failed to parse test file: ".$url);
		return $testConf;
	}
	
	static function checkResult($test) {
		// Loop through info subcategories (info_charset, info_lang, etc...)
		$infoHasBeenChecked = false;
		foreach (Conf::get('test_info_categories') as $info_category) {
			if ($test[$info_category] === null) {
				self::$logger->info("$info_category is not set for this test. Ignoring.");
				continue;
			}
			$infoHasBeenChecked = true;
			self::$logger->info("- Starting check for info category $info_category");
			if (empty($test[$info_category])) {
				//Information::getValuesStartingWith('charset_')
				$realCatName = preg_replace('/info_/', '', $info_category).'_';
				self::$logger->info("Category $info_category is set but empty. Checking that no values were returned in the resolved category: ".$realCatName);
				$returnedCatValues = Utils::valuesFromValArray(Information::getValuesStartingWith($realCatName));
				self::$logger->info("Values returned for category $realCatName are: ".implode(', ', $returnedCatValues));
				if (count($returnedCatValues) > 0) {
					self::$logger->info("FAILED: Values where returned but none were expected: ".implode(', ', $returnedCatValues));
					return array(
						'success' => false,
						'reason'  => "No values were expected for category $info_category. Found: ".implode(', ', $returnedCatValues)
					);
				}
				self::$logger->info("No values were returned.");
			}
			
			foreach ($test[$info_category] as $check) {
				$expectedValues = $check['values'];
				$returnedValues =  Utils::valuesFromValArray(Information::getValues($check['name']));
				self::$logger->info("Expected values for ".$check['name']." are: ".implode(', ', (array) $expectedValues));
				self::$logger->info("Returned values for ".$check['name']." are: ".implode(', ', (array) $returnedValues));
				$diff = array_diff((array) $expectedValues, (array) $returnedValues);
				if (!empty($diff)) {
					self::$logger->info("FAILED: Somes expected values where not returned or were incorrect for ".$check['name'].": ".implode(', ', $diff));
					return array(
						'success' => false,
						'reason'  => 'Missing or incorrect value(s) for '.$check['name'].': '.implode(', ', $diff)
					);
				}
				$diff = array_diff((array) $returnedValues, (array) $expectedValues);
				if (!empty($diff)) {
					self::$logger->info("FAILED: Somes values were returned that were not expected for ".$check['name'].": ".implode(', ', $diff));
					return array(
						'success' => false,
						'reason'  => 'Returned unexpected value(s): '.implode(', ', $diff)
					);
				}
			}
		}
		
		if ($test['reports'] === null) {
			self::$logger->info("There is no report check for this test.");
			if (!$infoHasBeenChecked)
				return array(
					'success' => 'undef'
				);
			return array(
				'success' => true
			);
		}
		
		if (empty($test['reports'])) {
			self::$logger->info("Report is set but empty. Checking that no report were returned");
			if (Report::$reports != null && count(Report::$reports) > 0) {
				$returnedReports = array_keys(Report::$reports);
				self::$logger->info("FAILED: Reports where returned but none were expected: ".implode(', ', $returnedReports));
				return array(
					'success' => false,
					'reason'  => "No reports were expected. Found: ".implode(', ', $returnedReports)
				);
			}
			return array(
				'success' => true
			);
		}
		self::$logger->info("Starting report check");
		$expectedReports = self::getReportKeys($test['reports']);
		$returnedReports = array_keys(Report::$reports);
		self::$logger->info("Expected reports are: ".implode(', ', (array) $expectedReports));
		self::$logger->info("Returned reports are: ".implode(', ', $returnedReports));
		$diff = array_diff((array) $expectedReports, (array) $returnedReports);
		if (!empty($diff)) {
			self::$logger->info("FAILED: Somes expected reports where not returned: ".implode(',', $diff));
			return array(
				'success' => false,
				'reason'  => 'Missing expected report(s): '.implode(',', $diff)
			);
		}
		$diff = array_diff((array) $returnedReports, (array) $expectedReports);
		if (!empty($diff)) {
			self::$logger->info("FAILED: Somes reports were returned that were not expected: ".implode('.', $diff));
			return array(
				'success' => false,
				'reason'  => 'Returned unexpected report(s): '.implode('.', $diff)
			);
		}
		foreach ($test['reports'] as $testReport) {
			if (!empty($testReport['checks'])) {
				self::$logger->info("Checking additional conditions for report: ".$testReport['name']);
				foreach ($testReport['checks'] as $condition) {
					self::$logger->error(print_r($condition,true));
					switch ($condition['type']) {
						case 'severity':
							if (Report::$reports[$testReport['name']]->severity == $condition['value'])
								self::$logger->info("- Severity must be ".$condition['value'].": PASSED");
							else {
								self::$logger->info("- Severity must be ".$condition['value'].": FAILED");
								return array(
									'success' => false,
									'reason'  => 'An additional condition on report '.$testReport['name'].' has not been met. Severity was expected to be '.$condition['value'].' but is '.Report::$reports[$testReport['name']]->severity.'.'
								);
							}
						default:
							self::$logger->warn("- Unknown condition: ".$condition['type']);
					}
				}
			}
		}
		//self::$logger->error(print_r($test['reports'],true));
		
		
		// run additional report checks like severity
		// TODO
		
		return array(
			'success' => true
		);
	}
	
	static function getReportKeys($reportArray) {
		$result = array();
		foreach ($reportArray as $report)
			$result[] = $report['name'];
		return $result;
	}
	
	static function startCheck($url) {
		$document = Net::getDocumentByUri($url);
		$uri = $document[0];
		$curl_info = $document[1];
		$content = $document[2];
		$checker = new Checker($curl_info, $content);
		$b = $checker->checkDocument();
		return $b;
	}
	
	static function constructUri($id, $format, $serveas) {
		return Conf::get('test_url').'?'.Conf::get('test_param_id').'='.$id.'&'.Conf::get('test_param_format').'='.$format.'&'.Conf::get('test_param_serveas').'='.$serveas;
	}
	
	static function generateTestURL($uri) {
		return Conf::get('base_uri').'check.php?uri='.urlencode($uri);
	}
	
	static function getTests($category, $testConf) {
		$tests = array();
		foreach ($testConf as $key => $val) {
			if (preg_match('/^'.$category.'_[^_]+$/', $key)) {
				$tests[] = array(
					'name'   		 => $testConf[$key],
					'id'			 => isset($testConf[$key.'_id']) ? $testConf[$key.'_id'] : null,
					'url'			 => isset($testConf[$key.'_url']) ? $testConf[$key.'_url'] : null,
					'test_for'		 => $testConf[$key.'_test_for'],
					'info_charset'   => isset($testConf[$key.'_info_charset']) ? self::getInfoChecks($testConf[$key.'_info_charset']) : null,
					'info_lang'   	 => isset($testConf[$key.'_info_lang']) ? self::getInfoChecks($testConf[$key.'_info_lang']) : null,
					'info_dir'   	 => isset($testConf[$key.'_info_dir']) ? self::getInfoChecks($testConf[$key.'_info_dir']) : null,
					'info_classId' 	 => isset($testConf[$key.'_info_classId']) ? self::getInfoChecks($testConf[$key.'_info_classId']) : null,
					'info_headers' 	 => isset($testConf[$key.'_info_headers']) ? self::getInfoChecks($testConf[$key.'_info_headers']) : null,
					'reports' 		 => isset($testConf[$key.'_report']) ? self::getReportChecks($testConf[$key.'_report']) : null 
				);
			}
		}
		return $tests;
	}
	
	static function getInfoChecks($checkArray) {
		$checkArray = (array) $checkArray;
		if (count($checkArray) == 1 && $checkArray[0] == "")
			return array();
		foreach ($checkArray as &$info)
			$info = self::parserInfo($info);
		return $checkArray;
	}
	
	static function getReportChecks($checkArray) {
		$checkArray = (array) $checkArray;
		if (count($checkArray) == 1 && $checkArray[0] == "")
			return array();
		foreach ($checkArray as &$info)
			$info = self::parserReport($info);
		return $checkArray;
	}
	
	static function parserReport($report) {
		if ($report == "")
			return null;
		preg_match('/^([^\{\}]+)({(.*)})?$/', $report, $matches);
		return array(
			'name'  => $matches[1],
			'checks' => isset($matches[3]) ? array_map('self::parseReportCondition', self::parseValues($matches[3])) : null
		);
	}
	
	static function parseReportCondition($condition) {
		$t = explode(":", $condition);
		return array (
			'type'  => $t[0],
			'value' => $t[1]
		);
	}
	
	static function parserInfo($info) {
		if ($info == "")
			return null;
		preg_match('/^([^\{\}]+)({(.*)})?$/', $info, $matches);
		return array(
			'name'  => $matches[1],
			'values' => isset($matches[3]) ? self::parseValues($matches[3]) : null
		);
	}
	
	static function parseValues($values) {
		return explode(',', $values);
	}
	
}

Test::_init();