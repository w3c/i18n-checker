<?php
header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$js[] = "mootools-1.2.5-core-more-yc.js";
$js[] = "w3c_unicorn_index.js";
$lang_action = "";
include('includes/head.html.php');
include('includes/form.php');
?>

	<div class="intro">
		<p><?php _lang('intro') ?></p>
		<p><?php _lang('intro_links') ?></p>
	</div>
	<div id="don_program">
		<script type="text/javascript" src="http://www.w3.org/QA/Tools/don_prog.js"></script>
	</div>

<?php include('includes/footer.html.php');