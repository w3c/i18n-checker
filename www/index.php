<?php
require_once(realpath(dirname(__FILE__).'/../src/class.Conf.php'));
require_once(PATH_SRC.DIRECTORY_SEPARATOR.'class.Language.php');
require_once(PATH_SRC.DIRECTORY_SEPARATOR.'class.Message.php');
// Hide language selection for now - remove this line or set to false to bring it back
$hideLangSelection = true;

Message::addMessage(MSG_LEVEL_WARNING, 'The checker is still only a prototype, so there are guarranteed to be bugs and missing features.  
	It will be developed over the coming months, but it has been made available for use now since it is likely to be helpful to many people already. 
	If you have suggestions for ways to improve the checker, please fill in the feedback form.');

/*$format = isset($_REQUEST['format']) && $_REQUEST['format'] != "" ? $_REQUEST['format'] : Conf::get('default_format');
if (!file_exists(PATH_TEMPLATES."/index.$format.php")) {
	$format = Conf::get('default_format');
	Message::addMessage(MSG_LEVEL_WARNING, lang("message_requested_format_unavailable", $_REQUEST['format'], $format));
}
include(PATH_TEMPLATES."/index.$format.php");*/
	
include(PATH_TEMPLATES."/index.html.php");