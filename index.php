<?php
require_once('code/common.php');

$messages[] = new Message(Message::warning, 'The checker is still only a prototype, so there are guarranteed to be bugs and missing features.  It will be developed over the coming months, but it has been made available for use now since it is likely to be helpful to many people already. If you have suggestions for ways to improve the checker, please fill in the feedback form.');

include('templates/index.html.php');