<?php
require_once('lib/phpQuery.php');


class ParserPHPQuery extends Parser {
	
	private static $logger;
	private $doc;
	private $metaCharsetTags = array();
	private $charsetsFromHTML = array();
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.PHPQuery');
	}
	
	protected function __construct($markup, $contentType) {
		//phpQuery::$debug = 2;
		$this->doc = phpQuery::newDocument($markup);
		parent::__construct($markup, $contentType);
	}
	
	public function charsetsFromHTML() {
		// attr(name) accesses the property on the first matched element
		$contentType = Utils::contentTypeToArray(pq('meta[http-equiv=Content-Type]')->attr('content'));
		pq('meta[http-equiv=Content-Type]')->each(array($this, 'addCharsetHTML'));
		return $this->charsetsFromHTML;
	}
	
	public function metaCharsetTags() {
		return $this->metaCharsetTags;
	}
	
	private function dump($node){
	    return $this->doc->document->saveXML($node);
	}
	
	public function addCharsetHTML($node) {
		$contentType = Utils::contentTypeToArray(pq($node)->attr('content'));
		$this->charsetsFromHTML[] = strtoupper($contentType['charset']);
		$this->metaCharsetTags[] = $this->dump($node);
		self::$logger->debug("Found meta tag charset: ".$contentType['charset']);
	}
}

ParserPHPQuery::init();