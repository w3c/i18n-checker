<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $lang ?>" lang="<?php echo $lang ?>">
<head>
	<title><?php echo $title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rev="start" href="<?php echo $baseUri ?>" title="Home Page" />
<?php if (isset($css)) foreach($css as $sheet) { ?>
	<link href="<?php echo $baseUri ?>style/<?php echo $sheet ?>" type="text/css" media="screen" rel="stylesheet" />
<?php } if (isset($js)) foreach($js as $script) { ?>
	<script type="text/javascript" src="<?php echo $baseUri ?>scripts/<?php echo $script ?>"></script>
<?php } ?>
</head>
<body id="mybody" class="js">
	<div id="banner">
		<h1>
			<a href="http://www.w3.org/"><img alt="W3C" width="110" height="61" id="logo" src="<?php echo $baseUri ?>images/w3c.png" /></a>
			<a href="<?php echo $baseUri ?>"><span><?php _lang('title') ?></span></a>
		</h1>
		<p><?php _lang('subtitle') ?></p>
	</div>

<?php if (count($messages) > 0) { ?>
<div id="messages">
	<?php foreach ($messages as $message) { ?>
	<div class="<?php echo $message->getStringType() ?>">
		<h4><?php _lang($message->message) ?></h4>
	</div>
	<?php } ?>
</div>
<?php } ?>