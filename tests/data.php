<?php
$test = array();


#Notes
# There should always be: title, assert, test, next
# Optional extras:
#   htmlattributes: usually lang, xml:lang, or dir, will be added to html tag, if not present a default will be supplied
#   htmldir: usually lang, xml:lang, or dir, will be added to html tag, if not present a default will be supplied
#	metaencodingdecls: write your own meta encoding declarations to appear in the head - if not present, defaults are supplied
#	contentlanguagep: write your own Content-Language meta elements to appear in the head - if not present, nothing is supplied
#   httpheader: the encoding part of the header, eg. charset=iso-8859-1
#   xmldeclaration: eg. <?xml version="1.0" encoding="utf-8" ?  (add the > too, missed it here because screws up editor)
#   addutf8bom: adds to beginning of file, use any string (i used 'yes')
#   header: produces an HTTP header, indicate the whole header, eg. Content-Language: ko






$test[51]=array(
'title'=>'UTF-16 pragma, non-UTF-16 encoding',
'assert'=>"",
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=utf-16" />',
'test'=>'<div class="test">Nothing to see here.</div>',
'next'=>'52');

$test[52]=array(
'title'=>'UTF-16 charset, non-UTF-16 encoding',
'assert'=>"",
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="utf-16" />',
'test'=>'<div class="test">Nothing to see here.</div>',
'next'=>'53');



# Encodings (new style)

$test["allfullup"]=array(
'title'=>'all_full_up',
'httpheader'=>'charset=windows-1252',
'xmldeclaration'=>'<?xml version="1.0" encoding="windows-1253"?>',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=windows-1254" />'."\n".'<meta charset="windows-1255" />',
'addutf8bom'=>'yes',
'test'=>'<div class="test">The only encoding information is in the HTTP header.</div>',
);




$test["noindoc"]=array(
'title'=>'rep_charset_no_in_doc',
'httpheader'=>'charset=utf-8',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'test'=>'<div class="test">The only encoding information is in the HTTP header.</div>',
);

$test["bomfound"]=array(
'title'=>'rep_charset_bom_found',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'addutf8bom'=>'yes',
'test'=>'<div class="test">The page has a UTF-8 BOM at the top.</div>',
);

$test["bomfound2"]=array(
'title'=>'rep_charset_bom_found',
'httpheader'=>'charset=utf-8',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'addutf8bom'=>'yes',
'test'=>'<div class="test">The page has a UTF-8 BOM at the top, and HTTP is set to utf-8.</div>',
);

$test[203]=array(
'title'=>'rep_charset_bom_in_content',
'test'=>'<div class="test">
	<p>The page has a UTF-8 BOM below the top of the page.</p>
	<p>Here is some random text, and here comes the BOM /﻿/. Ok, test that.</p>
	</div>'
);

$test[204]=array(
'title'=>'rep_charset_no_visible_charset',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'addutf8bom'=>'yes',
'test'=>'<div class="test">The page has no xml declaration and no meta declaration, and a utf-8 BOM has been detected.</div>',
);

$test[205]=array(
'title'=>'rep_charset_xml_decl_used',
'httpheader'=>'utf-8',
'xmldeclaration'=>'<?xml version="1.0" encoding="utf-8"?>',
'metaencodingdecls'=>'',
'test'=>'<div class="test">The page has an XML declaration.</div>',
);

$test[206]=array(
'title'=>'rep_charset_no_effective_charset',
'httpheader'=>'',
'xmldeclaration'=>'<?xml version="1.0" encoding="utf-8"?>',
'metaencodingdecls'=>'',
'test'=>'<div class="test">The page has an XML declaration and no other character encoding declaration.</div>',
);

$test[207]=array(
'title'=>'rep_charset_pragma',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
'test'=>'<div class="test">The page has an XML declaration and no other character encoding declaration.</div>',
);

$test[208]=array(
'title'=>'rep_charset_meta_ineffective',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
'test'=>'<div class="test">The page contains a meta element with a charset attribute or a meta element with an http-equiv attribute in the Encoding declaration state.</div>',
);

