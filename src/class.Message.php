<?php
/**
 * Contains the Message class
 * @package i18nChecker
 */
/**
 * Information severity level
 */
define("MSG_LEVEL_INFO", "info");
/**
 * Warning severity level
 */
define("MSG_LEVEL_WARNING", "warning");
/**
 * Error severity level
 */
define("MSG_LEVEL_ERROR", "error");
/**
 * A message
 * 
 * A message has 3 properties:
 * - a severity level, one of MSG_LEVEL_INFO, MSG_LEVEL_WARNING, and MSG_LEVEL_ERROR
 * - a message to be displayed
 * - an optional title
 * This class also holds a static reference of messages to be displayed for the current request.
 * 
 * @package i18nChecker
 * @author Thomas Gambet <tgambet@w3.org>
 * @copyright 2011 W3C ® (MIT, ERCIM, Keio)
 * @license http://www.w3.org/Consortium/Legal/copyright-software
 */
class Message
{
	public $title;
	public $message;
	public $type = MSG_LEVEL_INFO;
	public static $messages;
	
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