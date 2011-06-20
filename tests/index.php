<?php
@apache_setenv('no-gzip', 1);
@ini_set('zlib.output_compression', 0);
ob_implicit_flush(1);

require_once(realpath(dirname(__FILE__).'/../src/class.Conf.php'));
require_once(PATH_SRC.'/class.Message.php');
require_once(PATH_SRC.'/class.Language.php');
require_once(PATH_SRC.'/class.Net.php');
require_once(PATH_SRC.'/class.Checker.php');

header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker Tests";
$css[] = "base_ucn.css";
$js[] = "mootools-1.2.5-core-more-yc.js";
$lang_action = "";
include(PATH_TEMPLATES.'/html/head.php');

$logger = Logger::getLogger('Tests');
$logger->info("Initiating tests");

echo '<div id="infos" class="tests block">';

if (isset($_GET['test_file'])) {
	$file = Net::fetchDocument($_GET['test_file']);
	if ($file[4] != "") {
		$logger->error("Failed to parse submitted url: ".$_GET['test_file']);
		echo '<div><br />Failed to parse submitted url as a tests.properties file! ('.$file[4].')</div></div>';
		include(PATH_TEMPLATES.'/html/footer.php');
		exit(1);
	}
	$tmpfname = tempnam(".", "TEST_");
	$handle = fopen($tmpfname, "w");
	fwrite($handle, $file[1]);
	fclose($handle);
	$testConf = parse_ini_file($tmpfname);
	$remote = true;
	unlink($tmpfname);
} else {
	$logger->info("Parsing tests.properties");
	$testConf = parse_ini_file('tests.properties');
	$remote = false;
	if (!$testConf) {
		$logger->error("Failed to parse tests.properties");
		echo '<div><br />Failed to parse tests.properties!</div></div>';
		include(PATH_TEMPLATES.'/html/footer.php');
		exit(1);	
	}
}

$test_url=$testConf['test_url'];
$test_param_id=$testConf['test_param_id'];
$test_param_format=$testConf['test_param_format'];
$test_param_serveas=$testConf['test_param_serveas'];
$test_categories=$testConf['test_categories'];
$test_info_categories=$testConf['test_info_categories'];
$test_formats=explode(',',$testConf['test_formats']);

$tests = array();
$categories = array('charset','lang');

$count = 0;
foreach ($test_categories as $category) {
	$tests[$category] = getTests($category, $testConf);
	$count += count($tests[$category]);
}

$logger->info("Parsed $count tests successfully");

$startingTime = time();
$passedCount = 0;
$failedCount = 0;
?>
<div class="top">Succefully parsed <b><?php echo $count ?></b> tests from <?php echo $remote ? 'remote file ('.$_GET['test_file'].')' : 'tests.properties'?>.</div>

<table>
	<tbody>
<?php 
$i = 1;
foreach ($tests as $category => $catTests) {
	$logger->info("##################################");
	$logger->info("### Starting $category section");
	$logger->info("##################################");
	echo '<tr>';
	echo '<th></th><th>', lang($category.'_category'), "</th>";
	foreach ($test_formats as $format) {
		echo '<th>', $testConf['test_display_'.preg_replace('/:/', '_', $format)] ,'</th>';
	}
	echo '</tr>';
	// Loop through all tests in that category
	foreach ($catTests as $test) {
		$logger->info("# Starting test ".$test['name']." #");
		$logger->debug("Test data: ".print_r($test, true));
		echo '<tr>';
		echo '<td>', $i, '</td><td>', $test['name'], '</td>';
		$i++;
		$testFor = explode(',', $test['test_for']);
		foreach ($test_formats as $format) {
			if (!in_array($format, $testFor)) {
				echo '<td>-</td>';
				continue;
			}
			$logger->info("- Starting test for format $format -");
			$format = explode(':', $format);
			$uri = isset($test['url']) ? $test['url'] : constructUri($test['id'], $format[0], isset($format[1]) ? $format[1] : 'html');
			$logger->info("Test file uri resolved to: $uri");
			$b = startCheck($uri);
			if (!$b) {
				$logger->error("An error occured while executing test: ".generateTestURL($uri));
				echo '<td><a href="', generateTestURL($uri),'Check error</a></td>';
				continue;
			}
			$logger->info("Check executed successfully. Checking results...");
			$result = checkResult($test);
			if ($result['success']) {
				$logger->info("-> Test is successful");
				$passedCount++;
				echo '<td class="success"><a href="', generateTestURL($uri),'">✔</a></td>';
			} else {
				$logger->info("-> Test failed");
				$failedCount++;
				echo '<td class="fail" title="', $result['reason'], '"><a href="', generateTestURL($uri),'">✘</a></td>';
			}
			Information::clear();
			Report::clear();
			_flush();
			sleep($testConf['test_sleep_between']);
		}	
		echo '</tr>';
	}
}

