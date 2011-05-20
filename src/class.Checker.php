<?php
require_once('class.N11n.php');
require_once('class.Parser.php');
require_once('class.Information.php');
require_once('class.Report.php');

class Checker {

	private static $logger;
	private $curl_info;
	private $markup;
	private $doc;
	
	public static function init() {
		self::$logger = Logger::getLogger('Checker');
	}
	
	public function __construct($curl_info, $markup) {
		$this->markup = $markup;
		$this->curl_info = $curl_info;
	}
	
	public function checkDocument() {
		try {
			$this->doc = Parser::getParser($this->markup, isset($this->curl_info['content_type']) ? $this->curl_info['content_type'] : null);
		} catch (Exception $e) {
			Message::addMessage(MSG_LEVEL_ERROR, 'Exception: '.$e->getMessage());
			self::$logger->error('Exception raised for URI: '.$this->curl_info['url'], $e);
			return;
		}
		$this->addInfoDTDMimetype();
		$this->addInfoCharsetHTTP();
		$this->addInfoCharsetBom();
		// TODO: need an isXML() function + how about issuing a warning/comment if xml:lang is found in a non-xml doc?
		if ($this->doc->isXHTML() || $this->doc->isHTML5() || $this->doc->mimetypeFromHTTP() == 'application/xhtml+xml')
			$this->addInfoCharsetXMLDeclaration();
		$this->addInfoCharsetMeta();
		$this->addInfoLangAttr();
		if ($this->doc->isXHTML() || $this->doc->isHTML5())
			$this->addInfoXMLLangAttr();
		$this->addInfoLangHTTP();
		$this->addInfoLangMeta();
		$this->addInfoDirHTML();
		$this->addInfoClassId();
		$this->addInfoRequestHeaders();
	}
	
	private function addInfoDTDMimetype() {
		if ($this->doc->isXHTML()) {
			$dtd = 'XHTML';
		} elseif ($this->doc->isHTML()) {
			$dtd = 'HTML';
		} elseif ($this->doc->isXHTML5()) {
			$dtd = 'XHTML5';
		} elseif ($this->doc->isHTML5()) {
			$dtd = 'HTML5';
		}
		if ($dtd)
			Information::addInfo(null, 'dtd', $dtd, null, null);
		else
			Information::addInfo(null, 'dtd', 'NA', null, null);
		Information::addInfo(null, 'mimetype', $this->doc->mimetypeFromHTTP(), null, null);
	}
	