$test[209]=array(
'title'=>'rep_charset_meta_ineffective',
'metaencodingdecls'=>'<meta charset="utf-8" />',
'test'=>'<div class="test">The page contains a meta element with a charset attribute or a meta element with an http-equiv attribute in the Encoding declaration state.</div>',
);

$test["incorrectusemeta"]=array(
'title'=>'rep_charset_incorrect_use_meta',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />',
'test'=>'<div class="test">The page contains <em>only</em> a meta element with a meta element with an http-equiv attribute in the Encoding declaration state, and the encoding specified is not utf8/utf16.</div>'
);

$test["incorrectusemeta2"]=array(
'title'=>'rep_charset_incorrect_use_meta',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="iso-8859-15" />',
'test'=>'<div class="test">The page contains <em>only</em> a meta element with a charset attribute in the Encoding declaration state, and the encoding specified is not utf8/utf16.</div>'
);

$test[211]=array(
'title'=>'rep_charset_multiple_meta',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="utf-8" />'."\n".'<meta charset="utf-8" />',
'test'=>'<div class="test">
	<p>The page contains more than one meta element used to declare character encoding.</p>
	<p>Two meta charsets.</p>
	</div>'
	);

$test[212]=array(
'title'=>'rep_charset_multiple_meta',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'."\n".'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
'test'=>'<div class="test">
	<p>The page contains more than one meta element used to declare character encoding.</p>
	<p>Two pragmas.</p>
	</div>'
	);

$test[214]=array(
'title'=>'rep_charset_multiple_meta',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'."\n".'<meta charset="utf-8" />',
'test'=>'<div class="test">
	<p>The page contains more than one meta element used to declare character encoding.</p>
	<p>One meta charset, one pragma.</p>
	</div>'
	);

$test[215]=array(
'title'=>'rep_charset_1024_limit',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta name="description" content="This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file." /><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />',
'test'=>'<div class="test">The first meta element with encoding declaration doesn\'t fit entirely within the first 1024 bytes of the file.</div>',
);

$test[216]=array(
'title'=>'rep_charset_1024_limit',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta name="description" content="This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.This is a long piece of text before the character encoding declaration, which is intended to push the end of the declaration itself just more than 1024 bytes from the end of the file.And a bit more." /><meta charset="utf-8" />',
'test'=>'<div class="test">The first meta element with encoding declaration doesn\'t fit entirely within the first 1024 bytes of the file.</div>',
);

$test[217]=array(
'title'=>'rep_charset_charset_attr',
'metaencodingdecls'=>'<meta charset="utf-8" />',
'test'=>'<div class="test"><p>A <a charset="utf-8" href="http://www.w3.org/International/">charset attribute</a>is</p><p>used on an <a charset="is-8859-1" href="http://www.w3.org/International/">anchor</a>.</p></div>',
);

$test[218]=array(
'title'=>'rep_charset_charset_attr',
'metaencodingdecls'=>'<meta charset="utf-8" />',
'contentlanguagep'=>'<link charset="utf-8" rel="stylesheet" type="text/css" href="list-style.css" />',
'test'=>'<div class="test">is used on a link element</div>',
);

$test[219]=array(
'title'=>'rep_charset_charset_attr',
'metaencodingdecls'=>'<meta charset="utf-8" />',
'contentlanguagep'=>'<link charset="utf-8" rel="stylesheet" type="text/css" href="list-style.css" />',
'test'=>'<div class="test"><p>A <a charset="utf-8" href="http://www.w3.org/International/">charset attribute</a> is</p><p>used on <a charset="is-8859-1" href="http://www.w3.org/International/">both</a> a link and an anchor.</p></div>',
);

$test[220]=array(
'title'=>'rep_charset_none',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'test'=>'<div class="test">No encoding information found at all.</div>',
);

$test[221]=array(
'title'=>'rep_charset_none',
'httpheader'=>'',
'xmldeclaration'=>'<?xml version="1.0"?>',
'metaencodingdecls'=>'',
'test'=>'<div class="test">No encoding information found at all.</div>',
);

$test[222]=array(
'title'=>'rep_charset_no_utf8',
'httpheader'=>'charset=iso-8859-15',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'test'=>'<div class="test"><p>Any type of character encoding declaration found that doesn\'t declare the encoding to be UTF-8.</p><p>ISO 8859-15 set for HTTP.</div>',
);

