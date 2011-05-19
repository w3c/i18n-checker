<?php 
require_once('class.Parser_PHPQuery.php');
require_once('class.Parser_HTML5Lib.php');

abstract class Parser {
	
	private $markup;
	
	protected function __construct() {
		
	}
	
	//public abstract function getXMLDeclaration();
	
	public static function getParser($markup) {
		if (self::isHTML5($markup)) {
			return new Parser_HTML5Lib($markup);
		} else
			return new Parser_PHPQuery($markup);
	}
	
	private static function isHTML5($markup) {
		return preg_match("/^<!DOCTYPE HTML>/i", $markup) === false;
	}
	public function charsetFromHTML() {
		$contentType = $this->contentTypeFromHTML($this->markup);
		return $contentType[1];
	}
	public function charsetFromXML() {
		preg_match('@<'.'?xml[^>]+encoding\\s*=\\s*(["|\'])(.*?)\\1@i', $this->markup, $matches);
		return isset($matches[2]) ? strtolower($matches[2]) : null;
	}
	
	protected function contentTypeFromHTML() {
		$matches;
		// find meta tag
		preg_match('@<meta[^>]+http-equiv\\s*=\\s*(["|\'])Content-Type\\1([^>]+?)>@i', $this->markup, $matches);
		if (! isset($matches[0]))
			return array(null, null);
		// get attr 'content'
		preg_match('@content\\s*=\\s*(["|\'])(.+?)\\1@', $matches[0], $matches);
		if (! isset($matches[0]))
			return array(null, null);
		return $this->contentTypeToArray($matches[2]);
	}
	
	protected function contentTypeToArray($contentType) {
		$matches = explode(';', trim(strtolower($contentType)));
		if (isset($matches[1])) {
			$matches[1] = explode('=', $matches[1]);
			// strip 'charset='
			$matches[1] = isset($matches[1][1]) && trim($matches[1][1])
				? $matches[1][1]
				: $matches[1][0];
		} else
			$matches[1] = null;
		return $matches;
	}
	
}
