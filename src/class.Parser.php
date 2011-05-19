<?php 
require_once('class.Parser.PHPQuery.php');
require_once('class.Parser.HTML5Lib.php');
require_once('class.Utils.php');

abstract class Parser {
	
	private static $logger;
	private $markup;
	// HTTP Content-Type Header 
	private $contentType;
	private $isHTML;
	private $isHTML5;
	private $isXHTML;
	
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
		return preg_match("/<!DOCTYPE HTML>/i", $markup) == true;
	}
	
	public function isHTML5() {
		if ($this->isHTML5 == null) {
			$this->isHTML = false;
			$this->isXHTML = false;
			$this->isHTML5 = self::is_HTML5($this->markup);
		}
		return $this->isHTML5;
	}
	
	public function isXHTML() {
		if ($this->isXHTML == null) {
			$this->isHTML = false;
			$this->isHTML5 = false;
			$this->isXHTML = preg_match("/<!DOCTYPE [^>]*DTD XHTML/i", $this->markup) == true;
		}
		return $this->isXHTML;
	}
	
	public function isHTML() {
		if ($this->isHTML == null) {
			$this->isXHTML = false;
			$this->isHTML5 = false;
			$this->isHTML = preg_match("/<!DOCTYPE [^>]*DTD HTML/i", $this->markup) == true;
		}
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
		preg_match('@<'.'?xml[^>]+encoding\\s*=\\s*(["|\'])(.*?)\\1@i', $this->markup, $matches);
		return isset($matches[2]) ? strtolower($matches[2]) : null;
	}
	
	public function XMLDeclaration() {
		preg_match('/<\?xml[^>]+encoding\\s*=\\s*(["|\'])[^>]+>/i', $this->markup, $matches);
		return $matches[0];
	}
	
	public abstract function charsetsFromHTML();
	
	public abstract function metaCharsetTags();
	
	/*public function charsetFromHTML() {
		$contentType = $this->contentTypeFromHTML($this->markup);
		return $contentType['charset'];
	}*/
	
	/*protected function contentTypeFromHTML() {
		$matches;
		// find meta tag
		preg_match('@<meta[^>]+http-equiv\\s*=\\s*(["|\'])Content-Type\\1([^>]+?)>@i', $this->markup, $matches);
		if (! isset($matches[0]))
			return array(null, null);
		// get attr 'content'
		preg_match('@content\\s*=\\s*(["|\'])(.+?)\\1@', $matches[0], $matches);
		if (! isset($matches[0]))
			return array(null, null);
		return Utils::contentTypeToArray($matches[2]);
	}*/
	
}

Parser::init();
