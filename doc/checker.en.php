<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset="utf-8" />
<title>Internationalization Checker reports</title>
<meta name="description"
 content="Lists information about checks run by the i18n-checker." />
<link rel="copyright" href="#copyright"/>
<script src="https://www.w3.org/International/javascript/articletoc.js" type="text/javascript">
</script>
<style>
.unlinked {
	font-size: 150%;
	color: red;
	line-height: 1.5;
}
</style>
<link rel="stylesheet" href="https://www.w3.org/International/style/article-2016.css" type="text/css" />
<style type="text/css" media="all">
.message h4 {
	margin-left: 0;
	margin-bottom: 0;
	margin-right: 0;
	margin-top: .5em;
}
.message p {
	margin-left: 5.5%;
	margin-right: 0;
	margin-bottom: 0.5em;
	margin-top: 0.5em;
}
.message li {
	margin-top: 0;
	margin-bottom: 0;
}
.formats {
	color: #F63;
}
.formats:before {
	content: '[ ';
}
.formats:after {
	content: ' ]';
}
.message li p {
	margin-left: 0;
	margin-right: 0;
}
.type {
	font-size: 65%;
	margin-left: 5px;
	width: 250px;
}
.message {
	border: 1px solid #CCC;
	border-radius: 20px;
	margin-left: 7.5%;
	margin-right: 32%;
	padding: 30px;
	margin-bottom: 3em;
	position: relative;
}
.message h3 {
	margin-left: 0;
	margin-right: 0;
}
.message ol, .message ul  {
	padding-left: 0;
	margin-left: 3em;
	margin-right: 0;
	}
.message .insidenote {
	margin-top: -2em;
	font-style:italic;
}
.new:before {
	content: 'New!';
}
.update:before {
	content: 'Updated!';
}
.new:before, .update:before {
	position: absolute;
	top: 0;
	right:0;
	font-size: 1.5em;
	padding: 5px 10px;
	line-height: 1;
	background-color: yellow;
	border-radius: 20px;
	box-shadow: 5px 5px 3px #AFABAB;
	margin: 10px 20px 0 0;
	border: 1px solid #ccc;
	}
</style>
</head>
<?php 	
$language = parse_ini_file('../langs/en.properties');
function pr ($text) {
	$result = '';
	$array = (array)$text;
		foreach ($array as $val)
		$result .= '<p>'.$val.'</p>';
		return $result;
	}
$testpath = 'href="../www/check?uri=http%3A%2F%2Flocalhost%2Fgit%2Fi18n-checker%2Ftests%2Fgenerate?test=';
?>
</head>

<body>
<header>
  <nav id="mainNavigation">
    <aside id="mainNavigation">
      <nav id="site-navigation"> <a href="https://www.w3.org/International/"><img id="picture" alt="World map" title="World map" src="https://www.w3.org/International/icons/world.gif" height="61" width="150"></a>
      </nav>
      <nav class="noprint" id="search">
        <form method="get" action="https://www.w3.org/International/site-search.php" enctype="application/x-www-form-urlencoded" style="margin: 0;">
          <div id="searchSite">
            <input name="q" value="I18n site search:" onfocus="this.value=''" id="searchField" accesskey="E" maxlength="255" type="text">
          </div>
        </form>
      </nav>
      <nav id="breadcrumbs">
        <p><a href="https://www.w3.org/International/">Home</a> &gt; <a href="https://www.w3.org/International/resources">Resources</a> &gt; <a href="https://www.w3.org/International/articlelist#characters">Articles</a></p>
      </nav>
      <nav class="noprint" id="toc">
        <h2 id="internal-links" class="notoc"><a href="#internal-links">On this page</a></h2>
    	<div id="toclocation"> </div>
      </nav>
    </aside>
    <nav id="boilerplate">
      <div id="siteicons"><a href="https://www.w3.org/" title="Go to W3C Home Page"><img src="https://www.w3.org/International/icons/w3c_home.gif" alt="Go to W3C Home Page"></a><a href="https://www.w3.org/International/" title="Go to Internationalization Activity Home Page" id="i18n-name">Internationalization</a></div>
      <div id="sitelinks" class="noprint"><a href="https://www.w3.org/International/" title="Internationalization Activity home page.">Home</a>&nbsp; <a href="https://www.w3.org/International/resources" title="Information resources on the Internationalization site.">Resources</a>&nbsp; <a href="https://www.w3.org/International/technique-index" title="Task-based index of i18n techniques.">Techniques</a>&nbsp; <a href="https://www.w3.org/International/resource-index" title="Topic index for information on this site.">Topics</a>&nbsp; <a href="https://www.w3.org/International/log/description" title="Information about news filters and RSS feeds for W3C Internationalization.">News</a>&nbsp; <a href="https://www.w3.org/International/about#scope" title="Groups that make up the Internationalization Activity.">Groups</a>&nbsp; <a href="https://www.w3.org/International/about" title="About the Internationalization Activity.">About</a>&nbsp;	&nbsp; </div>
      <div id="line">&nbsp;</div>
    </nav>
  </nav>
  
<h1>Internationalization Checker reports</h1>
<section>
  <div id="audience">
    <p><span class="leadin">Intended audience:</span> this article is mainly intended for people developing the internationalization checker, but can also be used by those interested in tracking source references quickly for a particular report. </p>
  </div>
  <p>This page lists all the report messages used by the <a href="https://validator.w3.org/i18n-checker/">W3C Internationalization Checker</a>. As well as the text of the report and the severity of the report (with variants), it lists the conditions which trigger that report. It also lists references to articles or specifications that provide authoritative sources for the report.</p>
  <p>Text such as <samp>%1</samp> indicates the location of a list or item of information that will be generated at run time when a page is checked.</p>
  <p>The checker assumes that pages served as <code class="kw" translate="no">text/html</code> are parsed by the browser as HTML5. There are sometimes alternative tests or wording for pages served as <code class="kw" translate="no">application/xhtml+xml</code>, or for XHTML 1.0 pages that might be processed outside the browser as XML.</p>
  <p>This page will be updated from time to time, as new features are added to the checker or existing features are refined.</p>
