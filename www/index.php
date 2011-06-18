<?php
require_once(realpath(dirname(__FILE__).'/../src/class.Conf.php'));
require_once(PATH_SRC.'/class.Language.php');
require_once(PATH_SRC.'/class.Message.php');

Message::addMessage(MSG_LEVEL_WARNING, 'The checker is still only a prototype, so there are guarranteed to be bugs and missing features.  
	It will be developed over the coming months, but it has been made available for use now since it is likely to be helpful to many people already. 
	If you have suggestions for ways to improve the checker, please fill in the feedback form.');

include(PATH_TEMPLATES.'/index.html.php');