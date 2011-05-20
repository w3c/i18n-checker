<?php
require_once('lib/html5lib/Parser.php');

final class ParserHTML5Lib extends Parser {
	
	private static $logger;
	
	public static function init() {
		self::$logger = Logger::getLogger('Parser.PHPQuery');
	}
	
	protected function __construct($markup, $contentType) {
		$this->document = HTML5_Parser::parse($markup);
		parent::__construct($markup, $contentType);
	}
	
	// XXX: if phpQuery::loadDocument was implemented could be refactored in Parser. eg:
	// phpQuery::loadDocument($this->document);
	// pq('meta[http-equiv=content-language]');
	protected function parseMeta() {
		$this->charsetsFromHTML = array();
		$this->metaCharsetTags = array();
		$this->langsFromMeta = array();
		$this->metaLanguageTags = array();
		$metas = $this->document->getElementsByTagName("meta");
		foreach ($metas as $meta) {
			// check for charset attribute
			if (($charset = $meta->attributes->getNamedItem('charset')) != null) {
				$this->charsetsFromHTML[] = strtoupper($charset->value);
				$this->metaCharsetTags[] = $this->dump($meta);
			// check for http-equiv="content-language" (deprecated in HTML5)
			// TODO: Add a warning if <meta http-equiv="content-language" content="en"> is used in HTML5?
			// TODO: Content-Language value should be split on ',' and not used as-is
			// FIXME: case sensitity of getNamedItem
			} else if (($equivParam = $meta->attributes->getNamedItem('http-equiv')) != null) {
				if (strcasecmp($equivParam->value, 'Content-Language') == 0) {
					if (($contentParam = $meta->attributes->getNamedItem('content')) != null)
						$this->langsFromMeta[] = $contentParam->value;
					$this->metaLanguageTags[] = $this->dump($meta);
				} elseif (strcasecmp($equivParam->value, 'Content-Type') == 0) {
					if (($contentParam = $meta->attributes->getNamedItem('content')) != null)
						$this->charsetsFromHTML[] = Utils::charsetFromContentType($contentParam->value);
					$this->metaCharsetTags[] = $this->dump($meta);
				}
			}
		}
	}
}

ParserHTML5Lib::init();