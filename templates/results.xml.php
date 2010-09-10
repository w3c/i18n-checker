<?xml version="1.0" encoding="UTF-8"?>
<?php include('initialcode.php'); include('n11n.php'); include('checkercode.php'); ?>
<observationresponse xmlns="http://www.w3.org/2009/10/unicorn/observationresponse" ref="<?php echo htmlspecialchars($result['url']); ?>" xml:lang="en">

<?php if (!$fail) { ?>
	<?php if (count($errors) == 0) { ?>
	<status value="passed"/> 
		<?php if (count($errors) == 0) { ?>
	<message type="info">
		<title>No issues to report !</title>
	</message>
		<?php } else { ?>
	<group name="encoding">
		<title>Character encoding</title>
	</group>
	<group name="language">
		<title>Language</title>
	</group>
	<group name="direction">
		<title>Text direction</title>
	</group>
	<group name="names">
		<title>Class & id names</title>
	</group>
	<group name="report">
		<title>Detailed report</title>
	</group>
		<?php }  ?>
	<?php } else { ?>
	<status value="failed"/>
	<?php } ?>
	
	<message type="info">
		<context><?php print $httpcontenttypeHeader; ?></context>
		<title>HTTP Content-Type</title>
		<description>
<?php if ($httpcharsetValue=='nocharset') { print "No charset found."; }
 else if ($httpcharsetValue=='') { print "None found."; }
 else { print "<span class='result'>".$httpcharsetValue."</span>"; } ?>
		</description>
	</message>
	
	<message type="info">
		<title>Failure to do the validation</title>
		<description><?php echo $failuremessage; ?></description>
	</message>
	
	<message type="info">
		<title>Failure to do the validation</title>
		<description><?php echo $failuremessage; ?></description>
	</message>
	
	<message type="info">
		<title>Failure to do the validation</title>
		<description><?php echo $failuremessage; ?></description>
	</message>
	
	<message type="info">
		<title>Failure to do the validation</title>
		<description><?php echo $failuremessage; ?></description>
	</message>

<?php } else { ?>

	<status value="undef"/>
	<message type="info">
		<title>Failure</title>
		<description><?php echo $failuremessage; ?></description>
	</message>

<?php } ?>



</observationresponse>