	// INFO: CHARSET FROM HTTP CONTENT-TYPE HEADER
	private function addInfoCharsetHTTP() { 
		$category = 'character_encoding';
		$title = 'content_type';
		$value = strtoupper($this->doc->charsetFromHTTP());
		$display_value = null;
		$code = 'Content-Type: '.$this->curl_info['content_type'];
		if ($code != null && $value == null)
			$display_value = 'no_charset_found';
		if ($code == null && $value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: BYTE ORDER MARK.
	private function addInfoCharsetBom() {
		$category = 'character_encoding';
		$title = 'bom';
		$value = null;
		$display_value = null;
		$code = null;
		$filestart = substr($this->markup,0,3);
		if (ord($filestart{0})== 239 && ord($filestart{1})== 187 && ord($filestart{2})== 191) 
			$value = 'UTF-8';
		else { 
			$filestart = substr($this->markup,0,2);
			if (ord($filestart{0})== 254 && ord($filestart{1})== 255)
				$value = 'UTF-16BE';
			elseif (ord($filestart{0})== 255 && ord($filestart{1})== 254)
				$value = 'UTF-16LE';
		}
		if ($value != null) {
			// Convert to UTF-8
			if ($value == 'UTF-16LE')
				$this->markup = mb_convert_encoding($markup, 'UTF-8', 'UTF-16LE');
			elseif ($value == 'UTF-16BE')
				$this->markup = mb_convert_encoding($markup, 'UTF-8', 'UTF-16BE');
			$code = "Byte-order mark: {$value}";
		} else {
			$display_value = lang('token_no');
		}
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: CHARSET FROM XML DECLARATION
	private function addInfoCharsetXMLDeclaration() {
		$category = 'character_encoding';
		$title = 'xml_declaration';
		$value = $this->doc->charsetFromXML();
		$display_value = null;
		$code = $this->doc->XMLDeclaration();
		if ($code != null && $value == null)
			$display_value = 'no_encoding_found';
		if ($code == null && $value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: CHARSET FROM META CONTENT-TYPE OR META CHARSET (HTML5)
	private function addInfoCharsetMeta() {
		$category = 'character_encoding';
		$title = 'content_type_meta';
		$value = $this->doc->charsetsFromHTML();
		$display_value = null;
		$code = $this->doc->metaCharsetTags();
		if ($code != null && $value == null)
			$display_value = 'no_charset_found';
		if ($code == null && $value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: LANGUAGE FROM HTML LANG ATTRIBUTE
	private function addInfoLangAttr() {
		$category = 'language';
		$title = 'html_lang';
		$value = $this->doc->langFromHTML();
		$display_value = null;
		$code = $this->doc->HTMLTag();
		if ($code != null && $value == null)
			$display_value = 'token_none';
		if ($code == null && $value == null)
			$display_value = 'no_html_tag_found'; // Can this really happen ? Parsing should fail without an html tag
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: LANGUAGE FROM HTML XML:LANG ATTRIBUTE
	private function addInfoXMLLangAttr() {
		$category = 'language';
		$title = 'html_xmllang';
		$value = $this->doc->xmlLangFromHTML();
		$display_value = null;
		$code = $this->doc->HTMLTag();
		if ($code != null && $value == null)
			$display_value = 'token_none';
		if ($code == null && $value == null)
			$display_value = 'no_html_tag_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: LANGUAGE FROM HTTP CONTENT-LANGUAGE
	private function addInfoLangHTTP() {
		$category = 'language';
		$title = 'http_content_language';
		$value = isset($this->curl_info['content_language']) ? $this->curl_info['content_language'] : null;
		$display_value = null;
		$code = isset($this->curl_info['content_language']) ? 'Content-Language: '.$this->curl_info['content_language'] : null;
		if ($value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: LANGUAGE FROM META CONTENT-LANGUAGE
	// XXX: HTML5 content-language deprecated (http://www.w3.org/TR/html-markup/meta.http-equiv.content-language.html), consider adding a warning if used?
	private function addInfoLangMeta() {
		$category = 'language';
		$title = 'meta_content_language';
		$value = $this->doc->langsFromMeta();
		$display_value = null;
		$code = $this->doc->metaLangTags();
		if ($value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);		
	}
	
	// INFO: TEXT DIRECTION FROM HTML TAGS
	private function addInfoDirHTML() {
		$category = 'text_direction';
		$title = 'default_direction';
		$value = $this->doc->dirFromHTML();
		$display_value = null;
		$code = $this->doc->HTMLTag();
		if ($value == null)
			$value = lang('ltr_default');
		Information::addInfo($category, $title, $value, $display_value, $code);	
	}
	
	// INFO: REQUEST HEADERS
	private function addInfoClassId() {
		$classes = $this->doc->getNodesWithClass();
		$ids = $this->doc->getNodesWithID();
		$nodes = array_merge($classes, $ids);
		
		// Remove nodes for which all class names are ASCII
		$unsetASCII = function (&$classes, $code) use (&$nodes) {
			$classes = preg_filter('/[^\x20-\x7E]/', '$0', $classes);
			if (count($classes) == 0)
				unset($nodes[$code]);
		};
		array_walk(&$nodes, $unsetASCII);
		
		$category = 'class_and_id';
		$title = 'class_and_id_non_ascii';
		$value = array_unique(Utils::arrayFlatten(array_values($nodes)));
		$display_value = count($value) == 0 ? 'token_none' : null;
		$code = array_keys($nodes);
		Information::addInfo($category, $title, $value, $display_value, $code);	
		
		// Remove nodes for which all class names are NFC
		$unsetNFC = function (&$classes, $code) use (&$nodes) {
			$classStr = implode('', $classes);
			if (N11n::nfc($classStr) == $classStr)
				unset($nodes[$code]);
		};
		array_walk(&$nodes, $unsetNFC);
		$title = 'class_and_id_non_nfc';
		$value = array_unique(Utils::arrayFlatten(array_values($nodes)));
		$display_value = count($value) == 0 ? 'token_none' : null;
		$code = array_keys($nodes);
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	// INFO: REQUEST HEADERS
	private function addInfoRequestHeaders() {
		$category = 'request_headers';
		$title = 'accept_language';
		$value = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? Utils::parseHeader($_SERVER['HTTP_ACCEPT_LANGUAGE']) : null;
		$code = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? 'Accept-Language: '.$_SERVER['HTTP_ACCEPT_LANGUAGE'] : null;
		$display_value = null;
		if ($value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
		
		$category = 'request_headers';
		$title = 'accept_charset';
		$value = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? array_map('strtoupper', Utils::parseHeader($_SERVER['HTTP_ACCEPT_CHARSET'])) : null;
		$code = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? 'Accept-Charset: '.$_SERVER['HTTP_ACCEPT_CHARSET'] : null;
		$display_value = null;
		if ($value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
}

Checker::init();