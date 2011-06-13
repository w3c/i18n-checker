<?php
header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$js[] = "mootools-1.2.5-core-more-yc.js";
$js[] = "w3c_unicorn_index.js";
$js[] = "w3c_unicorn_results.js";
$lang_action = "check";
$lang_action .= Conf::get('show_extension') ? '.php' : '';
include('includes/head.html.php');
include('includes/form.php');
?>

<script type="text/javascript">
	window.addEvent('domready', W3Cr.start);
</script>

<?php if ($succeded) { ?>
<div id="results" class="section">
	<h1 class="title">
		<a href="#result"><?php _lang('results', $uri) ?></a>
	</h1>
	
	<div class="block<?php echo Report::getCount() == 0 ? ' noissues' : '' ?>">
		<?php if (Report::getCount() > 0) {
			 if (($errorCount = Report::getErrorCount()) > 0) {
				echo '<img src="images/error.png" alt="Error" title="', $errorCount, ' error(s)" /> ';
				echo "<strong>$errorCount</strong>";
			 } if (($warningCount = Report::getWarningCount()) > 0) {
				echo '<img src="images/warning.png" alt="Warning" title="', $warningCount, ' warning(s)" /> ';
				echo "<strong>$warningCount</strong>";
			 } if (($infoCount = Report::getInfoCount()) > 0) {
				echo '<img src="images/comment.png" alt="Suggestion" title="', $infoCount,' suggestion(s)" /> ';
				echo "<strong>$infoCount</strong>";
			}
		} else {
				echo lang('no_issues');
		} ?>
	</div>
</div>
<?php } ?>

<?php if (Information::getCount() > 0) { ?>
<div id="infos" class="section">
	<h1 class="title">
		<span class="meta"><?php echo Information::get('dtd')->display_value ?>&nbsp;&nbsp;-&nbsp;&nbsp;<?php echo Information::get('mimetype')->display_value ?></span>
		<a href="#infos"><?php _lang('information') ?></a>
	</h1>
	<div class="block">
		<table>
		<?php 
			foreach (Information::getInfoPerCategory() as $category => $infoArray) {
			    echo "<tr>\n";
			    	echo "<th>".lang($category)."</th>\n";
					echo "<th></th>\n";
					echo "<th>".lang('code')."</th>\n";
			    echo "</tr>\n";
			    foreach ($infoArray as $info) {
			    //$logger->error(print_r($info, true));
			    echo "<tr>\n";
			    	echo "<td>".lang($info->title)."</td>\n";
					echo "<td>";
					if ($info->display_value != null) {
						_lang($info->display_value);
					} else if ($info->values != null) { 
						//$logger->error(print_r($info->values, true));
						for ($i = 0; $i < count($info->values); $i++) {
							$valArray = $info->values[$i];
							foreach ((array) $valArray['values'] as $value)
								if ($value != null)
									echo '<strong class="', $info->title, '_', $i, '">', $value, '</strong> ';
						}
					}
					echo "</td>\n";
					echo "<td>\n";
						if ($info->values != null) {
							$count = count($info->values);
							echo $count > 1 ? '<ol>' : '';
							for ($i = 0; $i < $count; $i++) {
								if (($code = $info->values[$i]['code']) != null) {
									echo $count > 1 ? '<li>' : '';
									echo '<code class="', $info->title, '_', $i, '">', htmlspecialchars($code), '</code>';
									echo $count > 1 ? '</li>' : '';
								}
							}
							echo $count > 1 ? '</ol>' : '';
						}
					echo '</td>';
			    echo '</tr>';
			    }
			}
		?>
		</table>
		<p class="backtop"><a href="#"><?php _lang('top') ?></a></p>
	</div>
</div>
<?php } ?>

<?php if (Report::getCount() > 0) { ?>
<div id="report" class="section">
	<h1 class="title">
		<a href="#report"><?php _lang('detailed_report') ?></a>
	</h1>
	
	<div class="block">
		<ol>
		<?php foreach (Report::getReportsSorted() as $report) { ?> 
			<li class="section msg">
				<h2 class="title">
					<?php 
					if ($report->severity == REPORT_LEVEL_ERROR)
						echo '<img src="images/error.png" alt="Error" title="Error" />';
					elseif ($report->severity == REPORT_LEVEL_WARNING)
						echo '<img src="images/warning.png" alt="Warning" title="Warning" />';
					elseif ($report->severity == REPORT_LEVEL_INFO)
						echo '<img src="images/comment.png" alt="Suggestion" title="Suggestion" />';
					echo $report->title ?>
				</h2>
				<div class="block">
				<?php 
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
				?>
					<p class="backtop"><a href="#"><?php _lang('top') ?></a></p>
				</div>
			</li>
		<?php } ?>
		</ol>
	</div>
</div>
<?php } ?>

<?php  /* <div id="source" class="section">
	<h1><a href="#source"><?php _lang('source_code') ?></a></h1>
	<div class="content">
	</div>
</div> */ ?>

<div id="don_program">
	<script type="text/javascript" src="http://www.w3.org/QA/Tools/don_prog.js"></script>
</div>
	
<?php include('includes/footer.html.php');