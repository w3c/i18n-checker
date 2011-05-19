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
	
	protected function parseMeta() {
		$this->charsetsFromHTML = array();
		$this->metaCharsetTags = array();
		$this->langsFromMeta = array();
		$this->metaLanguageTags = array();
		
		// XXX: attributes values in selectors are case sensitive!
		// ---- Solution1: 
		// pq('meta[http-equiv]')->each(array($this, 'publicCallbackFunction'));
		// pq('meta[http-equiv]')->each(array($this, 'publicCallbackFunction'));
		
		// ---- Solution2: Requires PHP5.3 closures.
		/*$doc = &$this->document;
		$tags = &$this->metaCharsetTags;
		$charsets = &$this->charsetsFromHTML;
		$charsetCallback = function ($node) use (&$tags, &$charsets, &$doc) {
				$contentType = Utils::contentTypeToArray(pq($node)->attr('content'));
				$charsets[] = strtoupper($contentType['charset']);
				$tags[] = $doc->saveXML($node);
			};
		pq('meta[http-equiv=Content-Type]')->each($charsetCallback);
		pq('meta[http-equiv=content-type]')->each($charsetCallback);
		$tags = &$this->$metaLanguageTags;
		$langs = &$this->langsFromMeta;
		$langCallback = function ($node) use (&$tags, &$langs, &$doc) {
				$langs[] = pq($node)->attr('content');
				$tags[] = $doc->saveXML($node);
			};
		pq('meta[http-equiv="Content-Language"]')->each($langCallback);
		pq('meta[http-equiv="content-language"]')->each($langCallback);*/
		
		// ---- Solution3: fixes the case sensitivity issue on Content-Type
		// FIXME: case sensitivity on http-equiv
		// TODO: Content-Language value should be split on ',' and not used as-is
		foreach (pq('meta[http-equiv]') as $meta) {
			if (strcasecmp(pq($meta)->attr('http-equiv'), 'Content-Type') == 0) {
				$contentType = Utils::contentTypeToArray(pq($meta)->attr('content'));
				$this->charsetsFromHTML[] = strtoupper($contentType['charset']);
				$this->metaCharsetTags[] = $this->dump($meta);
			}
			else if (strcasecmp(pq($meta)->attr('http-equiv'), 'Content-Language') == 0) {
				$this->langsFromMeta[] = pq($meta)->attr('content');
				$this->metaLanguageTags[] = $this->dump($meta);
			}
		}
	}
	
}

ParserPHPQuery::init();