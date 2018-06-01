<?php 
/**
 * Contains the Utils class.
 * @package i18nChecker
 */
/**
 * Utility class
 * 
 * Contains several useful functions used by the checker logic.
 * 
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Utils {
	
	private function __construct() {}
	
	public static function contentTypeToArray($contentType) {
		if ($contentType == null)
			return array ('mimetype' => null, 'charset' => null);
		$matches = explode(';', trim($contentType));
		if (isset($matches[1])) {
			$matches[1] = explode('=', $matches[1]);
			$matches[1] = isset($matches[1][1]) && trim($matches[1][1])
				? $matches[1][1]
				: $matches[1][0];
		} else
			$matches[1] = null;
		return array ('mimetype' => $matches[0], 'charset' => $matches[1]);
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
	
	// Returns an array of values from a comma-separated string of values
	public static function getValuesFromCSString($string) {
		return array_map('trim', preg_split('/,/', $string));
	}
	
	public static function arrayToCS($array) {
		if (!is_array($array))
			return null;
		$result = '';
		foreach ($array as $val) {
			if (is_array($val))
				continue;
			$result .= $val.',';
		}
		return preg_replace('/,$/', '', $result);
		
	}
	
	public static function valuesFromValArray($array) {
		if ($array == null || !is_array($array))
			return null;
		$result = array();
		foreach ($array as $valArr) {
			if (array_key_exists('values', $valArr) && $valArr['values'] != null) // TODO: if not then an invalid array has been passed, log?
				$result[] = $valArr['values'];
		}
		return array_values(self::arrayFlatten($result));
	}
	
	public static function codesFromValArray($array) {
		if ($array == null || !is_array($array))
			return null;
		$result = array();
		foreach ($array as $valArr) {
			if (array_key_exists('code', $valArr) && $valArr['code'] != null) // TODO: if not then an invalid array has been passed, log?
				$result[] = $valArr['code'];
		}
		return array_values(self::arrayFlatten($result));
	}
	
	/*
	 public static function codesFromValArray($array) {
		if (!is_array($array))
			return null;
		$result = array();
		foreach ($array as $element) {
			array_merge($result, $element);
		}
		return $result;
	}
	 */
	
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
	
	public static function boolString($bValue) {
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
	
	// returns all elements in array1 that or not in array2
	public static function diffArray($array1, $array2) {
		if (!is_array($array1))
			return null;
		if (!is_array($array2))
			return $array1;
		foreach($array1 as $val) {
			if (!in_array($val, $array2))
				$result[] = $val;
		}
		return isset($result) ? $result : null;
	}
	
	public static function charsetFromXMLDeclaration($xmlDeclaration) {
		preg_match('@<'.'?xml[^>]+encoding\\s*=\\s*(["|\'])(.*?)\\1@i', $xmlDeclaration, $matches);
		return isset($matches[2]) ? $matches[2] : null;
	}
	
	public static function _empty($array) {
		return empty($array);
	}
	
	public static function findCodeIn($code, $array) {
		if (!is_array($array))
			return null;
		foreach($array as $val) {
			if ($val['code'] == $code)
				return $val;
		}
	}
	
	// XXX Prototype of a parse_url function that supports iris. /!\ only support http/https uris
	public static function parse_url($url) {
		if (!preg_match('@(https?)://([^:/]+)(:(\d+))?(/[^\?]*)?(\?([^#]*))?(#(.*))?@i', $url, $matches))
			return null;
		$result = array(
			'scheme'	=> isset($matches[1]) ? $matches[1] : null,
			'host'		=> isset($matches[2]) ? $matches[2] : null,
			'port'		=> isset($matches[4]) ? $matches[4] : null,
			'user'		=> null, //not implemented
			'pass'		=> null, //not implemented
			'path'		=> isset($matches[5]) ? $matches[5] : null,
			'query'		=> isset($matches[7]) ? $matches[7] : null,
			'fragment'	=> isset($matches[9]) ? $matches[9] : null,
		
		);
		$result = array_filter($result);
		return $result;
		/*'1 '.print_r($matches);
		preg_match('@https?://[^:/]+(:\d+)?/[^\?]*#.*@i', $url, $matches);
		'2 '.print_r($matches);*/
	}
	
	
}

