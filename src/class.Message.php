<?php

define("MSG_LEVEL_INFO", "info");
define("MSG_LEVEL_WARNING", "warning");
define("MSG_LEVEL_ERROR", "error");

class Message
{
	public $title;
	public $message;
	public $type = MSG_LEVEL_INFO;
	public static $messages = array();
	
	private function __construct($type, $message, $title='') {
		$this->type = $type;
		$this->title = $title;
		$this->message = $message;
	}
	
	static function addMessage($type, $message, $title='') {
		Message::$messages[] = new Message($type, $message, $title);
	}
	
	static function clearMessages() {
		Message::$messages = array();
	}
}