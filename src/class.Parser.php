<?php 
/**
 * Contains and initializes the Parser class.
 * @package w3Checker
 */
/**
 * 
 */
require_once('class.Parser.PHPQuery.php');
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
	
	// DOMDocument
	protected $document;
	// Meta charset tags
	protected $metaCharsets;
	// Meta language tags
	protected $metaLanguages;
	
	public static function _init() {
		self::$logger = Logger::getLogger('Parser');
	}
	
	public static function getParser($markup, $contentType) {
		if (true) { //self::is_HTML5($markup)) {
			self::$logger->debug(sprintf("Creating HTML5 parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			return new ParserHTML5Lib($markup, $contentType);
		} else
			self::$logger->debug(sprintf("Creating (X)HTML parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			return new ParserPHPQuery($markup, $contentType);
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
		if ($this->isServedAsXML && $this->isHTML5)
			$this->isXHTML5 = true;
		$this->charset = Utils::charsetFromContentType($this->contentType);
		$this->parseMeta();
	}
	
	private function findDoctype() {
		if (preg_match("/<!DOCTYPE [^>]*DTD HTML/i", substr($this->markup, '0', Conf::get('perf_head_length')))) {
			$this->isHTML = true;
		} else if (preg_match("/<!DOCTYPE HTML>/i", substr($this->markup, '0', Conf::get('perf_head_length')))) { 
			$this->isHTML5 = true;
		} else if (preg_match("/<!DOCTYPE [^>]*DTD XHTML 1.0[^>]+/i", substr($this->markup, '0', Conf::get('perf_head_length')), $matches)) {
			$this->isXHTML10 = true;
		} else if (preg_match("/<!DOCTYPE [^>]*DTD XHTML 1.1[^>]+/i", substr($this->markup, '0', Conf::get('perf_head_length')), $matches)) {
			$this->isXHTML11 = true;
		} else {
			//TODO Add warning
			$this->isHTML = true;
		}
	}
	
	public function doctype2String() {
		if ($this->isHTML)
			return 'HTML';
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
	
	public function charsetFromXML() {
		preg_match('@<'.'?xml[^>]+encoding\\s*=\\s*(["|\'])(.*?)\\1@i', substr($this->markup, '0', Conf::get('perf_head_length')), $matches);
		return isset($matches[2]) ? $matches[2] : null;
	}
	
	public function XMLDeclaration() {
		preg_match('/<\?xml[^>]+>/i', substr($this->markup, '0', Conf::get('perf_head_length')), $matches);
		return isset($matches[0]) ? $matches[0] : null;
	}
	
	public function dump($node){
	    return $this->document->saveXML($node);
	}
	
	// Only dumps the opening tag of $node
	public function dumpTag($node){
	    preg_match('/^<[^>]+>/i', $this->document->saveXML($node), $matches);
	    return isset($matches[0]) ? $matches[0] : null;
	}
	
	public function charsetsFromHTML() {
		return $this->metaCharsets;
	}
	
	public function langsFromMeta() {
		return $this->metaLanguages;
	}
	
	public function langFromHTML() {
		// Use getNamedItemNS(null,'lang') so that it does not match xml:lang attributes
		$lang = $this->document->getElementsByTagName('html')->item(0)->attributes->getNamedItemNS(null,'lang');
		return ($lang != null) ? $lang->value : null;
	}
	
	public function xmlLangFromHTML() {
		$lang = $this->document->getElementsByTagName('html')->item(0)->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace','lang');
		return ($lang != null) ? $lang->value : null;
	}
	
	public function HTMLTag() {
		return $this->dumpTag($this->document->getElementsByTagName('html')->item(0));
	}
	
	public function dirFromHTML() {
		$dir = $this->document->getElementsByTagName('html')->item(0)->attributes->getNamedItem('dir');
		return ($dir != null) ? strtoupper($dir->value) : null;
	}
	
	// XXX: if phpQuery::loadDocument was implemented could be refactored in Parser. eg:
	// phpQuery::loadDocument($this->document);
	// pq('meta[http-equiv=content-language]');
	protected function parseMeta() {
		$this->metaCharsets = array();
		$this->metaLanguages = array();
		
		$metas = $this->document->getElementsByTagName("meta");
		foreach ($metas as $meta) {
			// check for charset attribute
			if (($charset = $meta->attributes->getNamedItem('charset')) != null) {
				$this->metaCharsets[] = array ( 
					'code'   => $this->dump($meta),
					'values' => $charset->value
				);
			// check for http-equiv="content-language" (deprecated in HTML5)
			// TODO: Add a warning if <meta http-equiv="content-language" content="en"> is used in HTML5?
			// FIXME: case sensitity of getNamedItem
			} else if (($equivParam = $meta->attributes->getNamedItem('http-equiv')) != null) {
				if (strcasecmp($equivParam->value, 'Content-Language') == 0) {
					//if (($contentParam = $meta->attributes->getNamedItem('content')) != null)
					//	$this->langsFromMeta = Utils::arrayMergeCommaString($this->langsFromMeta, $contentParam->value);
					//$this->metaLanguageTags[] = $this->dump($meta);
					$this->metaLanguages[] = array ( 
						'code'   => $this->dump($meta),
						'values' => ($contentParam = $meta->attributes->getNamedItem('content')) == null ? null : Utils::getValuesFromCSString($contentParam->value)
					);
				} elseif (strcasecmp($equivParam->value, 'Content-Type') == 0) {
					//if (($contentParam = $meta->attributes->getNamedItem('content')) != null)
					//	$this->charsetsFromHTML[] = Utils::charsetFromContentType($contentParam->value);
					//$this->metaCharsetTags[] = $this->dump($meta);
					
					$this->metaCharsets[] = array ( 
						'code'   => $this->dump($meta),
						'values' => ($contentParam = $meta->attributes->getNamedItem('content')) == null ? null : Utils::charsetFromContentType($contentParam->value)
					);
				}
			}
		}
	}
	
	public function getNodesWithClass() {
		return $this->getNodesWithAttr('class');
	}
	
	public function getNodesWithId() {
		return $this->getNodesWithAttr('id');
	}
	
	public function getNodesWithAttr($attr, $xmlNamespace = false) {
		$t = &$this;
		$test = function($node) use (&$result, $t, $attr, $xmlNamespace) {
			if ($node->hasAttributes()) {
				/*echo $t->dumpTag($node)."\n";
				if ($node->attributes->getNamedItemNS(null, 'lang'))
					echo "lang: ".$node->attributes->getNamedItemNS(null,'lang')->value." - ".$node->attributes->getNamedItemNS(null,'lang')->namespaceURI."\n";
				if ($node->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace', 'lang'))
					echo "xml:lang: ".$node->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace', 'lang')->value." - ".$node->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace','lang')->namespaceURI."\n";
				foreach ($node->attributes as $n) {
					echo "attribute: ".$n->name."|".$n->value."\n";
					//echo "schema: ".$n->schemaTypeInfo."\n";
					//echo "speci: ".$n->specified."\n";
					//echo "val: ".$n->value."\n";
					//if ($node->attributes->getNamedItem('lang'))
					//	echo "getNamedItem ".$node->attributes->getNamedItem('lang')->value."\n";

				}*/
				$a = !$xmlNamespace ? $node->attributes->getNamedItemNS(null, $attr) : $node->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace', $attr);
				if ($a != null) {
					//print_r(Utils::boolString($xmlNamespace)." - ".$t->dumpTag($node)." - ".$node->attributes->getNamedItem($attr)->namespaceURI."\n");
					//print_r($node->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace', $attr)->namespaceURI);
					//if ($xmlNamespace && $a->namespaceURI != 'http://www.w3.org/XML/1998/namespace')
					//	return;
					//if (!$xmlNamespace && $a->namespaceURI != '')
					//	return;
					$result[] = array(
						'code' => $t->dumpTag($node),
						'values' => count(($p = array_values(array_filter(Utils::arrayTrim(preg_split('/[ ]+/', $a->value)))))) == 1 ? $p[0] : $p // array_filter(Utils::arrayTrim(preg_split('/[ ]+/', $a->value))) // array_filter with no callback parameter will remove empty elements
					);
					/*$result[] = array(
						'code' => $t->dumpTag($node),
						'values' => !$xmlMode ? 
								Utils::arrayTrim(preg_split('/[ ]+/', $node->attributes->getNamedItem($attr)->value)) :
								Utils::arrayTrim(preg_split('/[ ]+/', $node->attributes->getNamedItemNS('http://www.w3.org/XML/1998/namespace',$attr)->value))
					);*/
					//$result[$t->dumpTag($node)] = Utils::arrayTrim(preg_split('/[ ]+/', $node->attributes->getNamedItem($attr)->value));
				}
			}
		};
		$html = $this->document->getElementsByTagName('html')->item(0);
		$this->iterate($test, $html);
		return $result;
	} 
	
	public function getElementsByTagName($tagName) {
		return $this->document->getElementsByTagName($tagName);
	}
	
	protected function iterate($callback, $node) {
		foreach ($node->childNodes as $child) {
			$callback($child);
			if ($child->hasChildNodes())
				$this->iterate($callback, $child);
		}
	}
}

Parser::_init();
