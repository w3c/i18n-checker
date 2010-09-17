<?php
# code that parses the document and finds information

// ESTABLISH THE URI
// $hint: goes in the input box
// $uri: used elsewhere
$hint = 'http://';
$uri = $_GET['docAddr'];
if (substr($uri, 0, 14) == 'http://http://') { $uri = substr($uri, 7); }
if (substr($uri, 0, 7) != 'http://') { $uri = 'http://'.$uri; }
$slashes = count_chars($uri);
if ($slashes[47]==2) { $uri .= '/'; }
$hint = $uri;
$fail = false;
$failuremessage = '';

// CHECK THAT URIs ARE OK, AND FETCH DATA
if (preg_match("/\.\./", $uri) ) { 
	$fail = true;
	$failuremessage = '<p>This URI is not allowed.  There should be no dots in the URI.</p>';
	$result = '';
	$httpstatus = 'not applicable.';
	$uri = '';
	}
else {
	$result = load($uri,$options);
	#var_dump($result);
	$httpstatus = substr($result['headers']['firstline'],9);
	}

// fail if not HTTP 200
if (! $fail && (substr($httpstatus,0,3) != '200') ) {
	$fail = true;
	$failuremessage = '<p>A problem occurred while trying to access the page.  The HTTP error code is: <strong>'.$httpstatus.'</strong></p>';
	}

// fail if mime-type not text/html or application/xhtml+xml
// and set mimetype and mimetypename
if (! $fail) {
	// get mimetype
	$mimetype = 'unknown'; 
	$mimetypename = 'Unknown';
	if (strpos($result['headers']['Content-Type'], 'xml')) { $mimetype = 'xml'; }
	else if (strpos($result['headers']['Content-Type'], 'html')) { $mimetype = 'html'; }
	
	if (strpos($result['headers']['Content-Type'], ';')) {
		$parts = explode(';', $result['headers']['Content-Type']);
		$mimetypename = $parts[0];
		}
	else { $mimetypename = $result['headers']['Content-Type']; }

	if ($mimetypename != 'text/html' && $mimetypename != 'application/xhtml+xml') {
		$fail = true;
		$failuremessage = "<p>This application only supports analysis of pages served as text/html or application/xhtml+xml. You tried to access a page that was served as $mimetypename.";
		}
	}
	
