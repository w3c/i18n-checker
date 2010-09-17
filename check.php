<?php
require_once('code/common.php');
include('code/initialcode.php');
include('code/n11n.php');
include('code/checkercode.php');
include('code/checkermessages.php');
include('code/createmessages.php');
if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'xml') {
	include('templates/results.xml.php');
} else {
	include('templates/results.html.php');
}