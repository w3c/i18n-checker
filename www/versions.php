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

<h2>Change log for the W3C Internationalization (i18n) Checker</h2>
<p>This page documents changes to the checker. The page <a href="https://www.w3.org/International/quicktips/doc/checker">Internationalization Checker reports</a> lists all checks made, with the report messages and links to tests. New and updated checks listed below link to that page for details.</p>
<p>Please let us know about bugs and missing features using the <a href="https://github.com/w3c/i18n-checker/issues">feedback form</a>. Detailed change logs can be found in the <a href="https://github.com/w3c/i18n-checker/commits/master">GitHub commit list</a>.</p>
<h3 id="about">Version 2</h3>

<div class="bd compact">
	<p>Version 2 of the checker moves away from checking against particular specifications to checking how a page will work in a browser. For the most part, it assumes that pages will be parsed using an HTML5 compliant parser. Pages served as application/xhtml+xml have some significant differences with regards to character encoding and language declarations, however, and these are taken into account if the checker detects that the page being checked is served as XML.</p>
	<p>The following new checks were added. Follow the links for details.</p>
	<ul style="margin-left:3em;">
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_charset_bom_diff_encoding">UTF-8 BOM disagrees with another declaration</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_charset_legacy">Non-preferred name used for legacy character encoding</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_charset_unknown">Character encoding declaration named an unsupported encoding</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_lang_subtag_invalid">A language subtag is invalid</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_lang_grandfathered">A language attribute uses a grandfathered value</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_lang_zhCNTW">A language attribute uses zh-CN or zh-TW</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_control_escapes">Escaped characters addressing control code range</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_translate_incorrect">Incorrect values used for translate attribute</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_surrogate_escapes">Incorrect character escapes for supplementary characters</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_dir_default">Consider using dir='rtl' on the html tag</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_no_dir">No rtl markup found</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_css_direction">CSS is being used to set direction</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_bdo_auto">bdo tag found with dir attribute set to auto</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_bogus_dir_entities">Invalid directional named character entities found</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_dir_control_codes">Found Unicode code points for directional controls</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_dir_escapes">Found escape sequences for paired directional controls</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_markup_dir_unbalanced">Unpaired directional controls found</a></li>
    </ul>
		<p> The descriptive text was updated for the following check results, mostly to incorporate new recommendations post HTML5, or to accommodate the change in focus mentioned above.</p>
	<ul style="margin-left:3em;">
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#bom">Character encoding: BOM</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#xmldecl">Character encoding: XML declaration</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_charset_no_effective_charset">No effective character encoding information</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_charset_meta_ineffective">meta encoding declarations don't work with XML</a></li>
	  <li><a href="">Incorrect use of meta encoding declarations</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_charset_charset_attr">charset attribute used on a or link elements</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_charset_none">No character encoding information</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_lang_missing_html_attr">A tag uses an xml:lang attribute without an associated lang attribute</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_lang_missing_xml_attr">A tag uses a lang attribute without an associated xml:lang attribute</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_lang_malformed_attr">A language attribute value was incorrectly formed</a></li>
	  <li><a href="https://www.w3.org/International/quicktips/doc/checker#rep_lang_content_lang_meta">Content-Language meta element used</a></li>
    </ul>
<p>New rows were added to the information  table:</p>
	<ul style="margin-left:3em;">
	  <li>All language tags: lists all language tags used in the page. If you click on any of the language tags listed, you are taken to the Language Subtag Lookup tool, which provides information about validity of the subtags used, lists their meaning, and provides additional usage tips.</li>
	  <li>Unicode control codes: lists directional controls used in the document, with a frequency count for each. The list is divided to reflect actual characters vs. numeric character references vs. named character references.</li>
	  <li>Notable attributes: lists attributes used that are typically associated with  features needed by an international audience.</li>
	  <li>Notable elements: the same, but for elements.</li>
    </ul>
</div>
<p>This software is licensed under the terms of the <a href="https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document">W3C Software and Document Notice and License</a>.
    The source code is available <a href="https://github.com/w3c/i18n-checker">on GitHub</a>.</p>
</div>

<?php include(PATH_TEMPLATES.'/html/footer.php');
