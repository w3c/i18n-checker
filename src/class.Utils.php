<?php 

class Utils {
	
	private function __construct() {}
	
	public static function contentTypeToArray($contentType) {
		if ($contentType == null)
			return array ('mimetype' => null, 'charset' => null);
		$matches = explode(';', trim(strtolower($contentType)));
		if (isset($matches[1])) {
			$matches[1] = explode('=', $matches[1]);
			// strip 'charset='
			$matches[1] = isset($matches[1][1]) && trim($matches[1][1])
				? $matches[1][1]
				: $matches[1][0];
		} else
			$matches[1] = null;
		//return $matches;
		return array ('mimetype' => $matches[0], 'charset' => strtoupper($matches[1]));
	}
	
	public static function charsetFromContentType($contentType) {
		$ct = Utils::contentTypeToArray($contentType);
		return $ct['charset'];
	}
	
	public static function mimeFromContentType($contentType) {
		$ct = Utils::contentTypeToArray($contentType);
		return $ct['mimetype'];
	}
	
	// Adds the values contained in the comma-separated list $string (typically a list of languages) to $array
	public static function arrayMergeCommaString($array, $string) {
		return array_merge($array, array_map('trim', preg_split('/,/', $string)));
	}
	
	public static function arrayTrim($array) {
		return array_map('trim', $string);
	}
	
	public static function boolString($bValue = false) {
		return ($bValue ? 'true' : 'false');
	}
	
}