</section>






<section>
  <h2><a id="httpheader" href="#httpheader">Character encoding: HTTP header</a></h2>
  
  
  <section class="message">
    <?php $checkId='rep_charset_no_in_doc'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> The only encoding information is in the HTTP header.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations#httpheadwhat">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#character-encoding">Polyglot, 3. Specifying a Document's Character Encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/charmod/#C034">Character Model for the World Wide Web, 4.4.1 Mandating a unique character encoding, C034</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="noindoc"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
</section>


<section>
  <h2><a id="bom" href="#bom">Character encoding: BOM</a></h2>
  
  <section class="message update">
    <?php $checkId='rep_charset_bom_found'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/comment.png" alt="Comment:" /> The page has a UTF-8 BOM at the top.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-byte-order-mark">The byte-order mark (BOM) in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#character-encoding">Polyglot, 3. Specifying a Document's Character Encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Notes</h4>
      <ol>
        <li>
          <p>No need to test for UTF-8 BOM with non-UTF-8 encoding, since that's picked up by the multiple encoding test.</p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="bomfound"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="bomfound2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_charset_bom_diff_encoding'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Comment:" /> The page has a UTF-8 BOM at the top and a non-UTF-8 encoding declaration elsewhere.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-byte-order-mark">The byte-order mark (BOM) in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#character-encoding">Polyglot, 3. Specifying a Document's Character Encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Notes</h4>
      <ol>
        <li>
          <p>No need to test for UTF-8 BOM with non-UTF-8 encoding, since that's picked up by the multiple encoding test.</p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="bomdiffencoding"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="bomdiffencoding2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="bomdiffencoding3"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="bomdiffencoding4"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="bomdiffencoding5"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_charset_bom_in_content'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> The page has a UTF-8 BOM below the top of the page.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li>
          <p class="link"><a href="https://www.w3.org/International/questions/qa-byte-order-mark">The byte-order mark (BOM) in HTML</a> <span class="type">article</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="bomdiffencoding5"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_charset_no_visible_charset'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> The page has no xml declaration and no <code class="kw" translate="no">meta</code> declaration, and a utf-8  BOM has been detected.</li>
        <li>NOTE: For non-HTML5 pages, utf-16 bom could also be part of the condition, but this was dropped to align advice for legacy formats with HTML5.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations#quicklookup">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#character-encoding">Polyglot Markup: HTML-Compatible XHTML Documents, 3. Specifying a Document's Character Encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="204"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
</section>


