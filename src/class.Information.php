<?php
/**
 * Contains the Information class.
 * @package i18nChecker
 */
/**
 * An Information on the result page
 * 
 * An Information is a row of the information table on the i18n-checker result page.
 * 
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Information {
	
	public static $infos;
	
	public $category;
	public $title;
	public $values;
	/* eg:
	 * TODO: deambiguate values and values
	 * $values = array (
	 * 		array (
	 * 			'code' => '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'
	 * 			'values' => 'utf-8'
	 * 		),
	 *		array (
	 * 			'code' => 'Content-Language: ka, ta'
	 * 			'values' => array (ka, ta);
	 * 		),
	 * 		array (
	 * 			'code' => null
	 * 			'values' => null;
	 * 		),
	 * ) 
	 */
	public $display_value;
	
	private function __construct($category, $title, $values, $display_value = null) {
		$this->category = $category;
		$this->title = $title;
		$this->values = $values;
		$this->display_value = $display_value;
	}
	
	public static function addInfo($category, $title, $values, $display_value) {
		if (is_array($values)) {
			if (array_key_exists('values', $values)) {
				$values = array($values);
			}
		} elseif ($values != null) {
			$values = array(
				array(
					'code' => null,
					'values' => $values
				)
			);
		}
		self::$infos[$title] = new Information($category, $title, $values, $display_value);
	}
	
	public static function getInfoPerCategory() {
		foreach (self::$infos as $info)
			if ($info->category != null)
				$result[$info->category][] = $info;
		return $result;
	}
	
	public static function get($name) {
		if (array_key_exists($name, self::$infos))
			return self::$infos[$name];
		return null;
	}
	
	public static function getValues($name) {
		// If $name end with * return all values starting with that key
		if (preg_match('/\*$/', $name))
			return self::getValuesStartingWith(preg_replace('/\*$/', '', $name));
		return self::get($name) ? self::get($name)->values : null; 
	}
	
	public static function getValuesStartingWith($name) {
		$keys = array_keys(self::$infos);
		//$result = array();
		foreach ($keys as $key)
			if (preg_match('/^'.$name.'/', $key) && self::$infos[$key]->values != null)
				$result[] = self::$infos[$key]->values;
		return isset($result) ? Utils::arrayFlatten($result) : null; 
	}
	
	public static function getFirstVal($name) {
		if (($v = self::getValues($name)) != null)
			if (is_array($v[0]['values']))
				return $v[0]['values'][0];
			else 
				return $v[0]['values'];
		return null;
	}
	
	public static function getCount() {
		return count(self::$infos);
	}
	
	public static function clear() {
		self::$infos = array();
	}
	
}