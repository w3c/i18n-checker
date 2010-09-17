<?php

if (! $fail) {

	
	if ($doctype=='xhtml11' && $mimetype=='xml') {
		$errors[][0] = 'XHTML 1.1 not yet supported. View detailed report with care.';
			$errors[count($errors)-1][1] = '<p>The I18n Checker has not yet been adapted to deliver detailed advice for XHTML 1.1 files.  You may see more errors, warnings or comments below but they may not be relevant, or some important point for this format may be missing. Please use with care.</p><p>On the other hand, the information panel at the top of this page should be accurate.</p>'; 
		}
	if ($doctype=='html5' && $mimetype=='xml') {
		$errors[][0] = 'XHTML5 not yet supported. View detailed report with care.';
			$errors[count($errors)-1][1] = '<p>The I18n Checker has not yet been adapted to deliver detailed advice for XHTML5 files, ie. HTML5 served as XML.  You may see more errors, warnings or comments below but they may not be relevant, or some important point for this format may be missing. Please use with care.</p><p>On the other hand, the information panel at the top of this page should be accurate.</p>'; 
		}


#============================== CHARACTER ENCODINGS =================================

	// is utf-8 not used?
	if ($nonUTF8 != '') {
		$comments[][0] = $utf8_not_used_title;
		$comments[count($comments)-1][1] = $utf8_not_used_msg;
	}
	
	

	// Conflicting character encoding declarations.
	$same = true; $first = 'no encoding';
	foreach ($char_encoding as $value) { // get the first value
		if ($value['value'] != '') { $first = strtolower($value['value']); break; }
		}
		// No character encoding information
		if ($first == 'no encoding') {
			$warnings[][0] = $no_encoding_title;
			$warnings[count($warnings)-1][1] = $no_encoding_msg;
			}
	foreach ($char_encoding as $value) { // check that all values are the same
		if (strtolower($value['value']) != $first && $value['value'] != '') { $same = false; break; }
		}

	if (!$same) {
		$errors[][0] = $encoding_conflicts_title;
		$errors[count($errors)-1][1] = $encoding_conflicts_msg;
		}
		
	if ($char_encoding['http']['value'] != '' && !$same) {
		$errors[count($errors)-1][1] .= $http_conflict_msg;
		}


	// Multiple encoding declarations using the meta tag.
	if ($morehttpequivs!= '') {
		$warnings[][0] = $multiple_httpequiv_charset_title;
		$warnings[count($warnings)-1][1] = $multiple_httpequiv_charset_msg;
		}
		
		
	// UTF-8 BOM found at start of file
	if ($char_encoding['bom']['value'] == 'UTF-8') { 
		$warnings[][0] = $bom_at_start_title;
		$warnings[count($warnings)-1][1] = $bom_at_start_msg;
		}
	
	//BOM in content
	$fileremainder = substr($result['body'],3);
	if (preg_match('/ï»¿/',$fileremainder)) { 
		$warnings[][0] = $bom_in_content_title;
		$warnings[count($warnings)-1][1] = $bom_in_content_msg;
		}


	// No in-document encoding found
	if ($char_encoding['http']['value'] != '' &&
		$char_encoding['bom']['value'] == '' &&
		$char_encoding['xmldecl']['value'] == '' &&
		$char_encoding['httpequiv']['value'] == '' &&
		$char_encoding['html5']['value'] == '' 
		) { 
		$warnings[][0] = $no_indoc_encoding_title;
		$warnings[count($warnings)-1][1] = $no_indoc_encoding_msg;
		}




#============================== LANGUAGE TAGS =================================

	// check we have the right things in html tag
	if ($htmltag!='') { 
		// The html tag has no language attribute
		if (
			($mimetype=='html' && ($doctype=='html' || $doctype=='html5') && preg_match("/\slang/i", $htmltag) == false) || 
			($mimetype=='html' && $doctype=='xhtml' && (preg_match("/\sxml:lang/i", $htmltag) == false &&  preg_match("/\slang/i", $htmltag) == false)) ||
			($mimetype=='xml' && preg_match("/\sxml:lang/i", $htmltag) == false)
			 ){
			$warnings[][0] = $html_no_lang_title;
			$warnings[count($warnings)-1][1] = $html_no_lang_msg;
			if ($metaCLfound) {
				$warnings[count($warnings)-1][1] .= $html_no_lang_msg02;
				}
			if ($mimetype=='html' && ($doctype=='html' || $doctype=='html5')) { $warnings[count($warnings)-1][1] .= $html_no_lang_msg03; }
			if ($doctype=='xhtml' && $mimetype=='html') { $warnings[count($warnings)-1][1] .= $html_no_lang_msg04; }
			$warnings[count($warnings)-1][1] .= $html_no_lang_msg05;
			}
			
		// The lang attribute and the xml:lang attribute in the html tag have different values
		if ($htmllangValue!='' && $htmlxmllangValue!='' && $htmllangValue != $htmlxmllangValue) { 
			$errors[][0] = $lang_xmllang_conflict_in_html_title;
			$errors[count($errors)-1][1] = $lang_xmllang_conflict_in_html_msg; 
			}
		}
	
	// This HTML file contains xml:lang attributes
	if ($doctype=='html' && $s_inappropriate_xmllang != '') {
		$warnings[][0] = $xmllang_in_html_title;
		$warnings[count($warnings)-1][1] = $xmllang_in_html_msg; 
		}

	// A lang attribute value did not match an xml:lang value when they appeared together on the same tag.
	if (count($mismatchedlanguagevalues)>0) {
		$warnings[][0] = $lang_xmllang_mismatch_title;
		$warnings[count($warnings)-1][1] = $lang_xmllang_mismatch_msg;
		}

	// A language attribute value was incorrectly formed.
	if (count($incorrectvalues)>0) {
		$warnings[][0] = $non_wellformed_lang_title;
		$warnings[count($warnings)-1][1] = $non_wellformed_lang_msg;
		}
		

	// check that lang and xml:lang come in pairs in xhtml & check for non-welformed values
	if ($doctype=='xhtml' && $mimetype=='html') {
		
		
		// A tag uses a lang attribute without an associated xml:lang attribute.
		if ($s_langonlyarray != '') { 
			$warnings[][0] = $lang_no_xmllang_title;
			$warnings[count($warnings)-1][1] = $lang_no_xmllang_msg; 
			}
		
		// A tag uses an xml:lang attribute without an associated lang attribute.
		if ($s_xmllangonlyarray != '') { 
			$warnings[][0] = $xmllang_no_lang_title;
			$warnings[count($warnings)-1][1] = $xmllang_no_lang_msg; 
			}
		}
	
				
	
/*	// check that xhtml files served as XML have xml:lang
	if ($doctype=='xhtml11' && $mimetype=='xml') {
			
		// This XHTML file contains lang attributes
		if (count($langarray)>0) {
			$warnings[][0] = $lang_in_xhtml_title;
			$warnings[count($warnings)-1][1] = $lang_in_xhtml_msg; 
			}
		}
*/
			





#============================== TEXT DIRECTION =================================

	// Incorrect values used for dir attribute
	if ($dirmismatchctr > 0) { 
		$errors[][0] = $incorrect_dir_values_title;
		$errors[count($errors)-1][1] = $incorrect_dir_values_msg; 
		}




#============================== MISC =================================

	// are there non-NFC class or id names?
	if ($nonnfcnamectr > 0) {
		$warnings[][0] = $non_nfc_class_id_title;
		$warnings[count($warnings)-1][1] = $non_nfc_class_id_msg;
		}
	

	// <b> tags found in source
	if ($btagcount > 0) {
		$comments[][0] = $b_tags_title;
		$comments[count($comments)-1][1] = $b_tags_msg;
		}
	
	// <i> tags found in source
	if ($itagcount > 0) {
		$comments[][0] = $i_tags_title;
		$comments[count($comments)-1][1] = $i_tags_msg;
		}
	

		
		
		
	}

?>