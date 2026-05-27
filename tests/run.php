<?php
/**
 * CLI regression test runner.
 *
 * Usage: php tests/run.php
 *
 * Mirrors what www/test.php does in the browser: loads test definitions from
 * tests/tests_*.properties, constructs URLs to the test document generator,
 * runs each document through the Checker, and compares actual results against
 * expected info values and reports.
 *
 * Outputs one line per test-format combination and exits with code 1 if any
 * check fails (or an error occurs).
 */

// Bootstrap the checker (same path resolution as www/*.php entry points)
chdir(dirname(__FILE__) . '/../www');
require_once realpath(dirname(__FILE__) . '/../src/class.Conf.php');
require_once PATH_SRC . '/class.Message.php';
require_once PATH_SRC . '/class.Language.php';
require_once PATH_SRC . '/class.Net.php';
require_once PATH_SRC . '/class.Checker.php';
require_once PATH_SRC . '/class.Test.php';

$testConf = Test::load();
if ($testConf === null) {
	echo "ERROR: no test definitions loaded\n";
	exit(1);
}

$test_url       = Conf::get('test_url');
$test_param_id  = Conf::get('test_param_id');
$test_param_format = Conf::get('test_param_format');
$test_param_serveas = Conf::get('test_param_serveas');
$test_categories    = Conf::get('test_categories');
$test_info_categories = Conf::get('test_info_categories');
$test_formats       = explode(',', Conf::get('test_formats'));

$total   = 0;
$passed  = 0;
$failed  = 0;
$errors  = 0;
$details = [];   // collect failure lines for summary

foreach ($test_categories as $category) {
	$catTests = Test::getTests($category, $testConf);
	if (empty($catTests)) {
		continue;
	}

	foreach ($catTests as $test) {
		$testFor = explode(',', $test['test_for']);

		foreach ($test_formats as $formatStr) {
			if (!in_array($formatStr, $testFor)) {
				continue;       // this format does not apply
			}

			$total++;
			$parts = explode(':', $formatStr);
			$fmt   = $parts[0];
			$serve = isset($parts[1]) ? $parts[1] : 'html';

			$uri = isset($test['url'])
				? $test['url']
				: Test::constructUri($test['id'], $fmt, $serve);

			$b = ($serve === 'xml')
				? Test::startCheck($uri, false, 'application/xhtml+xml')
				: Test::startCheck($uri, false);

			if (!$b) {
				$errors++;
				$label = sprintf("ERROR %-30s %s", $test['name'], $formatStr);
				$details[] = $label;
				echo "$label\n";
				Information::clear();
				Report::clear();
				continue;
			}

			$result = Test::checkResult($test);

			if ($result['success'] === 'undef') {
				// nothing was actually checked — treat as pass
				$passed++;
				echo sprintf("SKIP  %-30s %s\n", $test['name'], $formatStr);
			} elseif ($result['success']) {
				$passed++;
				echo sprintf("PASS  %-30s %s\n", $test['name'], $formatStr);
			} else {
				$failed++;
				$label = sprintf("FAIL  %-30s %s  —  %s", $test['name'], $formatStr, $result['reason']);
				$details[] = $label;
				echo "$label\n";
			}

			// State cleanup
			Information::clear();
			Report::clear();
		}
	}
}

echo "\n";
echo "Results: $passed passed, $failed failed, $errors errors ($total total)\n";

if ($failed > 0 || $errors > 0) {
	echo "\n--- failures ---\n";
	foreach ($details as $d) {
		echo "  $d\n";
	}
	exit(1);
}

echo "All checks passed.\n";
exit(0);
