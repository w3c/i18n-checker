<?php
# converts a string to NFC or NFD and returns the result
# key routines are nfc and nfd
# Copyright (C) 2009  Richard Ishida ishida@w3.org
# Licence http://creativecommons.org/licenses/by-nc-sa/3.0/
# (If you use it, I'd be happy if you let me know.)
mb_internal_encoding("UTF-8");

function char2dec ($str) {
	$convmap = array(0x80, 0xffff, 0, 0xffff);
	$str = mb_encode_numericentity($str, $convmap, "UTF-8");
	$str = preg_replace('/[\&\#\;]/','',$str);
	return $str;
	}

function int2char ($int) { 
	$convmap = array(0x80, 0xffff, 0, 0xffff);
	$int = mb_decode_numericentity('&#'.$int.';', $convmap, "UTF-8");
	return $int;
	}

	
function decomposeHangul ($ch) {
	$chIndex = char2dec($ch);
	$sIndex = $chIndex-0xAC00;
	if ($sIndex<0 || $sIndex>=11172) {
		return $ch;
		}
	$result = '';
	$l = 0x1100+floor($sIndex/588);
	$v = 0x1161+floor(($sIndex % 588)/28);
	$t = 0x11a7+floor($sIndex % 28);
	
	$result .= int2char($l).int2char($v);
	
	if ($t != 0x11A7) { $result .= int2char($t); }
	return $result;
	}


function nfd ($str) { 
	$str = decompose($str); 
	$str = reorder($str); 
	return $str;
	}

function toArray ($string) {
    $strlen = mb_strlen($string);
    while ($strlen) {
		$ch = mb_substr($string,0,1,"UTF-8");
		if ($ch >= 'í €' && $ch <= 'í¯¿') { $width = 2; }
		else { 	$width = 1; }

        $array[] = mb_substr($string,0,$width,"UTF-8");
        $string = mb_substr($string,$width,$strlen,"UTF-8");
        $strlen = mb_strlen($string);
		}
    return $array;
	}	
	

function decompose ($string) { 
	GLOBAL $decomposable;		
	$str = toArray($string); 
	$decomposed = ''; 
	for ($i=0; $i<count($str); $i++) { 
		$current = $str[$i]; 
		if (isset($decomposable[$current])) { 
			$decomposed .= decompose($decomposable[$current]);
			}
		else if ($current >= 'ê°€' && $current <= 'íž£') { // hangul syllable
			$decomposed .= decomposeHangul($current);
			}
		else {
			$decomposed .= $current;
			}
		}
	return $decomposed;
	}


function isort ($array) {
	GLOBAL $nonzerocc; 
	for ($i=1;$i<count($array);$i++) {
		$testvalue = $nonzerocc[$array[$i]];
        $value = $array[$i];
        $j = $i-1;
        while ($j >= 0 and $nonzerocc[$array[$j]] > $testvalue) {
            $array[$j + 1] = $array[$j];
            $j = $j-1;
			}
        $array[$j+1] = $value;
		}
	return $array;
	}



function reorder ($string) { 
	GLOBAL $nonzerocc; 
	$string .= 'X';
	$str = toArray($string);
	$reordered = ''; 
	$i = 0;
	while ($i < count($str)-1) { // go through each character
		if (isset($nonzerocc[$str[$i]]) && isset($nonzerocc[$str[$i+1]])) { // if more than one cc...
			$j = 0; $temp = array(); 
			while ( isset($nonzerocc[$str[$i+$j]]) ) {
				$temp[$j] = $str[$i+$j]; 
				// temp is an array where the characters in str are keys and the comb class is the value
				$j++;
				}
			$newtemp = isort($temp);
			foreach ($newtemp as $ch) {
				$reordered .= $ch;
				}
			$i += count($temp);
			}
		else {
			$reordered .= $str[$i++];  
			}
		}
	return $reordered;
	}



