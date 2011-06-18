<?php
if (ob_get_length() > 0 && !Conf::get('debug')) {
	$logger = Logger::getLogger('Output');
	$logger->error("Output buffer is not empty: \n".ob_get_clean());
}
$logger = Logger::getLogger('Templates');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
<head>
	<title><?php echo $title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rev="start" href="<?php echo Conf::get('base_uri') ?>" title="Home Page" />
<?php if (isset($css)) foreach($css as $sheet) { ?>
	<link href="<?php echo Conf::get('base_uri') ?>style/<?php echo $sheet ?>" type="text/css" media="screen" rel="stylesheet" />
<?php } if (isset($js)) foreach($js as $script) { ?>
	<script type="text/javascript" src="<?php echo Conf::get('base_uri') ?>scripts/<?php echo $script ?>"></script>
<?php } ?>
</head>
<body>
	<div id="banner">
		<h1>
			<a href="http://www.w3.org/"><img alt="W3C" width="110" height="61" id="logo" src="<?php echo Conf::get('base_uri') ?>images/w3c.png" /></a>
			<a href="<?php echo Conf::get('base_uri') ?>"><span><?php _lang('title') ?></span></a>
		</h1>
		<p><?php _lang('subtitle') ?></p>
	</div>
