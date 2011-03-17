<?php
	

// headings for report text
$s_explanation = '<p class="desctitle">Explanation</p>';
$s_whattodo = '<p class="desctitle">What to do</p>';
$s_furtherreading = '<p class="desctitle">Further reading</p>';


#============================== CHARACTER ENCODINGS =================================

// Summary
// No character encoding information
// Non-UTF8 character encoding declared
// Conflicting character encoding declarations
// Multiple encoding declarations using the meta tag.
// UTF-8 BOM found at start of file
// BOM found in content
// No in-document encoding found

// TBD
// Use of utf-16be/le or other non-recommended encoding
// v.nu "No explicit character encoding declaration has been seen yet (assumed windows-1252) but the document contains non-ASCII. At line 26, column 19 v class="test">Ã½Ã¤Ã¨"
// xml declaration in html file
// meta encoding declaration in xml file
// v.nu "The charset attribute on the a element is obsolete. Use an HTTP Content-Type header on the linked resource instead."
// encoding declaration not within the first 512 bytes


// No character encoding information
$no_encoding_title = "No character encoding information.";
$no_encoding_msg = <<<eot
	$s_explanation
	<p>There is no declaration or byte-order mark to indicate the character encoding of the page. You should always specify the encoding used for an HTML page. If you don't, you risk that characters in your content will be incorrectly interpreted. This is not just an issue of human readability, increasingly machines need to understand your data too.</p>
	$s_whattodo
	<p>Add information to indicate the character encoding of the page.</p>
	$s_furtherreading
	<a href='http://www.w3.org/International/techniques/authoring-html#gscharset'>Character encodings explained</a><br />
	<a href='/International/techniques/authoring-html#indoc'>Declaring the character encoding in an X/HTML document</a>
eot;

		
// Non-UTF8 character encoding declared
$utf8_not_used_title = "Non-UTF8 character encoding declared.";
$utf8_not_used_msg = <<<eot
	$s_explanation
	<p>The page currently uses the following character encoding declarations that refer to non-Unicode character encodings:</p>
	<ol>
	$nonUTF8
	</ol>
	<p>A Unicode character encoding makes it easier to use a wide range of characters, from the registered trademark symbol to characters in multiple languages.  It also simplifies the use of scripts and databases for multilingual sites, and allows you to more easily expand your site to cover new languages, when needed. Using non-UTF-8 encodings can also have unexpected results on form submission and URL encodings, which use the document's character encoding by default. It is not a requirement to use UTF-8, but the HTML5 specification <a href="http://dev.w3.org/html5/spec/Overview.html#charset">recommends</a> its use, and you should consider it.</p>
	$s_whattodo
	<p>Save your content as UTF-8, and change the encoding declarations.</p>
	$s_furtherreading
	<p><a href='http://www.w3.org/International/techniques/authoring-html#gscharset'>Character encodings explained</a><br />
	<a href='http://www.w3.org/International/techniques/authoring-html#choosing'>Choosing a character encoding</a><br />
	<a href='http://www.w3.org/International/techniques/authoring-html#changing'>Changing the encoding of a document</a></p>
eot;

		
// Conflicting character encoding declarations
$encoding_conflicts_title = 'Conflicting character encoding declarations.';
$encoding_conflicts_msg = <<<eot
$s_explanation
	<p>The following character encoding declarations are inconsistent:</p>
	<ol>
	$encodingslist
	</ol>
	<p>Browsers will apply precedence rules to determine the character encoding to use for the page, but this may not be the encoding you intended.</p>
	$s_whattodo
	<p>Change the character encoding declarations so that they match.  Ensure that your document is actually saved in the encoding you choose.</p>
	$s_furtherreading
	<p><a href='http://www.w3.org/International/techniques/authoring-html#gscharset'>Character encodings explained</a><br />
	<a href='http://www.w3.org/International/techniques/authoring-html#choosing'>Choosing a character encoding</a><br />
	<a href='http://www.w3.org/International/techniques/authoring-html#changing'>Changing the encoding of a document</a></p>
eot;
$http_conflict_msg = <<<eot
	<p>Note, in particular, that the character encoding is declared in the HTTP header is <code>{$char_encoding['http']['value']}</code>.  This declaration will override all others.  To find out how to change the HTTP header declaration, see XXX.</p>
eot;

