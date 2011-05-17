<?php
require_once(realpath(dirname(__FILE__).'/../src/common.php'));
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$css[] = "minimum.css";
include('../templates/includes/head.html.php');
?>
<div style="margin: 1.5em 2.3em 1em;">

<h2>How to Provide Feedback For the W3C Internationalization Checker</h2>

<p>For the time being, please use the link below to provide feedback.  In the future we will provide other ways to provide feedback.</p>

<h3 id="errormsg">Report message feedback</h3>

<div class="bd compact">
	<p>If you think the messages reported by the W3C mobileOK Checker could be improved, or are not comprehensible, 
	   or you have other feedback, you can send questions and suggestions by clicking on the button below.
	</p>
	<p><strong>The checker is still only a prototype, so there are guarranteed to be bugs and missing features.</strong> It will slowly improve over the coming months, but it has been made available for use since it is likely to be helpful to many people already.</p>
	<form action="http://www.w3.org/International/2007/06/surveyform-2.php" method="post">
		<p><input type="submit" value="Send feedback" />
		<input name="docname" value="http://qa-dev.w3.org/i18n-checker/index.php" type="hidden" />
		<input name="referer" value="http://qa-dev.w3.org/i18n-checker/feedback.html" type="hidden" />
		<input name="lang" value="en" type="hidden" /></p>
	</form>
	<p>&nbsp;</p>
	<form method="get" action="http://www.w3.org/Search/Mail/Public/search" enctype="application/x-www-form-urlencoded"></form>
</div>

</div>
<?php include('../templates/includes/footer.html.php');