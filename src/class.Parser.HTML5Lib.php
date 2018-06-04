<?php
/**
 * Contains and initializes the ParserHTML5Lib class.
 * @package i18nChecker
 */
/**
 * 
 */
require_once(PATH_LIB.'/html5lib/Parser.php');
/**
 * ParserHTML5Lib class
 * 
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
final class ParserHTML5Lib extends Parser {
	
	private static $logger;
	
	public static function _init() {
		self::$logger = Logger::getLogger('Parser.HTML5Lib');
	}
	
	protected function __construct($markup, $contentType) {
		global $uri; // FIXME: will that be set every time ? Another way to pass it here ?
		try {
			// XXX Hack: Only way i found to force html is to remove the doctype declaration first
			$this->document = HTML5_Parser::parse(preg_replace('/<!DOCTYPE[^>]+(\n[^>]+)?>/', '', $markup, Conf::get('perf_head_length')));
			//$this->document = HTML5_Parser::parse($markup);
			self::$logger->debug("Successfully parsed document using html5lib.");
		} catch (Exception $e) {
			// Specify configuration
			$config = array(
				//'indent'	=> true,
				//'wrap'	=> 200
			);
			// Tidy
			$tidy = new tidy;
			$markup = $tidy->repairString($markup, $config, 'utf8');
			try {
				$this->document = HTML5_Parser::parse(preg_replace('/<!DOCTYPE[^>]+(\n[^>]+)?>/', '', $markup, Conf::get('perf_head_length')));
			} catch (Exception $e) {
				self::$logger->debug("Document parsing failed: ".$e->getMessage(), $e);
				throw $e;
			}
			Message::addMessage(MSG_LEVEL_WARNING, lang('message_parse_warn_tidied', isset($uri) && $uri != "" ? 'check?uri='.urlencode($uri) : ''));
		}
		parent::__construct($markup, $contentType);
	}
	
}

ParserHTML5Lib::_init();