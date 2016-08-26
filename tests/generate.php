<?php
include('data.php');
include('non-nfc.php');

// CHANGE AS NEEDED
$firsttest = '1';
$filename = 'white-space';
$stylelocation = '/International/tests';
$export = false;


// GET PARAMETERS
$serveas = 'html'; 
if (isset($_GET['serveas']) && $_GET['serveas'] == 'xml') { $serveas = 'xml'; }

$format = 'html';
if (isset($_GET['format'])) {
	if ($_GET['format'] == 'xhtml11') { $format = 'xhtml11'; }
	else if ($_GET['format'] == 'htmlx11') { $format = 'xhtml11'; }
	else if ($_GET['format'] == 'xhtml') { $format = 'xhtml'; }
	else if ($_GET['format'] == 'htmlx') { $format = 'xhtml'; }
	else if ($_GET['format'] == 'xhtml5') { $format = 'xhtml5'; }
	else if ($_GET['format'] == 'html5') { $format = 'html5'; }
	}

if ($format == 'html' || $format == 'html5') { $xsyntax=false; } else { $xsyntax=true; }
$slash = ''; if ($serveas == 'xml' || $format == 'xhtml') { $slash = ' /'; }


$buffer = '';

// SET COUNTERS
if (! isset($_GET['test']) ) { $_GET['test'] = $firsttest; }
$i = $_GET['test'];


// content-language header
if (isset($test[$i]['header'])) { header($test[$i]['header']); }

// write the HTTP headers
if (isset($test[$i]['httpheader'])) { 
	if ($serveas=='xml') { header("content-type: application/xhtml+xml;".$test[$i]['httpheader']); }
	else { header("content-type: text/html;".$test[$i]['httpheader']); }
	}
else {
	if ($serveas=='xml') { header("content-type: application/xhtml+xml; charset=utf-8"); }
	else { header("content-type: text/html; charset=utf-8"); }
}


#====================================


// add a BOM if required
if (isset($test[$i]['addutf8bom'])) { $buffer .= "﻿"; }


// write the xml declaration, if needed, and the doctype
if (isset($test[$i]['xmldeclaration'])) { $buffer .= $test[$i]['xmldeclaration']; }
else {
	if (($format=='xhtml11' || $format=='xhtml') && $serveas=='xml') {  $buffer .= '<?xml version="1.0" encoding="utf-8"?>'."\n"; }
	}
	