$test[223]=array(
'title'=>'rep_charset_no_utf8',
'httpheader'=>'',
'xmldeclaration'=>'<?xml version="1.0" encoding="iso-8859-15"?>',
'metaencodingdecls'=>'',
'test'=>'<div class="test"><p>Any type of character encoding declaration found that doesn\'t declare the encoding to be UTF-8.</p><p>ISO 8859-15 set for xml declaration.</div>',
);

$test[224]=array(
'title'=>'rep_charset_no_utf8',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />',
'test'=>'<div class="test"><p>Any type of character encoding declaration found that doesn\'t declare the encoding to be UTF-8.</p><p>ISO 8859-15 set for meta http-equiv.</div>',
);

$test[225]=array(
'title'=>'rep_charset_no_utf8',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="iso-8859-15" />',
'test'=>'<div class="test"><p>Any type of character encoding declaration found that doesn\'t declare the encoding to be UTF-8.</p><p>ISO 8859-15 set for meta charset.</div>',
);

$test[226]=array(
'title'=>'rep_charset_legacy',
'httpheader'=>'charset=csisolatin3',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'test'=>'<div class="test"><p>Any type of character encoding declaration found with a name that isn\'t the preferred name in the Encoding spec.</p><p>csisolatin3 set for HTTP.</div>',
);

$test[227]=array(
'title'=>'rep_charset_legacy',
'httpheader'=>'',
'xmldeclaration'=>'<?xml version="1.0" encoding="ISO_8859-3:1988"?>',
'metaencodingdecls'=>'',
'test'=>'<div class="test"><p>Any type of character encoding declaration found with a name that isn\'t the preferred name in the Encoding spec.</p><p>ISO_8859-3:1988 set for xml declaration.</div>',
);

$test[228]=array(
'title'=>'rep_charset_legacy',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />',
'test'=>'<div class="test"><p>Any type of character encoding declaration found with a name that isn\'t the preferred name in the Encoding spec.</p><p>ISO 8859-1 set for meta http-equiv.</div>',
);

$test[229]=array(
'title'=>'rep_charset_legacy',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="csisolatin3" />',
'test'=>'<div class="test"><p>Any type of character encoding declaration found with a name that isn\'t the preferred name in the Encoding spec.</p><p>csisolatin3 set for meta charset.</div>',
);

$test[230]=array(
'title'=>'rep_charset_legacy',
'httpheader'=>'charset=myencoding',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'test'=>'<div class="test"><p>Any type of character encoding declaration found with a name that isn\'t listed in the Encoding spec.</p><p>myencoding set for HTTP.</div>',
);

$test[231]=array(
'title'=>'rep_charset_unknown',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="myencoding" />',
'test'=>'<div class="test"><p>Any type of character encoding declaration found with a name that isn\'t listed in the Encoding spec.</p><p>myencoding set for meta charset.</div>',
);


$test["bomdiffencoding"]=array(
'title'=>'rep_charset_bom_diff_encoding',
'httpheader'=>'charset=windows-1252',
'xmldeclaration'=>'',
'metaencodingdecls'=>'',
'addutf8bom'=>'yes',
'test'=>'<div class="test"><p>The page has a UTF-8 BOM at the top and a non-UTF-8 encoding declaration elsewhere.</p><p>HTTP is set to windows-1252.</p></div>',
);

$test["bomdiffencoding2"]=array(
'title'=>'rep_charset_bom_diff_encoding',
'httpheader'=>'',
'xmldeclaration'=>'<?xml version="1.0" encoding="windows-1252"?>',
'metaencodingdecls'=>'',
'addutf8bom'=>'yes',
'test'=>'<div class="test"><p>The page has a UTF-8 BOM at the top and a non-UTF-8 encoding declaration elsewhere.</p><p>XML declaration is set to windows-1252.</p></div>',
);

$test["bomdiffencoding3"]=array(
'title'=>'rep_charset_bom_diff_encoding',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />',
'addutf8bom'=>'yes',
'test'=>'<div class="test"><p>The page has a UTF-8 BOM at the top and a non-UTF-8 encoding declaration elsewhere.</p><p>http-equiv is set to windows-1252.</p></div>',
);