if (!function_exists('http_build_url'))
{
	define('HTTP_URL_REPLACE', 1);				// Replace every part of the first URL when there's one of the second URL
	define('HTTP_URL_JOIN_PATH', 2);			// Join relative paths
	define('HTTP_URL_JOIN_QUERY', 4);			// Join query strings
	define('HTTP_URL_STRIP_USER', 8);			// Strip any user authentication information
	define('HTTP_URL_STRIP_PASS', 16);			// Strip any password authentication information
	define('HTTP_URL_STRIP_AUTH', 32);			// Strip any authentication information
	define('HTTP_URL_STRIP_PORT', 64);			// Strip explicit port numbers
	define('HTTP_URL_STRIP_PATH', 128);			// Strip complete path
	define('HTTP_URL_STRIP_QUERY', 256);		// Strip query string
	define('HTTP_URL_STRIP_FRAGMENT', 512);		// Strip any fragments (#identifier)
	define('HTTP_URL_STRIP_ALL', 1024);			// Strip anything but scheme and host
	
	// Build an URL
	// The parts of the second URL will be merged into the first according to the flags argument. 
	// 
	// @param	mixed			(Part(s) of) an URL in form of a string or associative array like parse_url() returns
	// @param	mixed			Same as the first argument
	// @param	int				A bitmask of binary or'ed HTTP_URL constants (Optional)HTTP_URL_REPLACE is the default
	// @param	array			If set, it will be filled with the parts of the composed url like parse_url() would return 
	function http_build_url($url, $parts=array(), $flags=HTTP_URL_REPLACE, &$new_url=false)
	{
		$keys = array('user','pass','port','path','query','fragment');
		
		// HTTP_URL_STRIP_ALL becomes all the HTTP_URL_STRIP_Xs
		if ($flags & HTTP_URL_STRIP_ALL)
		{
			$flags |= HTTP_URL_STRIP_USER;
			$flags |= HTTP_URL_STRIP_PASS;
			$flags |= HTTP_URL_STRIP_PORT;
			$flags |= HTTP_URL_STRIP_PATH;
			$flags |= HTTP_URL_STRIP_QUERY;
			$flags |= HTTP_URL_STRIP_FRAGMENT;
		}
		// HTTP_URL_STRIP_AUTH becomes HTTP_URL_STRIP_USER and HTTP_URL_STRIP_PASS
		else if ($flags & HTTP_URL_STRIP_AUTH)
		{
			$flags |= HTTP_URL_STRIP_USER;
			$flags |= HTTP_URL_STRIP_PASS;
		}
		
		// Parse the original URL
		$parse_url = is_array($url) ? $url : parse_url($url);
			//$parse_url = parse_url($url);
		
		// Scheme and Host are always replaced
		if (isset($parts['scheme']))
			$parse_url['scheme'] = $parts['scheme'];
		if (isset($parts['host']))
			$parse_url['host'] = $parts['host'];
		
		// (If applicable) Replace the original URL with it's new parts
		if ($flags & HTTP_URL_REPLACE)
		{
			foreach ($keys as $key)
			{
				if (isset($parts[$key]))
					$parse_url[$key] = $parts[$key];
			}
		}
		else
		{
			// Join the original URL path with the new path
			if (isset($parts['path']) && ($flags & HTTP_URL_JOIN_PATH))
			{
				if (isset($parse_url['path']))
					$parse_url['path'] = rtrim(str_replace(basename($parse_url['path']), '', $parse_url['path']), '/') . '/' . ltrim($parts['path'], '/');
				else
					$parse_url['path'] = $parts['path'];
			}
			
			// Join the original query string with the new query string
			if (isset($parts['query']) && ($flags & HTTP_URL_JOIN_QUERY))
			{
				if (isset($parse_url['query']))
					$parse_url['query'] .= '&' . $parts['query'];
				else
					$parse_url['query'] = $parts['query'];
			}
		}
			
		// Strips all the applicable sections of the URL
		// Note: Scheme and Host are never stripped
		foreach ($keys as $key)
		{
			if ($flags & (int)constant('HTTP_URL_STRIP_' . strtoupper($key)))
				unset($parse_url[$key]);
		}
		
		$new_url = $parse_url;
		
		return 
			 ((isset($parse_url['scheme'])) ? $parse_url['scheme'] . '://' : '')
			.((isset($parse_url['user'])) ? $parse_url['user'] . ((isset($parse_url['pass'])) ? ':' . $parse_url['pass'] : '') .'@' : '')
			.((isset($parse_url['host'])) ? $parse_url['host'] : '')
			.((isset($parse_url['port'])) ? ':' . $parse_url['port'] : '')
			.((isset($parse_url['path'])) ? $parse_url['path'] : '')
			.((isset($parse_url['query'])) ? '?' . $parse_url['query'] : '')
			.((isset($parse_url['fragment'])) ? '#' . $parse_url['fragment'] : '')
		;
	}
}