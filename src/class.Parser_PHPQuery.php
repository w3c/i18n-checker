<?php
require_once('lib/phpQuery.php');


class Parser_PHPQuery extends Parser {
	
	private static $logger;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.PHPQuery');
	}
	
	protected function __construct($content) {
		//phpQuery::$debug = 2;
		$doc = phpQuery::newDocument($content);
		//self::$logger->debug($doc->documentWrapper->charsetFromXML());
		/*try {
			phpQuery::newDocument($content);
		} catch (Exception $e) {
		    echo 'Caught exception: ',  $e->getMessage(), "\n";
		}*/
		self::$logger->debug(pq('html')->attr('lang'));
		self::$logger->debug(print_r(pq('html'),true));
	}
	
	public function getXMLDeclaration() {
		return pq('xml[encoding]');
	}
	
}

Parser_PHPQuery::init();