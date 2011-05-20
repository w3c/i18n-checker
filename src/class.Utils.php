<?php 

class Utils {
	
	private function __construct() {}
	
	public static function contentTypeToArray($contentType) {
		if ($contentType == null)
			return array ('mimetype' => null, 'charset' => null);
		$matches = explode(';', trim(strtolower($contentType)));
		if (isset($matches[1])) {
			$matches[1] = explode('=', $matches[1]);
			$matches[1] = isset($matches[1][1]) && trim($matches[1][1])
				? $matches[1][1]
				: $matches[1][0];
		} else
			$matches[1] = null;
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
	public static function arrayMergeCommaString(array $array = null, $string) {
		return array_merge((array) $array, array_map('trim', preg_split('/,/', $string)));
	}
	
	public static function arrayTrim(array $array) {
		return array_map('trim', $array);
	}
	
	public static function arrayFlatten(array $array, $nbPass = 1) {
		$result = array();
		if ($nbPass <= 0)
			return $array;
		foreach ($array as $key => $value) {
			if (is_array($value))
				foreach ($value as $valKey => $valVal) 
					$result[] = $valVal;
			else 
				$result[] = $value;
		}
		return self::arrayFlatten($result, $nbPass-1);
	}
	
	public static function boolString(bool $bValue) {
		return ($bValue ? 'true' : 'false');
	}
	
	// return an array of accepted languages/charsets from the Accept-Language and Accept-Charset HTTP headers 
	public static function parseHeader($header) {
		foreach (preg_split('/,/', $header) as $value) {
			$a = preg_split('/;/', $value);
			$result[] = trim($a[0]);
		}
		return $result;
	}
	
	public static function isASCII($string) {
		return preg_match('/^[\x20-\x7E]*$/', $string) == true;
	}
	
}