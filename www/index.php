<?php
require_once(realpath(dirname(__FILE__).'/../src/class.Conf.php'));
require_once(PATH_SRC.DIRECTORY_SEPARATOR.'class.Language.php');
require_once(PATH_SRC.DIRECTORY_SEPARATOR.'class.Message.php');
// Hide language selection for now - remove this line or set to false to bring it back
$hideLangSelection = true;

Message::addMessage(MSG_LEVEL_INFO, 'This is a pre-final release of the checker. Please contact us about errors, bugs or suggestions using the <a href="http://www.w3.org/International/2007/06/surveyform-110707.php?docname=http://validator.w3.org/i18n-checker&amp;referer=http://validator.w3.org/i18n-checker">feedback form</a>. We already have plans to add further tests and features, to translate the user interface, to add support for XHTML5 and polyglot documents, and to integrate with the W3C Unicorn checker.');

$format = isset($_REQUEST['format']) && $_REQUEST['format'] != "" ? $_REQUEST['format'] : Conf::get('default_format');
if (!file_exists(PATH_TEMPLATES."/index.$format.php")) {
	$format = Conf::get('default_format');
	Message::addMessage(MSG_LEVEL_WARNING, lang("message_requested_format_unavailable", $_REQUEST['format'], $format));
	include(PATH_TEMPLATES."/index.html.php");
} else {
	include(PATH_TEMPLATES."/index.$format.php");
}
	
//include(PATH_TEMPLATES."/index.html.php");