<?php
/**
 * Contains and initializes the Net class.
 * @package i18nChecker
 */
/*
 *
 */
require_once(PATH_SRC.'/class.Utils.php');
/**
 * HTTP related functions
 *
 * This class defines functions to fetch and return the content and important
 * information about remote or uploaded documents.
 *
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Net {

	private static $logger;

	public static function _init() {
		self::$logger = Logger::getLogger('Net');
	}

	public static function getDocumentByUri($uri) {
		self::$logger->info("Check by URI initiated for: ".$uri);

		// Check that a uri has been submitted
		if ($uri == "") {
			Message::addMessage(MSG_LEVEL_ERROR, lang("message_empty_uri"));
			self::$logger->info("- Aborted: URI is empty");
			return false;
		}

		// Check the scheme of the uri, must be http or https
		$scheme = parse_url($uri, PHP_URL_SCHEME);
		if ($scheme == null)
			$uri = 'http://'.$uri;
		elseif ($scheme != "http" && $scheme != "https") {
			Message::addMessage(MSG_LEVEL_ERROR, "scheme not allowed: ".$scheme); //TODO
			self::$logger->info("- Aborted: ".$scheme." scheme is not allowed");
			return false;
		}

		// Check that the uri is correct (CURLE_URL_MALFORMAT is not enough)
		/*if (preg_match('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@', $uri) == 0) {
			Message::addMessage(MSG_LEVEL_ERROR, lang("message_invalid_url_syntax", $uri));
			self::$logger->info("- Aborted: incorrect syntax");
			//return false;
		}*/

		// Get the content and headers of the submitted document
		$result = self::fetchDocument($uri);
		$uri = $result[0];
		$content = $result[1];
		$curl_info = $result[2];
		$curl_error = $result[3];

		self::$logger->debug("Effective URI: ".$uri);
		self::$logger->debug("Curl Info: ".print_r($curl_info, true));

		// Report errors to the user. Most common cases should be internationalized.
		if ($curl_error != 0) {
			if ($curl_error == CURLE_URL_MALFORMAT) {
				Message::addMessage(MSG_LEVEL_ERROR, lang("message_invalid_url_syntax", $uri));
			} elseif ($curl_error == CURLE_COULDNT_RESOLVE_HOST) {
				Message::addMessage(MSG_LEVEL_ERROR, lang("message_unknown_host", parse_url($uri, PHP_URL_HOST)));
			} elseif ($curl_error == CURLE_COULDNT_CONNECT) {
				Message::addMessage(MSG_LEVEL_ERROR, lang("message_connect_exception"));
			} elseif ($curl_error == CURLE_REMOTE_ACCESS_DENIED) {
				Message::addMessage(MSG_LEVEL_ERROR, lang("message_unauthorized_access"));
			} else {
				// Otherwise send the curl error message (english)
				Message::addMessage(MSG_LEVEL_ERROR, $result[4]);
			}
			self::$logger->info("Curl ERROR: ".$result[4]);
			return false;
		}

		// Check the response code.
		$response_code = $curl_info["http_code"];
		if ($response_code == 404) {
			Message::addMessage(MSG_LEVEL_ERROR, lang("message_document_not_found"));
			self::$logger->info("- Aborted: 404 HTTP error code");
			return false;
		}
		//} elseif ($response_code == 500) {
		//	Message::addMessage(MSG_LEVEL_ERROR, "received an internal server error (500): ".$uri); //TODO
		//	return;
		//}
		elseif ($response_code != 200) {
			Message::addMessage(MSG_LEVEL_ERROR, lang("message_http_error", $response_code));
			self::$logger->info("- Aborted: HTTP response code != 200 (".$response_code.")");
			return false;
		}

		// Check that the document mimetype is either text/html or application/xhtml+xml
		$mimetypename = 'Unknown';
		if (strpos($curl_info['content_type'], ';')) {
			$parts = explode(';', $curl_info['content_type']);
			$mimetypename = $parts[0];
		} else {
			$mimetypename = $curl_info['content_type'];
		}

		if ($mimetypename != 'text/html' && $mimetypename != 'application/xhtml+xml') {
			Message::addMessage(MSG_LEVEL_ERROR, lang("message_unsupported_mimetype", $mimetypename));
			self::$logger->info("- Aborted: ".$mimetypename." mime-type not supported");
			return false;
		}

		// Returns the headers and the content of the document
		return array($uri, $curl_info, $content);
	}

	public static function getDocumentByFileUpload($file) {
		Message::addMessage(MSG_LEVEL_WARNING, lang("message_file_upload_warning"));
		//Message::addMessage(MSG_LEVEL_WARNING, "The file upload feature is still experimental and not fully tested. Results should be considered with care.");
		$content = file_get_contents($file['tmp_name']);
		/* // seems that php deletes temporary file at the end of the request anyway
		 * if (Conf::get('delete_uploaded_files'))
		 *	unlink($file['tmp_name']);
		 */
		return array(null, null, $content);
	}

	public static function fetchDocument($url) {
		// Support of IRIs.
		$isIRI = false;
		if (!Utils::isASCII($url)) {
			$parsedURL = Utils::parse_url($url);
			if ($parsedURL != null) {
				//self::$logger->debug("Parsed url: ".print_r($parsedURL,true));
				$parsedURL['host'] = idn_to_ascii($parsedURL['host']);
				//self::$logger->debug("To ascii domain: ".$parsedURL['host']);
				$parsedURL['path'] = preg_replace('/%2F/', '/', urlencode($parsedURL['path']));
				//self::$logger->debug("Encoded path: ".$parsedURL['path']);
				$url = http_build_url($parsedURL);
				//self::$logger->debug("Final URL: ".$url);
				$isIRI = true;
			} else {
				self::$logger->error("Error parsing url: ".$url);
			}
		}

		//$url = str_replace("&amp;", "&", urldecode(trim($encodedUrl)));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, Conf::get('curl_user_agent'));
		curl_setopt($ch, CURLOPT_URL, $url);
		if (Conf::get('curl_cookiejar_enabled'))
			curl_setopt( $ch, CURLOPT_COOKIEJAR, Conf::get('curl_cookiejar_path'));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, Conf::get('curl_connect_timeout'));
		curl_setopt($ch, CURLOPT_TIMEOUT, Conf::get('curl_timeout'));
		curl_setopt($ch, CURLOPT_MAXREDIRS, Conf::get('curl_maxredirs'));
		// Curl does not parse the Content-Language header so we need a callback function (cf CURLOPT_HEADERFUNCTION)
		curl_setopt($ch, CURLOPT_HEADERFUNCTION, function ($ch, $curl_info) {
			$pattern = '/Content-Language:(.*?)\n/';
			if (preg_match($pattern, $curl_info, $result))
				$_REQUEST['doc_content_language'] = trim($result[1]);
			return strlen($curl_info);
		});

		self::$logger->debug("CURL Options: ".
				"\n\t\t User-Agent: ".Conf::get('curl_user_agent').
				"\n\t\t CookieJar: ".Conf::get('curl_cookiejar_path')." - Enabled: ".Conf::get('curl_cookiejar_enabled').
				"\n\t\t Connexion Timeout: ".Conf::get('curl_connect_timeout').
				"\n\t\t Timeout: ".Conf::get('curl_timeout').
				"\n\t\t Max redirections: ".Conf::get('curl_maxredirs'));

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

		// Add the content-language header value that we parsed before to $curl_info
		if (isset($_REQUEST['doc_content_language']) && $_REQUEST['doc_content_language'] != "") {
			$response['content_language'] = $_REQUEST['doc_content_language'];
			unset($_REQUEST['doc_content_language']);
			self::$logger->debug("Found Content-Language header: ".$response['content_language']);
		}
		// FIXME?
		// If http://उदाहरण.परीक्षा is redirected to http://उदाहरण.परीक्षा/मुख्य_पृष्ठ curl will return http://xn--p1b6ci4b4b3a.xn--11b5bs3a9aj6g/%E0%A4%AE%E0%A5%81%E0%A4%96%E0%A5%8D%E0%A4%AF_%E0%A4%AA%E0%A5%83%E0%A4%B7%E0%A5%8D%E0%A4%A0
		// If the submitted uri is an iri then punnycode to utf8 the domain name and decode the path.
		if ($isIRI) {
			$parsedURL = Utils::parse_url($response['url']);
			//self::$logger->debug("Parsed effective url: ".print_r($parsedURL,true));
			$parsedURL['host'] = idn_to_utf8($parsedURL['host']);
			//self::$logger->debug("To utf-8 domain: ".$parsedURL['host']);
			$parsedURL['path'] = urldecode($parsedURL['path']);
			//self::$logger->debug("Decoded path: ".$parsedURL['path']);
			$response['url'] = http_build_url($parsedURL);
			//self::$logger->debug("Final effective URL: ".$response['url']);
		}

		return array($response['url'], $content, $response, $code, $error);
	}
}

Net::_init();
