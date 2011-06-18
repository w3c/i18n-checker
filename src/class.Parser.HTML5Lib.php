<?php
require_once(PATH_LIB.'/html5lib/Parser.php');

final class ParserHTML5Lib extends Parser {
	
	private static $logger;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.HTML5Lib');
	}
	
	protected function __construct($markup, $contentType) {
		try {
			// XXX Hack: Only way i found to force html is to remove the xml declaration first -> careful if using this parser with non html5 xml documents
			$this->document = HTML5_Parser::parse(preg_replace('/<!DOCTYPE[^>\n]+>/', '', $markup, Conf::get('perf_head_length')));
			/*$this->document = HTML5_Parser::parse($markup);*/
			self::$logger->debug("Successfully parsed document as HTML5.");
		} catch (Exception $e) {
			self::$logger->debug("Document parsing failed: ".$e->getMessage(), $e);
			throw $e;
		}
		parent::__construct($markup, $contentType);
	}
	
}

ParserHTML5Lib::init();