if (! $fail) {
	
	#============================== GET DATA =================================
	
	$errors = array();
	$warnings = array();
	$comments = array();


	$nonUTF8 = '';
	$char_encoding = array(); // assoc array containing encoding values and code
				// top level can be 'http', 'bom', 'xmldecl', 'httpequiv', 'html5'
				// 2nd level is either 'value' or 'code'
	$morehttpequivs = '';
	$langxmllangmismatches = '';
	$incorrectvalues = '';
	$onlylang = '';
	$onlyxmllang = '';
	$s_inappropriate_xmllang = ''; // list of elements containing xml:lang in an html file
	$languageattributearray = array();
	$xmllangonlyarray = array(); // if this is an xhtml doc, will contain a list of elements containing xml:lang but no lang attribute
	$langonlyarray = array(); // if this is an xhtml doc, will contain a list of elements containing lang but no xml:lang attribute
	$s_xmllangonlyarray = ''; // a string containing xmllangonlyarray elements as list items
	$s_langonlyarray = ''; // a string containing langonlyarray elements as list items
	$mismatchedlanguagevalues = array(); // holds elements with mismatched lang and xml:lang attribute values
	$incorrectvalues = array(); // holds elements with non-well-formed language values
	
	// GET HTTP CONTENT-TYPE HEADER
												$httpcharsetValue = '';
												$httpcontenttypeHeader = '';
	$char_encoding['http']['value']='';
	$char_encoding['http']['code']='';
	if (isset($result['headers']['Content-Type'])) {
		$charset = strpos($result['headers']['Content-Type'], 'charset=');
		if ($charset === false) { $char_encoding['http']['code']='Content-Type: '.$result['headers']['Content-Type']; }  
		else { 
			$char_encoding['http']['value'] = substr($result['headers']['Content-Type'],$charset+8); $char_encoding['http']['code']='Content-Type: '.$result['headers']['Content-Type'];
			}
		}
	

	// BYTE ORDER MARK
	// if UTF-16, convert to UTF-8
	$char_encoding['bom']['value']='';
	$char_encoding['bom']['code']='';
	$filestart = substr($result['body'],0,3);
	if (ord($filestart{0})== 239 && ord($filestart{1})== 187 && ord($filestart{2})== 191) { $char_encoding['bom']['value'] = 'UTF-8'; } 
	
	$filestart = substr($result['body'],0,2);
	if (ord($filestart{0})== 254 && ord($filestart{1})== 255) { $char_encoding['bom']['value'] = 'UTF-16BE'; }
	
	$filestart = substr($result['body'],0,2);
	if (ord($filestart{0})== 255 && ord($filestart{1})== 254) { $char_encoding['bom']['value'] = 'UTF-16LE'; }
	
	if ($char_encoding['bom']['value'] == 'UTF-16LE') {
		$result['body'] = mb_convert_encoding(  $result['body'], 'UTF-8', 'UTF-16LE');
		}
	if ($char_encoding['bom']['value'] == 'UTF-16BE') {
		$result['body'] = mb_convert_encoding(  $result['body'], 'UTF-8', 'UTF-16BE');
		}

	if ($char_encoding['bom']['value'] != '') { $char_encoding['bom']['code'] = "Byte-order mark: {$char_encoding['bom']['value']}"; }

	
	// DOCTYPE
	$doctypename = 'No DOCTYPE';
	if (preg_match_all("/!DOCTYPE [^>]+>/i", $result['body'], $match)) {
		if (strpos($match[0][0], 'W3C//DTD HTML 4')) { $doctype = 'html'; $doctypename = "HTML"; }
		else if (strpos($match[0][0], 'W3C//DTD XHTML 1.0')) { $doctype = 'xhtml'; $doctypename = "XHTML 1.0"; }
		else if (strpos($match[0][0], 'W3C//DTD XHTML 1.1')) { $doctype = 'xhtml11'; $doctypename = "XHTML 1.1"; }
		else if (preg_match("/!DOCTYPE\s+html\s*>/i", $match[0][0])) { $doctype = 'html5'; $doctypename = "HTML5"; }
		else { $doctype = 'unknown';  $doctypename = "Unknown";}
		}
	else { $doctype='none'; }


	// get html tag
	$htmltag = '';
	if (preg_match_all("/<html[^>]*>/i", $result['body'], $match)) {
		$htmltag = str_replace('<','&lt;',$match[0][0]);
		}

	// get body tag
	$bodytag = '';
	if (preg_match_all("/<body[^>]*>/i", $result['body'], $matches)) {
		$bodytag = str_replace('<','&lt;',$matches[0][0]);
		}
	$bodylangfound = strpos($bodytag, ' lang');
	$bodyxmllangfound = strpos($bodytag, ' xml:lang');


	// XML DECLARATION
											$xmlcharsetValue = '';
	$xmldeclTag = '';
	$char_encoding['xmldecl']['value']='';
	$char_encoding['xmldecl']['code']='';
	if (preg_match_all("/<\?xml.*? encoding=([\"\'][^\"\'>]*[\"\']|[^ \"\'>]+)[^>]*>/i", $result['body'], $xmldecltagA)) {
		$xmldeclTag = str_replace('<','&lt;',$xmldecltagA[0][count($xmldecltagA[0])-1]);
		$char_encoding['xmldecl']['code']= $xmldeclTag;
		if (count($xmldecltagA[1]>0)) {
			$char_encoding['xmldecl']['value'] = $xmldecltagA[1][count($xmldecltagA[0])-1];
			$char_encoding['xmldecl']['value'] = str_replace('\'','',$char_encoding['xmldecl']['value']);	$char_encoding['xmldecl']['value'] = str_replace('"','',$char_encoding['xmldecl']['value']);
			}
		else {
			$char_encoding['xmldecl']['value'] = '';
			}
		}
	


	// META CHARSET ELEMENT
	$char_encoding['httpequiv']['value']='';
	$char_encoding['httpequiv']['code']='';
																	$metacharsetValue = ''; 
																	$metatagCode = '';
																	$metacharsetCount=0;
	if (preg_match_all("/<meta.*? http-equiv=[\"\']?Content-Type[^>]*>/i", $result['body'], $metatagA)) {
		$char_encoding['httpequiv']['code'] = $metatagA[0][count($metatagA[0])-1];
		$char_encoding['httpequiv']['code'] = str_replace('<','&lt;',$char_encoding['httpequiv']['code']);
		preg_match_all("/charset=([^\"\'>\s]+)/i", $char_encoding['httpequiv']['code'], $encvalueA);
		if (count($encvalueA)>0) {
			$char_encoding['httpequiv']['value'] = $encvalueA[1][0];
			}
		else {  $char_encoding['httpequiv']['code'] = ''; }
		$char_encoding['httpequiv']['value'] = str_replace('\'','',$char_encoding['httpequiv']['value']); 
		$char_encoding['httpequiv']['value'] = str_replace('"','',$char_encoding['httpequiv']['value']);

		if (count($metatagA[0])>1) {
			for ($i=0;$i<count($metatagA[0]);$i++) {
				$morehttpequivs .= '<li><code>'.str_replace('<','&lt;',$metatagA[0][$i]).'</code></li>';
				}
			} 
		}
	
	
	/* HTML5 CHARSET META
	$html5charsetValue = '';
	$html5charsetTag = '';
	$charset = preg_match_all("/<meta\s+charset\=[a-zA-Z0-9\-\s\"\'\=\:\_\.]+(\/)?>/i", $result['body'], $match);
	if ($charset == true) { 
		$matchstr = $match[0][0];
		$start = strpos($matchstr, 'charset=');
		$encoding = substr($matchstr,$start+8);
		$end = preg_match_all("/[a-zA-Z0-9\-\:\_\.]+/i", $encoding, $match2);
		$html5charsetValue = $match2[0][0];
		$html5charsetTag = str_replace('<','&lt;',$matchstr);
		$html5charsetTag = str_replace('>','&gt;',$html5charsetTag);
		}
	*/



	// HTML5 CHARSET META
	$char_encoding['html5']['value']='';
	$char_encoding['html5']['code']='';
	if (preg_match_all("/<meta\s+charset\=[a-zA-Z0-9\-\s\"\'\=\:\_\.]+(\/)?>/i", $result['body'], $match)) { 
		$char_encoding['html5']['code'] = $match[0][count($match[0])-1];
		$char_encoding['html5']['code'] = str_replace('<','&lt;',$char_encoding['html5']['code']);
		//preg_match_all("/charset=([^\"\'>\s]+|[^\"\'>\s]+[\"\'>\s])/i", $char_encoding['html5']['code'], $encvalueA);
		preg_match_all("/charset=[\"\'>\s]*([^\"\'>\s]+)/i", $char_encoding['html5']['code'], $encvalueA);
		if (count($encvalueA)>0) {
			$char_encoding['html5']['value'] = $encvalueA[1][0];
			}
		else {  $char_encoding['html5']['code'] = ''; }
		$char_encoding['html5']['value'] = str_replace('\'','',$char_encoding['html5']['value']); 
		$char_encoding['html5']['value'] = str_replace('"','',$char_encoding['html5']['value']);

		// if multiple meta charset declarations, add to morehttpequivs list
		if (count($metatagA[0])>1) {
			for ($i=0;$i<count($match[0]);$i++) {
				$morehttpequivs .= '<li><code>'.str_replace('<','&lt;',$match[0][$i]).'</code></li>';
				}
			} 
		}
	
//var_dump($char_encoding);
		
		
		
	// check for non-UTF8 encodings
	$nonUTF8 = '';
	foreach ($char_encoding as $enctype){
		if (strtolower($enctype['value']) != 'utf-8' && $enctype['value'] != '') {
			$nonUTF8 .= '<li><code>'.$enctype['code'].'</code></li>';
			}
		}


	// make list of encoding values
	$encodingslist = '';
	foreach ($char_encoding as $value) {
		if ($value['value'] != '') { $encodingslist .= '<li><code>'.$value['code'].'</code></li>'; }
		}

	

	// determine page encoding using precedence rules
	$pageencoding = '';
	if ($httpcharsetValue != '') { $pageencoding = $httpcharsetValue; }
	//else if ($mimetype == 'html' && 
			   // need to work out whether document is html5, and figure out preference order for meta charset vs meta content-type
			   // also add a check that the declaration is within the first 512 bytes of start
			   // also add an error if there is both an html5 and content-type declaration
			   // warn against use of utf-32
			   // add warning about URL submissions to advice to use utf-8
			   // add a check for utf-8 or utf-1 BOM for html5
	
	
	
	
	
	
	// HTML LANG
	$htmllangValue = '';
	$langs = preg_match_all("/\slang=[\"\']?([^\s\"\'\\>]+)[\s\"\'\/>]/i", $htmltag, $match);
	if ($langs) { $htmllangValue = $match[1][0]; }

	
	// HTML XML:LANG
	$htmlxmllangValue = '';
	$langs = preg_match_all("/\sxml:lang=[\"\']?([^\s\"\'\\>]+)[\s\"\'\/>]/i", $htmltag, $match);
	if ($langs) { $htmlxmllangValue = $match[1][0]; }


	// HTTP CONTENT-LANGUAGE
	$httpcontentlangValue = '';
	$httpcontentlangHeader = '';
	if (isset($result['headers']['Content-Language'])) {
		$httpcontentlangHeader = "Content-Language: ".$result['headers']['Content-Language'];
		$httpcontentlangValue = $result['headers']['Content-Language'];
		}
	
	
	// META CONTENT-LANGUAGE
	$metacontentlangValue = '';
	$metacontentlangTag = '';
	$metaCLfound = preg_match_all("/<meta [^<>]+content-language[^<>]+content\=[a-zA-Z0-9\-\s\"\'\=,]+(\/)?>/i", $result['body'], $match);
	if ($metaCLfound == true) { 
		$matchstr = $match[0][0];
		$start = strpos($matchstr, 'content=');
		$encoding = substr($matchstr,$start+8);
		$end = preg_match_all("/[a-zA-Z0-9\-,\s]+/i", $encoding, $match2);
		$metacontentlangValue = $match2[0][0];
		$matchstr = str_replace('<','&lt;',$matchstr);
		$metacontentlangTag = str_replace('>','&gt;',$matchstr);
		}
	
	
	// make a list of elements containing lang and/or xml:lang attributes 
	$langs = preg_match_all("/<[^>]+( xml:lang=| lang=)[^>]+>/i", $result['body'], $languageattributearray);
	
	//var_dump($languageattributearray);
	
	if ($doctype=='xhtml' && $mimetype=='html') {
		// make a list of elements that don't contain xml:lang
		foreach ($languageattributearray[0] as $tag) { 
			if (strpos($tag, ' xml:lang=') === false) {
//				$xmllangonlyarray[] = $tag;
				$s_langonlyarray .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
				}
			}
		//var_dump($xmllangonlyarray);
		
		
		// make a list of elements that don't contain lang
		foreach ($languageattributearray[0] as $tag) { 
			if (strpos($tag, ' lang=') === false) {
//				$langonlyarray[] = $tag;
				$s_xmllangonlyarray .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
				}
			}
/*		$s_xmllangonlyarray = '';
		foreach ($xmllangonlyarray as $tag) {
			$s_xmllangonlyarray .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
			}
		$s_langonlyarray = '';
		foreach ($langonlyarray as $tag) {
			$s_langonlyarray .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
			}
*/		//var_dump($langonlyarray);
		}
	
	
	// make a list of elements containing xml:lang attributes in HTML files
	if ($doctype=='html') {
		foreach ($languageattributearray[0] as $tag) { 
			if (strpos($tag, ' xml:lang=')) {
				$s_inappropriate_xmllang .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
				}
			}
		/*foreach ($languageattributearray as $tag) {
			$s_inappropriate_xmllang .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
			}
		$langs = preg_match_all("/<[^>]+ xml:lang=[^>]+>/i", $result['body'], $xmllangarray);
		for ($i=0; $i<count($xmllangarray[0]); $i++) { 
			$inappropriate_xmllang .= '<li><code>'.str_replace('<','&lt;',$xmllangarray[0][$i]).'</code></li>';  
			}*/
		}
	

	// extract language values, and check whether they are the same and well-formed
	foreach ($languageattributearray[0] as $tag) { 
		// check whether there are multiple attributes
		$xmllangvalue = '';
		$langvalue = '';
		$langs = preg_match_all("/\sxml:lang=[\"\']?([^\s\"\'\\>]+)[\s\"\'\/>]/i", $tag, $values);
		if ($langs) { $xmllangvalue = $values[1][0]; }
		$langs = preg_match_all("/\slang=[\"\']?([^\s\"\'\\>]+)[\s\"\'\/>]/i", $tag, $values);
		if ($langs) { $langvalue = $values[1][0]; }
		//print $tag."\n".$langvalue."\n".$xmllangvalue."\n";
		
		// if both attributes are present, make a list of those that aren't the same
		if (($xmllangvalue != '' && $langvalue != '') && ($xmllangvalue != $langvalue)) {
			$mismatchedlanguagevalues[] = $tag;
			}
		
		// check values for well-formedness
		if (preg_match("/[a-zA-Z0-9]*[^a-zA-Z0-9\-]+[a-zA-Z0-9]*/", $langvalue) || 
				preg_match("/[a-zA-Z0-9]*[^a-zA-Z0-9\-]+[a-zA-Z0-9]*/", $xmllangvalue) ) {
			$incorrectvalues[] = $tag;
			//$incorrectvalues .= '<li><code>'.str_replace('<','&lt;',$langarray[0][$i]).'</code></li>';
			}
		}

	$s_incorrectvalues = '';
	foreach ($incorrectvalues as $tag) {
		$s_incorrectvalues .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
		}
	$s_mismatchedlanguagevalues = '';
	foreach ($mismatchedlanguagevalues as $tag) {
		$s_mismatchedlanguagevalues .= '<li><code>'.str_replace('<','&lt;',$tag).'</code></li>';
		}


	//var_dump($incorrectvalues);
	
	/*for ($i=0; $i<count($xmllangarray[0]); $i++) { 
		$inappropriate_xmllang .= '<li><code>'.str_replace('<','&lt;',$xmllangarray[0][$i]).'</code></li>';  
		}
*/
	
	// check that lang and xml:lang come in pairs in xhtml & check for non-welformed values
/*	if ($doctype=='xhtml' && $mimetype=='html') {
	
		// get a list of all tags containing lang attribute
		if (preg_match_all("/<[^>]+ lang=[^>]+>/i", $result['body'], $langarray)) { 
			// check lang always matched with xml:lang
			$onlylangctr = 0;
			$mismatchlangctr = 0;
			$langxmllangmismatches = '';
			$onlylang = '';
			$incorrectvaluectr = 0;
			$incorrectvalues = '';
			for ($i=0; $i<count($langarray[0]); $i++) { 
				// check that lang is accompanied by xml:lang
				if (strpos($langarray[0][$i], 'xml:lang=') === false) {
					$onlylangctr++;
					$onlylang .= '<li><code>'.str_replace('<','&lt;',$langarray[0][$i]).'</code></li>';  
					}
				else {
					$matchstr = $langarray[0][$i];
					// get lang value
					$start = strpos($matchstr, ' lang=');
					$start = strpos($matchstr, '"',$start+6);
					$langvalue = substr($matchstr,$start+1);
					#print '<p>'.$langvalue.'</p>';
					$end = strpos($langvalue, '"');
					$langvalue = substr($langvalue,0,$end);
					#print '<p>'.$langvalue.'</p>';
					// get xml:lang value
					$start = strpos($matchstr, 'xml:lang=');
					$start = strpos($matchstr, '"',$start+5);
					$xmllangvalue = substr($matchstr,$start+1);
					#print '<p>'.$xmllangvalue.'</p>';
					$end = strpos($xmllangvalue, '"');
					$xmllangvalue = substr($xmllangvalue,0,$end);
					#print '<p>'.$xmllangvalue.'</p>';
					//check for mismatches
					#if ($langvalue != $xmllangvalue) { 
					#	$mismatchlangctr++;
						//$mismatches .= ' ['.$langvalue.', '.$xmllangvalue.']';
					#	$mismatches .= '<br />'.str_replace('<','&lt;',$langarray[0][$i]);
					#	}
					if ($langvalue != $xmllangvalue) { 
						$mismatchlangctr++;
						//$mismatches .= ' ['.$langvalue.', '.$xmllangvalue.']';
						$langxmllangmismatches .= '<li><code>'.str_replace('<','&lt;',$langarray[0][$i]).'</code></li>';
						}
					// check for invalid values
					if (preg_match("/[a-zA-Z0-9\-]*[^a-zA-Z0-9\-]+[a-zA-Z0-9\-]/", $langvalue) || 
							preg_match("/[a-zA-Z0-9\-]*[^a-zA-Z0-9\-]+[a-zA-Z0-9\-]/", $xmllangvalue) ) {
						$incorrectvaluectr++;
						$incorrectvalues .= '<li><code>'.str_replace('<','&lt;',$langarray[0][$i]).'</code></li>';
						}
					}
				}

			// get a list of all tags containing xml:lang attribute
			if (preg_match_all("/<[^>]+ xml:lang[^>]+>/i", $result['body'], $xmllangarray)) { 
				#var_dump($match);
				// check xml:lang always matched with lang
				$onlyxmllangctr = 0;
				$onlyxmllang = '';
				for ($i=0; $i<count($xmllangarray[0]); $i++) { 
					if (strpos($xmllangarray[0][$i], ' lang=') === false) {
						$onlyxmllangctr++;
						$onlyxmllang .= '<li><code>'.str_replace('<','&lt;',$xmllangarray[0][$i]).'</code></li>';  
						}
					}
				}
			}
		}
*/	
	// check that xhtml files served as XML have xml:lang
	if ($doctype=='xhtml' && $mimetype=='xml') {
		$langs = preg_match_all("/<[^>]+ lang=[^>]+>/i", $result['body'], $langarray);
		}

	
	
	// HTML DIR
	$htmldirValue = '';
	$attributefound = preg_match_all("/ dir[^>]+/i", $htmltag, $match);
	if ($attributefound == true) {
		$matchstr = $match[0][0];
		$start = strpos($matchstr, 'lang=');
		$encoding = substr($matchstr,$start+5);
		$end = preg_match_all("/[a-zA-Z0-9\-]+/i", $encoding, $match2);
		$htmldirValue = $match2[0][0];
		}
		
	// find all dir attributes
	$dirtagctr=0; $dirmismatchctr=0; $dirmismatches='';
	if (preg_match_all("/<[^>]+? dir=([\"\'][^\"\'>]*[\"\']|[^ \"\'>]+)[^>]*>/i", $result['body'], $dirtagsA)) {
		$dirtagctr = count($dirtagsA[0]);
		for ($i=0; $i<$dirtagctr; $i++) { 
			$dirvalue = $dirtagsA[1][$i]; $dirvalue = str_replace('\'','',$dirvalue); $dirvalue = str_replace('"','',$dirvalue);
			if (! (strtolower($dirvalue == 'rtl') || strtolower($dirvalue == 'ltr')) ) { 
				$dirmismatchctr++;
				$dirmismatches .= '<li><code>'.str_replace('<','&lt;',$dirtagsA[0][$i]).'</code></li>';
				}
			}
		}


	// NON-ASCII NAMES
	$nonasciinamectr = 0; 
	$nonasciinames = '';
	$classfound = preg_match_all("/<[^>]*? class=([\"\'][^\"\'>]*[\"\']|[^ \"\'>]+)[^>]*>/i", $result['body'], $classesA);
	for ($i=0; $i<count($classesA[1]);$i++){
		#print str_replace('<','&lt;',$classesA[0][$i]).'<br />';
		if (preg_match("/[!-~\s]*[^!-~\s]+.*/",  $classesA[1][$i])) {
			$nonasciinamectr++; 
			$nonasciinames .= '<li><code>'.str_replace('<','&lt;',$classesA[0][$i]).'</code></li>';
			}
		}
	$classfound = preg_match_all("/<[^>]*? id=([\"\'][^\"\'>]*[\"\']|[^ \"\'>]+)[^>]*>/i", $result['body'], $classesA);
	for ($i=0; $i<count($classesA[1]);$i++){
		#print str_replace('<','&lt;',$classesA[0][$i]).'<br />';
		if (preg_match("/[!-~\s]*[^!-~\s]+.*/",  $classesA[1][$i])) {
			$nonasciinamectr++; 
			$nonasciinames .= '<li><code>'.str_replace('<','&lt;',$classesA[0][$i]).'</code></li>';
			}
		}
	
	
		
	// NON-NFC CLASS OR ID NAMES
	$nonnfcnamectr = 0; 
	$nonnfcnames = '';
	$namefound = preg_match_all("/&lt;[^>]*? class=([\"\'][^\"\'>]*[\"\']|[^ \"\'>]+)[^>]*>/i", $nonasciinames, $classesA);
	for ($i=0; $i<count($classesA[1]);$i++){
		if (nfc($classesA[1][$i]) != $classesA[1][$i]) {
			$nonnfcnamectr++; 
			$nonnfcnames .= '<li><code>'.str_replace('<','&lt;',$classesA[0][$i]).'</code></li>';
			}
		}
	$classfound = preg_match_all("/&lt;[^>]*? id=([\"\'][^\"\'>]*[\"\']|[^ \"\'>]+)[^>]*>/i", $nonasciinames, $classesA);
	for ($i=0; $i<count($classesA[1]);$i++){
		if (nfc($classesA[1][$i]) != $classesA[1][$i]) {
			$nonnfcnamectr++; 
			$nonnfcnames .= '<li><code>'.str_replace('<','&lt;',$classesA[0][$i]).'</code></li>';
			}
		}


	// B
	$btagcount = 0; 
	$namefound = preg_match_all("/<b(\s[^>]*?)?>/i", $result['body'], $matches);
	$btagcount = count($matches[0]);
	$totalbtags = $btagcount;
	foreach ($matches[0] as $ctag) {
		if (preg_match("/ class=/",  $ctag)) { $btagcount--; }
		}

	// I
	$itagcount = 0; 
	$namefound = preg_match_all("/<i(\s[^>]*?)?>/i", $result['body'], $matches);
	$itagcount = count($matches[0]);
	$totalitags = $itagcount;
	foreach ($matches[0] as $ctag) {
		if (preg_match("/ class=/",  $ctag)) { $itagcount--; }
		}


	// use Microsoft language detection API 
	//$ldquery = urlencode($result['body']); 
	//$detectedlanguage = file_get_contents('http://api.microsofttranslator.com/V1/Http.svc/Detect?AppId=E323A4CA8F95B174ED68C516B0BAE670C7FC7C60&text='.$ldquery);
	//var_dump( $detectedlanguage ); 
}
?>