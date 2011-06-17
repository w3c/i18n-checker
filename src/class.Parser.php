<?php 
require_once('class.Parser.PHPQuery.php');
require_once('class.Parser.HTML5Lib.php');
require_once('class.Utils.php');

abstract class Parser {
	
	private static $logger;
	protected $markup;
	// HTTP Content-Type Header 
	protected $contentType;
	// TODO: What if no dtd is declared?
	protected $isHTML;
	protected $isHTML5;
	protected $isXHTML;
	protected $isXHTML5;
	public $doctype; 
	// DOMDocument
	protected $document;
	// Meta charset tags
	protected $metaCharsets; // Change in one array($code => array(values))
	//protected $charsetsFromHTML;
	// Meta language tags
	protected $metaLanguages;
	//protected $langsFromMeta;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser');
	}
	
	protected function __construct($markup, $contentType) {
		$this->markup = $markup;
		$this->contentType = $contentType;
		$this->findDoctype();
		$this->parseMeta();
	}
	
	public static function getParser($markup, $contentType) {
		if (true) { //self::is_HTML5($markup)) {
			self::$logger->debug(sprintf("Creating HTML5 parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			return new ParserHTML5Lib($markup, $contentType);
		} else
			self::$logger->debug(sprintf("Creating (X)HTML parser. Content-type is: %s", $contentType == null ? 'null' : $contentType));
			return new ParserPHPQuery($markup, $contentType);
	}
	
	private static function is_HTML5($markup) {
		return preg_match("/<!DOCTYPE HTML>/i", substr($markup, '0', Conf::get('perf_head_length'))) == true;
	}
	
	// FIXME: This has been refactored quickly and is not very nice
	public function findDoctype() {
			if (preg_match("/<!DOCTYPE [^>]*DTD HTML/i", substr($this->markup, '0', Conf::get('perf_head_length')))) {
				$this->isHTML = true;
				$this->doctype = "HTML";
				$this->isHTML5 = false;
				$this->isXHTML = false;
				$this->isXHTML5 = false;
				return;
			}
			if (self::is_HTML5($this->markup)) { 
				$this->doctype = "HTML5";
				$this->isHTML5 = true;
				$this->isHTML = false;
				$this->isXHTML = false;
				if (Utils::mimeFromContentType($this->contentType) == "application/xhtml+xml") {
			 		$this->doctype = "XHTML5";
			 		$this->isXHTML5 = true;
			 	} else {
			 		$this->isXHTML5 = false;
			 	}
			 	return;
			}
			 
			if (preg_match("/<!DOCTYPE [^>]*DTD XHTML[^>]+/i", substr($this->markup, '0', Conf::get('perf_head_length')), $matches)) {
				$this->isXHTML = true;
				$this->doctype = "XHTML";
				self::$logger->error($matches[0]);
				if (preg_match('/1\.0/', $matches[0]))
					$this->doctype = "XHTML 1.0";
				if (preg_match('/1\.1/', $matches[0]))
					$this->doctype = "XHTML 1.1";
				$this->isHTML = false;
				$this->isHTML5 = false;
				$this->isXHTML5 = false;
				return;
			}
	}
	
	public function isHTML() {
		if ($this->isHTML == null) {
			/*if ($this->isHTML = preg_match("/<!DOCTYPE [^>]*DTD HTML/i", substr($this->markup, '0', Conf::get('perf_head_length'))) == true) {
				$doctype = "HTML";
				$this->isHTML5 = false;
				$this->isXHTML5 = false;
				$this->isXHTML = false;
			}*/
			$this->findDoctype();
		}
		return $this->isHTML;
	}
	
	public function isHTML5() {
		if ($this->isHTML5 == null) {
			//$this->isHTML5 = self::is_HTML5($this->markup);
			// If HTML5 DTD then it can't be HTML or XHTML but still can be XHTML5 (in which case both isHTML5 and isXHTML5 return true) 
			/*if ($this->isHTML5 = self::is_HTML5($this->markup)) { 
				$doctype = "HTML5";
				$this->isHTML = false;
				$this->isXHTML = false;
				
			}*/
			$this->findDoctype();
		}
		return $this->isHTML5;
	}
	
	public function isXHTML() {
		if ($this->isXHTML == null) {
			/*if ($this->isXHTML = preg_match("/<!DOCTYPE [^>]*DTD XHTML/i", substr($this->markup, '0', Conf::get('perf_head_length')), $matches) == true) {
				$doctype = "XHTML";
				if (preg_match('/1\.0/', $matches[0]))
					$doctype = "XHTML 1.0";
				if (preg_match('/1\.1/', $matches[0]))
					$doctype = "XHTML 1.1";
				$this->isHTML = false;
				$this->isHTML5 = false;
				$this->isXHTML5 = false;
			}*/
			$this->findDoctype();
		}
		return $this->isXHTML;
	}
	
	public function isXHTML5() {
		if ($this->isXHTML5 == null) {
		 	/*if ($this->isHTML5() && Utils::mimeFromContentType($this->contentType) == "application/xhtml+xml") {
		 		$doctype = "XHTML5";
		 		$this->isXHTML5 = true;
				$this->isHTML = false;
				$this->isXHTML = false;
		 	} else {
		 		$this->isXHTML5 = false;
		 	}*/
			$this->findDoctype();
		}
		return $this->isXHTML5;
	}
	
	public function isXML() {
		return $this->isXHTML() || $this->isXHTML5();
	}
	
	public function mimetypeFromHTTP() {
		return ($mime = Utils::mimeFromContentType($this->contentType)) ? $mime : 'N/A';
	}
	
	public function charsetFromHTTP() {
		return Utils::charsetFromContentType($this->contentType);
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
		//if ($this->metaCharsets == null)
		//	$this->parseMeta();
		return $this->metaCharsets;
	}
	
	/*public function charsetsFromHTML() {
		if ($this->charsetsFromHTML == null)
			$this->parseMeta();
		return array_unique((array) $this->charsetsFromHTML);
	}
	
	public function metaCharsetTags() {
		if ($this->metaCharsetTags == null)
			$this->parseMeta();
		return $this->metaCharsetTags;
	}*/
	
	//protected abstract function parseMeta();
	
	//public abstract function getNodesWithAttr($attr);
	
	public function langsFromMeta() {
		//if ($this->metaLanguages == null)
		//	$this->parseMeta();
		return $this->metaLanguages;
	}
	
	/*public function metaLangTags() {
		if ($this->metaLanguageTags == null)
			$this->parseMeta();
		return $this->metaLanguageTags;
	}*/
	
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
	
	//public abstract function getNodesWithClass();
	
	//public abstract function getNodesWithId();
	
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
						'values' => count(($p = array_filter(Utils::arrayTrim(preg_split('/[ ]+/', $a->value))))) == 1 ? $p[0] : $p // array_filter(Utils::arrayTrim(preg_split('/[ ]+/', $a->value))) // array_filter with no callback parameter will remove empty elements
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

Parser::init();