function nfc ($string) { 
	GLOBAL $decomposable;
	GLOBAL $composable;
	GLOBAL $nonzerocc;
	GLOBAL $nfcexclusions;
	$composed = '';	
	$string .= 'X';
	// replace non-starter decompositions
	$string = str_replace('Ì?', 'Ì?', $string);
	$string = str_replace('Ì€', 'Ì€', $string);
	$string = str_replace('Ì“', 'Ì“', $string);
	$string = str_replace('ÌˆÌ?', 'ÌˆÌ?', $string);
	$string = str_replace('à½±à½²', 'à½±à½²', $string);
	$i=-1; 
	$str = toArray($string);
	//str = str.replace('\u0F73', '\u0F71\u0F72')
	//str = str.replace('\u0F75', '\u0F71\u0F74')
	//str = str.replace('\u0F81', '\u0F71\u0F80')
	while (++$i<count($str)-1) {
		$current = $str[$i];
		$next = $str[$i+1];
		if (isset($decomposable[$current])) { // decomposable char 
			if ((! isset($nfcexclusions[$current])) && (! isset($nonzerocc[$next]))) { // current char is not in exclusions & next of cclass 0
				$composed .= $current;
				} 
			else { // in exclusions or next not in cclass 0
				$temp = decompose($current);
				while (isset($nonzerocc[$str[++$i]])) { $temp.=$str[$i]; } // find combining sequence
				$temp = reorder($temp);
				$composed .= compose($temp);
				$i--;
				}
			}
		else if ($current>='á„€' && $current<='á‡¹') { // jamo characters
			$temp = $current;
			while ($str[++$i]>='á„€' && $str[$i]<='á‡¹') { $temp.=$str[$i]; } // gather jamos
			$composed .= composeHangul($temp);
			$i--;
			}
		else { // not a composite character... 
			if (isset($nonzerocc[$next])) { // but followed by combining char(s)
				$temp = $current;
				while (isset($nonzerocc[$str[++$i]])) { $temp.=$str[$i]; } // find combining sequence
				$temp = reorder($temp);
				$composed .= compose($temp);
				$i--;
				}
			else { 
				if (! isset($composable[$current.$next])) {
					$composed .= $current; 
					} 
				else {
					$base=$i; 
					while (isset($composable[$str[$base].$str[++$i]])) { 
						$str[$base] = $composable[$str[$base].$str[$i]]; 
						}
					$composed .= $str[$base]; $i--;
					}
				}
			}
		}
	return $composed;
	}


function compose ($str) { 
	// takes a base character followed by combining characters in the right order and produces nfc
	GLOBAL $nonzerocc;
	GLOBAL $composable;
	$strlength = mb_strlen($str,"UTF-8");
	$str = $str.'X';
	$lastcclass = -1;
	$base = mb_substr($str,0,1,"UTF-8");
	$store = '';
	$next = '';
	$ptr = 1; 
	while ($ptr < $strlength) {
		$next = mb_substr($str,$ptr,1,"UTF-8");
		if (isset($composable[$base.$next]) && ((! isset($nonzerocc[$next])) || $nonzerocc[$next] != $lastcclass)) { 
			$base = $composable[$base.$next];
			$ptr++;
			}
		else {
			$store .= $next;
			if (isset($nonzerocc[$next])) { $lastcclass = $nonzerocc[$next]; }
			$ptr++;
			}
		}
	return $base.$store;
	}


function composeHangul ($str) {
	$strlength = mb_strlen($str);
	if ($strlength == 0) { return; }
	$last = char2dec(mb_substr($str,0,1));
	$result=array();
	$result[0] = mb_substr($str,0,1);

	for ($i=1; $i<$strlength; ++$i) {
		$ch = char2dec(mb_substr($str,$i,1));
		
		$lIndex = $last-0x1100;
		if (0<=$lIndex && $lIndex<19) {
			$vIndex = $ch-0x1161;
			if (0<=$vIndex && $vIndex<21) {
				$last = 0xAC00+($lIndex*21+$vIndex)*28;
				$result[count($result)-1] = int2char($last);
				continue;
				}
			}
		
		$sIndex = $last-0xAC00;
		if (0<=$sIndex && $sIndex<11172 && ($sIndex % 28)==0) {
			$tIndex = $ch-0x11A7;
			if (0<$tIndex && $tIndex<28) {
				$last = $last+$tIndex;
				$result[count($result)-1] = int2char($last);
				continue;
				}
			}
			
		$last = $ch;
		$result[] = int2char($ch);
		}
	$resultstr = '';
	for ($j=0;$j<count($result);$j++){ $resultstr .= $result[$j]; }
	return $resultstr;
	}

	
// DATA
include('n11ndata.php');
?>