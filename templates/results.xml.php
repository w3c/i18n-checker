<?php 
$xml = '<?xml version="1.0" encoding="UTF-8"?>';
echo $xml;
 ?>

<observationresponse xmlns="http://www.w3.org/2009/10/unicorn/observationresponse" ref="<?php echo htmlspecialchars($result['url']); ?>" xml:lang="en">

<?php if ($fail) { ?>
	<status value="undef"/> 
<?php } else if (count($errors) <= 0) { ?>
	<status value="passed"/> 
<?php } else { ?>
	<status value="failed"/> 
<?php } ?>

<group name="encoding">
	<title><?php _lang('character_encoding') ?></title>
</group>
<group name="language">
	<title><?php _lang('language') ?></title>
</group>
<group name="direction">
	<title><?php _lang('text_direction') ?></title>
</group>
<group name="refnames">
	<title><?php _lang('class_and_id') ?></title>
</group>
<group name="header">
	<title><?php _lang('request_headers') ?></title>
</group>
<group name="report">
	<title><?php _lang('detailed_report') ?></title>
</group>

<message type="info" group="encoding">
<?php
if (isset($result['headers']['Content-Type'])) {?>
	<context><?php print $char_encoding['http']['code'] ?></context>
<?php } ?>
	<title><?php _lang('content_type') ?></title>
	<description><?php
if (! isset($result['headers']['Content-Type'])) { _lang('none_found'); }
else if ($char_encoding['http']['value'] != '') { print $char_encoding['http']['value']; }
else { _lang('no_charset_found'); } 
?></description>
</message>

<message type="info" group="encoding">
	<title><?php _lang('bom') ?></title>
	<description><?php
if ($char_encoding['bom']['value'] != '') { print $char_encoding['bom']['value']; }
else { _lang('token_no'); } 
?></description>
</message>

<message type="info" group="encoding">
<?php if ($xmldeclTag!='') { ?>
	<context><?php  print $xmldeclTag ?></context>
<?php } ?>
	<title><?php _lang('xml_declaration') ?></title>
	<description><?php
if ($xmldeclTag == '') { _lang('none_found'); }
else if ($char_encoding['xmldecl']['value'] != '') { print $char_encoding['xmldecl']['value']; }
else { _lang('no_encoding_found'); } 
?></description>
</message>

<message type="info" group="encoding">
<?php if ($char_encoding['httpequiv']['code']!='') { ?>
	<context><?php print $char_encoding['httpequiv']['code'] ?></context>
<?php } ?>
	<title><?php _lang('content_type_meta') ?></title>
	<description><?php
if ($char_encoding['httpequiv']['value']=='') { _lang('none_found'); }
else { print $char_encoding['httpequiv']['value']; }
?></description>
</message>

<message type="info" group="encoding">
<?php if ($char_encoding['html5']['code']!='') { ?>
	<context><?php print $char_encoding['html5']['code'] ?></context>
<?php } ?>
	<title><?php _lang('html5_meta_charset') ?></title>
	<description><?php
if ($char_encoding['html5']['value']=='') { _lang('none_found'); }
else { print $char_encoding['html5']['value']; } 
?></description>
</message>

<message type="info" group="language">
<?php if ($htmltag!='') { ?>
	<context><?php print $htmltag; ?></context>
<?php } ?>
	<title>&lt;html lang=</title>
	<description><?php
if ($htmltag=='') { _lang('no_html_tag_found'); }
else if ($htmllangValue=='') { _lang('token_none'); }
else { print $htmllangValue; } ?></description>
</message>

<message type="info" group="language">
<?php if ($htmltag!='') { ?>
	<context><?php print $htmltag; ?></context>
<?php } ?>
	<title>&lt;html xml:lang=</title>
	<description><?php
if ($htmltag=='') { _lang('no_html_tag_found'); }
else if ($htmlxmllangValue=='') { _lang('token_none'); }
else { print $htmlxmllangValue; } ?></description>
</message>

<message type="info" group="language">
<?php if ($httpcontentlangHeader!='') { ?>
	<context><?php print $httpcontentlangHeader; ?></context>
<?php } ?>
	<title><?php _lang('http_content_language') ?></title>
	<description><?php
if ($httpcontentlangHeader=='') { _lang('none_found'); }
else if ($httpcontentlangValue=='') { _lang('token_none'); }
else { print $httpcontentlangValue; } ?></description>
</message>

<message type="info" group="language">
<?php if ($metacontentlangTag!='') { ?>
	<context><?php print $metacontentlangTag; ?></context>
<?php } ?>
	<title><?php _lang('meta_content_language') ?></title>
	<description><?php
if ($metacontentlangTag=='') { _lang('none_found'); }
else if ($metacontentlangValue=='') { _lang('token_none'); }
else { print $metacontentlangValue; } ?></description>
</message>

<message type="info" group="language">
	<title><?php _lang('detected_language') ?></title>
	<description></description>
</message>

</observationresponse>
