<?php

class Information {
	
	public static $infos;
	
	public $category;
	public $title;
	public $value;
	public $display_value;
	public $code;
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
		if (self::$infos == null)
			self::$infos = array();
		self::$infos[] = new Information($category, $title, $value, $display_value, $code, $hidden);
	}
	
	public static function getInfoPerCategory() {
		$result = array();
		foreach (self::$infos as $info) {
			if (!isset($result[$info->category]))
				$result[$info->category] = array();
			$result[$info->category][] = $info;
		}
		return $result;
	}
	
	public static function getCount() {
		return count(self::$infos);
	}
	
}