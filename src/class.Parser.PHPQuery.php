<?php
require_once('lib/phpQuery.php');

final class ParserPHPQuery extends Parser {
	
	private static $logger;
	private $doc;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.PHPQuery');
	}
	
	protected function __construct($markup, $contentType) {
		//phpQuery::$debug = 2;
		$this->doc = phpQuery::newDocument($markup);
		$this->document = $this->doc->document;
		parent::__construct($markup, $contentType);
	}
	
	// @Override
	protected function parseMeta() {
		$this->charsetsFromHTML = array();
		$this->metaCharsetTags = array();
		// Seems we can't use an anonymous callback function
		pq('meta[http-equiv=Content-Type]')->each(array($this, 'addCharsetHTML'));
	}
	
	public function addCharsetHTML($node) {
		$contentType = Utils::contentTypeToArray(pq($node)->attr('content'));
		$this->charsetsFromHTML[] = strtoupper($contentType['charset']);
		$this->metaCharsetTags[] = $this->dump($node);
		self::$logger->debug("Found meta tag charset: ".$contentType['charset']);
	}
	
	/*public function langFromHTML() {
		self::$logger->debug($this->dumpTag(pq('html')->elements[0]));
	}*/
}

ParserPHPQuery::init();