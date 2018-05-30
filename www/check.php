<?php
require_once(realpath(dirname(__FILE__).'/../src/class.Conf.php'));
require_once(PATH_SRC.'/class.Language.php');
require_once(PATH_SRC.'/class.Message.php');
// Hide language selection for now - remove this line or set to false to bring it back
$hideLangSelection = true;
// Check debug_lang parameter
if (isset($_GET['debug_lang']) && $_GET['debug_lang'] == 'true')
	Conf::set('debug_lang', 'true');
// Check mimetype parameter
$forcedMimeType = null;
if (isset($_REQUEST['mimetype']) && $_REQUEST['mimetype'] != '') {
	switch ($_REQUEST['mimetype']) {
		case "html":
			$forcedMimeType = "text/html";
			break;
		case "xml":
			$forcedMimeType = "application/xhtml+xml";
			break;
	}
}
// Check format parameter
$format = isset($_REQUEST['format']) && $_REQUEST['format'] != "" ? $_REQUEST['format'] : Conf::get('default_format');
if (!file_exists(PATH_TEMPLATES."/results.$format.php")) {
	$format = Conf::get('default_format');
	Message::addMessage(MSG_LEVEL_WARNING, lang("message_requested_format_unavailable", $_REQUEST['format'], $format));
}
// Check uri parameter or uploaded file
if (!isset($_GET['uri']) && (!isset($_FILES['file']) || $_FILES['file']['tmp_name'] == "")) {
	Message::addMessage(MSG_LEVEL_ERROR, lang("message_nothing_to_validate"));
	include(PATH_TEMPLATES."/index.$format.php");
	exit;
}
require_once(PATH_SRC.'/class.Net.php');
if (isset($_GET['uri'])) {
	$uri = $_GET['uri'];
	if (filter_var($uri, FILTER_VALIDATE_URL) === false) {
		$newuri = "https://".$uri;
		if (filter_var($newuri, FILTER_VALIDATE_URL) === false) {
		         Message::addMessage(MSG_LEVEL_ERROR, lang("message_nothing_to_validate"));
			 include(PATH_TEMPLATES."/index.$format.php");
			 exit;
		}
		$url = $newurl;
	}
        $document = Net::getDocumentByUri($uri);
}
elseif (isset($_FILES['file']))
	$document = Net::getDocumentByFileUpload($_FILES['file']);
if ($document == false) {
	include(PATH_TEMPLATES."/index.$format.php");
	exit;
}
require_once(PATH_SRC.'/class.Checker.php');
$uri = $document[0];
$curl_info = $document[1];
$content = $document[2];
if (isset($_GET['debug_upload']) && $_GET['debug_upload'] == 'true'){
	$uri = null;
	$curl_info = null;
}
$checker = new Checker($curl_info, $content);
if (!$checker->checkDocument($forcedMimeType)) {
	include(PATH_TEMPLATES."/index.$format.php");
	exit;
}
include(PATH_TEMPLATES."/results.$format.php");