<?php

function fetchDocument($url, $javascript_loop = 0, $timeout = 5) {
	global $conf;
	$url = str_replace( "&amp;", "&", urldecode(trim($url)) );

	$cookie = tempnam ("/tmp", "CURLCOOKIE");
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_USERAGENT, $conf['user_agent'] );
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_ENCODING, "" );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $conf['curl_connect_timeout'] );
	curl_setopt( $ch, CURLOPT_TIMEOUT, $conf['curl_timeout'] );
	curl_setopt( $ch, CURLOPT_MAXREDIRS, $conf['curl_maxredirs'] );
	curl_setopt( $ch, CURLOPT_HEADERFUNCTION, 'getLanguageHeader' );
	
	$header = array();
	if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		$header[] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	if (isset($_SERVER['HTTP_ACCEPT_CHARSET']))
		$header[] = $_SERVER['HTTP_ACCEPT_CHARSET'];
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
	
	$content = curl_exec($ch);
	$response = curl_getinfo($ch);
	$code = curl_errno($ch);
	$error = curl_error($ch);
	curl_close($ch);

//	if ($response['http_code'] == 301 || $response['http_code'] == 302) {
//		ini_set("user_agent", $conf['user_agent']);
//
//		if ( $headers = get_headers($response['url']) ) {
//			foreach( $headers as $value ) {
//				if ( substr( strtolower($value), 0, 9 ) == "location:" )
//					return get_url( trim( substr( $value, 9, strlen($value) ) ) );
//			}
//		}
//	}

// Follow JavaScript redirection ?
//	if (( preg_match("/>[[:space:]]+window\.location\.replace\('(.*)'\)/i", $content, $value)
//	   || preg_match("/>[[:space:]]+window\.location\=\"(.*)\"/i", $content, $value)) 
//	   && $javascript_loop > 0 && $javascript_loop < 5) {
//		return fetchDocument( $value[1], $javascript_loop+1 );
//	} else {
//		return array( $url, $content, $response, $code, $error );
//	}
	
	return array( $url, $content, $response, $code, $error );
}

function getDocumentByUri($uri) {
	
	// Messages to be display on top of the page
	global $messages;
	
	// Check that a uri has been submitted
	if ($uri == "") {
		$messages[] = new Message(Message::error, lang("message_empty_uri"));
		return false;
	}
	
	// Check the scheme of the uri, must be http or https
	$scheme = parse_url($uri, PHP_URL_SCHEME);
	if ($scheme == null)
		$uri = 'http://'.$uri;
	elseif ($scheme != "http" && $scheme != "https") {
		$messages[] = new Message(Message::error, "scheme not allowed: ".$scheme); //TODO
		return false;
	}
	
	// Check that the uri is correct (CURLE_URL_MALFORMAT is not enough)
	if (preg_match('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@', $uri) == 0) {
		$messages[] = new Message(Message::error, lang("message_invalid_url_syntax", $uri));
		return false;
	}
	
	// Get the content and headers of the submitted document
	$result = fetchDocument($uri);
	$uri = $result[0];
	$content = $result[1];
	$headers = $result[2];
	$curl_error = $result[3];
	
	// Add the content-language header value that we parsed before to $headers
	if (isset($_REQUEST['doc_content_language'])) {
		$headers['content_language'] = $_REQUEST['doc_content_language'];
		unset($_REQUEST['doc_content_language']);
	} 
	
	// Report errors to the user. Most common cases should be internationalized.
	if ($curl_error != 0) {
		if ($curl_error == CURLE_URL_MALFORMAT) {
			$messages[] = new Message(Message::error, lang("message_invalid_url_syntax", $uri));
		} elseif ($curl_error == CURLE_COULDNT_RESOLVE_HOST) {
			$messages[] = new Message(Message::error, lang("message_unknown_host", parse_url($uri, PHP_URL_HOST)));
		} elseif ($curl_error == CURLE_COULDNT_CONNECT) {
			$messages[] = new Message(Message::error, lang("message_connect_exception"));
		} elseif ($curl_error == 'CURLE_REMOTE_ACCESS_DENIED') {
			$messages[] = new Message(Message::error, lang("message_unauthorized_access"));
		} else {
			// Otherwise send the curl error message (english)
			$messages[] = new Message(Message::error, $result[4]);
		}
		return false;
	}
	
	// Check the response code. 
	$response_code = $headers["http_code"];
	if ($response_code == 404) {
		$messages[] = new Message(Message::error, lang("message_document_not_found"));
		return false;
	}
	//} elseif ($response_code == 500) {
	//	$messages[] = new Message(Message::error, "received an internal server error (500): ".$uri); //TODO
	//	return;
	//}
	elseif ($response_code != 200) {
		$messages[] = new Message(Message::error, lang("message_http_error", $response_code));
		return false;
	}
	
	// Check that the document mimetype is either text/html or application/xhtml+xml
	$mimetypename = 'Unknown';
	if (strpos($headers['content_type'], ';')) {
		$parts = explode(';', $headers['content_type']);
		$mimetypename = $parts[0];
	} else { 
		$mimetypename = $headers['content_type']; 
	}
	
	if ($mimetypename != 'text/html' && $mimetypename != 'application/xhtml+xml') {
		$messages[] = new Message(Message::error, lang("message_unsupported_mimetype", $mimetypename));
		return false;
	}
	
	// Returns the headers and the content of the document
	return array($uri, $headers, $content);
}

function getDocumentByFileUpload($file) {
	
}

// Curl does not parse the Content-Language header so we need a callback function (cf CURLOPT_HEADERFUNCTION)
function getLanguageHeader($ch, $headers) {
	$pattern = '/Content-Language:(.*?)\n/';
	if (preg_match($pattern, $headers, $result)) {
		// Let's stock the value in $_REQUEST. Wouldn't be necessary is this file was a class
		$_REQUEST['doc_content_language'] = trim($result[1]);
	}
	//print_r($GLOBALS);
	return strlen($headers);
}
