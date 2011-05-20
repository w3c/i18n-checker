<?php

class Information {
	
	public static $infos;
	
	public $category;
	public $title;
	public $value;
	public $display_value;
	public $code;
	// Not used: set category to null to hide that information from the info table
	public $hidden;
	
	private function __construct($category, $title, $value, $display_value, $code, $hidden) {
		$this->category = $category;
		$this->title = $title;
		$this->value = $value;
		$this->display_value = $display_value;
		$this->code = $code;
		$this->hidden = $hidden;
	}
	
	public static function addInfo($category, $title, $value, $display_value, $code, $hidden = false) {
		self::$infos[] = new Information($category, $title, $value, $display_value, $code, $hidden);
	}
	
	public static function getInfoPerCategory() {
		foreach (self::$infos as $info) {
			if ($info->category != null) {
				$result[$info->category][] = $info;
			}
		}
		return $result;
	}
	
	public static function get($name) {
		foreach (self::$infos as $info) {
			if ($info->title == $name) {
				return $info;
			}
		}
		return null;
	}
	
	public static function getValue($name) {
		return self::get($name) ? self::get($name)->value : null; 
	}
	
	public static function getCount() {
		return count(self::$infos);
	}
	
}