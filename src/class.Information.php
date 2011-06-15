<?php

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
		return self::get($name) ? self::get($name)->values : null; 
	}
	
	public static function getFirstVal($name) {
		return ($v = self::getValues($name)) ? $v[0]['values'][0] : null; 
	}
	
	/*public static function getCode($name) {
		return self::get($name) ? self::get($name)->code : null; 
	}*/
	
	public static function getCount() {
		return count(self::$infos);
	}
	
}