$test["bomdiffencoding4"]=array(
'title'=>'rep_charset_bom_diff_encoding',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="windows-1252" />',
'addutf8bom'=>'yes',
'test'=>'<div class="test"><p>The page has a UTF-8 BOM at the top and a non-UTF-8 encoding declaration elsewhere.</p><p>charset is set to windows-1252.</p></div>',
);

$test["bomdiffencoding5"]=array(
'title'=>'rep_charset_bom_diff_encoding',
'httpheader'=>'',
'xmldeclaration'=>'',
'metaencodingdecls'=>'<meta charset="utf-8" />',
'addutf8bom'=>'yes',
'test'=>'<div class="test"><p>The page has a UTF-8 BOM at the top and a non-UTF-8 encoding declaration elsewhere.</p><p>charset is set to utf-8, so this should not produce an error.</p></div>',
);




# Language


$test["missingxmlattr"]=array(
'title'=>'rep_lang_missing_xml_attr',
'test'=>'<div class="test"><p lang="en">In any tag there is a lang attribute but no <span lang="fr">xml:lang attribute</span>.</p></div>',
);

$test["missinghtmlattr"]=array(
'title'=>'rep_lang_missing_html_attr',
'test'=>'<div class="test"><p xml:lang="en">In any tag there is an xml:lang attribute but no <span xml:lang="fr">lang attribute</span>.</p></div>',
);

$test["langconflict"]=array(
'title'=>'rep_lang_conflict',
'test'=>'<div class="test"><p xml:lang="en" lang="fr">In any tag the lang and xml:lang attributes <span lang="en" xml:lang="fr">don\'t match</span>.</p></div>',
);

$test["langconflict2"]=array(
'title'=>'rep_lang_conflict',
'test'=>'<div class="test"><p xml:lang="en-GB" lang="en">In any tag the lang and xml:lang attributes <span lang="fr-CA" xml:lang="fr">don\'t match</span>.</p></div>',
);

$test["nolangattr"]=array(
'title'=>'rep_lang_no_lang_attr',
'htmlattributes'=>"",
'test'=>"<div class='test'>The html tag has no xml:lang attribute and no lang attribute.</div>",
);

$test["htmlnoeffectivelang"]=array(
'title'=>'rep_lang_html_no_effective_lang',
'htmlattributes'=>"xml:lang='en'",
'test'=>"<div class='test'>The html tag has no lang attribute, but has an xml:lang attribute.</div>",
);

$test["htmlnoeffectivelang2"]=array(
'title'=>'rep_lang_html_no_effective_lang',
'htmlattributes'=>"lang='en'",
'test'=>"<div class='test'>The html tag has no xml:lang attribute, but has a lang attribute.</div>",
);

$test["malformedattr"]=array(
'title'=>'rep_lang_malformed_attr',
'test'=>"<div class='test'>Any tag that has an xml:lang or lang attribute with a value that is not just a-zA-Z0-9 plus hyphen.".
'<p title="Armenian : Armenian" lang="hy, my" class="phrase">armenian text</p>'.
'<p title="Armenian : Armenian" lang="hy my" class="phrase">armenian text</p>'.
'<p title="Canadian Syllabics : Inuktitut" lang="iu_CA" class="phrase">inuktitut text</p></div>',
);

$test["malformedattr2"]=array(
'title'=>'rep_lang_malformed_attr',
'test'=>"<div class='test'>Any tag that has an xml:lang or lang attribute with a value that is not just a-zA-Z0-9 plus hyphen.".
'<p title="Armenian : Armenian" xml:lang="hy, my" class="phrase">armenian text</p>'.
'<p title="Armenian : Armenian" xml:lang="hy my" class="phrase">armenian text</p>'.
'<p title="Canadian Syllabics : Inuktitut" xml:lang="iu_CA" class="phrase">inuktitut text</p></div>',
);

