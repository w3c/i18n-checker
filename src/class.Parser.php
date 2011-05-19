<?php 
require_once('class.Parser.PHPQuery.php');
require_once('class.Parser.HTML5Lib.php');
require_once('class.Utils.php');

abstract class Parser {
	
	private static $logger;
	private $markup;
	// HTTP Content-Type Header 
	private $contentType;
	// TODO: What if no dtd is declared? What about XHTML5 ?
	private $isHTML;
	private $isHTML5;
	private $isXHTML;
	// DOMDocument
	protected $document;
	// Meta charset tags
	protected $metaCharsetTags;
	protected $charsetsFromHTML;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser');
	}
	
	protected function __construct($markup, $contentType) {
		$this->markup = $markup;
		$this->contentType = $contentType;
	}
	
	public static function getParser($markup, $contentType) {
		if (self::is_HTML5($markup)) {
			self::$logger->debug(sprintf("Creating HTML5 parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			return new ParserHTML5Lib($markup, $contentType);
		} else
			self::$logger->debug(sprintf("Creating (X)HTML parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			return new ParserPHPQuery($markup, $contentType);
	}
	
	private static function is_HTML5($markup) {
		return preg_match("/<!DOCTYPE HTML>/i", substr($markup, '0', Conf::get('perf_head_length'))) == true;
	}
	
	public function isHTML5() {
		if ($this->isHTML5 == null)
			$this->isHTML5 = self::is_HTML5($this->markup);
		return $this->isHTML5;
	}
	
	public function isXHTML() {
		if ($this->isXHTML == null)
			$this->isXHTML = preg_match("/<!DOCTYPE [^>]*DTD XHTML/i", substr($this->markup, '0', Conf::get('perf_head_length'))) == true;
		return $this->isXHTML;
	}
	
	public function isHTML() {
		if ($this->isHTML == null)
			$this->isHTML = preg_match("/<!DOCTYPE [^>]*DTD HTML/i", substr($this->markup, '0', Conf::get('perf_head_length'))) == true;
		return $this->isHTML;
	}
	
	public function mimetypeFromHTTP() {
		$contentType = Utils::contentTypeToArray($this->contentType);
		return $contentType['mimetype'];
	}
	
	public function charsetFromHTTP() {
		$contentType = Utils::contentTypeToArray($this->contentType);
		return $contentType['charset'];
	}
	
	public function charsetFromXML() {
		preg_match('@<'.'?xml[^>]+encoding\\s*=\\s*(["|\'])(.*?)\\1@i', substr($this->markup, '0', Conf::get('perf_head_length')), $matches);
		return isset($matches[2]) ? strtoupper($matches[2]) : null;
	}
	
	public function XMLDeclaration() {
		preg_match('/<\?xml[^>]+encoding\\s*=\\s*(["|\'])[^>]+>/i', substr($this->markup, '0', Conf::get('perf_head_length')), $matches);
		return isset($matches[0]) ? $matches[0] : null;
	}
	
	protected function dump($node){
	    return $this->document->saveXML($node);
	}
	
	// Only dumps the opening tag of $node
	protected function dumpTag($node){
	    preg_match('/^<[^>]+>/i', $this->document->saveXML($node), $matches);
	    return isset($matches[0]) ? $matches[0] : null;
	}
	
	public function charsetsFromHTML() {
		if ($this->charsetsFromHTML == null)
			$this->parseMeta();
		return $this->charsetsFromHTML;
	}
	
	public function metaCharsetTags() {
		if ($this->metaCharsetTags == null)
			$this->parseMeta();
		return $this->metaCharsetTags;
	}
	
	protected function parseMeta() {
		$this->charsetsFromHTML = array();
		$this->metaCharsetTags = array();
		$metas = $this->document->getElementsByTagName("meta");
		foreach ($metas as $meta) {
			if (($charset = $meta->attributes->getNamedItem('charset')) != null) {
				$this->charsetsFromHTML[] = strtoupper($charset->value);
				$this->metaCharsetTags[] = $this->dump($meta);
			}
		}
	}
	
	public function langFromHTML() {
		// Use getNamedItemNS(null,'lang') so that it does not match xml:lang attributes
		$lang = $this->document->getElementsByTagName('html')->item(0)->attributes->getNamedItemNS(null,'lang');
		if ($lang != null)
			return $lang->value;
		return null;
	}
	
	public function xmlLangFromHTML() {
		$lang = $this->document->getElementsByTagName('html')->item(0)->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace','lang');
		if ($lang != null)
			return $lang->value;
		return null;
	}
	
	public function HTMLTag() {
		return $this->dumpTag($this->document->getElementsByTagName('html')->item(0));
	}
}

Parser::init();