?>
	</tbody>
</table>

<?php echo '<div class="result">Ran a total of <b>', $passedCount + $failedCount, '</b> checks in <b>', time() - $startingTime, '</b> seconds. <b>',
	$failedCount, '</b> checks failed.</div>' ?>

</div>

<script type="text/javascript">
	var td = $$('#infos td[title]');
	td.each(function(element) { 
		element.store('tip:text', element.title);
		element.removeProperty('title');
	});
	new Tips(td);
	var resText = $$('div.result');
	var intro = $$('div.top');
	intro.set('html', intro.get('html') + ' ' + resText.get('html'));
</script>

<?php 

include(PATH_TEMPLATES.'/html/footer.php');

function checkResult($test) {
	global $test_info_categories, $logger;
	// Loop through info subcategories (info_charset, info_lang, etc...)
	foreach ($test_info_categories as $info_category) {
		if ($test[$info_category] === null) {
			$logger->info("$info_category is not set for this test. Ignoring.");
			continue;
		}
		$logger->info("- Starting check for info category $info_category");
		//$test[$info_category] = getInfoTests($test[$info_category]);
		//$logger->info("Infos to check are: ".$test[$info_category] == null ? 'none present' : print_r($test[$info_category], true));
		
		if (empty($test[$info_category])) {
			//Information::getValuesStartingWith('charset_')
			$realCatName = preg_replace('/info_/', '', $info_category).'_';
			$logger->info("Category $info_category is set but empty. Checking that no values were returned in the resolved category: ".$realCatName);
			$returnedCatValues = Utils::valuesFromValArray(Information::getValuesStartingWith($realCatName));
			$logger->info("Values returned for category $realCatName are: ".implode(', ', $returnedCatValues));
			if (count($returnedCatValues) > 0) {
				$logger->info("FAILED: Values where returned but none were expected: ".implode(', ', $returnedCatValues));
				return array(
					'success' => false,
					'reason'  => "No values were expected for category $info_category. Found: ".implode(', ', $returnedCatValues)
				);
			}
			$logger->info("No values were returned.");
		}
		
		foreach ($test[$info_category] as $check) {
			$expectedValues = $check['values'];
			$returnedValues =  Utils::valuesFromValArray(Information::getValues($check['name']));
			$logger->info("Expected values for ".$check['name']." are: ".implode(', ', (array) $expectedValues));
			$logger->info("Returned values for ".$check['name']." are: ".implode(', ', (array) $returnedValues));
			$diff = array_diff((array) $expectedValues, (array) $returnedValues);
			if (!empty($diff)) {
				$logger->info("FAILED: Somes expected values where not returned or were incorrect for ".$check['name'].": ".implode(', ', $diff));
				return array(
					'success' => false,
					'reason'  => 'Missing or incorrect value(s) for '.$check['name'].': '.implode(', ', $diff)
				);
			}
			$diff = array_diff((array) $returnedValues, (array) $expectedValues);
			if (!empty($diff)) {
				$logger->info("FAILED: Somes values were returned that were not expected for ".$check['name'].": ".implode(', ', $diff));
				return array(
					'success' => false,
					'reason'  => 'Returned unexpected value(s): '.implode(', ', $diff)
				);
			}
		}
	}
	
	if ($test['reports'] === null) {
		$logger->info("There is no report check for this test.");
		return array(
			'success' => true
		);
	}
	
	if (empty($test['reports'])) {
		$logger->info("Report is set but empty. Checking that no report were returned");
		$returnedReports = array_keys(Report::$reports);
		if (count($returnedReports) > 0) {
			$logger->info("FAILED: Reports where returned but none were expected: ".implode(', ', $returnedReports));
			return array(
				'success' => false,
				'reason'  => "No reports were expected. Found: ".implode(', ', $returnedReports)
			);
		}
		return array(
			'success' => true
		);
	}
	$logger->info("Starting report check");
	$expectedReports = getReportKeys($test['reports']);
	$returnedReports = array_keys(Report::$reports);
	$logger->info("Expected reports are: ".implode(', ', (array) $expectedReports));
	$logger->info("Returned reports are: ".implode(', ', $returnedReports));
	$diff = array_diff((array) $expectedReports, (array) $returnedReports);
	if (!empty($diff)) {
		$logger->info("FAILED: Somes expected reports where not returned: ".implode(',', $diff));
		return array(
			'success' => false,
			'reason'  => 'Missing expected report(s): '.implode(',', $diff)
		);
	}
	$diff = array_diff((array) $returnedReports, (array) $expectedReports);
	if (!empty($diff)) {
		$logger->info("FAILED: Somes reports were returned that were not expected: ".implode('.', $diff));
		return array(
			'success' => false,
			'reason'  => 'Returned unexpected report(s): '.implode('.', $diff)
		);
	}
	// run additional report checks like severity
	// TODO
	
	return array(
		'success' => true
	);
}

