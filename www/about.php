<?php
require_once(realpath(dirname(__FILE__).'/../src/class.Conf.php'));
require_once(PATH_SRC.'/class.Language.php');
require_once(PATH_SRC.'/class.Message.php');
header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
include(PATH_TEMPLATES.'/html/head.php');
// Hide language selection for now - this page is not internationalized
$hideLangSelection = true;
?>
<div class="about">

<h2>About the W3C Internationalization (i18n) Checker</h2>
<p>Getting internationalization features right at the beginning saves a
  lot of time and trouble if you ever need to use your content in a
  language-sensitive way in the future. However, the test will also throw
  up issues that could cause you problems straight away, such as those
  related to character encodings and to non-normalized class and id names. </p>
<h3 id="TableOfContents">Table of contents</h3>

<div id="toc" class="toc">
	<ol>
		<li><a href="#about">About this service</a></li>
		<li><a href="#others">References and other resources</a></li>
		<li><a href="#credits">Credits</a></li>
	</ol>
</div>
<h3 id="about">About this service</h3>

<div class="bd compact">
	<p>The <a href="<?php echo Conf::get('base_uri') ?>">W3C Internationalization Checker</a> is a
	free service by the <acronym title="World Wide Web Consortium">W3C</acronym>
	that provides:</p>
	<ul style="margin-left:3em;">
	  <li>a table listing   key
	    international settings for a page, such as character encoding, language
	    declarations, and text direction.</li>
	  <li>a list of errors, warnings and helpful
	    suggestions about the page, with pointers to resources where you can learn more.</li>
    </ul>
	<p>The reports take into account both markup and HTTP headers, which can be particularly useful for
    troubleshooting problems. The advice given in the checker  reports considers how your HMTL pages (ie. files served as <code class="kw" translate="no">text/html</code>)  will behave in a modern browser, rather than just validating against a particular version of the standard. The advice is tailored to suit files served as <code class="kw" translate="no">application/xhtml+xml</code> for aspects relating to character encoding and language declaration.</p>
	<p>Please let us know about bugs and missing features using the <a href="https://github.com/w3c/i18n-checker/issues">feedback form</a>. A <a href="https://www.w3.org/International/quicktips/doc/checker.en.php">list of current checks</a> run by the checker is available.</p>
	<p>This software is licensed under the terms of the <a href="https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document">W3C Software and Document Notice and License</a>.
    The source code is available <a href="https://github.com/w3c/i18n-checker">on GitHub</a>.</p>
</div>

<h3 id="others">References and other resources</h3>

<div>
	<h4>Further reading</h4>
	<ul class="bd compact">
		<li>The W3C's Internationalization Activity's <a href="https://www.w3.org/International/i18n-drafts/techniques/authoring-html.en.html">techniques
		Index</a>   provides links to
		recommendations and useful resources, organised by task. The checker reports link back to  this
	  index.</li>
		<li>The <a href="http://www.w3.org/International/quicktips/">Internationalization
		Quick Tips for the Web</a> summarize key concepts of international Web
		design.</li>
		<li>You can follow the Internationalization Activity news at the <a
			href="http://www.w3.org/International/">home page</a>, or via one of
		our <a href="http://www.w3.org/International/log/description">RSS feeds</a>
		or the <a href="http://www.twitter.com/webi18n">@webi18n twitter
		channel</a>.</li>
	</ul>
</div>

<div>
	<h4>Relevant activities</h4>
	<ul class="bd compact">
		<li>The <a href="http://www.w3.org/International/">W3C's Internationalization
		Activity</a> works with W3C working groups and liaises with other organizations
		to ensure Web technologies work for everyone, regardless of their language,
		script, or culture. It also provides articles and other resources about Web
		internationalization.</li>
		<li>The <a style="" href="https://www.w3.org/International/ig/">Internationalization
		Interest Group</a> operates via a set of public mailing lists supporting the activity of
		the Internationalization Working Groups. Anyone can participate in the
		Interest Group by simply joining the mailing list.</li>
	</ul>
</div>

<div>
	<h4>Online Tools &amp; Other Validators</h4>
	<div class="bd compact">
		<p>The <a href="http://www.w3.org/International/">Internationalization
		Activity</a> section of the W3C site points to some <a
			href="http://www.w3.org/International/tools/">internationalization-related
		tools</a>.</p>
		<p>In addition to this checker, the W3C offers a number of other
		tools to help you check various types of documents (HTML, XHTML, CSS,
		RDF, P3P, ...), find broken links in your Web pages, and so on. All
		these tools are listed on the W3C's <a
			href="http://www.w3.org/QA/Tools/"><acronym title="Quality Assurance">QA</acronym>
		Toolbox</a>.</p>

		<p>The W3C also hosts a number of other <a
			href="http://www.w3.org/Status">Open Source software projects</a>.</p>
	</div>
</div>

<h3 id="credits">Credits</h3>
<div class="bd compact">
	<p>R. Ishida is maintaining the
	checker at the W3C, using a code base developed with the help of Thomas Gambet.</p>
</div>

</div>

<?php include(PATH_TEMPLATES.'/html/footer.php');
