<?php 
/**
 * Contains and initializes the Parser class.
 * @package w3Checker
 */
/**
 * 
 */
require_once('class.Parser.HTML5Lib.php');
require_once('class.Utils.php');
/**
 * Parser class
 * 
 * @todo review
 * @package w3Checker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
abstract class Parser {
	
	private static $logger;
	
	public $markup;
	public $contentType;
	public $mimetype;
	public $charset;
	public $isHTML = false;
	public $isHTML5 = false;
	public $isXHTML10 = false;
	public $isXHTML11 = false;
	// = isXHTML10 || isXHTML11 
	public $isXHTML1x = false;
	// = isHTML5 && isServedAsXML
	public $isXHTML5 = false;
	// = isXHTML10 || isXHTML11 || isXHTML5
	public $isXML = false;
	public $isServedAsXML = false;
	// DOMDocument object
	public $document;
	// Store of cached results of certain functions
	private $cache;
	
	public static function _init() {
		self::$logger = Logger::getLogger('Parser');
	}
	
	public static function getParser($markup, $contentType) {
		//if (true) { //self::is_HTML5($markup)) {
			self::$logger->debug(sprintf("Creating HTML5 parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			//return new ParserDOM($markup, $contentType);
			return new ParserHTML5Lib($markup, $contentType);
		//}
			//self::$logger->debug(sprintf("Creating (X)HTML parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			//return new ParserPHPQuery($markup, $contentType);
	}
	
	protected function __construct($markup, $contentType) {
		$this->markup = $markup;
		$this->findDoctype();
		$this->isXHTML1x = $this->isXHTML10 || $this->isXHTML11;
		// Auto determination of the mimetype based on the doctype if $contentType is null
		if ($contentType == null) {
			if ($this->isHTML || $this->isHTML5 || $this->isXHTML10) {
				$this->contentType = "text/html; charset=utf-8";
			} else {
				$this->contentType = "application/xhtml+xml; charset=utf-8";
				$this->isServedAsXML = true;
			}
		} else {
			$this->contentType = $contentType;
		}
		$this->mimetype = Utils::mimeFromContentType($this->contentType);
		if ($this->mimetype == 'application/xhtml+xml')
			$this->isServedAsXML = true;
		if ($this->isServedAsXML && $this->isHTML5) {
			$this->isXHTML5 = true;
			$this->isHTML5 = false;
		}
		$this->charset = Utils::charsetFromContentType($this->contentType);
	}
	
	protected function findDoctype() {
		if (preg_match("/<!DOCTYPE [^>]*DTD HTML/i", substr($this->markup, '0', Conf::get('perf_head_length')))) {
			$this->isHTML = true;
		} else if (preg_match("/<!DOCTYPE HTML>/i", substr($this->markup, '0', Conf::get('perf_head_length')))) { 
			$this->isHTML5 = true;
		} else if (preg_match("/<!DOCTYPE [^>]*DTD XHTML(\+[^ ]+)? 1.0[^>]+/i", substr($this->markup, '0', Conf::get('perf_head_length')), $matches)) {
			$this->isXHTML10 = true;
		} else if (preg_match("/<!DOCTYPE [^>]*DTD XHTML(\+[^ ]+)? 1.1[^>]+/i", substr($this->markup, '0', Conf::get('perf_head_length')), $matches)) {
			$this->isXHTML11 = true;
		} else {
			//TODO Add warning
			$this->isHTML = true;
		}
	}
	
	public function doctype2String() {
		if ($this->isHTML)
			return 'HTML 4.01';
		if ($this->isXHTML10)
			return 'XHTML 1.0';
		if ($this->isXHTML11)
			return 'XHTML 1.1';
		if ($this->isXHTML5)
			return 'XHTML 5';
		if ($this->isHTML5)
			return 'HTML5';
		self::$logger->error("No doctype has been defined. This shouldn't happen.");
		return "N/A";
	}
	
	public function HTMLTag() {
		return $this->dumpTag($this->document->getElementsByTagName('html')->item(0));
	}
	
	public function XMLDeclaration() {
		preg_match('/<\?xml[^>]+>/i', substr($this->markup, '0', Conf::get('perf_head_length')), $matches);
		return isset($matches[0]) ? $matches[0] : null;
	}
	
	public function getHTMLTagAttr($name, $xmlNamespace = false) {
		//if ($this->document->getElementsByTagName('html')->item(0) == null)
		//	return null;
		$htmlAttrs = $this->document->getElementsByTagName('html')->item(0)->attributes;//$this->document->documentElement->attributes;
		if ($htmlAttrs == null)
			return null;
		if ($xmlNamespace)
			$attr = $htmlAttrs->getNamedItemNS('http://www.w3.org/XML/1998/namespace', $name);
		else
			$attr = $htmlAttrs->getNamedItemNS(null, $name);
		return ($attr != null) ? $attr->value : null;
	}
	
	// does not return null! should check if empty and not if null
	public function getMetaWithAttr($name) {
		$metas = $this->document->getElementsByTagName("meta");
		// FIXME: case sensitive. Should iterate over attributes and do strcasecmp.
		foreach ($metas as $meta) {
			if (($charset = $meta->attributes->getNamedItem($name)) != null) {
				$result[] = array ( 
					'code'   => $this->dump($meta),
					'values' => $charset->value
				);
			}
		}
		return isset($result) ? $result : array();
	}
	
	// does not return null! should check if empty and not if null
	public function getHTTPEquivMeta($name, $codeFunction = null) {
		$metas = $this->document->getElementsByTagName("meta");
		foreach ($metas as $meta) {
			if (($equivParam = $meta->attributes->getNamedItem('http-equiv')) != null) {
				if (strcasecmp($equivParam->value, $name) == 0) {
					$_code = $this->dump($meta);
					if (($contentParam = $meta->attributes->getNamedItem('content')) == null)
						$_values = null;
					else
						$_values = $codeFunction == null ? $contentParam->value : call_user_func($codeFunction, $contentParam->value);
					$result[] = array ( 
							'code'   => $_code,
							'values' => $_values
						);
				}
			}
		}
		return isset($result) ? $result : array();
	}
	
	public function getMetaCharset() {
		return $this->getMetaWithAttr('charset');
	}
	
	public function getMetaContentType() {
		return $this->getHTTPEquivMeta('Content-Type', 'Utils::charsetFromContentType');
	}
	
	public function getMetaContentLanguage() {
		return $this->getHTTPEquivMeta('Content-Language', 'Utils::getValuesFromCSString');
	}
	
	public function getNodesWithAttr($attr, $xmlNamespace = false) {
		$t = &$this;
		$test = function($node) use (&$result, $t, $attr, $xmlNamespace) {
			if ($node != null && $node->hasAttributes()) {
				$a = !$xmlNamespace ? $node->attributes->getNamedItemNS(null, $attr) : $node->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace', $attr);
				if ($a != null) {
					$result[] = array(
						'code' => $t->dumpTag($node),
						'values' => count(($p = array_values(array_filter(Utils::arrayTrim(preg_split('/[ ]+/', $a->value)))))) == 1 ? $p[0] : $p // array_filter with no callback parameter will remove empty elements
					);
				}
			}
		};
		$html = $this->document->getElementsByTagName('html')->item(0);
		$this->iterate($test, $html, true);
		return $result;
	} 
	
	public function getElementsByTagName($tagName) {
		return $this->document->getElementsByTagName($tagName);
	}
	
	public function dump($node){
	    return $this->document->saveXML($node);
	}
	
	// Only dumps the opening tag of $node
	public function dumpTag($node){
	    preg_match('/^<[^>]+>/i', $this->document->saveXML($node), $matches);
	    return isset($matches[0]) ? $matches[0] : null;
	}
	
	protected function iterate($callback, $node, $includeParentNode = false) {
		if ($includeParentNode)
			$callback($node);
		if ($node == null)
			return;
		foreach ($node->childNodes as $child) {
			$callback($child);
			if ($child->hasChildNodes())
				$this->iterate($callback, $child);
		}
	}
}

Parser::_init();