$test["malformedattr3"]=array(
'title'=>'rep_lang_malformed_attr',
'test'=>"<div class='test'>Lang tags have language subtag longer than 3 chars.".
'<p title="1 of 2" lang="putonghua" >text</p>'.
'<p title="2 of 4" lang="putonghua-Hans">text</p>'.
'<p title="should not show" xml:lang="cmn-Hans">text</p>'.
'<p title="3 of 4" xml:lang="putonghua" >text</p>'.
'<p title="4 of 4" xml:lang="putonghua-Hans">text</p>'.
'<p title="should not show" xml:lang="cmn-Hans">text</p>
</div>',
);


$test["contentlangmeta"]=array(
'title'=>'rep_lang_content_lang_meta',
'contentlanguagep'=>'<meta http-equiv="Content-Language" content="ko" />',
'test'=>"<div class='test'>The page contains a meta element with the http-equiv attribute set to Content-Language.</div>",
);

$test["contentlangmeta2"]=array(
'title'=>'rep_lang_content_lang_meta',
'header'=>'Content-Language: ko',
'test'=>"<div class='test'>The HTTP header contains Content-Language: ko.</div>",
);

$test["charsetInfo"]=array(
'title'=>'Testing info panel for charset',
'httpheader'=>'charset=utf-8',
'xmldeclaration'=>'<?xml version="1.0" encoding="utf-8"?>',
'metaencodingdecls'=>'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta charset="utf-8" />',
'test'=>"<div class='test'>UTF-8 declared for HTTP, xml declaration and two metas.</div>",
);




# Character-based tests

# test nonnfc is in non-nfc.php
# open that with a non-normalizing editor!


$test["nonlatin"]=array(
'title'=>'rep_non_latin_chars',
'assert'=>"Tests recognition of non-ASCII characters",
'test'=>'<div class="test">
	<p title="Latin : Hungarian" class="phrase Nemzetköziesítés">Nemzetköziesítés Fejlesztési Terület, W3C</p>
    <p title="Myanmar: Burmese" class="လှွားကွန်">အပြည်ပြည်ဆိုင်ရာလှုပ်ရှားမှု၊ W3C</p>
    <p id="လွှားကွန်">အပြည်ပြည်ဆိုင်ရာလှုပ်ရှားမှု၊ W3C</p>
    <p title="Latin : Welsh" class="phrase" id="Terület">Gweithgaredd rhyngwladoli, W3C (Consortiwm y We Fyd-Eang)</p>
    <div title="Tamil" id="கோ">தணநஷசழ</p>
    <div class="கோ">தணநஷசழ</p>
    <div title="Vietnamese" class="cằn" >Đằm kởn ngế</p>
    <p id="cằn" >Đằm kởn ngế</p>
	</div>',
);




# Markup

$test["bitagsnoclass"]=array(
'title'=>'rep_markup_tags_no_class',
'test'=>'<div class="test"><p><b>This is bold text</b> but this is not. This is <b>bolded with no class attribute</b>, whereas <b class="control">this has a class attribute</b>.</p></div>',
);

$test["bitagsnoclass2"]=array(
'title'=>'rep_markup_tags_no_class',
'test'=>'<div class="test"><p><i>This is italic text</i> but this is not. This is <i>italicised with no class attribute</i>, whereas <i class="control">this has a class attribute</i>.</p></div>',
);


$test["dirIncorrect"]=array(
'title'=>'rep_markup_dir_incorrect',
'test'=>'<div class="test"><p>Here is some Arabic text: <span dir="rlm">نشاط التدويل، W3C</span>, <span dir="rtl">نشاط التدويل، W3C</span>.</p><p><p>Here is the same Arabic text with auto <span dir="automatic">نشاط التدويل، W3C</span>. And here is auto on a paragraph:</p><p dir="AUTO">نشاط التدويل، W3C</p></div>'
);

$test["bdoNoDir"]=array(
'title'=>'rep_markup_bdo_no_dir',
'test'=>'<div class="test"><p>A <bdo dir="rtl">bdo tag</bdo> exists <bdo>with no dir attribute</bdo>.</p><p><bdo dir="rtl">نشاط التدويل، W3C</bdo>.</p><p><bdo>نشاط التدويل، W3C</bdo></p></div>'
);