// write the doctype
if ($format=='xhtml11') { $buffer .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'; }
else if ($format=='xhtml') {  $buffer .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'; }
else if ($format=='xhtml5') {  $buffer .= '<!DOCTYPE html>'; }
else if ($format=='html5') {  $buffer .= '<!DOCTYPE html>'; }
#else { $buffer .= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/html4/strict.dtd">'; }
else { $buffer .= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/1998/REC-html40-19980424/strict.dtd">'; }


// write the html tag
$buffer .= "\n<html ";
$defaultLang = 'en';
if (isset($test[$i]['defaultlang'])) { 
	$defaultLang =  $test[$i]['defaultlang'];  
	}
// if data.php specifies attributes, add those, otherwise use standard en
if (isset($test[$i]['htmldir'])) { 
	$buffer .=  " ".$test[$i]['htmldir']." ";  
	}
if (isset($test[$i]['htmlattributes'])) { 
	$buffer .=  " ".$test[$i]['htmlattributes']." ";  
	}
else {
	if ($format=='xhtml' || $format=='xhtml11' || $format=='xhtml5') { $buffer .= ' xml:lang="'.$defaultLang.'" '; }
	else { $buffer .= ' lang="'.$defaultLang.'" '; }
	if ($format=='xhtml' && $serveas=='html') { $buffer .= ' lang="'.$defaultLang.'" '; }
	}
if ($format=='xhtml' || $format=='xhtml11' || $format=='xhtml5') { $buffer .= ' xmlns="http://www.w3.org/1999/xhtml"'; }
$buffer .= ">\n";
$buffer .= "<head>\n";


// write the encoding declaration
if (isset($test[$i]['metaencodingdecls'])) { 
	if (! $xsyntax) { $test[$i]['metaencodingdecls'] = str_replace('/>', '>', $test[$i]['metaencodingdecls']); }
	$buffer .=  " ".$test[$i]['metaencodingdecls']." ";  
	}
else {
	if ($serveas=='html' && $format != 'html5') {
		$metaenc = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8';
		if ($xsyntax) { $metaenc .= '" />'; } else { $metaenc .= '">';  $metaenc .= "\n"; }
		$buffer .= $metaenc; 
		}
	if ($serveas=='html' && $format =='html5') {
		$metaenc = '<meta charset="utf-8';
		if ($xsyntax) { $metaenc .= '" />'; } else { $metaenc .= '">';  $metaenc .= "\n"; }
		$buffer .= $metaenc; 
		}
	}
	
// write any Content-Language meta
if (isset($test[$i]['contentlanguagep'])) { 
	if (! $xsyntax) { $test[$i]['contentlanguagep'] = str_replace('/>', '>', $test[$i]['contentlanguagep']); }
	$buffer .=  " ".$test[$i]['contentlanguagep']." ";  
	}

// write all the metadata
$buffer .= "<title>".$test[$i]['title']."</title>\n";


$buffer .= "</head>\n";
$buffer .= "<body>\n";


$buffer .= "<p class='title'>Test for: ".$test[$i]['title']."</p>\n";


// add the test itself, [checking for language attributes is disabled]
$testcode = "\n\n\n".$test[$i]['test']."\n\n\n"; 
if (! $xsyntax) { $testcode = str_replace('/>', '>', $testcode); }
#if ($serveas=='html' && $format=='xhtml') { $testcode = preg_replace("/ xml:lang=(\'|\")([-a-zA-Z0-9]*)(\'|\")/", " lang=$1$2$3 xml:lang=$1$2$3", $testcode); }
#else if (! $xsyntax) { $testcode = preg_replace("/ xml:lang=(\'|\")([-a-zA-Z0-9]*)(\'|\")/", " lang=$1$2$3", $testcode); }
$buffer .= $testcode; 

	

$buffer .= "</body>\n";
$buffer .= "</html>\n";

# ========================================

echo $buffer;


?>


<?php 
$printlist = false;
if ($printlist) {
	echo '<div dir="ltr" style="font-size:80%;">';
	$ptr =$firsttest;
	while (isset($ptr) && $ptr != '') {
		echo '&lt;!-- '.$test[$ptr]['title'].' --> &lt;li>&lt;?php echo $test['.$ptr.'][\'title\'];?>&lt;br />&lt;span class="assertion">&lt;?php echo $test['.$ptr.'][\'assert\'];?>&lt;/span>&lt;br />&lt;a href="tests-white-space/generate?test='.$ptr.'">HTML4&lt;/a> &lt;a href="tests-white-space/generate?test='.$ptr.'&amp;amp;format=html5">HTML5&lt;/a> &lt;a href="tests-white-space/generate?test='.$ptr.'&amp;amp;format=xhtml">XHTML1.0&lt;sup>html&lt;/sup>&lt;/a> &lt;a href="tests-white-space/generate?test='.$ptr.'&amp;amp;serveas=xml&amp;amp;format=xhtml">XHTML1.0&lt;sup>xml&lt;/sup>&lt;/a> &lt;a href="tests-white-space/generate?test='.$ptr.'&amp;amp;serveas=xml&amp;amp;format=xhtml5">XHTML5&lt;/a> &lt;a href="tests-white-space/generate?test='.$ptr.'&amp;amp;format=xhtml11&amp;amp;serveas=xml">XHTML1.1&lt;/a>&lt;/li><br /><br />';
		$ptr = $test[$ptr]['next'];
		}
	echo '</div>';
	}
?>