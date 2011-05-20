<?php
require_once('lib/phpQuery.php');

final class ParserPHPQuery extends Parser {
	
	private static $logger;
	private $doc;
	private $forcedHTML = false;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.PHPQuery');
	}
	
	protected function __construct($markup, $contentType) {
		//phpQuery::$debug = 2;
		//phpQuery::$defaultCharset = "utf-8";
		try {
			$this->doc = phpQuery::newDocument($markup);
			if ($this->doc->isHTML())
				self::$logger->debug("Successfully parsed document as HTML.");
			if ($this->doc->isXHTML())
				self::$logger->debug("Successfully parsed document as XHTML.");
		} catch (Exception $e) {
			// force HTML parsing, phpQuery parser seem to choke easily on malformed XHTML code
			self::$logger->debug("Document parsing failed. Forcing HTML mode.");
			$this->doc = phpQuery::newDocumentHTML($markup);
			$this->forcedHTML = true;
			self::$logger->debug("Successfully parsed document as HTML.");
		}
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
		// pq('meta[http-equiv=content-type]')->each(array($this, 'publicCallbackFunction'));
		// pq('meta[http-equiv=Content-Type]')->each(array($this, 'publicCallbackFunction'));
		
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
		$tags = &$this->metaLanguageTags;
		$langs = &$this->langsFromMeta;
		$langCallback = function ($node) use (&$tags, &$langs, &$doc) {
				$langs[] = pq($node)->attr('content');
				$tags[] = $doc->saveXML($node);
			};
		pq('meta[http-equiv="Content-Language"]')->each($langCallback);
		pq('meta[http-equiv="content-language"]')->each($langCallback);*/
		
		// ---- Solution3: fixes the case sensitivity issue on Content-Type
		// FIXME: case sensitivity on http-equiv
		foreach (pq('meta[http-equiv]') as $meta) {
			if (strcasecmp(pq($meta)->attr('http-equiv'), 'Content-Type') == 0) {
				$this->charsetsFromHTML[] = Utils::charsetFromContentType(pq($meta)->attr('content'));
				$this->metaCharsetTags[] = $this->dump($meta);
			}
			else if (strcasecmp(pq($meta)->attr('http-equiv'), 'Content-Language') == 0) {
				$this->langsFromMeta = Utils::arrayMergeCommaString($this->langsFromMeta, pq($meta)->attr('content'));
				$this->metaLanguageTags[] = $this->dump($meta);
			}
		}
	}
	
	// @Override: if document is parsed as HTML getNamedItemNS('...XML/1998/namespace','lang') fails
	public function xmlLangFromHTML() {
		if (!$this->doc->isHTML())
			return parent::xmlLangFromHTML();
		preg_match('/xml:lang=[\'"]?([^\s>\'"]+)/i', $this->HTMLTag(), $matches);
		return isset($matches[1]) ? $matches[1] : null;
	}
	
	// @Override: if document is parsed as HTML phpQuery isn't reliable to dump accurate html tag 
	public function HTMLTag() {
		if (!$this->doc->isHTML())
			return parent::HTMLTag();
		preg_match('/<html[^>]+>/i', substr($this->markup, '0', Conf::get('perf_head_length')), $matches);
		return isset($matches[0]) ? $matches[0] : '<html>';
	}
	
}

ParserPHPQuery::init();