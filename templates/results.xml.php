<?php 
header('Content-Type: application/xml; charset=UTF-8');
$xml = '<?xml version="1.0" encoding="UTF-8"?>';
echo $xml;
if (isset($_GET['debug_lang']) && $_GET['debug_lang'] == 'true')
	Conf::set('debug_lang', 'true');

$reps = array (
	array(
		'key'		=> 'charset',
		'name'		=> 'charset_category',
		'reports'	=> Report::getReportsStartingWith('rep_charset_')
	),
	array(
		'key'		=> 'lang',
		'name'		=> 'lang_category',
		'reports'	=> Report::getReportsStartingWith('rep_lang_')
	),
	array(
		'key'		=> 'markup',
		'name'		=> 'markup_category',
		'reports'	=> Report::getReportsStartingWith('rep_markup_')
	),
	array(
		'key'		=> 'nonLatin',
		'name'		=> 'classId_category',
		'reports'	=> Report::getReportsStartingWith('rep_latin_')
	),
)

?>

<observationresponse xmlns="http://www.w3.org/2009/10/unicorn/observationresponse" ref="<?php echo htmlspecialchars($uri); ?>" xml:lang="en">

<?php if (Report::getErrorCount() > 0) { ?>
	<status value="failed" />
<?php } else if (Report::getWarningCount() > 0) { ?>
	<status value="undef" />
<?php } else { ?>
	<status value="passed" />
	<message type="info">
		<title><?=lang('rep_unicorn_no_issue')?></title>
		<description><?=lang('rep_unicorn_decription','http://validator.w3.org/i18n-checker/check?uri='.htmlentities(urlencode($uri),ENT_COMPAT,"utf-8"))?></description>
	</message> 
<?php } ?>

<?php 

foreach ($reps as $cat) {
	if ($cat['reports'] != null) { 
		echo '<group name="', $cat['key'], '">', "\n";
     	echo "\t", '<title>', lang($cat['name']), '</title>', "\n";
     	echo '</group>', "\n\n";
	}
}

foreach ($reps as $cat) {
	if ($cat['reports'] != null) { 
		foreach ($cat['reports'] as $report) {
			echo '<message type="', $report->severity, '" group="', $cat['key'], '">', "\n";
				echo '<title>', preg_replace('|</?code[^>]*>|', '', $report->title), '</title>', "\n";
				echo '<description>', "\n";
				if ($report->explanation != null) {
					echo "<h3>", lang('rep_explanation'), "</h3>";
					foreach ((array) $report->explanation as $expl)
						echo strpos($expl, '<') === 0 ? $expl : "<p>".$expl."</p>"; // if the line starts with a tag do not add inside p
				}
				if ($report->whattodo != null) {
					echo "<h3>", lang('rep_what_to_do'), "</h3>";
					foreach ((array) $report->whattodo as $todo)
						echo strpos($todo, '<') === 0 ? $todo : "<p>".$todo."</p>";
				}
				if ($report->further != null) {
					echo "<h3>", lang('rep_further_reading'), "</h3>";
					echo Language::format($report->further, LANG_FORMAT_OL);
				}
				echo "\n", '</description>', "\n";
			echo '</message>', "\n\n";
		}
 	}
}
?>
</observationresponse>