// Multiple encoding declarations using the meta tag.
$multiple_httpequiv_charset_title = 'Multiple encoding declarations using the meta tag.';
$multiple_httpequiv_charset_msg = <<<eot
	$s_explanation
	<p>One document has to have a single character encoding, and you only need one meta element to declare the character encoding. This page has the following list of meta elements containing character encoding declarations:</p>
	<ol class="detail">
	$morehttpequivs
	</ol>
	$s_whattodo
	<p>Edit the markup to remove all but one meta element.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gscharset'>Character encodings explained</a><br />
	<a href='/International/techniques/authoring-html#indoc'>Declaring the character encoding in an X/HTML document</a>
	</p>
eot;

// UTF-8 BOM found at start of file
$bom_at_start_title = 'UTF-8 BOM found at start of file.';
$bom_at_start_msg = <<<eot
	$s_explanation
	<p>The UTF-8 Byte Order Mark (BOM) was found at the beginning of the page.  It can sometimes introduce blank spaces or short sequences of strange-looking characters (such as ï»¿).</p>
	$s_whattodo
	<p>Using an editor or an appropriate tool, remove the byte order mark from the beginning of the file. This can often be achieved by saving the document with the appropriate settings in the editor. On the other hand, some editors (such as Notepad on Windows) do not give you a choice, and always add the byte order mark. In this case you may need to use a different editor.</p>
	$s_furtherreading
	<p>
	<a href='/International/techniques/authoring-html#bomhandling'>Handling the byte-order mark</a><br />
	</p>
eot;


// BOM found in content
$bom_in_content_title = 'BOM found in content.';
$bom_in_content_msg = <<<eot
	$s_explanation
	<p>The UTF-8 Byte Order Mark (BOM) was found below the top of the page.  This is often caused when the BOM is at the top of a file or chunk of content that is included into a page. It can sometimes introduce blank spaces or short sequences of strange-looking characters (such as ï»¿).</p>
	$s_whattodo
	<p>Using an editor or an appropriate tool, remove the byte order mark from the beginning of the file or chunk of content where it appears. This can often be achieved by saving the content with appropriate settings in the editor. On the other hand, some editors (such as Notepad on Windows) do not give you a choice, and always add the byte order mark. In this case you may need to use a different editor.</p>
	$s_furtherreading
	<p>
	<a href='/International/techniques/authoring-html#bomhandling'>Handling the byte-order mark</a><br />
	</p>
eot;


// No in-document encoding found
$no_indoc_encoding_title = 'No in-document encoding found.';
$no_indoc_encoding_msg = <<<eot
	$s_explanation
	<p>A character encoding is specified in the HTTP header (<code>{$char_encoding['http']['value']}</code>), but there was no matching encoding declaration in the page. The well-formedness status of this document may change when decoupled from the external encoding information.</p>
	$s_whattodo
	<p>Add information to indicate the character encoding of the page inside the page itself.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gscharset'>Character encodings explained</a><br />
	<a href='/International/techniques/authoring-html#indoc'>Declaring the character encoding in an X/HTML document</a>
	</p>
eot;



#============================== LANGUAGE TAGS =================================


// The html tag has no language attribute
$html_no_lang_title = "The html tag has no language attribute.";
$html_no_lang_msg = <<<eot
	$s_explanation
	<p>There is no effective language attribute in the html tag.</p>
	<p><code>$htmltag</code></p>
	<p>A language attribute on the html tag sets the default natural language for the page.  This information can be used for processing the content in various ways, including such things as spell-checking, accessibility, data formatting, and choice of styles for rendering the page. Every page should have the correct default language specified.</p>
	<p>For HTML files, this should be a lang attribute.  xml:lang should only be used for XHTML pages.</p>
eot;
$html_no_lang_msg02 = <<<eot
	<p>The page does declare the <code>$metacontentlangValue</code> language in the meta Content-Language element <code>$metacontentlangTag</code>, however, this meta element should not be used to set the default language for content, and is not recognised by all user agents. You should always use a language attribute on the html tag to set the default language for content.</p>
eot;
$html_no_lang_msg03 = <<<eot
	$s_whattodo
	<p>Add a lang attribute that indicates the default language of your page.</p>
	<p>Example: <code>lang="de"</code></p>
eot;
$html_no_lang_msg04 = <<<eot
	$s_whattodo
	<p>Since this is an XHTML page served as HTML, add both a lang attribute and an xml:lang attribute to the html tag to indicate the default language of your page.  The lang attribute is understood by HTML processors, but not by XML processors, and vice versa.</p>
	<p>Example: <code>lang="de" xml:lang="de"</code></p>