function getReportKeys($reportArray) {
	$result = array();
	foreach ($reportArray as $report)
		$result[] = $report['name'];
	return $result; 
}

function startCheck($url) {
	$document = Net::getDocumentByUri($url);
	$uri = $document[0];
	$curl_info = $document[1];
	$content = $document[2];
	$checker = new Checker($curl_info, $content);
	$b = $checker->checkDocument();
	return $b;
}

function constructUri($id, $format, $serveas) {
	global $test_url, $test_param_id, $test_param_format, $test_param_serveas; 
	return $test_url.'?'.$test_param_id.'='.$id.'&'.$test_param_format.'='.$format.'&'.$test_param_serveas.'='.$serveas;
}

function generateTestURL($uri) {
	global $testConf;
	return $testConf['test_url_validator'].'?uri='.urlencode($uri);
}

function getTests($category, $testConf) {
	$tests = array();
	foreach ($testConf as $key => $val) {
		if (preg_match('/^'.$category.'_[^_]+$/', $key)) {
			$tests[] = array(
				'name'   		 => $testConf[$key],
				'id'			 => isset($testConf[$key.'_id']) ? $testConf[$key.'_id'] : null,
				'url'			 => isset($testConf[$key.'_url']) ? $testConf[$key.'_url'] : null,
				'test_for'		 => $testConf[$key.'_test_for'],
				'info_charset'   => isset($testConf[$key.'_info_charset']) ? getInfoChecks($testConf[$key.'_info_charset']) : null,
				'info_lang'   	 => isset($testConf[$key.'_info_lang']) ? getInfoChecks($testConf[$key.'_info_lang']) : null,
				'info_dir'   	 => isset($testConf[$key.'_info_dir']) ? getInfoChecks($testConf[$key.'_info_dir']) : null,
				'info_classId' 	 => isset($testConf[$key.'_info_nonLat']) ? getInfoChecks($testConf[$key.'_info_nonLat']) : null,
				'info_headers' 	 => isset($testConf[$key.'_info_headers']) ? getInfoChecks($testConf[$key.'_info_headers']) : null,
				'reports' 		 => isset($testConf[$key.'_report']) ? getReportChecks($testConf[$key.'_report']) : null 
			);
		}
	}
	return $tests;
}

/*
 * 
 * 
 */
function getInfoChecks($checkArray) {
	$checkArray = (array) $checkArray;
	if (count($checkArray) == 1 && $checkArray[0] == "")
		return array();
	foreach ($checkArray as &$info)
		$info = parserInfo($info);
	return $checkArray;
}

function getReportChecks($checkArray) {
	$checkArray = (array) $checkArray;
	if (count($checkArray) == 1 && $checkArray[0] == "")
		return array();
	foreach ($checkArray as &$info)
		$info = parserReport($info);
	return $checkArray;
}

function parserReport($report) {
	if ($report == "")
		return null;
	preg_match('/^([^\{\}]+)({(.*)})?$/', $report, $matches);
	return array(
		'name'  => $matches[1],
		'checks' => isset($matches[3]) ? array_map('parseReportCondition', parseValues($matches[3])) : null
	);
}

function parseReportCondition($condition) {
	$t = explode(":", $condition);
	return array (
		'type'  => $t[0],
		'value' => $t[1]
	);
}

function parserInfo($info) {
	if ($info == "")
		return null;
	preg_match('/^([^\{\}]+)({(.*)})?$/', $info, $matches);
	return array(
		'name'  => $matches[1],
		'values' => isset($matches[3]) ? parseValues($matches[3]) : null
	);
}

function parseValues($values) {
	return explode(',', $values);
}

function _flush (){
    echo(str_repeat(' ',256));
    // check that buffer is actually set before flushing
    if (ob_get_length()){
        @ob_flush();
        @flush();
        @ob_end_flush();
    }
    @ob_start();
}