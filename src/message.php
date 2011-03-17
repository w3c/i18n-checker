<?php
class Message
{
	const info = 0;
	const warning = 1;
	const error = 2;
	
	public $title;
	public $message;
	public $type = Message::info;
	
	function __construct($type, $message, $title='') {
		$this->type = $type;
		$this->title = $title;
		$this->message = $message;
	}
	
	function getStringType() {
		if ($this->type == Message::info)
			return 'info';
		if ($this->type == Message::warning)
			return 'warning';
		if ($this->type == Message::error)
			return 'error';
	}
}