eot;
$html_no_lang_msg05 = <<<eot
	$s_furtherreading
	<p>
	<a href='/International/techniques/authoring-html#gslang'>Language declarations explained</a><br />
	<a href='/International/techniques/authoring-html#textprocessing'>Using attributes to declare language</a><br />
	<a href='/International/techniques/authoring-html#langvalues'>Choosing language values</a>
	</p>
eot;


// The lang attribute and the xml:lang attribute in the html tag have different values
$lang_xmllang_conflict_in_html_title = "The lang attribute and the xml:lang attribute in the html tag have different values.";
$lang_xmllang_conflict_in_html_msg = <<<eot
	$s_explanation
	<p>The lang value is <code>$htmllangValue</code> and the xml:lang value is <code>$htmlxmllangValue</code> in the html tag:</p><p><code>$htmltag</code></p>
	$s_whattodo
	<p>Change one of the values by editing the markup.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gslang'>Language declarations explained</a><br />
	<a href='/International/techniques/authoring-html#textprocessing'>Using attributes to declare language</a><br />
	</p>
eot;


// This HTML file contains xml:lang attributes
$xmllang_in_html_title = "This HTML file contains xml:lang attributes.";
$xmllang_in_html_msg = <<<eot
	$s_explanation
	<p>The page contains xml:lang attributes in the following places:</p>
	<ol>$s_inappropriate_xmllang</ol>
	<p>xml:lang is not a valid attribute unless you are using XHTML.</p>
	$s_whattodo
	<p>Remove the xml:lang attributes from the markup, replacing them, where appropriate, with lang attributes.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gslang'>Language declarations explained</a><br />
	<a href='http://www.w3.org/International/techniques/authoring-html#langvalues'>Choosing language values</a></p>
eot;

// A lang attribute value did not match an xml:lang value when they appeared together on the same tag.
$lang_xmllang_mismatch_title = "A lang attribute value did not match an xml:lang value when they appeared together on the same tag.";
$lang_xmllang_mismatch_msg = <<<eot
	$s_explanation
	<p>In the following tag or tags the language values of the lang and xml:lang attributes don't match:</p>
	<ol>$s_mismatchedlanguagevalues</ol>
	$s_whattodo
	<p>Change one of the values by editing the markup.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gslang'>Language declarations explained</a><br />
	<a href='http://www.w3.org/International/techniques/authoring-html#langvalues'>Choosing language values</a></p>
eot;

// A language attribute value was incorrectly formed.
$non_wellformed_lang_title = "A language attribute value was incorrectly formed.";
$non_wellformed_lang_msg = <<<eot
	$s_explanation
	<p>In the following tag or tags the language values of the lang and xml:lang attributes are not well-formed according to BCP47. Attributes values must contain a maximum of one language tag, and a language tag is composed of one or more subtags taken from the IANA Language Subtag Registry, separated by hyphens (eg. <code>zh-Hans-SG</code>).</p>
	<ol>$s_incorrectvalues</ol>
	$s_whattodo
	<p>Change the attribute values to conform to BCP47 syntax rules.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gslang'>Language declarations explained</a><br />
	<a href='http://www.w3.org/International/techniques/authoring-html#langvalues'>Choosing language values</a></p>
eot;




// A tag uses a lang attribute without an associated xml:lang attribute.
$lang_no_xmllang_title = "A tag uses a lang attribute without an associated xml:lang attribute.";
$lang_no_xmllang_msg = <<<eot
	$s_explanation
	<p>In the following tag or tags the lang attribute is not accompanied by an xml:lang attribute. This may cause problems if you try to process an XHTML page as XML, since XML processors don't recognise lang, but do recognise xml:lang.  It is for this reason that the XHTML specification recommends that you use both.</p>
	<ol>$s_langonlyarray</ol>
	$s_whattodo
	<p>Add an xml:lang attribute to each of the above tags, with the same value as the lang attribute.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gslang'>Language declarations explained</a><br />
	<a href='/International/techniques/authoring-html#textprocessing'>Using attributes to declare language</a>
	</p>
eot;



// A tag uses an xml:lang attribute without an associated lang attribute.
$xmllang_no_lang_title = "A tag uses an xml:lang attribute without an associated lang attribute.";
$xmllang_no_lang_msg = <<<eot
	$s_explanation
	<p>In the following tag or tags the xml:lang attribute is not accompanied by a lang attribute. This may cause problems if you try to display an XHTML page as HTML, since HTML parsers don't recognise xml:lang, but they do recognise lang.</p>
	<ol>$s_xmllangonlyarray</ol>
	$s_whattodo
	<p>Add a lang attribute to each of the above tags, with the same value as the xml:lang attribute.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/techniques/authoring-html#gslang'>Language declarations explained</a><br />
	<a href='/International/techniques/authoring-html#textprocessing'>Using attributes to declare language</a>
	</p>
