<?php
/**
 * Contains and initializes the Checker class.
 * @package i18nChecker
 */
/**
 * 
 */
require_once('class.N11n.php');
require_once('class.Parser.php');
require_once('class.Information.php');
require_once('class.Report.php');
/**
 * The I18n Checker
 * 
 * This class holds the logic of the i18n checker.
 * 
 * @package i18nChecker
 * @author Richard Ishida <ishida@w3.org> & Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Checker {

	private static $logger;
	private $curl_info;
	private $markup;
	private $doc;
	
	public static function _init() {
		self::$logger = Logger::getLogger('Checker');
	}
	
	public function __construct($curl_info, $markup) {
		$this->markup = $markup;
		$this->curl_info = $curl_info;
	}
	
	public function checkDocument() {
		
		// Do that first !
		$bom = $this->convertEncoding();
		
		// Instantiate parser
		try {
			$this->doc = Parser::getParser($this->markup, isset($this->curl_info['content_type']) ? $this->curl_info['content_type'] : null);
		} catch (Exception $e) {
			Message::addMessage(MSG_LEVEL_ERROR, 'Exception: '.$e->getMessage());
			self::$logger->error('Exception raised for URI: '.$this->curl_info['url'], $e);
			return false;
		}
		
		// Gather information
		$this->addInfoDTDMimetype();
		$this->addInfoCharsetHTTP();
		$this->addInfoCharsetBom($bom);
		$this->addInfoCharsetXMLDeclaration();
		$this->addInfoCharsetMeta();
		$this->addInfoLangAttr();
		$this->addInfoXMLLangAttr();
		$this->addInfoLangHTTP();
		$this->addInfoLangMeta();
		$this->addInfoDirHTML();
		$this->addInfoClassId();
		$this->addInfoRequestHeaders();
		
		// Generate report
		$this->addReportCharsets();
		$this->addReportLanguages();
		$this->addReportDirValues();
		$this->addReportMisc();
		return true;
	}
	
	private function addInfoDTDMimetype() {
		if ($this->doc->isXHTML5())
			Message::addMessage(MSG_LEVEL_WARNING, lang("message_xhtml5_partial_support"));
		Information::addInfo(null, 'dtd', null, $this->doc->doctype);
		Information::addInfo(null, 'mimetype', null, $this->doc->mimetypeFromHTTP());
	}
	
	// INFO: CHARSET FROM HTTP CONTENT-TYPE HEADER
	private function addInfoCharsetHTTP() { 
		$category = 'charset_category';
		$title = 'charset_http';
		$_code = $this->curl_info['content_type'] ? 'Content-Type: '.$this->curl_info['content_type'] : null;
		$_val = $this->doc->charsetFromHTTP();
		$value = array('code' => $_code, 'values' => $_val);
		$display_value = null;
		if ($_code != null && $_val == null)
			$display_value = 'charset_none_found';
		if ($_code == null && $_val == null)
			$display_value = 'val_none_found';
		if (!$this->curl_info['url'])
			$display_value = 'charset_na_upload';
		Information::addInfo($category, $title, $value, $display_value);
	}
	
	private function convertEncoding() {
		$filestart = substr($this->markup,0,3);
		if (ord($filestart{0})== 239 && ord($filestart{1})== 187 && ord($filestart{2})== 191) 
			return 'UTF-8';
		else { 
			$filestart = substr($this->markup,0,2);
			if (ord($filestart{0})== 254 && ord($filestart{1})== 255) {
				$this->markup = mb_convert_encoding($this->markup, 'UTF-8', 'UTF-16BE');
				return 'UTF-16BE';
			} else if (ord($filestart{0})== 255 && ord($filestart{1})== 254) {
				$this->markup = mb_convert_encoding($this->markup, 'UTF-8', 'UTF-16LE');
				return 'UTF-16LE';
			}
		}
	}
	
	// INFO: BYTE ORDER MARK.
	private function addInfoCharsetBom($bom = '') {
		$category = 'charset_category';
		$title = 'charset_bom';
		$value = null;
		$display_value = null;
		if ($bom != '')
			$value = array ('code' => null, 'values' => $bom);
		else
			$display_value = 'val_no';
		Information::addInfo($category, $title, $value, $display_value);
	}
	
	// INFO: CHARSET FROM XML DECLARATION
	private function addInfoCharsetXMLDeclaration() {
		$category = 'charset_category';
		$title = 'charset_xml';
		$_code = $this->doc->XMLDeclaration();
		$_val = $this->doc->charsetFromXML();
		$value = array('code' => $_code, 'values' => $_val);
		$display_value = null;
		if ($_code != null && $_val == null)
			$display_value = 'charset_none_found';
		if ($_code == null && $_val == null)
			$display_value = 'val_none_found';
		if ($this->doc->isXML() || (!$this->doc->isXML() && $_code != null) || ($this->doc->isXHTML5() && $_code != null))
			Information::addInfo($category, $title, $value, $display_value);
	}
	
	// INFO: CHARSET FROM META CONTENT-TYPE OR META CHARSET (HTML5)
	private function addInfoCharsetMeta() {
		$category = 'charset_category';
		$title = 'charset_meta';
		$value = $this->doc->charsetsFromHTML();
		$display_value = null;
		$vals = Utils::valuesFromValArray($value);
		if (empty($vals)) {
			$codes = Utils::codesFromValArray($value);
			if (empty($codes))
				$display_value = 'val_none_found';
			else
				$display_value = 'charset_none_found';
		}
		if (empty($vals) && $this->doc->isXML() && $this->doc->mimetypeFromHTTP() != 'text/html') 
			return;
		Information::addInfo($category, $title, $value, $display_value);
	}
	
	// INFO: LANGUAGE FROM HTML LANG ATTRIBUTE
	private function addInfoLangAttr() {
		$category = 'lang_category';
		$title = 'lang_attr_lang';
		$_code = $this->doc->HTMLTag();
		$_val = $this->doc->langFromHTML();
		$value = array('code' => $_code, 'values' => $_val);
		$display_value = null;
		if ($_code != null && $_val == null)
			$display_value = 'val_none';
		if ($_code == null && $_val == null)
			$display_value = 'no_html_tag_found';
		Information::addInfo($category, $title, $value, $display_value);
	}
	
	// INFO: LANGUAGE FROM HTML XML:LANG ATTRIBUTE
	private function addInfoXMLLangAttr() {
		$category = 'lang_category';
		$title = 'lang_attr_xmllang';
		$_code = $this->doc->HTMLTag();
		$_val = $this->doc->xmlLangFromHTML();
		$value = array('code' => $_code, 'values' => $_val);
		$display_value = null;
		if ($_code != null && $_val == null)
			$display_value = 'val_none';
		if ($_code == null && $_val == null)
			$display_value = 'no_html_tag_found';
		if ($this->doc->isXML() || $_val != null) // If no xml:lang is null add the line only if doc is xml to begin with
			Information::addInfo($category, $title, $value, $display_value);
	}
	
	// INFO: LANGUAGE FROM HTTP CONTENT-LANGUAGE
	private function addInfoLangHTTP() {
		$category = 'lang_category';
		$title = 'lang_http';
		$_code = isset($this->curl_info['content_language']) ? 'Content-Language: '.$this->curl_info['content_language'] : null;
		$_val = isset($this->curl_info['content_language']) ? Utils::getValuesFromCSString($this->curl_info['content_language']) : null;
		$value = array(
			'code' => $_code,
			'values' => $_val
		);		
		$display_value = null;
		if ($_val == null)
			$display_value = 'val_none_found';
		Information::addInfo($category, $title, $value, $display_value);
	}
	
	// INFO: LANGUAGE FROM META CONTENT-LANGUAGE
	// XXX: HTML5 content-language deprecated (http://www.w3.org/TR/html-markup/meta.http-equiv.content-language.html), consider adding a warning if used?
	private function addInfoLangMeta() {
		$category = 'lang_category';
		$title = 'lang_meta';
		$value = $this->doc->langsFromMeta();
		$display_value = null;
		if ($value == null)
			$display_value = 'val_none_found';
		if (!empty($value))
			Information::addInfo($category, $title, $value, $display_value);		
	}
	
	// INFO: TEXT DIRECTION FROM HTML TAGS
	private function addInfoDirHTML() {
		$category = 'dir_category';
		$title = 'dir_default';
		$_code = $this->doc->HTMLTag();
		$_val = $this->doc->dirFromHTML();
		$value = array('code' => $_code, 'values' => $_val);
		$display_value = null;
		if ($_val == null)
			$value = lang('dir_default_ltr');
		Information::addInfo($category, $title, $value, $display_value);	
	}
	
	// INFO: NON ASCII AND NFC CLASSES AND IDS
	private function addInfoClassId() {
		$classes = $this->doc->getNodesWithClass();
		$ids = $this->doc->getNodesWithID();
		$nodes = array_merge((array) $classes,(array) $ids);
		
		// Remove nodes for which all class names are ASCII
		//self::$logger->error(print_r($nodes, true));
		// FIXME! use array_filter
		if (count($nodes) > 0)
			array_walk(&$nodes, function (&$valArray, $key) use (&$nodes) {
				$valArray['values'] = preg_filter('/[^\x20-\x7E]/', '$0', $valArray['values']);
				if (count($valArray['values']) == 0)
					unset($nodes[$key]);
			});
		
		$category = 'classId_category';
		$title = 'classId_non_ascii';
		$value = array_values($nodes); // we use array_values() to reindex the array
		$display_value = count($value) == 0 ? 'val_none' : null;
		Information::addInfo($category, $title, $value, $display_value);
		
		// Remove nodes for which all class names are NFC
		// FIXME: i shoudln't unset elements while walking through the array. clone first or use array_filter
		if (count($nodes) > 0)
			array_walk(&$nodes, function (&$valArray, $key) use (&$nodes) {
				if (is_array($valArray['values'])) 
					$classStr = implode('', $valArray['values']);
				else
					$classStr = $valArray['values']; 
				if (N11n::nfc($classStr) == $classStr)
					unset($nodes[$key]);
			});
		$title = 'classId_non_nfc';
		$value = array_values($nodes);
		$display_value = count($value) == 0 ? 'val_none' : null;
		Information::addInfo($category, $title, $value, $display_value);
	}
	
	// INFO: REQUEST HEADERS
	private function addInfoRequestHeaders() {
		$category = 'headers_category';
		$title = 'headers_accept_language';
		$_val = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? Utils::parseHeader($_SERVER['HTTP_ACCEPT_LANGUAGE']) : null;
		$_code = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? 'Accept-Language: '.$_SERVER['HTTP_ACCEPT_LANGUAGE'] : null;
		$value = array('code' => $_code, 'values' => $_val);
		$display_value = null;
		if ($_val == null)
			$display_value = 'val_none_found';
		Information::addInfo($category, $title, $value, $display_value);
		
		$title = 'headers_accept_charset';
		$_val = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? Utils::parseHeader($_SERVER['HTTP_ACCEPT_CHARSET']) : null;
		$_code = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? 'Accept-Charset: '.$_SERVER['HTTP_ACCEPT_CHARSET'] : null;
		$value = array('code' => $_code, 'values' => $_val);
		$display_value = null;
		if ($_val == null)
			$display_value = 'val_none_found';
		Information::addInfo($category, $title, $value, $display_value);
	}
	
	private function addReportCharsets() {
		$category = 'charset_category';
		
		// Get all the charsets found
		$charsets = (array) Information::getValuesStartingWith('charset_');
		$charsetVals = array_unique(array_map('strtoupper', Utils::valuesFromValArray($charsets)));
		$charsetVals = $charsetVals == null ? array() : $charsetVals;
		$charsetCodes = Utils::codesFromValArray(
			array_filter($charsets, function ($array) {
				if ($array['values'] != null && !empty($array['values']))
					return true;
				return false;
			})
		);
		
		// WARNING: No character encoding information
		if (empty($charsetVals)) {
			self::$logger->debug('No charset information found for this document.');
			Report::addReport(
				'rep_charset_none',
				$category, REPORT_LEVEL_WARNING,
				lang('rep_charset_none'),
				lang('rep_charset_none_expl'),
				lang('rep_charset_none_todo'),
				lang('rep_charset_none_link')
			);
			return;
		}
		
		// INFO: Non UTF-8 charset declared
		if (!in_array("UTF-8", $charsetVals) || count(array_unique($charsetVals)) > 1) {
			$nonUTF8CharsetCodes = Utils::codesFromValArray(
				array_filter($charsets, function ($array) {
					// XXX Review this
					if ($array['values'] != null 
						&& (!in_array("UTF-8", array_map('strtoupper', (array) $array['values']))))
						return true;
					return false;
				})
			);
			Report::addReport(
				'rep_charset_no_utf8',
				$category, REPORT_LEVEL_INFO,
				lang('rep_charset_no_utf8'),
				lang('rep_charset_no_utf8_expl', Language::format($nonUTF8CharsetCodes, LANG_FORMAT_OL_CODE)),
				lang('rep_charset_no_utf8_todo'),
				lang('rep_charset_no_utf8_link')
			);
		}
		
		// ERROR: Conflicting character encoding declarations
		if (count(array_unique($charsetVals)) != 1) {
			$codes = $charsetCodes;
			if (($bom = Information::getFirstVal('charset_bom')) != null) // There is no code line for BOM, so add manually if present
				$codes[] = "Byte order mark (BOM): $bom";
			Report::addReport(
				'rep_charset_conflict',
				$category, REPORT_LEVEL_ERROR,
				lang('rep_charset_conflict'),
				lang('rep_charset_conflict_expl', Language::format($codes, LANG_FORMAT_OL_CODE)),
				lang('rep_charset_conflict_todo'),
				lang('rep_charset_conflict_link')
			);
		}
		
		// WARNING: Multiple encoding declarations using the meta tag
		if (count(Information::getValues('charset_meta')) > 1) {
			Report::addReport(
				'rep_charset_multiple_meta',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_charset_multiple_meta'),
				lang('rep_charset_multiple_meta_expl', Language::format(Utils::codesFromValArray(Information::getValues('charset_meta')), LANG_FORMAT_OL_CODE)),
				lang('rep_charset_multiple_meta_todo'),
				lang('rep_charset_multiple_meta_link')
			);
		}
		
		// WARNING: UTF-8 BOM found at start of file
		if (($bom = Information::getFirstVal('charset_bom')) != null 
			&& strcasecmp($bom, "UTF-8") == 0) {
			Report::addReport(
				'rep_charset_bom_found',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_charset_bom_found'),
				lang('rep_charset_bom_found_expl'),
				lang('rep_charset_bom_found_todo'),
				lang('rep_charset_bom_found_link')
			);
		}
		
		// WARNING: No charset declaration in the document
		$inDocCharsets = array_merge(
			(array) Information::getValues('charset_bom'),
			(array) Information::getValues('charset_xml'),
			(array) Information::getValues('charset_meta')
		);
		$inDocCharsets = 
			array_filter($inDocCharsets, function ($array) {
				if ($array['values'] != null && !empty($array['values']))
					return true;
				return false;
			});
		if (!empty($charsetVals) && empty($inDocCharsets)) {
			Report::addReport(
				'rep_charset_no_in_doc',
				$category, REPORT_LEVEL_WARNING,
				lang('rep_charset_no_in_doc'),
				lang('rep_charset_no_in_doc_expl', Information::get('charset_http')->values[0]['code']),
				lang('rep_charset_no_in_doc_todo'),
				lang('rep_charset_no_in_doc_link')
			);
		}
		
		// WARNING: BOM in content
		// /!\ In the following line is the invisible BOM.
		if (preg_match('/﻿/', substr($this->markup,3))) {
			Report::addReport(
				'rep_charset_bom_in_content',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_charset_bom_in_content'),
				lang('rep_charset_bom_in_content_expl'),
				lang('rep_charset_bom_in_content_todo'),
				lang('rep_charset_bom_in_content_link')
			);
		}
		
	}
	
	private function addReportLanguages() {
		$category = 'lang_category';
		
		// Attributes on the html tag
		$langAttr = Information::getFirstVal('lang_attr_lang');
		$xmlLangAttr = Information::getFirstVal('lang_attr_xmllang');
		// Attributes on all nodes
		$htmlLangAttrs = $this->doc->getNodesWithAttr('lang');
		$xmlLangAttrs = $this->doc->getNodesWithAttr('lang', true);
		// Only the tag dumps of nodes containing (xml:)lang
		$htmlLangCodes = Utils::codesFromValArray($htmlLangAttrs);
		$xmlLangCodes = Utils::codesFromValArray($xmlLangAttrs);
		
		// WARNING: The html tag doesn't have the right language attributes
		/* 3 tests:
		 * - mimetype:text/html + doctype HTML  => lang != null
		 * - mimetype:text/html + doctype XHTML => lang != null && xml:lang != null
		 * - mimetype:application/xhtml+xml     => xml:lang != null 
		 */
		$b = false;
		$todo = 'rep_lang_no_lang_attr_todo_1';
		if ($this->doc->mimetypeFromHTTP() != 'text/html' && $xmlLangAttr == null) {
			$b = true;
		} else if ($this->doc->mimetypeFromHTTP() != 'application/xhtml+xml' && $this->doc->isXML() && $xmlLangAttr == null && $langAttr == null) {
			$b = true;
			$todo = 'rep_lang_no_lang_attr_todo_2';
		} else if (!$this->doc->isXML() && $langAttr == null) {
			$b = true;
		}
		if ($b) {
			$expl = lang('rep_lang_no_lang_attr_expl', htmlspecialchars($this->doc->HTMLTag()));
			if ($this->doc->langsFromMeta() != null) {
				$a = Information::getValues('lang_meta');
				$expl[] = lang('rep_lang_no_lang_attr_expl_CL', Utils::arrayToCS($a[0]['values']), htmlspecialchars($a[0]['code']));
			}
			Report::addReport(
				'rep_lang_no_lang_attr',
				$category, REPORT_LEVEL_WARNING,
				lang('rep_lang_no_lang_attr'),
				$expl,
				lang($todo),
				lang('rep_lang_no_lang_attr_link')
			);
		}

		// ERROR: The lang attribute and the xml:lang attribute in the html tag have different values
		if ($this->doc->isXML() && $langAttr != null && $xmlLangAttr != null && $langAttr != $xmlLangAttr) {
			Report::addReport(
				'rep_lang_conflict_html',
				$category, REPORT_LEVEL_ERROR,
				lang('rep_lang_conflict_html'),
				lang('rep_lang_conflict_html_expl', $langAttr, $xmlLangAttr, htmlspecialchars($this->doc->HTMLTag())),
				lang('rep_lang_conflict_todo'),
				lang('rep_lang_conflict_link')
			);
		}
		
		// WARNING: This HTML file contains xml:lang attributes
		if (!$this->doc->isXML() && ($xmlLangAttrs != null || $xmlLangAttr != null)) {
			$codes = array();
			if ($xmlLangAttrs != null)
				$codes = $xmlLangCodes;
			if ($xmlLangAttr != null)
				$codes[] = $this->doc->HTMLTag();
			Report::addReport(
				'rep_lang_xml_attr_in_html',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_lang_xml_attr_in_html'),
				lang('rep_lang_xml_attr_in_html_expl', Language::format($codes, LANG_FORMAT_OL_CODE)),
				lang('rep_lang_xml_attr_in_html_todo'),
				lang('rep_lang_xml_attr_in_html_link')
			);
		}
		
		// WARNING: Check that lang and xml:lang come in pairs in xhtml served as text/html
		if ($this->doc->isXML() && $this->doc->mimetypeFromHTTP() != "application/xhtml+xml" 
			&& ((($diff = Utils::diffArray($htmlLangCodes, $xmlLangCodes)) != null) || ($langAttr != null && $xmlLangAttr == null))) {
			$codes = array();
			if (!empty($diff))// != null)
				$codes = $diff;
			if ($xmlLangAttr == null)
				$codes[] = $this->doc->HTMLTag();
			Report::addReport(
				'rep_lang_missing_xml_attr',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_lang_missing_xml_attr'),
				lang('rep_lang_missing_xml_attr_expl', Language::format($codes, LANG_FORMAT_OL_CODE)),
				lang('rep_lang_missing_xml_attr_todo'),
				lang('rep_lang_missing_attr_link')
			);
		}
		if ($this->doc->isXML() && $this->doc->mimetypeFromHTTP() != "application/xhtml+xml" 
			&& ((($diff = Utils::diffArray($xmlLangCodes, $htmlLangCodes)) != null) || ($langAttr == null && $xmlLangAttr != null))) {
			$codes = array();
			if (!empty($diff))// != null)
				$codes = $diff;
			if ($langAttr == null)
				$codes[] = $this->doc->HTMLTag();
			Report::addReport(
				'rep_lang_missing_html_attr',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_lang_missing_html_attr'),
				lang('rep_lang_missing_html_attr_expl', Language::format($codes, LANG_FORMAT_OL_CODE)),
				lang('rep_lang_missing_html_attr_todo'),
				lang('rep_lang_missing_attr_link')
			);
		}
		
		// WARNING: A language attribute value was incorrectly formed.
		$malformedAttrs = array_filter(array_merge((array) $htmlLangAttrs, (array) $xmlLangAttrs), function ($element) {
			foreach ((array) $element['values'] as $val)
				if (preg_match("/^[a-zA-Z0-9]*[^a-zA-Z0-9\-]+[a-zA-Z0-9]*$/", $val))
					return true; // keep only those that do not match
				return false;
		});
		if ($malformedAttrs != null) {
			Report::addReport(
				'rep_lang_malformed_attr',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_lang_malformed_attr'),
				lang('rep_lang_malformed_attr_expl', Language::format(array_unique(Utils::codesFromValArray($malformedAttrs)), LANG_FORMAT_OL_CODE)),
				lang('rep_lang_malformed_attr_todo'),
				lang('rep_lang_malformed_attr_link')
			);
		}
		
		// ERROR: A lang attribute value did not match an xml:lang value when they appeared together on the same tag.
		$nonMatchingAttrs = array();
		if ($this->doc->isXML() && count($htmlLangAttrs) > 0)
			array_walk(&$htmlLangAttrs, function (&$valArray, $key) use (&$xmlLangAttrs, &$nonMatchingAttrs) {
				$code = $valArray['code'];
				if (($el = Utils::findCodeIn($code, $xmlLangAttrs)) != null) {
					if ($el['values'] != $valArray['values']) {
						$nonMatchingAttrs[] = $code;
					}
				}
			});
		if (count($nonMatchingAttrs) > 0) {
			Report::addReport(
				'rep_lang_conflict',
				$category, REPORT_LEVEL_WARNING, 
				lang('rep_lang_conflict'),
				lang('rep_lang_conflict_expl', Language::format($nonMatchingAttrs, LANG_FORMAT_OL_CODE)),
				lang('rep_lang_conflict_todo'),
				lang('rep_lang_conflict_link')
			);
		}
		
	}
	
	private function addReportDirValues() {
		// ERROR: Incorrect values used for dir attribute
		$dirNodes = $this->doc->getNodesWithAttr('dir');
		$isXHTML = $this->doc->isXHTML();
		if (count($dirNodes) > 0) {
			$invalidDirNodes = array_filter($dirNodes, function ($array) use ($isXHTML) {
				$b = $isXHTML ? preg_match('/(rtl)|(ltr)/', $array['values']) : preg_match('/(rtl)|(ltr)/i', $array['values']);
				if ($b)
					return false;
				return true;
			});
			if (count($invalidDirNodes) > 0)
				Report::addReport(
					'rep_dir_incorrect',
					'dir_category', REPORT_LEVEL_ERROR, 
					lang('rep_dir_incorrect'),
					lang('rep_dir_incorrect_expl', Language::format(Utils::codesFromValArray($invalidDirNodes), LANG_FORMAT_OL_CODE)),
					lang('rep_dir_incorrect_todo'),
					lang('rep_dir_incorrect_link')
				);
		}
		
	}
	
	private function addReportMisc() {
		// WARNING: are there non-NFC class or id names?
		$nonNFCs = Information::getValues('classId_non_nfc');
		if (count($nonNFCs) > 0) {
			Report::addReport(
				'rep_misc_non_nfc',
				'nonLatin_category', REPORT_LEVEL_WARNING, 
				lang('rep_misc_non_nfc'),
				lang('rep_misc_non_nfc_expl', count($nonNFCs), Language::format(Utils::codesFromValArray($nonNFCs), LANG_FORMAT_OL_CODE)),
				lang('rep_misc_non_nfc_todo'),
				lang('rep_misc_non_nfc_link')
			);
		}
		
		// INFO: <b> tags found in source
		$bTags = $this->doc->getElementsByTagName('b');
		$count = 0;
		if (count($bTags) > 0) {
			foreach ($bTags as $bTag) {
				if ($bTag->hasAttributes() || $bTag->attributes->getNamedItem('class') == null) {
					$count++;
				}
			}
			if ($count > 0)
				Report::addReport(
					'rep_misc_tags_no_class',
					'markup_category', REPORT_LEVEL_INFO, 
					lang('rep_misc_tags_no_class', 'b'),
					lang('rep_misc_tags_no_class_expl', 'b', count($bTags), $count),
					lang('rep_misc_tags_no_class_todo', 'b'),
					lang('rep_misc_tags_no_class_link')
				);
		}
		
		// INFO: <i> tags found in source
		$iTags = $this->doc->getElementsByTagName('i');
		$count = 0;
		if (count($iTags) > 0) {
			foreach ($iTags as $iTag) {
				if ($iTag->hasAttributes() || $iTag->attributes->getNamedItem('class') == null) {
					$count++;
				}
			}
			if ($count > 0)
				Report::addReport(
					'rep_misc_tags_no_class',
					'markup_category', REPORT_LEVEL_INFO, 
					lang('rep_misc_tags_no_class', 'i'),
					lang('rep_misc_tags_no_class_expl', 'i', count($iTags), $count),
					lang('rep_misc_tags_no_class_todo', 'i'),
					lang('rep_misc_tags_no_class_link')
				);
		}
	}
}

Checker::_init();