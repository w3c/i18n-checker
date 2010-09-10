<?php
function load($url,$options=array('method'=>'get','return_info'=>false)) {
$counter = 0;
$status = 'x';
while ($status != 'ok' and $counter++<10) { // check a maximum of 10 times for redirects
    $url_parts = parse_url($url);
	$info = array('http_code'    => 200);
    $response = '';
	
	#print $counter."\n";
		
	$send_header = array(
        'Accept' => 'text/*,application/*',
        'User-Agent' => 'BinGet/1.00.A (http://www.bin-co.com/php/scripts/load/)'
    	);

	if(isset($url_parts['query'])) {
		if(isset($options['method']) and $options['method'] == 'post')
			$page = $url_parts['path'];
		else
			$page = $url_parts['path'] . '?' . $url_parts['query'];
		} 
	else {
		$page = $url_parts['path'];
		}

	// open a connection
	$fp = fsockopen($url_parts['host'], 80, $errno, $errstr, 30);

	if (! $fp) {
		$body = "Connection could not be established.";
		$headers['Status'] = $errstr;
		return;
		}

	// set up the outgoing http headers
	$out = '';
	if(isset($options['method']) and $options['method'] == 'post' and isset($url_parts['query'])) {
		$out .= "POST $page HTTP/1.1\r\n";
		}
	else { $out .= "GET $page HTTP/1.0\r\n"; } //HTTP/1.0 is much easier to handle than HTTP/1.1
	$out .= "Host: $url_parts[host]\r\n";
	$out .= "Accept: $send_header[Accept]\r\n";
	$out .= "User-Agent: {$send_header['User-Agent']}\r\n";
	if(isset($options['modified_since']))
		$out .= "If-Modified-Since: ".gmdate('D, d M Y H:i:s \G\M\T',strtotime($options['modified_since'])) ."\r\n";
	$out .= "Connection: Close\r\n";
            
	//HTTP Basic Authorization support
	if(isset($url_parts['user']) and isset($url_parts['pass'])) {
		$out .= "Authorization: Basic ".base64_encode($url_parts['user'].':'.$url_parts['pass']) . "\r\n";
		}

	//If the request is post - pass the data in a special way.
	if(isset($options['method']) and $options['method'] == 'post' and isset($url_parts['query']) and $url_parts['query']) {
		$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out .= 'Content-Length: ' . strlen($url_parts['query']) . "\r\n";
		$out .= "\r\n" . $url_parts['query'];
		}
	$out .= "\r\n";

	// send the request and get the response
	fwrite($fp, $out);
	while (!feof($fp)) {
		$response .= fgets($fp, 128);
		}
	fclose($fp);
    
	//Get the headers in an associative array
    $headers = array();

    #if($info['http_code'] == 404) {
    #    $body = "";
     #   $headers['Status'] = 404;
    #} else {
	//Separate header and content
	$separator_position = strpos($response,"\r\n\r\n");
	$header_text = substr($response,0,$separator_position);
	$body = substr($response,$separator_position+4);
        

	// chop up the header
	$headerlines = explode("\n",$header_text);
	foreach($headerlines as $line) {
		$parts = explode(": ",$line);
		if(count($parts) == 2) $headers[$parts[0]] = chop($parts[1]);
		}
	$headers['firstline'] = $headerlines[0];
    #}

	if (isset($headers['Location'])) {
		$url = $headers['Location'];
		$status = 'redirected'; 
		
		print "<p class='redirect'>Redirected to ".$headers['Location']."</p>";
		}
	else { #print "<h1>Not redirected.</h1>"; 
		$status = 'ok'; 
		}
	}
    if($options['return_info']) return array('headers' => $headers, 'body' => $body, 'info' => $info);
    return $body;
	
}


$options = array(
	'return_info'	=> true,
	'method'		=> 'get'
);
?>