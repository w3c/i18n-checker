<?php

class ParserHTML5Lib extends Parser {
	
	protected function __construct($markup, $contentType) {
		parent::__construct($markup, $contentType);
	}
	
	public function charsetsFromHTML() {
		return null;
	}
	
	public function metaCharsetTags() {
		return null;
	}
	
	
}