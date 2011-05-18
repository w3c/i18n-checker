<?php
require_once(realpath(dirname(__FILE__).'/../src/common.php'));
header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$js[] = "mootools-1.2.5-core-more-yc.js";
$js[] = "w3c_unicorn_index.js";
$lang_action = "";
Message::addMessage(MSG_LEVEL_WARNING, 'The checker is still only a prototype, so there are guarranteed to be bugs and missing features.  
	It will be developed over the coming months, but it has been made available for use now since it is likely to be helpful to many people already. 
	If you have suggestions for ways to improve the checker, please fill in the feedback form.');

include(PATH_TEMPLATES.'/includes/head.html.php');
include(PATH_TEMPLATES.'/includes/form.php'); ?>


	<div class="intro">
		<p><?php _lang('intro') ?></p>
		<p><?php _lang('intro_links') ?></p>
	</div>
	<div id="don_program">
		<script type="text/javascript" src="http://www.w3.org/QA/Tools/don_prog.js"></script>
	</div>


<?php include(PATH_TEMPLATES.'/includes/footer.html.php');