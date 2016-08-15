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
    troubleshooting problems</p>
	<p>Please let us know about bugs and missing features using the <a href="feedback.html">feedback form</a>. </p>
	
	<p>The information panel at the top of the page should work for most formats. The checker outputs tailored advice for HTML5, HTML4, and XHTML 1.0/1.1  (served as
	text/html or application/xhtml+xml).</p>
</div>

<h3 id="others">References and other resources</h3>

<div>
	<h4>Further reading</h4>
	<ul class="bd compact">
		<li>The <a href="http://www.w3.org/International/technique-index">Techniques
		Index</a> of the Internationalization Activity provides links to
		recommendations and useful resources on a task by task basis. The W3C
		Internationalization Checker reports link back to the part of this
	  index that deals with Authoring HTML &amp; CSS.</li>
		<li>You can track the report suggestions back to authoritative sources using the page <a href="http://www.w3.org/International/quicktips/checker">Internationalization Checker reports</a>.</li>
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
		Activity</a> works with W3C working groups and liaises with other
		organizations to make it possible to use Web technologies with
		different languages, scripts, and cultures. It also provides articles
		and other resources about Web internationalization.</li>
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
		<p>In addition to this checker, the W3C is offering a number of other
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
	<p>Richard Ishida is maintaining the
	checker at the W3C, using a code base developed by him and Thomas Gambet.</p>
</div>

</div>

<?php include(PATH_TEMPLATES.'/html/footer.php');
