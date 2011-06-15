<?php
require_once('lib/html5lib/Parser.php');

final class ParserHTML5Lib extends Parser {
	
	private static $logger;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.HTML5Lib');
	}
	
	protected function __construct($markup, $contentType) {
		try {
			$this->document = HTML5_Parser::parse($markup);
			self::$logger->debug("Successfully parsed document as HTML5.");
		} catch (Exception $e) {
			self::$logger->debug("Document parsing failed: ".$e->getMessage(), $e);
			throw $e;
		}
		parent::__construct($markup, $contentType);
	}
	
}

ParserHTML5Lib::init();