eot;


// This XHTML file contains lang attributes
$lang_in_xhtml_title = "This XHTML file contains lang attributes.";
$lang_in_xhtml_msg = "<p>lang is not a valid attribute for an document that is not XHTML 1.0. It is recommended that you remove the xml:lang attributes from the markup. See XXX</p>"; 



#============================== TEXT DIRECTION =================================


// Incorrect values used for dir attribute
$incorrect_dir_values_title = "Incorrect values used for dir attribute.";
$incorrect_dir_values_msg = <<<eot
	$s_explanation
	<p>In the following tag or tags the value should be one of 'rtl' or 'ltr':</p>
	<ol>
	$dirmismatches
	</ol>
	$s_whattodo
	<p>Correct the attribute values.</p>
	$s_furtherreading
	<p>
	<a href='/International/techniques/authoring-html#gsdirection'>Markup for text direction explained</a><br />
	<a href='/International/techniques/authoring-html#using'>Setting up a right-to-left page</a><br />
	<a href='/International/techniques/authoring-html#blocks'>Changing the direction of a block element</a><br />
	<a href='/International/techniques/authoring-html#inline'>Mixing text direction inline</a>
	</p>
eot;

	

#============================== MISC =================================

// are there non-NFC class or id names?
$non_nfc_class_id_title = "Class or id names found that are not in Unicode Normalization&nbsp;Form&nbsp;C.";
$non_nfc_class_id_msg = <<<eot
	$s_explanation
	<p>Unicode allows you to represent certain letters using different combinations of bytes. For example é can be represented as LATIN SMALL LETTER E WITH ACUTE or as LATIN SMALL LETTER E followed by COMBINING ACUTE ACCENT. To avoid problems when trying to match class or id names against CSS selectors, or for JavaScript lookup, all your markup tags and CSS and JavaScript code should use the same byte combinations for the same text, ie. be normalised.</p>
	<p>Total number of non-NFC names: <strong>$nonnfcnamectr</strong>.</p>
	<p><button id='nfcdisplaybutton' onclick='document.getElementById("nonnfcclassorid").style.display = "block"; this.style.display = "none"; return false;'>Show list</button></p>
	<ol id='nonnfcclassorid' style='display:none;' class='detail'>$nonnfcnames</ol>
	$s_whattodo
	<p>It is recommended to save all content as Unicode Normalization Form C (NFC).</p>
	$s_furtherreading
	<p>
	<a href='/International/tutorials/tutorial-char-enc/temp#n11n'>Unicode normalization forms</a>
	</p>
eot;


// <b> tags found in source
$b_tags_title = "&lt;b> tags found with no class attribute.";
$b_tags_msg = <<<eot
	$s_explanation
	<p>One or more &lt;b> tags that don't use a class attribute were found in the source code for this page. These tags may cause problems for localization if the content for which they are used has more than one semantic value.</p>
	<p>Total number of &lt;b> tags: <strong>$totalbtags</strong>.</p>
	<p>Number of &lt;b> tags without a class attribute: <strong>$btagcount</strong>.</p>
	$s_whattodo
	<p>You should not use &lt;b> tags if there is a more descriptive and relevant tag available. If you do use them, it is usually better to add class attributes that describe the intended meaning of the markup, so that you can distinguish one use from another.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/questions/qa-b-and-i-tags.en.php'>Using &lt;b> and &lt;i> tags</a>
	</p>
eot;


// <i> tags found in source
$i_tags_title = "&lt;i> tags found with no class attribute.";
$i_tags_msg = <<<eot
	$s_explanation
	<p>One or more &lt;i> tags that don't use a class attribute were found in the source code for this page. These tags may cause problems for localization if the content for which they are used has more than one semantic value.</p>
	<p>Total number of &lt;i> tags: <strong>$totalitags</strong>.</p>
	<p>Number of &lt;i> tags without a class attribute: <strong>$itagcount</strong>.</p>
	$s_whattodo
	<p>You should not use &lt;i> tags if there is a more descriptive and relevant tag available. If you do use them, it is usually better to add class attributes that describe the intended meaning of the markup, so that you can distinguish one use from another.</p>
	$s_furtherreading
	<p>
	<a href='http://www.w3.org/International/questions/qa-b-and-i-tags.en.php'>Using &lt;b> and &lt;i> tags</a>
	</p>
eot;


