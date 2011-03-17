<?php
require_once('../src/common.php');
include('../src/n11n.php');
include('../src/net.php');

// Check parameters (currently only 'uri')
if (!isset($_GET['uri'])) {
	$messages[] = new Message(Message::error, lang("message_nothing_to_validate"));
	header('Content-Type: text/html; charset=UTF-8');
	include('../templates/index.html.php');
	return;
}

// Fetch the document
$document = getDocumentByUri($_GET['uri']);

// If something went wrong redirect to the home page with error messages
if ($document == false) {
	header('Content-Type: text/html; charset=UTF-8');
	include('../templates/index.html.php');
	return;
}

$uri = $document[0];
$headers = $document[1];
$content = $document[2];
//$results = checkDocument($headers, $content);

include('../src/checkercode.php');
include('../src/checkermessages.php');
include('../src/createmessages.php');

if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'xml') {
	header('Content-Type: application/xml; charset=UTF-8');
	include('../templates/results.xml.php');
} else {
	header('Content-Type: text/html; charset=UTF-8');
	include('../templates/results.html.php');
}
