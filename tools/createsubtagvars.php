<?php

/*
This script generates the code for two variables in class.Parser.php:
- $languages
- $otherSubtags

It should be run each time the IANA registry is updated, and the output should be added to the class.Parser.php code.
*/
?>


<?php

####################  READ IN DATA #######################################

# Reads in the subtag registry and sorts all the entries into arrays, one for language tags, one for region tags, etc.

$languages 		= array();
$scripts   		= array();
$regions    	= array();
$grandfathered 	= array();
$redundant   	= array();
$variant    	= array();
$extlang    	= array();


$registry = file_get_contents('http://www.iana.org/assignments/language-subtag-registry');
	

####################  STORE IN TEMPORARY ARRAYS #######################################

$registryItems = explode('%%', $registry);
	
foreach ($registryItems as $item) {
	$itemLines = explode("\n", $item);
	$item 	   = array();
	foreach($itemLines as $line) {
		if(substr($line,0,2) == '  ') {
			$item[$property] .= ' ' . trim($line);
			}
		elseif (strpos($line, ':') !== false) {
			list($property, $value) = explode(':', $line);
			if(!isset($item[$property])) {
				$item[$property] = trim($value);
				}
			else {
				$item[$property] .= ', ' . trim($value);
				}
			}
		}
		
	if(isset($item['Type'])) {
		switch($item['Type']) {
			case 'language' 		: $languages[] 		= $item; break;
			case 'script'   		: $scripts[]   		= $item; break;
			case 'region'   		: $regions[]   		= $item; break;
			case 'grandfathered' 	: $grandfathered[]	= $item; break;
			case 'redundant'	    : $redundant[]		= $item; break;
			case 'variant'          : $variant[]		= $item; break;
			case 'extlang'          : $extlang[]		= $item; break;
				
			default                 : echo "Unkown Type: " . $item['Type'] . "</br />";
			}
		}
	}


#change the Tag field in Grandfathered and Redundant tags to Subtag, just to make lookup easier
for ($i=0; $i<count($grandfathered); $i++) {
	$grandfathered[$i]['Subtag'] = $grandfathered[$i]['Tag'];
	}
for ($i=0; $i<count($redundant); $i++) {
	$redundant[$i]['Subtag'] = $redundant[$i]['Tag'];
	}
	


####################  GENERATE THE OUTPUT #######################################


$out = 'public $languages = "|';
for ($r=0;$r<count($languages);$r++) {
	$out .= $languages[$r]['Subtag'].'|';
	}
$out .= '"';


print($out.";\n");


$repeats = '';
$tagRegister = array();

$out = 'public $otherSubtags = "|';
for ($r=0;$r<count($extlang);$r++) {
	if (! isset($tagRegister[$extlang[$r]['Subtag']])) {
		$tagRegister[$extlang[$r]['Subtag']] = 'ok';
		$out .= $extlang[$r]['Subtag'].'|';
		}
	}


for ($r=0;$r<count($regions);$r++) {
	if (! isset($tagRegister[$regions[$r]['Subtag']])) {
		$tagRegister[$regions[$r]['Subtag']] = 'ok';
		$out .= strtolower($regions[$r]['Subtag']).'|';
		}
	}


for ($r=0;$r<count($scripts);$r++) {
	if (! isset($tagRegister[$scripts[$r]['Subtag']])) {
		$tagRegister[$scripts[$r]['Subtag']] = 'ok';
		$out .= strtolower($scripts[$r]['Subtag']).'|';
		}
	}


for ($r=0;$r<count($variant);$r++) {
	if (! isset($tagRegister[$variant[$r]['Subtag']])) {
		$tagRegister[$variant[$r]['Subtag']] = 'ok';
		$out .= strtolower($variant[$r]['Subtag']).'|';
		}
	}
$out .= '"';

print($out.";\n");



//$filename = 'macrolanguages.js';
//$fp = fopen( $filename, 'w' );
//fwrite( $fp, $out );


?>
