<?php 
header('Content-Type: application/xml; charset=UTF-8');
$xml = '<?xml version="1.0" encoding="UTF-8"?>';
echo $xml;
?>

<observationresponse xmlns="http://www.w3.org/2009/10/unicorn/observationresponse" ref="<?php echo isset($uri) ? htmlspecialchars($uri) : "" ?>" xml:lang="en">

<?php if (count(Message::$messages) > 0) { ?>
	<?php foreach (Message::$messages as $message) { ?>
	<message type="<?php echo $message->type ?>">
		<title></title>
		<description>
			<?php echo $message->message ?>
		</description>
	</message>
	<?php } ?>
<?php } ?>


</observationresponse>