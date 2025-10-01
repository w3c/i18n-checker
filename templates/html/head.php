<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
<head>
	<title><?php echo $title ?></title>
	<link rel="icon" type="image/png" href="https://www.w3.org/assets/logos/w3c-2025/favicons/favicon-32.png" />
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
			<a href="https://www.w3.org/"><img alt="W3C" id="logo" src="https://www.w3.org/assets/logos/w3c-2025/svg/margins/w3c-letters-bg-white.svg" /></a>
			<a href="<?php echo Conf::get('base_uri') ?>"><span><?php _lang('title') ?></span></a>
		</h1>
		<p><?php _lang('subtitle') ?></p>
	</div>
