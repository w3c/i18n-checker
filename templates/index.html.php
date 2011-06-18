<?php
header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$js[] = "mootools-1.2.5-core-more-yc.js";
$js[] = "w3c_unicorn_index.js";
$lang_action = "";

if (isset($_GET['debug_lang']) && $_GET['debug_lang'] == 'true')
	Conf::set('debug_lang', 'true');

include(PATH_TEMPLATES.'/html/head.php');
include(PATH_TEMPLATES.'/html/messages.php');
include(PATH_TEMPLATES.'/html/form.php');
?>

	<div class="intro">
		<p><?php _lang('intro') ?></p>
		<p><?php _lang('intro_links') ?></p>
	</div>
	<div id="don_program">
		<script type="text/javascript" src="http://www.w3.org/QA/Tools/don_prog.js"></script>
	</div>

<?php include(PATH_TEMPLATES.'/html/footer.php');