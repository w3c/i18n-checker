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
		$this->metaCharsets = array();
		$this->metaLanguages = array();
		
		// PhpQuery adds the content-type meta tag if not originally present, which is an issue.
		// Workaround is to first detect if there is one present using a regex. This will give false results if the tag is commented however.
		$noContentTypeMeta = preg_match('/<meta http-equiv="?content-type"?/i', $this->markup) ? false : true;
		
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
		//foreach (pq('meta[http-equiv]') as $meta) {
		foreach (pq('meta') as $meta) {
			if (strcasecmp(pq($meta)->attr('http-equiv'), 'Content-Type') == 0 && !$noContentTypeMeta) {
				//$this->charsetsFromHTML[] = Utils::charsetFromContentType(pq($meta)->attr('content'));
				//$this->metaCharsetTags[] = $this->dump($meta);
				$this->metaCharsets[] = array ( 
					'code'   => $this->dump($meta),
					'values' => Utils::charsetFromContentType(pq($meta)->attr('content'))
				);
			} else if (strcasecmp(pq($meta)->attr('http-equiv'), 'Content-Language') == 0) {
				//$this->langsFromMeta = Utils::arrayMergeCommaString($this->langsFromMeta, pq($meta)->attr('content'));
				//$this->metaLanguageTags[] = $this->dump($meta);
				$this->metaLanguages[] = array ( 
					'code'   => $this->dump($meta),
					'values' => Utils::getValuesFromCSString(pq($meta)->attr('content'))
				);
			} else if (pq($meta)->attr('charset') != null) {
				//$this->langsFromMeta = Utils::arrayMergeCommaString($this->langsFromMeta, pq($meta)->attr('content'));
				//$this->metaLanguageTags[] = $this->dump($meta);
				$this->metaCharsets[] = array ( 
					'code'   => $this->dump($meta),
					'values' => Utils::getValuesFromCSString(pq($meta)->attr('charset'))
				);
			}
		}
		//self::$logger->error(print_r($this->metaCharsets, true));
		//self::$logger->error(print_r($this->metaLanguages, true));
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
	
	public function getNodesWithClass() {
		return $this->getNodesWithAttr('class');
	}
	
	public function getNodesWithId() {
		return $this->getNodesWithAttr('id');
	}
	
	// Example: 
	// FIXME
	// getNodesWithAttr('class') = array(
	//     '<div class="கோ">' => array('கோ'),
	//     '<div class="test cằn">' => array('test', 'cằn'),
	//     '<div class="c1 c2">' => array('c1', 'c2')
	// );
	// FIXME xmlAttr
	/*public function getNodesWithAttr($attr, $xmlAttr = false) {
		$result = array();
		foreach (pq('*['.$attr.']') as $node)
			//$result[$this->dumpTag($node)] = Utils::arrayTrim(preg_split('/[ ]+/', pq($node)->attr($attr)));
			$result[] = array(
				'code' => $this->dumpTag($node),
				'values' => count(($p = array_filter(Utils::arrayTrim(preg_split('/[ ]+/', pq($node)->attr($attr)))))) == 1 ? $p[0] : $p // Utils::arrayTrim(preg_split('/[ ]+/', pq($node)->attr($attr)))
			);
		//self::$logger->error(print_r($result, true));
		return $result;
	} */
}

ParserPHPQuery::init();