$test["bdoAuto"]=array(
'title'=>'rep_markup_bdo_auto',
'test'=>'<div class="test"><p>A <bdo dir="rtl">bdo tag</bdo> exists <bdo dir="auto">with no dir set to auto</bdo>.</p><p><bdo dir="rtl">نشاط التدويل، W3C</bdo>.</p><p><bdo dir="auto">نشاط التدويل، W3C</bdo></p></div>'
);

$test["dirDefaultRTL"]=array(
'title'=>'dir rtl in html tag',
'htmldir'=>"dir='rtl'",
'test'=>'<div class="test">Dir is set to rtl on html tag.</div>',
);

$test["dirDefaultLTR"]=array(
'title'=>'dir ltr in html tag',
'htmldir'=>"dir='ltr'",
'test'=>'<div class="test">Dir is set to rtl on html tag.</div>',
);

$test["noDirDefault"]=array(
'title'=>'no dir in html tag',
'test'=>'<div class="test">No dir is set on html tag.</div>',
);

$test["bogusDirEntities"]=array(
'title'=>'rep_markup_bogus_dir_entities',
'test'=>'<div class="test"><p>embedded &lre; ‫نشاط التدويل، W3C‬ &pdf; and &rle; ‫نشاط التدويل، W3C‬ &pdf;</p><p>isolated: &rli; ‫نشاط التدويل، W3C‬ &pdi; and &lri; ‫نشاط التدويل، W3C‬ &pdi; and &fsi; ‫نشاط التدويل، W3C‬ &pdi;</p><p>EMBEDDED &LRE; ‫نشاط التدويل، W3C‬ &PDF; AND &RLE; ‫نشاط التدويل، W3C‬ &PDF;</p><p>ISOLATED: &RLI; ‫نشاط التدويل، W3C‬ &PDI; AND &LRI; ‫نشاط التدويل، W3C‬ &PDI; AND &FSI; ‫نشاط التدويل، W3C‬ &PDI;</p>.</div>',
);

$test["dirControls"]=array(
'title'=>'rep_markup_dir_controls',
'test'=>'<div class="test"><p>embedded 
&#x202B;نشاط التدويل، W3C&#x202C;
&#x202A;نشاط التدويل، W3C&#x202C;
‫نشاط التدويل، W3C‬
‪نشاط التدويل، W3C‬
</p>.</div>',
);

$test["dirControls2"]=array(
'title'=>'rep_markup_dir_controls',
'test'=>'<div class="test"><p>isolated 
&#x2066;نشاط التدويل، W3C&#x2069;
&#x2067;نشاط التدويل، W3C&#x2069;
&#x2068;نشاط التدويل، W3C&#x2069;
⁦نشاط التدويل، W3C⁩
⁧نشاط التدويل، W3C⁩
⁨نشاط التدويل، W3C⁩
</p>.</div>',
);

$test["dirControls3"]=array(
'title'=>'rep_markup_dir_controls',
'test'=>'<div class="test"><p>overrides 
&#x202D;نشاط التدويل، W3C&#x202C;
&#x202E;نشاط التدويل، W3C&#x202C;
‭نشاط التدويل، W3C‬
‮نشاط التدويل، W3C‬
</p>.</div>',
);

$test["dirControls4"]=array(
'title'=>'rep_markup_dir_controls',
'test'=>'<div class="test"><p>rlm/lrm 
&#x200E;نشاط التدويل، W3C
&#x200F;نشاط التدويل، W3C
&lrm;نشاط التدويل، W3C
&rlm;نشاط التدويل، W3C
‎نشاط التدويل، W3C
‏نشاط التدويل، W3C
</p>.</div>',
);

$test["dirUnbalanced"]=array(
'title'=>'rep_markup_dir_controls',
'test'=>'<div class="test"><p>unbalanced escaped rli 
&#x2066;نشاط التدويل، W3C
⁦نشاط التدويل، W3C⁩
</p>.</div>',
);

$test["dirUnbalanced2"]=array(
'title'=>'rep_markup_dir_controls',
'test'=>'<div class="test"><p>unbalanced rli codepoint
&#x2066;نشاط التدويل، W3C&#x2069;
⁦نشاط التدويل، W3C
</p>.</div>',
);



?>