<?php
header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$js[] = "mootools-1.3.2.js";
$js[] = "w3c_unicorn_index.js";

if (isset($_GET['debug_lang']) && $_GET['debug_lang'] == 'true')
	Conf::set('debug_lang', 'true');

include(PATH_TEMPLATES.'/html/head.php');
include(PATH_TEMPLATES.'/html/messages.php');
include(PATH_TEMPLATES.'/html/form.php');
?>

	<div class="intro">
		<p><?php _lang('intro', Conf::get('base_uri').'about'.(Conf::get('show_extension') ? '.php' : '')) ?></p>
		<p><?php _lang('intro_links') ?></p>
	</div>
	<!--div class="disclaimer">
		<h2>About doctypes and MIME types.</h2>
		<p>Pages accessed over the Web are accompanied by an HTTP header that provides information about the document requested, including its MIME type. If a document is transmitted with an HTML MIME type, such as text/html, then it will be processed as an HTML document by Web browsers. When a document is transmitted with an XML MIME type, such as application/xhtml+xml, then it is treated as an XML document by Web browsers, to be parsed by an XML processor.</p>
		<p>A document with a doctype such as HTML 4.01 should always be transmitted with an HTML MIME type. Others, such as XHTML 1.x doctypes, can be transmitted with either an HTML or XML MIME type. The appropriate way to declare the character encoding and language of a page differs significantly according to the MIME type applied.</p>
		<p>On the right side of the Information section heading in the checker, we display the doctype and MIME-type used to process the page. Pages that have no doctype are currently handled as HTML5.</p>
		<p>For more information about this, see <a href="http://www.w3.org/International/articles/serving-xhtml/">Serving HTML &amp; XHTML</a>.</p>
	</div-->
	<div id="w3c-include" class="intro">
		<script type="text/javascript" src="//www.w3.org/QA/Tools/w3c-include.js"></script>
	</div>

<?php include(PATH_TEMPLATES.'/html/footer.php');