<section>
  <h2><a id="xmldecl" href="#xmldecl">Character encoding: XML declaration</a></h2>
  
  
  <section class="message update">
    <?php $checkId='rep_charset_xml_decl_used'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> <span class="formats">html, xhtml</span> The page has an XML declaration.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <p class="formats">html</p>
      <?php echo pr($language[$checkId.'_expl_html5']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_expl_xhtml']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <p class="formats">html</p>
      <?php echo pr($language[$checkId.'_todo_html']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_todo_xhtml']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/syntax.html#writing">HTML5, 8.1 Writing HTML documents</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#PI-and-xml">Polyglot Markup: HTML-Compatible XHTML Documents, 2. Processing Instructions and the XML Declaration</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_1">XHTML 1.0, C.1. Processing Instructions and the XML Declaration</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_9">XHTML 1.0, C.9. Character Encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xml/#charencoding">XML 1.0, 4.3.3 Character Encoding in Entities</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="205"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  
  <section class="message update">
    <?php $checkId='rep_charset_no_effective_charset'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Warning:" /> <span class="formats">html</span> The page has an XML declaration and no other character encoding declaration.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-markup/syntax.html#character-encoding">HTML: The Markup Language, 4.2. Character encoding declaration</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/syntax.html#writing">HTML5, 8.1 Writing HTML documents</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#PI-and-xml">Polyglot Markup: HTML-Compatible XHTML Documents, 2. Processing Instructions and the XML Declaration</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_1">XHTML 1.0, C.1. Processing Instructions and the XML Declaration</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_9">XHTML 1.0, C.9. Character Encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="206"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
</section>


<section>
  <h2><a id="meta" name="meta">Character encoding: meta declaration</a></h2>
  <section class="message">
    <?php $checkId='rep_charset_pragma'; ?>
    <!--meta character encoding declaration uses http-equiv -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/comment.png" alt="Comment:" /> <span class="formats">html</span> The page contains a <code class="kw" translate="no">meta</code> element with  an <code class="kw" translate="no">http-equiv</code> attribute in the Encoding declaration state.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#attr-meta-http-equiv-content-type">HTML5, 4.2.5.3 Pragma directives</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="207"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  
  <section class="message update">
    <?php $checkId='rep_charset_meta_ineffective'; ?>
    <!-- meta encoding declarations don't work with XML -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/comment.png" alt="Comment:" /> <span class="formats">xml</span> The page contains a <code class="kw" translate="no">meta</code> element with a <code class="kw" translate="no">charset</code> attribute or a <code class="kw" translate="no">meta</code> element with an <code class="kw" translate="no">http-equiv</code> attribute in the Encoding declaration state.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-markup/syntax.html#character-encoding">HTML: The Markup Language, 4.2. Character encoding declaration</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#charset">HTML5, 4.2.5.5 Specifying the document's character encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_9">XHTML 1.0, C.9. Character Encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
      <section>
        <h4>Tests</h4>
        <p>
          <?php $testnum="208"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
        <p>
          <?php $testnum="209"; ?>
          <a target="_blank" <?php echo $testpath; ?>209%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath; ?>209%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath; ?>209%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath; ?>209%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath; ?>209%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      </section>
    </section>
  </section>
  
  <!--div class="section2">
	    <div class="message">
	      <?php $checkId='rep_charset_meta_charset_invalid'; ?> A meta tag with a charset attribute will cause validation to fail 
            <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
	      <div class="h4">
	        <h4>Conditions and severity</h4>
	        <div class="insidenote">[<?php echo $checkId; ?>]</div>
          </div>
	      <ul class="conditions">
	        <li><img src="media/images/warning.png" alt="Warning:" /> <span class="formats">html,xhtml,xhtml10x,xhtml11x</span> The page contains a meta element with a charset attribute.</li>
          </ul>
	      <div class="h4">
	        <h4>Explanation</h4>
          </div>
	      <?php echo pr($language[$checkId.'_expl']); ?>
	      <div class="h4">
	        <h4>What to do</h4>
          </div>
	      <?php echo pr($language[$checkId.'_todo']); ?>
	      <div class="h4">
	        <h4>Further reading</h4>
          </div>
	      <?php echo pr($language[$checkId.'_link']); ?>
	      <div class="h4">
	        <h4>Sources</h4>
          </div>
	      <ol>
	        <li class="w3">
	          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
	        </li>
	        <li class="w3">
	          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_9">XHTML 1.0, C.9. Character Encoding</a> <span class="type">specification</span></p>
            </li>
	        <li class="w3">
	          <p class="link"><a href="https://www.w3.org/TR/html401/charset.html#h-5.2.2">HTML 4.01, 5.2.2 Specifying the character encoding</a> <span class="type">specification</span></p>
            </li>
	      </ol>
	    </div>
      </div-->
  
  <section class="message update">
    <?php $checkId='rep_charset_incorrect_use_meta'; ?>
    <!-- Incorrect use of meta encoding declarations -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Warning:" /> <span class="formats">xml</span> The page contains <em>only</em> a <code class="kw" translate="no">meta</code> element with a <code class="kw" translate="no">charset</code> attribute or a <code class="kw" translate="no">meta</code> element with an <code class="kw" translate="no">http-equiv</code> attribute in the Encoding declaration state, and the encoding specified is not utf8/utf16.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link">This section still to be worked on</p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#character-encoding">Polyglot Markup, 3. Specifying a Document's Character Encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xml/#charencoding">XML 1.0, 4.3.3 Character Encoding in Entities</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="incorrectusemeta"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="incorrectusemeta2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_charset_multiple_meta'; ?>
    <!-- Multiple encoding declarations using the meta tag -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> The page contains more than one <code class="kw" translate="no">meta</code> element used to declare character encoding.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#the-meta-element">HTML5, 4.2.5 The meta element</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/parsing.html#the-input-stream">HTML5, 8.2.2 The input stream</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section>
      <h4>Tests</h4>
      <p>
        <?php $testnum="211"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="212"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="214"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <div class="section2">
    <div class="message">
      <?php $checkId='rep_charset_utf16_meta'; ?>
      <!-- Meta character encoding declaration used in UTF-16 page -->
      <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
      <div class="h4">
        <h4>Conditions and severity</h4>
        <div class="insidenote">[<?php echo $checkId; ?>]</div>
      </div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> <span class="formats">html</span> The page is encoded as UTF16 and a <code class="kw" translate="no">meta</code> encoding declaration is used.</li>
      </ul>
      <div class="h4">
        <h4>Explanation</h4>
      </div>
      <?php echo pr($language[$checkId.'_expl']); ?>
      <div class="h4">
        <h4>What to do</h4>
      </div>
      <?php echo pr($language[$checkId.'_todo']); ?>
      <div class="h4">
        <h4>Further reading</h4>
      </div>
      <?php echo pr($language[$checkId.'_link']); ?>
      <div class="h4">
        <h4>Sources</h4>
      </div>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#charset">HTML5, 4.2.5.5 Specifying the document's character encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </div>
  </div>
  <div class="section2">
    <div class="message">
      <?php $checkId='rep_charset_bogus_utf16'; ?>
      <!-- UTF-16 encoding declaration in a non-UTF-16 document -->
      <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
      <div class="h4">
        <h4>Conditions and severity</h4>
        <div class="insidenote">[<?php echo $checkId; ?>]</div>
      </div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> The page is not encoded as UTF16 and a <code class="kw" translate="no">meta</code> encoding declaration is used.</li>
      </ul>
      <div class="h4">
        <h4>Explanation</h4>
      </div>
      <?php echo pr($language[$checkId.'_expl']); ?>
      <div class="h4">
        <h4>What to do</h4>
      </div>
      <?php echo pr($language[$checkId.'_todo']); ?>
      <div class="h4">
        <h4>Further reading</h4>
      </div>
      <?php echo pr($language[$checkId.'_link']); ?>
      <div class="h4">
        <h4>Sources</h4>
      </div>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/parsing.html#the-input-stream">HTML5, 8.2.2 The input stream</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </div>
  </div>
  <div class="section2">
    <div class="message">
      <?php $checkId='rep_charset_utf16lebe'; ?>
      <!-- UTF-16LE or UTF-16BE found in a character encoding declaration -->
      <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
      <div class="h4">
        <h4>Conditions and severity</h4>
        <div class="insidenote">[<?php echo $checkId; ?>]</div>
      </div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A <code class="kw" translate="no">utf-16be</code> or <code class="kw" translate="no">utf-16le</code> encoding declaration is used in a <code class="kw" translate="no">meta</code> tag, an xml declaration, or a http header.</li>
      </ul>
      <div class="h4">
        <h4>Explanation</h4>
      </div>
      <?php echo pr($language[$checkId.'_expl']); ?>
      <div class="h4">
        <h4>What to do</h4>
      </div>
      <?php echo pr($language[$checkId.'_todo']); ?>
      <div class="h4">
        <h4>Further reading</h4>
      </div>
      <?php echo pr($language[$checkId.'_link']); ?>
      <div class="h4">
        <h4>Sources</h4>
      </div>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xml/#charencoding">XML 1.0, 4.3.3 Character Encoding in Entities</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </div>
  </div>
  <section class="message">
    <?php $checkId='rep_charset_1024_limit'; ?>
    <!-- Character encoding declaration in a meta tag not within 1024 bytes of the file start -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> <span class="formats">html</span> The first <code class="kw" translate="no">meta</code> element with encoding declaration doesn't fit entirely within the first 1024 bytes of the file.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/parsing.html#determining-the-character-encoding">HTML5, 8.2.2.1 Determining the character encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="215"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="216"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
</section>


<section>
  <h2><a id="charset" href="#charset">Character encoding: charset attribute</a></h2>
  
  
  <section class="message update">
    <?php $checkId='rep_charset_charset_attr'; ?>
    <!-- charset attribute used on a or link elements -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> <span class="formats">html</span> A <code class="kw" translate="no">charset</code> attribute is used on a <code class="kw" translate="no">link</code> or an <code class="kw" translate="no">a</code> element.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations#httpheadwhat">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/obsolete.html#non-conforming-features">HTML5, 11.2 Non-conforming features</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="217"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="218"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="219"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
</section>


<section>
  <h2><a id="charother" href="#charother">Character encoding: other</a></h2>
  
  
  <section class="message update">
    <?php $checkId='rep_charset_none'; ?>
    <!-- No character encoding information -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> <span class="formats">html</span> No encoding information found at all.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-markup/syntax.html#character-encoding">HTML: The Markup Language, 4.2. Character encoding declaration</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html51/document-metadata.html#specifying-the-documents-character-encoding">HTML5.1, 4.2.5.5 Specifying the document's character encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#charset">HTML5, 4.2.5.5 Specifying the document's character encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/charset.html#h-5.2.2">HTML 4.01, 5.2.2 Specifying the character encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/charmod/#C034">Character Model for the World Wide Web, 4.4.1 Mandating a unique character encoding, C034</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="220"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_charset_no_encoding_xml'; ?>
    <!-- No in-document encoding declaration found -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> <span class="formats">xml</span> No encoding information found at all.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-encoding-declarations">Declaring character encodings in HTML</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#character-encoding">Polyglot Markup: HTML-Compatible XHTML Documents, 3. Specifying a Document's Character Encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/charmod/#C034">Character Model for the World Wide Web, 4.4.1 Mandating a unique character encoding, C034</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="221"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_charset_no_utf8'; ?>
    <!-- Non-UTF-8 character encoding declared -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> Any type of character encoding declaration found that doesn't declare the encoding to be UTF-8.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-choosing-encodings">Choosing &amp; applying a character encoding</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#charset">HTML5, 4.2.5.5 Specifying the document's character encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#character-encoding">Polyglot Markup: 3. Specifying a Document's Character Encoding</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum=222; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum=223; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum=224; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum=225; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_charset_legacy'; ?>
    <!-- Non-preferred name used for legacy character encoding  -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Warning:" /> Any type of character encoding declaration found with a name that isn't the preferred name in the Encoding spec.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-choosing-encodings">Choosing &amp; applying a character encoding</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#charset">HTML5, 4.2.5.5 Specifying the document's character encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href='https://encoding.spec.whatwg.org/#names-and-labels'>Encoding Spec: Names and labels</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum=226; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum=227; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum=228; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum=229; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_charset_unknown'; ?>
    <!-- Non-preferred name used for legacy character encoding  -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Warning:" /> Any type of character encoding declaration found with a name that isn't listed in the Encoding spec.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-choosing-encodings">Choosing &amp; applying a character encoding</a> <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#charset">HTML5, 4.2.5.5 Specifying the document's character encoding</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href='https://encoding.spec.whatwg.org/#names-and-labels'>Encoding Spec: Names and labels</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum=230; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum=231; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
</section>


<section>
  <h2><a id="langattr" href="#langattr">Language: attributes</a></h2>
  
  
  <section class="message update">
    <?php $checkId='rep_lang_missing_html_attr'; ?>
    <!-- A tag uses an xml:lang attribute without an associated lang attribute-->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> <span class="formats">html</span> In any tag there is an <code class="kw" translate="no">xml:lang</code> attribute but no <code class="kw" translate="no">lang</code> attribute.</li>
      </ul>
    </section>
    <section>
      <h4>What to do</h4>
      <p class="formats">html5</p>
      <?php echo pr($language[$checkId.'_expl_html']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_expl_xhtml']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <p class="formats">html5</p>
      <?php echo pr($language[$checkId.'_todo_html']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_todo_xhtml']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language['rep_lang_missing_attr_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-lang-and-xml:lang-attributes">HTML5, 3.2.3.3 The lang and xml:lang attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_7">XHTML 1.0, C.7. The lang and xml:lang Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml11/doctype.html#s_doctype">XHTML 1.1, 3. The XHTML 1.1 Document Type</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      </p>
      <p>
        <?php $testnum="missinghtmlattr"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  
  <section class="message update">
    <!-- A tag uses a lang attribute without an associated xml:lang attribute -->
    <?php $checkId='rep_lang_missing_xml_attr'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Warning:" /> <span class="formats">xml</span> In any tag there is a <code class="kw" translate="no">lang</code> attribute but no <code class="kw" translate="no">xml:lang</code> attribute.</li>
        <li><img src="media/images/warning.png" alt="Warning:" /> <span class="formats">xhtml</span> as above.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <p class="formats">xml</p>
      <?php echo pr($language[$checkId.'_expl_xml']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_expl_xhtml']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <p class="formats">xml</p>
      <?php echo pr($language[$checkId.'_todo_xml']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_todo_xhtml']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language['rep_lang_missing_attr_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_7">XHTML 1.0, C.7. The lang and xml:lang Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml11/doctype.html#s_doctype">XHTML 1.1, 3. The XHTML 1.1 Document Type</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/REC-xml/#sec-lang-tag">XML 1.0, 2.12 Language Identification</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="missingxmlattr"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_lang_conflict'; ?>
    <!-- A lang attribute value did not match an xml:lang value when they appeared together on the same tag. -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> In any tag the <code class="kw" translate="no">lang</code> and <code class="kw" translate="no">xml:lang</code> attributes don't match.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-lang-and-xml:lang-attributes">HTML5, 3.2.3.3 The lang and xml:lang attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_7">XHTML 1.0, C.7. The lang and xml:lang Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml11/doctype.html#s_doctype">XHTML 1.1, 3. The XHTML 1.1 Document Type</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="langconflict"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="langconflict2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_lang_no_lang_attr'; ?>
    <!-- The html tag has no language attribute -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> The <code class="kw" translate="no">html</code> tag has no <code class="kw" translate="no">xml:lang</code> attribute and no <code class="kw" translate="no">lang</code> attribute.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <p class="formats">html</p>
      <?php echo pr($language[$checkId.'_todo_html']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_todo_xhtml']); ?>
      <p class="formats">xml</p>
      <?php echo pr($language[$checkId.'_todo_xml']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-lang-and-xml:lang-attributes">HTML5, 3.2.3.3 The lang and xml:lang attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.1">HTML 4.01, 8.1 Specifying the language of content: the lang attribute</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_7">XHTML 1.0, C.7. The lang and xml:lang Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml11/doctype.html#s_doctype">XHTML 1.1, 3. The XHTML 1.1 Document Type</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/REC-xml/#sec-lang-tag">XML 1.0, 2.12 Language Identification</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="nolangattr"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  <section class="message">
    <?php $checkId='rep_lang_html_no_effective_lang'; ?>
    <!-- The language declaration in the html tag will have no effect -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> <span class="formats">html</span> The <code class="kw" translate="no">html</code> tag has no <code class="kw" translate="no">lang</code> attribute, but has an <code class="kw" translate="no">xml:lang</code> attribute.</li>
        <li><img src="media/images/warning.png" alt="Warning:" /> <span class="formats">xml</span> The <code class="kw" translate="no">html</code> tag has no <code class="kw" translate="no">xml:lang</code> attribute, but has a <code class="kw" translate="no">lang</code> attribute.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <p class="formats">html</p>
      <?php echo pr($language[$checkId.'_todo_html']); ?>
      <p class="formats">xhtml</p>
      <?php echo pr($language[$checkId.'_todo_xhtml']); ?>
      <p class="formats">xml</p>
      <?php echo pr($language[$checkId.'_todo_xml']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-lang-and-xml:lang-attributes">HTML5, 3.2.3.3 The lang and xml:lang attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.1">HTML 4.01, 8.1 Specifying the language of content: the lang attribute</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_7">XHTML 1.0, C.7. The lang and xml:lang Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/xhtml11/doctype.html#s_doctype">XHTML 1.1, 3. The XHTML 1.1 Document Type</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/REC-xml/#sec-lang-tag">XML 1.0, 2.12 Language Identification</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="htmlnoeffectivelang"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="htmlnoeffectivelang2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  <!--div class="section2"> removed because html4 is same as html5 now
    <div class="message">
      <?php $checkId='rep_lang_xml_attr_in_html'; ?> This HTML file contains xml:lang attributes
            <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
      <div class="h4">
        <h4>Conditions and severity</h4>
        <div class="insidenote">[<?php echo $checkId; ?>]</div>
      </div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> <span class="formats">html</span> In any tag there is an xml:lang attribute.</li>
      </ul>
      <div class="h4">
        <h4>Explanation</h4>
      </div>
      <?php echo pr($language[$checkId.'_expl']); ?>
      <div class="h4">
        <h4>What to do</h4>
      </div>
      <?php echo pr($language[$checkId.'_todo']); ?>
      <div class="h4">
        <h4>Further reading</h4>
      </div>
      <?php echo pr($language[$checkId.'_link']); ?>
      <div class="h4">
        <h4>Sources</h4>
      </div>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
			      <li class="w3">
			        <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-lang-and-xml:lang-attributes">HTML5, 3.2.3.3 The lang and xml:lang attributes</a> <span class="type">specification</span></p>
			      </li>
			      <li class="w3">
			        <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
			      </li>
			      <li class="w3">
			        <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.1">HTML 4.01, 8.1 Specifying the language of content: the lang attribute</a> <span class="type">specification</span></p>
			      </li>
			      <li class="w3">
			        <p class="link"><a href="https://www.w3.org/TR/xhtml1/#C_7">XHTML 1.0, C.7. The lang and xml:lang Attributes</a> <span class="type">specification</span></p>
			      </li>
			      <li class="w3">
			        <p class="link"><a href="https://www.w3.org/TR/xhtml11/doctype.html#s_doctype">XHTML 1.1, 3. The XHTML 1.1 Document Type</a> <span class="type">specification</span></p>
			      </li>
      </ol>
    </div>
  </div-->
  
  <section class="message update">
    <?php $checkId='rep_lang_malformed_attr'; ?>
    <!-- A language attribute value was incorrectly formed -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> Any tag that has an <code class="kw" translate="no">xml:lang</code> or <code class="kw" translate="no">lang</code> attribute with a value that is not just a-zA-Z0-9 plus hyphen.</li>
        <li>Also, any tag that has an initial subtag with more than three characters.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="http://www.rfc-editor.org/rfc/bcp/bcp47.txt">Internet-Draft: BCP 47</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-lang-and-xml:lang-attributes">HTML5, 3.2.3.3 The lang and xml:lang attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.1">HTML 4.01, 8.1 Specifying the language of content: the lang attribute</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/REC-xml/#sec-lang-tag">XML 1.0, 2.12 Language Identification</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="malformedattr"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="malformedattr2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
        <p><?php $testnum="malformedattr3"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_lang_subtag_invalid'; ?>
    <!-- A language subtag is invalid -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A language subtag is invalid.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.rfc-editor.org/rfc/bcp/bcp47.txt">Internet-Draft: BCP 47</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-lang-and-xml:lang-attributes">HTML5, 3.2.3.3 The lang and xml:lang attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.1">HTML 4.01, 8.1 Specifying the language of content: the lang attribute</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/REC-xml/#sec-lang-tag">XML 1.0, 2.12 Language Identification</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="subtagInvalid"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
    </section>
  </section>
  
  
</section>
  <section class="message new">
    <?php $checkId='rep_lang_grandfathered'; ?>
    <!-- A language attribute uses a grandfathered value -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A language attribute uses a grandfathered value.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="http://www.rfc-editor.org/rfc/bcp/bcp47.txt">Internet-Draft: BCP 47</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="grandfathered"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
    </section>
  </section>
  
  
</section>
  <section class="message new">
    <?php $checkId='rep_lang_zhCNTW'; ?>
    <!-- A language attribute uses a grandfathered value -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A language attribute uses a grandfathered value.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/articles/language-tags/#script"><cite>The script subtag</cite>, in Language tags in HTML and XML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="http://www.rfc-editor.org/rfc/bcp/bcp47.txt">Internet-Draft: BCP 47</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="zhCNTW"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
      <p>
        <?php $testnum="zhCNTW2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
    </section>
  </section>
  
  
</section>
<section>
  <h2><a id="contentlang" name="contentlang">Language: Content-Language meta</a></h2>
  
  
  <section class="message update">
    <?php $checkId='rep_lang_content_lang_meta'; ?>
    <!-- Content-Language meta element used to set the default document language -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> The page contains a <code class="kw" translate="no">meta</code> element with the <code class="kw" translate="no">http-equiv</code> attribute set to <code class="kw" translate="no">Content-Language</code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/semantics.html#pragma-directives">HTML5, 4.2.5.3 Pragma directives</a> <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html-polyglot/#language-attributes">Polyglot markup, 7.2 Language Attributes</a> <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="contentlangmeta"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
      <p>
        <?php $testnum="contentlangmeta2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>"</p>
    </section>
  </section>
</section>
<section>
  <h2><a id="nonlatin" href="#nonlatin">Non-Latin attribute values</a></h2>
  <section class="message">
    <?php $checkId='rep_latin_non_nfc'; ?>
    <!-- Class or id names found that are not in Unicode Normalization Form C -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> Non-NFC text found in a <code class="kw" translate="no">class</code> or <code class="kw" translate="no">id</code> attribute.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      </div>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-html-css-normalization">Unicode normalization forms</a > <span class="type">article</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="nonnfc"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
</section>
<section>
  <h2><a id="markup" href="#markup">Markup: general</a></h2>
  <section class="message">
    <?php $checkId='rep_markup_tags_no_class_b'; ?>
    <!-- b tags found with no class attribute -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/comment.png" alt="Comment:" /> A <code class="kw" translate="no">b</code> tag is found without a <code class="kw" translate="no">class</code> attribute.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-b-and-i-tags.en.php">Using &lt;b&gt; and &lt;i&gt; tags</a > <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-b-element">HTML5, 4.6.17 The b element</a > <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-i-element">HTML5, 4.6.16 The i element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="bitagsnoclass"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  <section class="message">
    <?php $checkId='rep_markup_tags_no_class_i'; ?>
    <!-- i tags found with no class attribute -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/comment.png" alt="Comment:" /> An <code class="kw" translate="no">i</code> tag is found without a <code class="kw" translate="no">class</code> attribute.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/questions/qa-b-and-i-tags.en.php">Using &lt;b&gt; and &lt;i&gt; tags</a > <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-b-element">HTML5, 4.6.17 The b element</a > <span class="type">article</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-i-element">HTML5, 4.6.16 The i element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="bitagsnoclass2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_control_escapes'; ?>
    <!-- Escaped characters addressing control code range -->
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A numeric character reference points to the C0 or C1 range.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html51/dom.html#kinds-of-content-phrasing-content">HTML5.1, 3.2.4.2.5. Phrasing content</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="controlEscapes"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_translate_incorrect'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> One or more <code class="kw" translate="no">translate</code> attributes have incorrect values<code class="kw" translate="no"></code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://w3c.github.io/html/dom.html#the-translate-attribute">HTML5, 3.2.5.4. The translate attribute</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="translateIncorrect"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_align'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> One or more <code class="kw" translate="no">align</code> attributes have been used on elements in the markup.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html51/obsolete.html#obsolete-but-conforming-features">HTML5.1, 11.1. Obsolete but conforming features</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="align"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_surrogate_escapes'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> The markup contains character references for surrogate characters.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://w3c.github.io/html/dom.html#the-translate-attribute">HTML5, 3.2.5.4. The translate attribute</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="surrogateEscapes"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
    </section>
  </section>

</section>


<section>
  <h2><a id="direction" href="#direction">Markup: direction</a></h2>
  
  
  <section class="message">
    <?php $checkId='rep_markup_dir_incorrect'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A <code class="kw" translate="no">dir</code> attribute contains values that are not <code class="kw" translate="no">rtl</code>, <code class="kw" translate="no">ltr</code> or <code class="kw" translate="no">auto</code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl_html']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-dir-attribute">HTML5, 3.2.3.5 The dir attribute</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2">HTML 4.01, 8.2 Specifying the direction of text and tables: the dir attribute</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
      <section class="tests">
        <h4>Tests</h4>
        <p>
          <?php $testnum="dirIncorrect"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_dir_default'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/comment.png" alt="Info:" /> The <code class="kw" translate="no">html</code> tag has a language attribute with one of the following values, <code class="kw" translate="no">ar</code>, <code class="kw" translate="no">fa</code>, <code class="kw" translate="no">ur</code>, <code class="kw" translate="no">ckb</code>, <code class="kw" translate="no">he</code>, <code class="kw" translate="no">ug</code>, <code class="kw" translate="no">dv</code>, <code class="kw" translate="no">ps</code>, <code class="kw" translate="no">nqo</code>, <code class="kw" translate="no">syr</code>, or any language tag that includes the <code class="kw" translate="no">Arab</code> script tag. There is no <code class="kw" translate="no">dir</code> attribute on the <code class="kw" translate="no">html</code> tag, but there are <code class="kw" translate="no">dir</code> attributes elsewhere on the page.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-dir-attribute">HTML5, 3.2.3.5 The dir attribute</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2">HTML 4.01, 8.2 Specifying the direction of text and tables: the dir attribute</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
      <section class="tests">
        <h4>Tests</h4>
        <p>
          <?php $testnum="dirDefault"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
        <p>
          <?php $testnum="dirDefault2"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
        <p>
          <?php $testnum="dirDefault3"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
        <p>
          <?php $testnum="dirDefault4"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_no_dir'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="warning:" /> The <code class="kw" translate="no">html</code> tag has a language attribute with one of the following values, <code class="kw" translate="no">ar</code>, <code class="kw" translate="no">fa</code>, <code class="kw" translate="no">ur</code>, <code class="kw" translate="no">ckb</code>, <code class="kw" translate="no">he</code>, <code class="kw" translate="no">ug</code>, <code class="kw" translate="no">dv</code>, <code class="kw" translate="no">ps</code>, <code class="kw" translate="no">nqo</code>, <code class="kw" translate="no">syr</code>, or any language tag that includes the <code class="kw" translate="no">Arab</code> script tag. There is no <code class="kw" translate="no">dir</code> attribute on the <code class="kw" translate="no">html</code> tag, nor elsewhere on the page.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-dir-attribute">HTML5, 3.2.3.5 The dir attribute</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2">HTML 4.01, 8.2 Specifying the direction of text and tables: the dir attribute</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
      <section class="tests">
        <h4>Tests</h4>
        <p>
          <?php $testnum="noDir"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_css_direction'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> The page has a <code class="kw" translate="no">style</code> attribute that specifies a <code class="kw" translate="no">direction</code> property.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/elements.html#the-dir-attribute">HTML5, 3.2.3.5 The dir attribute</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2">HTML 4.01, 8.2 Specifying the direction of text and tables: the dir attribute</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
      <section class="tests">
        <h4>Tests</h4>
        <p>
          <?php $testnum="cssDirection"; ?>
          <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      </section>
  </section>
  
  
  <section class="message">
    <?php $checkId='rep_markup_bdo_no_dir'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A <code class="kw" translate="no">bdo</code> tag exists with no <code class="kw" translate="no">dir</code> attribute.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-bdo-element">HTML5, 4.6.24 The bdo element</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2.4">HTML 4.01, 8.2.4 Overriding the bidirectional algorithm: the BDO element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="bdoNoDir"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
    
    
  </section>
  <section class="message new">
    <?php $checkId='rep_markup_bdo_auto'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/error.png" alt="Error:" /> A <code class="kw" translate="no">bdo</code> tag has a <code class="kw" translate="no">dir</code> with the value <code class="kw" translate="no">auto</code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-bdo-element">HTML5, 4.6.24 The bdo element</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2.4">HTML 4.01, 8.2.4 Overriding the bidirectional algorithm: the BDO element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="bdoAuto"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_bogus_dir_entities'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Error:" /> The page contains one of the following named character references, or the uppercase equivalent: <code class="kw" translate="no">&amp;rle;, &amp;lre;, &amp;pdf;, &amp;rli;, &amp;lri;, &amp;fsi;, &amp;pdi;, &amp;rlo;, &amp;lro;</code><code class="kw" translate="no"></code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-bdo-element">HTML5, 4.6.24 The bdo element</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2.4">HTML 4.01, 8.2.4 Overriding the bidirectional algorithm: the BDO element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="bogusDirEntities"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_dir_control_codes'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> The page contains one or more Unicode code points that are used as directional controls<code class="kw" translate="no"></code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-bdo-element">HTML5, 4.6.24 The bdo element</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2.4">HTML 4.01, 8.2.4 Overriding the bidirectional algorithm: the BDO element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="dirControls"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
        <?php $testnum="dirControls2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
        <?php $testnum="dirControls3"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
        <?php $testnum="dirControls4"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_dir_escapes'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/comment.png" alt="Info:" /> The page contains one or more character references for directional controls<code class="kw" translate="no"></code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-bdo-element">HTML5, 4.6.24 The bdo element</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2.4">HTML 4.01, 8.2.4 Overriding the bidirectional algorithm: the BDO element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="dirControls"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
        <?php $testnum="dirControls2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
        <?php $testnum="dirControls3"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
        <?php $testnum="dirControls4"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  <section class="message new">
    <?php $checkId='rep_markup_dir_unbalanced'; ?>
    <h3><?php echo '<a id="'.$checkId.'" href="#'.$checkId.'">'.$language[$checkId].'</a>'; ?></h3>
    <section>
      <h4>Conditions and severity</h4>
      <div class="insidenote">[<?php echo $checkId; ?>]</div>
      <ul class="conditions">
        <li><img src="media/images/warning.png" alt="Warning:" /> The page contains an odd number of paired directional controls<code class="kw" translate="no"></code>.</li>
      </ul>
    </section>
    <section>
      <h4>Explanation</h4>
      <?php echo pr($language[$checkId.'_expl']); ?>
    </section>
    <section>
      <h4>What to do</h4>
      <?php echo pr($language[$checkId.'_todo']); ?>
    </section>
    <section>
      <h4>Further reading</h4>
      <?php echo pr($language[$checkId.'_link']); ?>
    </section>
    <section>
      <h4>Sources</h4>
      <ol>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/International/tutorials/language-decl/">Declaring Language in XHTML and HTML</a ><span class="type">tutorial</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html5/text-level-semantics.html#the-bdo-element">HTML5, 4.6.24 The bdo element</a > <span class="type">specification</span></p>
        </li>
        <li class="w3">
          <p class="link"><a href="https://www.w3.org/TR/html401/struct/dirlang.html#h-8.2.4">HTML 4.01, 8.2.4 Overriding the bidirectional algorithm: the BDO element</a > <span class="type">specification</span></p>
        </li>
      </ol>
    </section>
    <section class="tests">
      <h4>Tests</h4>
      <p>
        <?php $testnum="dirUnbalanced"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
      <p>
        <?php $testnum="dirUnbalanced2"; ?>
        <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html%26serveas=html">HTML4</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=html5%26serveas=html">HTML5</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=html">XHTML1.0</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml%26serveas=xml">XHTML1.0x</a> &bull; &nbsp; <a target="_blank" <?php echo $testpath.$testnum; ?>%26format=xhtml11%26serveas=xml">XHTML1.1x</a>" </p>
    </section>
  </section>
  
  
  
</section>
<aside class="section" id="survey">
  <p>Tell us what you think.</p>
  <p><a class="interaction" target="_blank" href="https://github.com/w3c/i18n-checker/issues">Leave a comment</a></p>
  <p style="margin-top:1em">Follow our news feed.</p>
  <p><a class="interaction" href="http://twitter.com/webi18n" title="Twitter: @webi18n"><img src="https://www.w3.org/International/icons/twitter-bird.png" style="vertical-align: middle;" alt=" ">@webi18n</a></p>
  <p><a class="interaction" href="https://www.w3.org/blog/International/feed/rdf/" title="RSS"><img src="https://www.w3.org/International/icons/rssLink.png" alt=" ">RSS</a></p>
</aside>
<section>
  <h2><a id="materials" href="#materials">Other introductory materials</a></h2>
  <p>We have recently published a <a href="https://www.w3.org/International/getting-started/">Getting Started</a> page to help you find information on the site.
    The Getting Started page points to a series of articles that are underway, and that provide newcomers with a gentle introduction to key
    internationalization topics and point to basic information on the site to get you going. </p>
</section>


<footer><address><p>By: Richard Ishida, W3C. </p></address><small id="version">Content first published <time datetime="2011-07-08">2011-07-08  18:08</time>
. Last substantive update <time datetime="2016-08-22T14:19Z">2016-08-22  14:19 GMT</time>. This version <time datetime="2016-08-22T14:19Z">2016-08-22  14:19 GMT</time></small>	<small>For the history of document changes, see the <a href="https://www.w3.org/blog/International/tag/article-checker/">news feed</a> for substantive changes, and the <a href="https://github.com/w3c/i18n-checker/commits/master">Github commit list</a> for all changes since Jan 2016.</small><small class="copyright" lang="en"><a rel="Copyright" href="/Consortium/Legal/ipr-notice#Copyright" id="copyright">Copyright</a> © 2008-2016 <a href="/"><abbr title="World Wide Web Consortium">W3C</abbr></a><sup>®</sup> (<a href="http://www.csail.mit.edu/"><abbr title="Massachusetts Institute of Technology">MIT</abbr></a>, <a href="http://www.ercim.eu/"><abbr title="European Research Consortium for Informatics and Mathematics">ERCIM</abbr></a>, <a href="http://www.keio.ac.jp/">Keio</a>, <a href="http://ev.buaa.edu.cn/">Beihang</a>), All Rights Reserved. W3C <a href="/Consortium/Legal/ipr-notice#Legal_Disclaimer">liability</a>, <a href="/Consortium/Legal/ipr-notice#W3C_Trademarks">trademark</a>, <a rel="Copyright" href="/Consortium/Legal/copyright-documents">document use</a> and <a rel="Copyright" href="/Consortium/Legal/copyright-software">software licensing</a> rules apply. Your interactions with this site are in accordance with our <a href="/Consortium/Legal/privacy-statement#Public">public</a> and <a href="/Consortium/Legal/privacy-statement#Members">Member</a> privacy statements.</small>	</footer>


<script type="text/javascript">if (document.getElementById('toclocation')) { createtoc(); }</script>
</body>
</html>
