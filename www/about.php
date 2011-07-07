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
<div style="margin: 1.5em 2.3em 1em;">

<h2>About The W3C Internationalization (i18n) Checker</h2>
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
	<p>The <a href="index.php">W3C Internationalization Checker</a> is a
	free service by <acronym title="World Wide Web Consortium">W3C</acronym>
	that provides information about internationalization features of your
	page, and provides advice on how to improve your use of
    markup for the multilingual Web.</p>
	<p>Getting internationalization features right at the beginning saves a
	lot of time and trouble if you ever need to use your content in a
	language-sensitive way in the future. However, the test will also throw
	up issues that could cause you problems straight away, such as those
	related to character encodings and to non-normalized class and id names.</p>

	<p>The first part of the report for a page lists key
	internationalization settings related to character encoding, language
	declarations, text direction and class/id names. This information
	includes that coming in HTTP headers, which can be particularly useful for
	troubleshooting problems.</p>
	<p>The second part of the report lists errors, warnings and helpful
	suggestions based on your use (or not) of internationalization-related
	markup. The report also points you to resources where you can read more
	about the topic in question.</p>
	<p><strong>The checker is currently a beta release, so please let us know about bugs and missing feature</strong> using the <a href="feedback.html">feedback form</a>. We already have plans to add a number of new features over the coming months, and to translation the user interface.</p>
	
	<p>The information panel at the top of the page should work for most formats. In terms of issue reports, the checker currently targets HTML4, HTML5, and XHTML 1.0/1.1 (served as
	text/html or application/xhtml+xml). It doesn't yet produce issue reports for XHTML5.</p>
	<p>The hope is to eventually merge features of this checker with other
	checkers and validators at the W3C, once it reaches an appropriate level
	of maturity.</p>
</div>

<h3 id="others">References and other resources</h3>

<div>
	<h4>Further reading</h4>
	<ul class="bd compact">
		<li>The <a href="http://www.w3.org/International/technique-index">Techniques
		Index</a> of the Internationalization Activity provides links to
		recommendations and useful resources on a task by task basis. The W3C
		Internationalization Checker reports link back to the part of this
		index that deals with Authoring HTML &amp; CSS whenever possible.</li>
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
		<li>The <a href="http://www.w3.org/Mobile/">W3C's Internationalization
		Activity</a> works with W3C working groups and liaises with other
		organizations to make it possible to use Web technologies with
		different languages, scripts, and cultures. It also provides articles
		and other resources about Web internationalization.</li>
	
		<li>The <a style="" href="/International/ig/">Internationalization
		Interest Group</a>. This is a public list supporting the activity of
		the Internationalization Working Groups. Anyone can participate in the
		Interest Group by simply joining the mailing list.</li>
		<li>The <a href="http://www.multilingualweb.eu/">MultilingualWeb
		project</a> is exploring standards and best practices that support the
		creation, localization and use of multilingual web-based information.
		This project is funded by the European Commission through the ICT PSP
		Grant Agreement No. 250500, and as part of the Competitiveness and
		Innovation Framework Programme. Partners in the project are providing
		feedback on the Internationalization Checker.</li>
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
	<p><a href="http://rishida.net/">Richard Ishida</a> and Thomas Gambet are developing the
	checker at the W3C. The <a href="http://multilingualweb.eu/">MultilingualWeb
	project</a> partners are also providing feedback on the checker.</p>
</div>

</div>

<?php include(PATH_TEMPLATES.'/html/footer.php');
