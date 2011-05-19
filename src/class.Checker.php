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
			Message::addMessage(MSG_LEVEL_ERROR, $e);
			return;
		}
		$this->addInfoCharsetHTTP();
		$this->addInfoCharsetBom();
		if ($this->doc->isXHTML() || $this->doc->mimetypeFromHTTP() == 'application/xhtml+xml')
			$this->addInfoCharsetXMLDeclaration();
		$this->addInfoCharsetMeta();
		$this->addInfoLangAttr();
		if ($this->doc->isXHTML()) // TODO: need an isXML() function + how about issuing a warning/comment if xml:lang is found in a non-xml doc?
			$this->addInfoXMLLangAttr();
		$this->addInfoLangHTTP();
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
	
	// INFO: CHARSET FROM META ELEMENTS
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
		$code = isset($this->curl_info['content_language']) ? 'Content-Language: '.$this->curl_info['content_language'] : null;;
		if ($value == null)
			$display_value = 'none_found';
		Information::addInfo($category, $title, $value, $display_value, $code);
	}
	
	private function oth() {
		// INFO: META CONTENT-LANGUAGE
		$language['meta_content_language'] = array();
		if (preg_match("/<meta.*? http-equiv=[\"\']?Content-Language[^>]* content=[\"\']?([a-zA-Z0-9\-\s\=,]+)[^>]*>/i", $markup, $match)) { 
			$language['meta_content_language']['code'] = $match[0];
			$language['meta_content_language']['value'] = $match[1];
		} else {
			$language['meta_content_language']['display'] = lang('none_found');
		}
		
	}
	
	function checkMisc($curl_info, $markup) {
		
		// Create language information category 
		global $results;
		$direction = &$results['infos']['text_direction'];
		
		// INFO: HTML DIR ATTRIBUTE
		$direction['default_direction'] = array();
		if (preg_match("/<html[^>]*dir=[\'\"]?([^ >\'\"]+)[\'\"]?[^>]*>/i", $markup, $match)) {
			$direction['default_direction']['value'] = $match[1];
			$direction['default_direction']['code'] = $match[0];
		} else {
			$direction['default_direction']['value'] = lang('ltr_default');
			if (preg_match("/<html[^>]*>/i", $markup, $match)) {
				$direction['default_direction']['code'] = $match[0];
			} else {
				$direction['default_direction']['display'] = lang('no_html_tag_found');
			}
		}
		
	//	// find all dir attributes
	//	$dirtagctr=0; $dirmismatchctr=0; $dirmismatches='';
	//	if (preg_match_all("/<[^>]+? dir=([\"\'][^\"\'>]*[\"\']|[^ \"\'>]+)[^>]*>/i", $markup, $dirtagsA)) {
	//		$dirtagctr = count($dirtagsA[0]);
	//		for ($i=0; $i<$dirtagctr; $i++) { 
	//			$dirvalue = $dirtagsA[1][$i]; $dirvalue = str_replace('\'','',$dirvalue); $dirvalue = str_replace('"','',$dirvalue);
	//			if (! (strtolower($dirvalue == 'rtl') || strtolower($dirvalue == 'ltr')) ) { 
	//				$dirmismatchctr++;
	//				$dirmismatches .= '<li><code>'.str_replace('<','&lt;',$dirtagsA[0][$i]).'</code></li>';
	//			}
	//		}
	//	}
	
		// Create class_and_id information category 
		$class = &$results['infos']['class_and_id'];
		
		// INFO: NON-ASCII AND NFC NAMES
		$classfound = preg_match_all("/<[^>]*? class=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/i", $markup, $classesA);
		$idsfound = preg_match_all("/<[^>]*? id=[\'\"]?([^>\'\"]+)[\'\"]?[^>]*>/i", $markup, $idsA);
		$class['class_and_id_non_ascii'] = array();
		$class['class_and_id_non_ascii']['value'] = 0;
		$class['class_and_id_non_nfc'] = array();
		$class['class_and_id_non_nfc']['value'] = 0;
		foreach ($classesA[1] as $key => $classes) {
			$names = explode(" ", $classes);
			foreach ($names as $name) {
				if (preg_match("/[!-~\s]*[^!-~\s]+.*/", $name)) {
					$class['class_and_id_non_ascii']['value'] += 1;
					$class['class_and_id_non_ascii']['code'][] = $classesA[0][$key];
					if (N11n::nfc($name) != $name) {
						$class['class_and_id_non_nfc']['value'] += 1;
						$class['class_and_id_non_nfc']['code'][] = $classesA[0][$key];
					}
				}
			}
		}
		foreach ($idsA[1] as $key => $classes) {
			$names = explode(" ", $classes);
			foreach ($names as $name) {
				if (preg_match("/[!-~\s]*[^!-~\s]+.*/", $name)) {
					$class['class_and_id_non_ascii']['value'] += 1;
					$class['class_and_id_non_ascii']['code'][] = $idsA[0][$key];
					if (N11n::nfc($name) != $name) {
						$class['class_and_id_non_nfc']['value'] += 1;
						$class['class_and_id_non_nfc']['code'][] = $idsA[0][$key];
					}
				}
			}
		}
		if ($class['class_and_id_non_ascii']['value'] == 0)
			$class['class_and_id_non_ascii']['display'] = lang('token_none');
		if ($class['class_and_id_non_nfc']['value'] == 0)
			$class['class_and_id_non_nfc']['display'] = lang('token_none');
			
		// Create class_and_id information category
		$headers = &$results['infos']['request_headers'];
		
		// INFO: REQUEST HEADERS
		$headers['accept_language'] = array();
		$headers['accept_language']['value'] = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : lang('none_found');
		$headers['accept_charset'] = array();
		$headers['accept_charset']['value'] = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? $_SERVER['HTTP_ACCEPT_CHARSET'] : lang('none_found');
		
	}
	
	/*public function isHTML5($markup) {
		if ($this->is_html5 == null)
			$this->is_html5 = preg_match("/^<!DOCTYPE HTML>/i", $markup);
		return $this->is_html5;
	}*/
}

Checker::init();