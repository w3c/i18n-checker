<?php
require_once(realpath(dirname(__FILE__).'/../src/common.php'));
require_once(PATH_SRC.'/class.Net.php');
require_once(PATH_SRC.'/class.Checker.php');

if (!isset($_GET['uri']) && !isset($_POST['file'])) {
	Message::addMessage(MSG_LEVEL_ERROR, lang("message_nothing_to_validate"));
	include(PATH_TEMPLATES.'/index.html.php');
	return;
}
// Get the document either by URI or attached as a file
if (isset($_GET['uri']))
	$document = Net::getDocumentByUri($_GET['uri']);
elseif (isset($_POST['file']))
	$document = Net::getDocumentByFileUpload($_POST['file']);
// If no doc found or something went wrong redirect to home page with error messages
if ($document == false) {
	include(PATH_WEBDIR.'/index.php');
	return;
}
// Final uri (after redirections) or false if file upload
$uri = $document[0];
// Curl information (cf log file)  or false if file upload
$curl_info = $document[1];
// The content of the document
$content = $document[2];
// Validate the document. Information is stored in $results[infos] and report messages in $results[reports]
//$results['infos'] = array();
//$results['reports'] = array();
//Checker::checkDocument($curl_info, $content);

$checker = new Checker($curl_info, $content);
$checker->checkDocument();

// Check the format parameter to determine output template
if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'xml') {
	include(PATH_TEMPLATES.'/results.xml.php');
} else {
	include(PATH_TEMPLATES.'/results.html.php');
}