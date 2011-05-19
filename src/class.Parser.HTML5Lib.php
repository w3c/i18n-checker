<?php
require_once('lib/html5lib/Parser.php');

final class ParserHTML5Lib extends Parser {
	
	private static $logger;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.PHPQuery');
	}
	
	protected function __construct($markup, $contentType) {
		$this->document = HTML5_Parser::parse($markup);
		parent::__construct($markup, $contentType);
	}
	
}

ParserHTML5Lib::init();