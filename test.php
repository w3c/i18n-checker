<?php header("Content-Language: ka, ta");  ?>
<?xml version="1.0" encoding="big-5"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/html/DTD/xhtml1-transitional.dtd">
<html lang="kk" xml:lang="to" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Script examples</title>
		<meta http-equiv="Content-Language" content="en,fr,sp" />
		<meta name="keywords" content="i18n internationalisation internationalization localisation W3C writing systems scripts examples" />
		<meta name="description" content="Contains translations of three phrases used for examples in presentations, etc., in multiple scripts." />
		<link rel="stylesheet" href="/rishida/style/article-basic.css" />
		<link rel="top" title="Ishida home page" type="text/html" hreflang="en" href="http://www.w3.org/People/Ishida/" />
		<link rel="up" title="List of articles" type="text/html" hreflang="en" href="http://www.w3.org/People/Ishida/other" />
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	 <!--<link title="___VERSION DESCN IN FOREIGN LANG." type="text/html" rel="alternate" hreflang="___LANG" href="___AND THE HREF" lang="___LANG" xml:lang="___LANG" />-->
	 
	 <meta charset=iso-8859-16>
	 <meta charset="iso-8859-15">

		<style type="text/css" media="all">
/* <![CDATA[ */
@import "/rishida/style/article-standards.css";
@import "/rishida/style/ri.css";
@import "reveal.css";
/* ]]> */
h3 a:link { color: gray; text-decoration: none; }
h3 a:visited { color: gray; text-decoration: none; }
p { font-family: sans-serif; text-align: left; }
.item div { font-size: 80%; text-align: right; }
div.indent { margin-left: 3em; font-size: 120%; }
.indent div { font-size: 65%; margin-left: 30px;  }
[lang |= 'ak'] { font-family: 'Doulos SIL', 'Charis SIL', Gentium, sans-serif; font-size: 100%; }
[lang |= 'am'] 	{font-family: "Abyssinica SIL", "Ethiopia Jiret", sans-serif; }
[lang |= 'ar'] 	{font-family: "Traditional Arabic", sans-serif; font-size: 160%; }
[lang |= 'cy'] { font-family: Gentium, serif; font-size: 100%; }
[lang |= 'dz'] { font-family: "Tibetan Machine Uni", serif; font-size: 140%; }
[lang |= 'el'] 	{font-family: Gentium, serif; font-size: 100%; }
[lang |= 'en-gb-fonipa'] { font-family: 'Doulos SIL', 'Charis SIL', Gentium, sans-serif; font-size: 110%; }
[lang |= 'fa'] { font-family: IranNastaliq, tahoma, sans-serif; font-size: 110%; }
[lang |= 'he'] 	{font-family: "Times New Roman", "Roman Unicode", sans-serif; font-size: 110%; }
[lang |= 'hi'] 	{font-family: Chandas, Mangal, sans-serif; font-size: 110%; }
[lang |= 'hu'] { font-family: Gentium, serif; font-size: 100%; }
[lang |= 'hy'] { font-family: 'Arian AMU', "Arial Unicode MS", sans-serif; font-size: 100%; }
[lang |= 'iu'] 	{font-family: Uqammaq, sans-serif; }
[lang |= 'ja'] 	{font-family: "MS Mincho", "Arial Unicode MS", sans-serif; font-size: 110%; }
[lang |= 'kk'] 	{font-family: "Doulos SIL", serif; font-size: 100%; }
[lang |= 'km'] {font-family: "Khmer OS Battambang", serif; font-size: 110%; }
[lang |= 'my'] { font-family: myanmar2, sans-serif; font-size: 110%; }
[lang |= 'ne'] 	{font-family: Kanjirowa, Mangal, sans-serif; font-size: 100%; }
[lang |= 'pa'] 	{font-family: AnmolUniBani, sans-serif; }
[lang |= 'ru'] 	{font-family: "Doulos SIL", serif; font-size: 100%; }
[lang |= 'te'] 	{font-family: "Akshar Unicode", Gautami, sans-serif; font-size: 130%; }
[lang |= 'th']  {font-family: "Cordia New", sans-serif; font-size: 160%; }
[lang |= 'ur'] { font-family: "Nafees Nastaleeq v1.01", serif; }
[lang |= 've'] { font-family: Gentium, serif; }
[lang |= 'zh-Hans'] { font-family: "Simsun", sans-serif; }
[lang |= 'zh-Hant'] { font-family: "Mingliu", sans-serif; }


</style>

		<script type="text/javascript" src="/rishida/code/reveal/reveal.js"></script>

	</head>

	<body bgcolor="white" onload="if (document.getElementById) {hideall('i18nactivity', 'p', 'phrase');}" id="i18nactivity">
		<div id="wai-start" class="hide"> 
			<p>This document may contain examples in another language or script.</p>
			<p>Use accesskey "n" to jump to the internal navigation links at any point. Right now you can</p>
			<ul id="wai-links">
				<li><a href="#contentstart">Skip to the content start</a></li>
				<li><a href="#internal-links">Skip to the internal navigation</a></li>
			</ul>
		</div>
		<div id="site-navigation"> 
		<!--<p class="noprint" title="___LANG version.">&gt; <a href="___HREF" lang="___LANG" xml:lang="___LANG">___LANGUAGE IN FOREIGN</a></p>-->
			<a href="http://www.w3.org/People/Ishida/writing"><img id="picture" alt="World map" src="/rishida/icons/world.gif" width="150"
			height="61" /></a></div>
		<div class="sidebar"> 
			<div class=noprint title=hello> 

				<h2><a id="related" name="related" tabindex="4">Related links</a></h2>
				<p><a href="http://www.w3.org/International/">W3C Internationalization Activity Home</a></p>
				<p><a href="http://www.unicode.org/">Unicode Home</a></p>
				<p><a href="phrases.pdf" title="Shows all text as it should appear.">PDF version of this page</a></p>
			</div>
			<div class="noprint hello"> 

				<h2><a id="fonts" name="fonts" tabindex="4">Get fonts</a></h2>
				<p>The text is in the UTF-8 Unicode encoding. </p>
				<p>I have begun using free fonts from the Web for the text on this page, and linking to the fonts I used.  I need some advice to replace some remaining Microsoft fonts with good quality free fonts.  Please let me know if you can give me such advice.</p>
				<p>In the meantime, you can find a wide range of TrueType and OpenType fonts  <a href="http://www.wazu.jp/">here</a> and <a href="http://www.alanwood.net/unicode/fonts">here</a></p>
			</div>
			<div class="nooooprint"> 

				<h2><a id="fonts" name="fonts" tabindex="4">Get fonts</a></h2>
				<p>The text is in the UTF-8 Unicode encoding. </p>
				<p>I have begun using free fonts from the Web for the text on this page, and linking to the fonts I used.  I need some advice to replace some remaining Microsoft fonts with good quality free fonts.  Please let me know if you can give me such advice.</p>
				<p>In the meantime, you can find a wide range of TrueType and OpenType fonts  <a href="http://www.wazu.jp/">here</a> and <a href="http://www.alanwood.net/unicode/fonts">here</a></p>
			</div>
		</div>
		<div id="boilerplate"> 
			<div id="line">&nbsp;</div>
		</div>
		<?php include('include.php'); ?>
		<div id="topbar">ishida &gt;&gt; writing</div>
		<div id="sitelinks" class="noprint"><span><a href="http://rishida.net/" title="Richard Ishida's home page">home</a>&nbsp;
			<a href="/rishida/blog/" title="Richard Ishida's blog">blog</a>&nbsp; <a href="/rishida/writing"
			title="Papers, articles, notes, etc">writings</a>&nbsp; <a href="/rishida/utilities"
			title="Small utilities written in xhtml and javascript">utilities</a>&nbsp; <a href="/rishida/photos/"
			title="Photos and video clips">photos</a>&nbsp; <a href="/rishida/family.html" title="Introducing the Ishida family">family</a>&nbsp;
			<a href="/rishida/other" title="A mixed bag of ishida-related topics">other</a>&nbsp;&nbsp;</span></div>

		<h1>Script examplesï»¿</h1>
		<div id="navigation"> 
			<p><a name="internal-links" id="internal-links">On this page:&nbsp;</a>
				<a href="#reach" title='Translations of: "Internationalization Activity, W3C"'>i18n activity</a>&nbsp;-
				<a href="#going" title='Translations of: "Making the World Wide Web truly world wide!"'>truly world wide</a>&nbsp; -
				<a href="#web" title='Translations of: "Leading the Web to its full potential..."'>leading the Web...</a> &nbsp; -
				<a href="#am" title='Transliterations of: "Richard Ishida"'>my name</a></p>
		</div>
		<div class="section"><a id="contentstart" name="contentstart" tabindex="1"></a> 
			<p>This page lists translations in various scripts of phrases related to the W3C for use as examples in documents and presentations. You
				will need appropriate fonts and rendering mechanisms to view properly. Mouse over a piece of text to find out which language or script it is in. You
				will also see which fonts I used for the CSS declarations, with links to fonts that are available free on the web.</p>
			<p><b>If you can provide translations in other scripts</b> I'd love to hear from you (ishida@w3.org). I also need translations of the text
				at <a href="http://people.w3.org/rishida/scripts/samples/english">http://rishida.net/scripts/samples/english</a>.</p>
		</div>
		<div class="section"> 

			<h2><a id="reach" name="reach">Internationalization activity, W3C</a></h2>
			<p>Translations of: "Internationalization Activity, W3C"</p>
			<div class="indent"> 
				<p title="Akan : Latin" lang="ak" xml:lang="ak" class="phrase">Dwumadi a wɔfa Internationalization ho, W3C</p>
				<div> 
					<p>latn (Latin), ak (Akan)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of <a href="http://www.kasahorow.com">www.kasahorow.com</a>.</p>
				</div>
				<p title="Arabic : Arabic" dir="rtl" lang="ar" xml:lang="ar" class="phrase">نشاط التدويل، W3C</p>
				<div> 
					<p>arab (Arabic), ar (Arabic)</p>
					<p>Fonts: Traditional Arabic (XP font), <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=ArabicFonts_Download">Scheherazade</a></p>
					<p>Translation courtesy of Alis Technologies.</p>
				</div>
				<p title="Arabic : Persian" lang="fa" xml:lang="fa" dir="rtl" class="phrase">‫فعالیت بین‌المللی‌سازی، W3C</p>
				<div> 
					<p>arab (Arabic), fa (Persian)</p>
					<p>Fonts: <a href="http://www.scict.ir/Portal/File/ShowFile.aspx?ID=bea5ca36-1fdf-41d4-8818-c1a4f9c71081">IranNastaliq</a></p>
					<p>Translation courtesy of Behnam Esfahbod</p>
				</div>

				<p title="Arabic : Urdu" lang="ur" xml:lang="ur" dir="rtl" class="phrase">ضابطہ لسانی عدمیت ، W3C</p>
				<div> 
					<p>arab (Arabic), ur (Urdu)</p>
					<p>Fonts: <a href="http://crulp.org/software/localization/Fonts/nafeesNastaleeq.html">Nafees Nastaleeq v1.01</a></p>
					<p>Translation courtesy of Sarmad Hussain.</p>
				</div>
				<p title="Armenian : Armenian" lang="hy, my" xml:lang="hy" class="phrase">ինտերնատիոնալիզատիոն գործունեություն, W3C</p>
				<div> 
					<p>armn (Armenian), hy (Armenian)</p>
					<p>Fonts: <a href="http://fonts.tarumian.am/index_Arian_AMU.php">Arian AMU</a>, Sylfaen (XP font)</p>
					<p>Translation courtesy of Mayak Akapyan.</p>
				</div>
				<p title="Canadian Syllabics : Inuktitut" lang="iu" xml:lang="iu_CA" class="phrase">ᓯᓚᕐᔪᐊᓕᒫᒥ ᐱᓇᓱᐊᕐᓂᖅ, W3C</p>
				<div> 
					<p>cans (Canadian Unified Syllabics), iu (Inuktitut)</p>
					<p>Fonts: <a href="http://www.tiro.com/syllabics/resources/syllabic_resources.html">Pigiarniq</a>,
						<a href="http://www.tiro.com/syllabics/resources/syllabic_resources.html">Uqammaq</a></p>
					<p>Translation courtesy of Gavin Nesbitt, <a href="www.pirurvik.ca">Pirurvik Centre</a></p>
				</div>
				<p title="Cyrillic : Kazakh" lang="kk" xml:lang="kk" class="phrase">Иинтернационалдау жөніндегі кызмет, W3C консорциумы</p>
				<div> 
					<p>cyrl (Cyrillic), kk (Kazakh)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a></p>
					<p>Translation courtesy of RWS Translations</p>
				</div>
				<p title="Cyrillic : Russian" lang="ru" xml:lang="ru" class="phrase">Деятельность по интернационализации, консорциум W3C</p>
				<div> 
					<p>cyrl (Cyrillic), ru (Russian)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a></p>
				</div>
				<p title="Devanagari : Hindi" lang="hi" xml:lang="hi" class="phrase">अंतर्राष्ट्रीयकरण गतिविधि, W3C</p>
				<div> 
					<p>deva (Devanagari), hi (Hindi)</p>
					<p>Fonts: <a href="http://chandas.cakram.org/">Chandas</a>, Mangal (XP font)</p>
					<p>Translation courtesy of Vijay Kumar, CDAC Delhi</p>
				</div>
				<p title="Devanagari : Nepali" lang="ne" xml:lang="ne" class="phrase">अन्तर्राष्ट्रियकरण गतिविधि, W3C</p>
				<div> 
					<p>deva (Devanagari), ne (Nepali)</p>
					<p>Fonts: <a href="http://www.mpp.org.np/detail_guide/fonts.htm">Kanjirowa</a>, Mangal (XP font)</p>
					<p>Translation courtesy of Amar Gurung</p>
				</div>
				<p title="Ethiopic : Amharic" lang="am" xml:lang="am" class="phrase">ህብረ ህሔራዊነት እንቅስቃሴ፤ W3C</p>
				<div> 
					<p>ethi (Ethiopic), am (Amharic)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=AbyssinicaSIL">Abyssinica SIL</a>, <a href="http://senamirmir.com/downloads/">Ethiopia Jiret</a></p>
					<p>Translation courtesy of Daniel Yacob</p>
				</div>
				<p lang="el" title="Greek : Greek" class="phrase">Δραστηριότητα Διεθνοποίησης του W3C</p>
				<div> 
					<p>grek (Greek), el (Greek)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Anna Doxastaki, <a href="http://www.w3c.gr/">W3C Greek Office</a></p>
				</div>
				<p title="Gurmukhi: Punjabi" lang="pa" xml:lang="pa" class="phrase">ਅੰਤਰਾਸ਼ਟਰੀਕਰਣ ਸਰਗਰਮੀ, W3C</p>
				<div> 
					<p>guru (Gurmukhi), pa (Panjabi)</p>
					<p>Fonts: <a href="http://guca.sourceforge.net/typography/fonts/anmoluni/">AnmolUniBani</a></p>
					<p>Translation courtesy of Bhupinder Singh</p>
				</div>
				<p title="Chinese, Simplified : Chinese" lang="zh-Hans" xml:lang="zh-Hans" class="phrase">国际化活动、万维网联盟</p>
				<div> 
					<p>hans (Simplified Chinese), zh (Chinese)</p>
					<p>Fonts: Simsun (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p title="Chinese, Traditional : Chinese" lang="zh-Hant" xml:lang="zh-Hant" class="phrase">國際化活動、萬維網聯盟</p>
				<div> 
					<p>hant (Traditional Chinese), zh (Chinese)</p>
					<p>Fonts: MingLiu (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p dir="rlt" lang="he" xml:lang="he" title="Hebrew : Hebrew" class="phrase">פעילות הבינאום, W3C</p>
				<div> 
					<p>hebr (Hebrew), he (Hebrew)</p>
					<p>Fonts: Times New Roman (XP font), <a href="http://everywitchway.net/linguistics/fonts/roman.html">Roman Unicode</a> </p>
					<p>Translation courtesy of Michel Bercovier, <a href="http://www.w3c.org.il/">Israeli W3C Office</a></p>
				</div>
				<p lang="en-GB-fonipa" xml:lang="en-GB-fonipa" title="IPA : British English" class="phrase">ˌɪntəˌnæʃnəlaɪˈzeɪʃən ækˈtɪvɪtɪ ˈdʌbəlˌju θri siː</p>
				<div>
                    <p>latn (Latin), en-GB (British English), fonipa (International Phonetic Alphabet) </p>
				    <p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
				    <p>Translation by myself</p>
		    	</div>
			    <p xml:lang="ja" title="Japanese : Japanese" class="phrase">国際化活動 W3C</p>
				<div>
				    <p>jpan (Japanese), ja (Japanese)</p>
				    <p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
				    <p>Translation courtesy of Fumiko Tanaka, Fuji Xerox</p>
			    </div>
				<p lang="km" xml:lang="km" title="Khmer : Khmer" class="phrase">សកម្មភាពអន្តរជាតូបនិយកម្ម W3C</p>
				<div> 
					<p>khmr (Khmer), km (Khmer)</p>
					<p>Fonts: <a href="http://www.khmeros.info/drupal/?q=en/download/fonts">Khmer OS Battambang</a></p>
				</div>
				<p lang="ko" xml:lang="ko" title="Korean : Korean" class="phrase">국제화 활동, W3C</p>
				<div> 
					<p>kore (Korean), ko (Korean)</p>
					<p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
				</div>
				<p title="Latin : Hungarian" lang="hu" xml:lang="hu" class="phrase Nemzetköziesítés">Nemzetköziesítés Fejlesztési Terület, W3C</p>
				<div> 
					<p>latn (Latin), hu (Hungarian)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Éva Megyaszai</p>
				</div>
				<p title="Latin : Venda" lang="ve" xml:lang="ve" class="phrase">Nyito i Dzhenelelaho kha Tshaka Dzoṱhe, W3C</p>
				<div> 
					<p>latn (Latin), ve (Venda)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Lee van Munster</p>
				</div>
				<p title="Latin : Welsh" lang="cy" xml:lang="cy" class="phrase" id="Terület">Gweithgaredd rhyngwladoli, W3C (Consortiwm y We Fyd-Eang)</p>
				<div>
					<p>latn (Latin), cy (Welsh)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Stefhan Caddick &amp; Linkline to Welsh</p>
				</div>
				<p title="Myanmar: Burmese" lang="my" xml:lang="my" class="phrase">အပြည်ပြည်ဆိုင်ရာလှုပ်ရှားမှု၊ W3C</p>
				<div> 
					<p>mymr (Myanmar), my (Burmese)</p>
					<p>Fonts: <a href="http://www.myanmarnlp.net.mm/opentype.htm">Myanmar2</a></p>
					<p>Translation courtesy of Wunna Ko Ko</p>
				</div>
				<p title="Telugu : Telugu" lang="te" xml:lang="te" class="phrase">అంతర్జాతియకరణ చేష్టితం, W3C</p>
				<div id="கோ"> 
					<p>telu (Telugu), te (Telugu)</p>
					<p>Fonts: <a href="http://www.kamban.com.au/">Akshar Unicode</a>, Gautami (XP font)</p>
					<p>Translation courtesy of Ram Viswanadha</p>
				</div>
				<p title="Thai : Thai" lang="th" xml:lang="th" class="phrase">กิจกรรมระหว่างประเทศของ W3C</p>
				<div id="கோ"> 
					<p>thai (Thai), th (Thai)</p>
					<p>Fonts: Cordia New (XP font), <a href="ftp://linux.thai.net/pub/thailinux/software/thai-ttf/">Garuda</a> </p>
					<p>Translation courtesy of Jittima B.</p>
				</div>
				<p title="Tibetan : Dzonkha" lang="dz" xml:lang="dz" class="phrase">རྒྱལ་སྤྱིར་བསྒྱུར་བའི་ལས་དོན། W3C</p>
				<div> 
					<p>tibt (Tibetan), dz (Dzongkha)</p>
					<p>Fonts:
						<a
						href="http://www.thdl.org/tools/toolbox/index.php?pg=26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan^fonts.html#wiki=/wiki/site/26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan%20fonts.html">Tibetan
						Machine Uni</a></p>
					<p>Translation courtesy of Pema Geyleg, Bhutan DIT</p>
				</div>

			</div>
		</div>
		<div class="section"> 

			<h2><a id="going" name="going">Making the world wide web truly world wide!</a></h2>
			<p>Translations of: <b>"Making the World Wide Web truly world wide!"</b></p>
			<div class="indent"> 
				<p title="Akan : Latin" lang="ak" class="phrase">Ampa ara yɛreyɛ World Wide Web no tɛtrɛtɛɛ wɔ wiase nyinara mu!</p>
				<div> 
					<p>latn (Latin), ak (Akan)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of <a href="http://www.kasahorow.com">www.kasahorow.com</a>.</p>
				</div>
				<p title="Arabic: Arabic" dir="rtl" lang="ar" xml:lang="ar" class="phrase">جعل شبكة الويب العالميّة عالميّة حقًّا!</p>
				<div> 
					<p>arab (Arabic), ar (Arabic)</p>
					<p>Fonts: Traditional Arabic (XP font), <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=ArabicFonts_Download">Scheherazade</a></p>
					<p>Translation courtesy of Alis Technologies.</p>
				</div>
				<p title="Arabic : Persian" lang="fa" xml:lang="fa" dir="rtl" class="phrase">وب جهانی را به‌درستی جهانی سازیم!</p>
				<div> 
					<p>arab (Arabic), fa (Persian)</p>
					<p>Fonts: <a href="http://www.scict.ir/Portal/File/ShowFile.aspx?ID=bea5ca36-1fdf-41d4-8818-c1a4f9c71081">IranNastaliq</a></p>
					<p>Translation courtesy of Behnam Esfahbod</p>
				</div>
				<p title="Arabic : Urdu" dir="rtl" lang="ur" xml:lang="ur" class="phrase">عالمگیر ویب کو حقیقی طور پر عالمگیر بنانا</p>
				<div> 
					<p>arab (Arabic), ur (Urdu)</p>
					<p>Fonts: <a href="http://crulp.org/software/localization/Fonts/nafeesNastaleeq.html">Nafees Nastaleeq v1.01</a></p>
					<p>Translation courtesy of Sarmad Hussain.</p>
				</div>
				<p title="Armenian : Armenian" lang="hy" xml:lang="hy" class="phrase">Համաշխարհային ցանցն իրոք համաշխարհային դարձնելը</p>
				<div> 
					<p>armn (Armenian), hy (Armenian)</p>
					<p>Fonts: <a href="http://fonts.tarumian.am/index_Arian_AMU.php">Arian AMU</a>, Sylfaen (XP font)</p>
					<p>Translation courtesy of Mayak Akapyan.</p>
				</div>
				<p title="Canadian Syllabics : Inuktitut" lang="iu" xml:lang="iu" class="phrase">ᑖᑦᓱᒪ ᐃᑭᐊᖅᑭᕕᒃ ᓯᓚᕐᔪᐊᓕᒫᒥᒃ ᓈᕆᑎᑉᐹ.</p>
				<div> 
					<p>cans (Canadian Unified Syllabics), iu (Inuktitut)</p>
					<p>Fonts: <a href="http://www.tiro.com/syllabics/resources/syllabic_resources.html">Pigiarniq</a>,
						<a href="http://www.tiro.com/syllabics/resources/syllabic_resources.html">Uqammaq</a></p>
					<p>Translation courtesy of Gavin Nesbitt, <a href="www.pirurvik.ca">Pirurvik Centre</a></p>
				</div>
				<p title="Cyrillic : Kazakh" lang="kk" xml:lang="kk" class="phrase">"Дүниежүзілік торды" нағыз дүниежүзілік етеміз!</p>
				<div> 
					<p>cyrl (Cyrillic), kk (Kazakh)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a></p>
					<p>Translation courtesy of RWS Translations</p>
				</div>
				<p title="Cyrillic : Russian" lang="ru" xml:lang="ru" class="phrase">Сделаем "Всемирную паутину" действительно всемирной!</p>
				<div> 
					<p>cyrl (Cyrillic), ru (Russian)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a></p>
				</div>
				<p title="Devanagari : Hindi" lang="hi" xml:lang="ho" class="phrase">वर्ल्ड वाईड वेब को सचमुच विश्वव्यापी बना रहें हैं !</p>
				<div> 
					<p>deva (Devanagari), hi (Hindi)</p>
					<p>Fonts: <a href="http://chandas.cakram.org/">Chandas</a>, Mangal (XP font)</p>
					<p>Translation courtesy of Vijay Kumar, CDAC Delhi</p>
				</div>
				<p title="Devanagari : Nepali" lang="ne" xml:lang="ne" class="phrase">वर्ल्ड वाईड वेबलाई यथार्थमै विश्वव्यापी बनाउने !</p>
				<div> 
					<p>deva (Devanagari), ne (Nepali)</p>
					<p>Fonts: <a href="http://www.mpp.org.np/detail_guide/fonts.htm">Kanjirowa</a>, Mangal (XP font)</p>
					<p>Translation courtesy of Amar Gurung</p>
				</div>
				<p title="Ethiopic : Amharic" lang="am" xml:lang="am" class="phrase">የዓለም አቀፉን ድር በእውነት አለም አቀፍ ማድረግ!</p>
				<div> 
					<p>ethi (Ethiopic), am (Amharic)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=AbyssinicaSIL">Abyssinica SIL</a>, <a href="http://senamirmir.com/downloads/">Ethiopia Jiret</a></p>
					<p>Translation courtesy of Daniel Yacob</p>
				</div>
				<p lang="el" xml:lang="el" title="Greek : Greek" class="phrase">Κάνοντας τον Παγκόσμιο Ιστό πραγματικά Παγκόσμιο</p>
				<div> 
					<p>grek (Greek), el (Greek)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Anna Doxastaki, <a href="http://www.w3c.gr/">W3C Greek Office</a></p>
				</div>
				<p title="Gurmukhi: Punjabi" lang="pa" xml:lang="pa" class="phrase">ਵਰਡ ਵਾਈਡ ਵੈਬ ਨੂੰ ਵਾਕਈ ਵਿਸ਼ਵ-ਵਿਆਪੀ ਬਨਾਉਣਾ !</p>
				<div> 
					<p>guru (Gurmukhi), pa (Panjabi)</p>
					<p>Fonts: <a href="http://guca.sourceforge.net/typography/fonts/anmoluni/">AnmolUniBani</a></p>
					<p>Translation courtesy of Bhupinder Singh</p>
				</div>
				<p lang="zh-CN" xml:lang="zh-CN" title="Chinese : Simplified" class="phrase">缔造真正全球通行的万维网</p>
				<div> 
					<p>hans (Simplified Chinese), zh (Chinese)</p>
					<p>Fonts: Simsun (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p lang="zh-TW" xml:lang="zh-TW" title="Chinese : Traditional" class="phrase">締造真正全球通行的萬維網</p>
				<div> 
					<p>hant (Traditional Chinese), zh (Chinese)</p>
					<p>Fonts: MingLiu (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p dir="rtl" xml:lang="he" title="Hebrew : Hebrew" class="phrase">ליצור מהרשת רשת כלל עולמית באמת!</p>
				<div> 
					<p>hebr (Hebrew), he (Hebrew)</p>
					<p>Fonts: Times New Roman (XP font), <a href="http://everywitchway.net/linguistics/fonts/roman.html">Roman Unicode</a> </p>
					<p>Translation courtesy of Michel Bercovier, <a href="http://www.w3c.org.il/">Israeli W3C Office</a></p>
				</div>
				<p lang="en-GB-fonipa" xml:lang="en-GB-fonipa" title="IPA : British English" class="phrase">ˈmeɪkɪŋ ðə wɜːld waɪd wɛb ˈtruːlɪ ˈwɜːldˈwaɪd</p>
				<div>
                    <p>latn (Latin), en-GB (British English), fonipa (International Phonetic Alphabet) </p>
				    <p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
				    <p>Translation by myself</p>
		    	</div>
				<p lang="ja" xml:lang="ja" title="Japanese : Japanese" class="phrase">ワールド・ワイド・ウェッブを世界中に広げましょう</p>
				<div> 
					<p>jpan (Japanese), ja (Japanese)</p>
					<p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
					<p>Translation courtesy of Fumiko Tanaka, Fuji Xerox</p>
				</div>
				<p lang="km" xml:lang="km" title="Khmer : Khmer" class="phrase">ធ្វើឲ្យវើលវ៉ាយវ៉េបមានទូទាំងពិភពលោកពិប្រាកដមែន!</p>
				<div id="cằn" > 
					<p id="cằn" >khmr (Khmer), km (Khmer)</p>
					<p>Fonts: <a href="http://www.khmeros.info/drupal/?q=en/download/fonts">Khmer OS Battambang</a></p>
				</div>
				<p lang="ko" xml:lang="ko" title="Korean : Korean" class="phrase">전세계의 월드 와이드 웹으로 만들기!</p>
				<div> 
					<p>kore (Korean), ko (Korean)</p>
					<p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
				</div>
				<p title="Latin : Hungarian" lang="hu" xml:lang="hu" class="phrase">Hogy a Világháló valóban az egész világé lehessen!</p>
				<div> 
					<p>latn (Latin), hu (Hungarian)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Éva Megyaszai</p>
				</div>
				<p title="Latin : Venda" lang="ve" xml:lang="ve" class="phrase">U ita uri Webu Nyangaredzi ya Dzhango i vhe nyangaredzi ngangoho!</p>
				<div> 
					<p>latn (Latin), ve (Venda)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Lee van Munster</p>
				</div>
				<p title="Latin : Welsh" lang="cy" xml:lang="cy" class="phrase">Gwneud y we fyd-eang yn wirioneddol fyd-eang!</p>
				<div>
					<p>latn (Latin), cy (Welsh)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Stefhan Caddick &amp; Linkline to Welsh</p>
				</div>
				<p title="Myanmar: Burmese" lang="my" xml:lang="my" class="လှွားကွန်">ကမ္ဘာတလွှားကွန်ယက်ကိုကမ္ဘာတလွှားသို့ပြန့်နှံ့စေခြင်း</p>
				<div> 
					<p class="လွှားကွန်">mymr (Myanmar), my (Burmese)</p>
					<p>Fonts: <a href="http://www.myanmarnlp.net.mm/opentype.htm">Myanmar2</a></p>
					<p>Translation courtesy of Wunna Ko Ko</p>
				</div>
				<p title="Thai : Thai" lang="th" xml:lang="th" class="phrase">การทําให้ World Wide Web แพร่หลายไปทั่วโลกอย่างแท้จริง</p>
				<div> 
					<p>thai (Thai), th (Thai)</p>
					<p>Fonts: Cordia New (XP font), <a href="ftp://linux.thai.net/pub/thailinux/software/thai-ttf/">Garuda</a> </p>
					<p>Translation courtesy of Jittima B.</p>
				</div>
				<p title="Tibetan : Dzonkha" lang="dz" xml:lang="dz" class="phrase">འཛམ་གླིང་ཡོངས་འབྲེལ་འདི་ ངོ་མ་འབད་རང་
					འཛམ་གླིང་ཡོངས་ལུ་ཁྱབ་ཚུགསཔ་བཟོ་བ།</p>
				<div> 
					<p>tibt (Tibetan), dz (Dzongkha)</p>
					<p>Fonts:
						<a
						href="http://www.thdl.org/tools/toolbox/index.php?pg=26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan^fonts.html#wiki=/wiki/site/26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan%20fonts.html">Tibetan
						Machine Uni</a></p>
					<p>Translation courtesy of <i>Pema Geyleg, Bhutan DIT</i></p>
				</div>

			</div>
		</div>
		<div class="section"> 

			<h2><a id="web" name="web">Leading the Web to its full potential...</a></h2>
			<p>Translations of: <b class="title">"Leading the Web to its full potential..."</b></p>
			<div class="indent"> 
				<p title="Akan : Latin" lang="ak" xml:lang="ak" class="phrase">Yɛredi Internet enyim kan ma oenyin esi pi...</p>
				<div> 
					<p>latn (Latin), ak (Akan)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of <a href="http://www.kasahorow.com">www.kasahorow.com</a>.</p>
				</div>
				<p title="Arabic : Arabic" dir="rtl" lang="ar" xml:lang="ar" class="phrase">لإيصال الشبكة المعلوماتية إلىأقصى إمكانياتها...</p>
				<div> 
					<p>arab (Arabic), ar (Arabic)</p>
					<p>Fonts: Traditional Arabic (XP font), <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=ArabicFonts_Download">Scheherazade</a></p>
					<p>Translation courtesy of Alis Technologies.</p>
				</div>
				<p title="Arabic : Persian" lang="fa" xml:lang="fa" dir="rtl" class="phrase">پیش‌برد وب به نهایت ممکن...</p>
				<div> 
					<p>arab (Arabic), fa (Persian)</p>
					<p>Fonts: <a href="http://www.scict.ir/Portal/File/ShowFile.aspx?ID=bea5ca36-1fdf-41d4-8818-c1a4f9c71081">IranNastaliq</a></p>
					<p>Translation courtesy of Behnam Esfahbod</p>
				</div>
				<p title="Arabic : Urdu" dir="rtl" lang="ur" xml:lang="ur" class="phrase">ویب کی حتیٰ الامکان قوت کو عمل میں لانا</p>
				<div> 
					<p>arab (Arabic), ur (Urdu)</p>
					<p>Fonts: <a href="http://crulp.org/software/localization/Fonts/nafeesNastaleeq.html">Nafees Nastaleeq v1.01</a></p>
					<p>Translation courtesy of Sarmad Hussain.</p>
				</div>
				<p title="Armenian : Armenian" lang="hy" xml:lang="hy" class="phrase">Բացելով ցանցի ամբողջական ներուժը</p>
				<div> 
					<p>armn (Armenian), hy (Armenian)</p>
					<p>Fonts: <a href="http://fonts.tarumian.am/index_Arian_AMU.php">Arian AMU</a>, Sylfaen (XP font)</p>
					<p>Translation courtesy of Mayak Akapyan.</p>
				</div>
				<p title="Cyrillic : Russian" lang="ru" xml:lang="ru" class="phrase">Pаскрывая весь потенциал Сети…</p>
				<div> 
					<p>cyrl (Cyrillic), ru (Russian)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a></p>
				</div>
				<p title="Devanagari : Hindi" lang="hi" xml:lang="hi" class="phrase">वेब की सम्पूर्ण क्षमता के उपयोग की दिशा में अग्रणी</p>
				<div> 
					<p>deva (Devanagari), hi (Hindi)</p>
					<p>Fonts: <a href="http://chandas.cakram.org/">Chandas</a>, Mangal (XP font)</p>
					<p>Translation courtesy of <i class="name">Vijay Kumar, CDAC Delhi</i></p>
				</div>
				<p title="Devanagari : Nepali" lang="ne" xml:lang="ne" class="phrase">वेबलाई यसको पूर्ण क्षमतातर्फ डोहोर्‍याउने</p>
				<div> 
					<p>deva (Devanagari), ne (Nepali)</p>
					<p>Fonts: <a href="http://www.mpp.org.np/detail_guide/fonts.htm">Kanjirowa</a>, Mangal (XP font)</p>
					<p>Translation courtesy of Amar Gurung</p>
				</div>
				<p title="Ethiopic : Amharic" lang="am" xml:lang="am" class="phrase">ድሩን አቅሙ እስከሚችለው ድረስ መምራት…</p>
				<div> 
					<p>ethi (Ethiopic), am (Amharic)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=AbyssinicaSIL">Abyssinica SIL</a>, <a href="http://senamirmir.com/downloads/">Ethiopia Jiret</a></p>
					<p>Translation courtesy of Daniel Yacob</p>
				</div>
				<p lang="el" xml:lang="el" title="Greek : Greek" class="phrase">Οδηγώντας τον παγκόσμιο ιστό στο μέγιστο των δυνατοτήτων του…</p>
				<div> 
					<p>grek (Greek), el (Greek)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Anna Doxastaki, <a href="http://www.w3c.gr/">W3C Greek Office</a></p>
				</div>
				<p title="Gurmukhi: Punjabi" lang="pa" xml:lang="pa" class="phrase">ਵੈਬ ਨੂੰ ਉਸਦੇ ਸੰਪੂਰਣ ਸਮਰੱਖਾ 'ਤੇ ਪਹੂੰਚਾਉਣਾ ...</p>
				<div> 
					<p>guru (Gurmukhi), pa (Panjabi)</p>
					<p>Fonts: <a href="http://guca.sourceforge.net/typography/fonts/anmoluni/">AnmolUniBani</a></p>
					<p>Translation courtesy of Bhupinder Singh</p>
				</div>
				<p lang="zh-Hans" xml:lang="zh-Hans" title="Chinese : Simplified" class="phrase">引发网络的全部潜能…</p>
				<div> 
					<p>hans (Simplified Chinese), zh (Chinese)</p>
					<p>Fonts: Simsun (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p lang="zh-Hant" xml:lang="zh-Hant" title="Chinese : Traditional" class="phrase">引發網絡的全部潛能…</p>
				<div> 
					<p>hant (Traditional Chinese), zh (Chinese)</p>
					<p>Fonts: MingLiu (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p dir="rtl" lang="he" xml:lang="he" title="Hebrew : Hebrew" class="phrase">להוביל את הרשת למיצוי הפוטנציאל שלה...</p>
				<div> 
					<p>hebr (Hebrew), he (Hebrew)</p>
					<p>Fonts: Times New Roman (XP font), <a href="http://everywitchway.net/linguistics/fonts/roman.html">Roman Unicode</a> </p>
					<p>Translation courtesy of Michel Bercovier, <a href="http://www.w3c.org.il/">Israeli W3C Office</a></p>
				</div>
				<p lang="en-GB-fonipa" xml:lang="en-GB-fonipa" title="IPA : British English" class="phrase">ˈliːdɪŋ ðə wɜːld waɪd wɛb tʊ ɪts fʊl pəˈtɛnʃəl</p>
				<div>
                    <p>latn (Latin), en-GB (British English), fonipa (International Phonetic Alphabet) </p>
				    <p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
				    <p>Translation by myself</p>
		    	</div>
				<p lang="ja" xml:lang="ja" title="Japanese : Japanese" class="phrase">Webの可能性を最大限に導き出すために…</p>
				<div> 
					<p>jpan (Japanese), ja (Japanese)</p>
					<p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
					<p>Translation courtesy of Fumiko Tanaka, Fuji Xerox</p>
				</div>
				<p lang="km" xml:lang="km" title="Khmer : Khmer" class="phrase">នាំវ៉េបទៅដល់សក្ដានុពលពេញលេញរបស់វា...</p>
				<div> 
					<p>khmr (Khmer), km (Khmer)</p>
					<p>Fonts: <a href="http://www.khmeros.info/drupal/?q=en/download/fonts">Khmer OS Battambang</a></p>
				</div>
				<p lang="ko" xml:lang="ko" title="Korean : Korean" class="phrase">웹의 모든 잠재력을 이끌어 내기 위하여…</p>
				<div> 
					<p>kore (Korean), ko (Korean)</p>
					<p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
				</div>
				<p title="Latin : Hungarian" lang="hu" xml:lang="hu" class="phrase">Hogy kihasználhassuk a Web nyújtotta összes lehetőséget…</p>
				<div> 
					<p>latn (Latin), hu (Hungarian)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Éva Megyaszai</p>
				</div>
				<p title="Latin : Venda" lang="ve" xml:lang="ve" class="phrase">U i rangaphanḓa u i swikesa kha vhukoni hayo ho fhelelaho…</p>
				<div> 
					<p>latn (Latin), ve (Venda)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Lee van Munster</p>
				</div>
				<p title="Latin : Welsh" lang="cy" xml:lang="cy" class="phrase">Yn arwain y We i wireddu’i photensial...</p>
				<div>
					<p>latn (Latin), cy (Welsh)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Stefhan Caddick &amp; Linkline to Welsh</p>
				</div>
				<p title="Myanmar: Burmese" lang="my" xml:lang="my" class="phrase">ကွန်ယက်ကိုအပြည့်အဝဆီသို့ဦးဆောင်ခြင်း</p>
				<div> 
					<p>mymr (Myanmar), my (Burmese)</p>
					<p>Fonts: <a href="http://www.myanmarnlp.net.mm/opentype.htm">Myanmar2</a></p>
					<p>Translation courtesy of Wunna Ko Ko</p>
				</div>
				<p title="Thai : Thai" lang="th" xml:lang="th" class="phrase">การนําไปสู่ Webที่เต็มไปด้วยศักยภาพ</p>
				<div> 
					<p>thai (Thai), th (Thai)</p>
					<p>Fonts: Cordia New (XP font), <a href="ftp://linux.thai.net/pub/thailinux/software/thai-ttf/">Garuda</a> </p>
					<p>Translation courtesy of Jittima B.</p>
				</div>
				<p title="Tibetan : Dzonkha" lang="dz" xml:lang="dz" class="phrase">ཡོངས་འབྲེལ་གྱི་ནུས་ཚད་ཧྲིལ་བུ་སྤྱོད་པ།</p>
				<div> 
					<p>tibt (Tibetan), dz (Dzongkha)</p>
					<p>Fonts:
						<a
						href="http://www.thdl.org/tools/toolbox/index.php?pg=26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan^fonts.html#wiki=/wiki/site/26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan%20fonts.html">Tibetan
						Machine Uni</a></p>
					<p>Translation courtesy of Pema Geyleg, Bhutan DIT</p>
				</div>
			</div>
		</div>
		<div class="section"> 

			<h2><a id="am" name="am">richard ishida</a></h2>
			<p>Transliterations of: "Richard Ishida"</p>
			<div class="indent"> 
				<p title="Akan : Latin" lang="ak" xml:lang="ak" class="phrase">Richard Ishida</p>
				<div> 
					<p>latn (Latin), ak (Akan)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of <a href="http://www.kasahorow.com">www.kasahorow.com</a>.</p>
				</div>
				<p title="Arabic : Arabic" dir="rtl" xml:lang="ar" lang="ar" class="phrase">ريتشارد ايشيدا </p>
				<div> 
					<p>arab (Arabic), ar (Arabic)</p>
					<p>Fonts: Traditional Arabic (XP font), <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=ArabicFonts_Download">Scheherazade</a></p>
					<p>Translation courtesy of Alis Technologies.</p>
				</div>
				<p title="Arabic : Persian" lang="fa" xml:lang="fa" dir="rtl" class="phrase">ریچارد ایشیدا</p>
				<div> 
					<p>arab (Arabic), fa (Persian)</p>
					<p>Fonts: <a href="http://www.scict.ir/Portal/File/ShowFile.aspx?ID=bea5ca36-1fdf-41d4-8818-c1a4f9c71081">IranNastaliq</a></p>
					<p>Translation courtesy of Behnam Esfahbod</p>
				</div>
				<p title="Arabic : Urdu" dir="rtl" xml:lang="ur-UR" lang="ur" class="phrase">رِچرڈ اشیڈا</p>
				<div> 
					<p>arab (Arabic), ur (Urdu)</p>
					<p>Fonts: <a href="http://crulp.org/software/localization/Fonts/nafeesNastaleeq.html">Nafees Nastaleeq v1.01</a></p>
					<p>Translation courtesy of Sarmad Hussain.</p>
				</div>
				<p title="Armenian : Armenian" lang="hy" xml:lang="hy" class="phrase">Ռիչարդ Իշիդա</p>
				<div> 
					<p>armn (Armenian), hy (Armenian)</p>
					<p>Fonts: <a href="http://fonts.tarumian.am/index_Arian_AMU.php">Arian AMU</a>, Sylfaen (XP font)</p>
					<p>Translation courtesy of Mayak Akapyan.</p>
				</div>
				<p title="Canadian Syllabics : Inuktitut" lang="iu" xml:lang="iu" class="phrase">ᕆᑦᓱ ᐃᓰᑕ </p>
				<div> 
					<p>cans (Canadian Unified Syllabics), iu (Inuktitut)</p>
					<p>Fonts: <a href="http://www.tiro.com/syllabics/resources/syllabic_resources.html">Pigiarniq</a>,
						<a href="http://www.tiro.com/syllabics/resources/syllabic_resources.html">Uqammaq</a></p>
					<p>Translation courtesy of Gavin Nesbitt, <a href="www.pirurvik.ca">Pirurvik Centre</a></p>
				</div>
				<p title="Cyrillic : Kazakh" lang="kk" xml:lang="kk" class="phrase">Ричард Ишида</p>
				<div> 
					<p>cyrl (Cyrillic), kk (Kazakh)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a></p>
					<p>Translation courtesy of RWS Translations</p>
				</div>
				<p title="Cyrillic : Russian" lang="ru" xml:lang="ru" class="phrase">Ричард Ишида</p>
				<div> 
					<p>cyrl (Cyrillic), ru (Russian)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a></p>
				</div>
				<p title="Devanagari : Hindi" lang="hi" xml:lang="hi" class="phrase">रिचर्ड इशिदा</p>
				<div> 
					<p>deva (Devanagari), hi (Hindi)</p>
					<p>Fonts: <a href="http://chandas.cakram.org/">Chandas</a>, Mangal (XP font)</p>
					<p>Translation courtesy of Vijay Kumar, CDAC Delhi</p>
				</div>
				<p title="Devanagari : Nepali" xml:lang="ne" class="phrase">रिचर्ड इशिडा</p>
				<div> 
					<p>deva (Devanagari), ne (Nepali)</p>
					<p>Fonts: <a href="http://www.mpp.org.np/detail_guide/fonts.htm">Kanjirowa</a>, Mangal (XP font)</p>
					<p>Translation courtesy of Amar Gurung</p>
				</div>
				<p title="Ethiopic : Amharic" lang="am" xml:lang="am" class="phrase">ሪቻርድ ኢሺዳ</p>
				<div> 
					<p>ethi (Ethiopic), am (Amharic)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=AbyssinicaSIL">Abyssinica SIL</a>, <a href="http://senamirmir.com/downloads/">Ethiopia Jiret</a></p>
					<p>Translation courtesy of Daniel Yacob</p>
				</div>
				<p lang="el" xml:lang="el" title="Greek : Greek" class="phrase">Ριχάρδος Ισίδα</p>
				<div> 
					<p>grek (Greek), el (Greek)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Anna Doxastaki, <a href="http://www.w3c.gr/">W3C Greek Office</a></p>
				</div>
				<p title="Gurmukhi: Punjabi" lang="pa" xml:lang="pa" class="phrase">ਰਿੱਚਰਡ ਇਸ਼ਿਦਾ</p>
				<div> 
					<p>guru (Gurmukhi), pa (Panjabi)</p>
					<p>Fonts: <a href="http://guca.sourceforge.net/typography/fonts/anmoluni/">AnmolUniBani</a></p>
					<p>Translation courtesy of Bhupinder Singh</p>
				</div>
				<p lang="zh-CN" xml:lang="zh-CN" title="Chinese, Simplified : Chinese" class="phrase">瑞查德.伊喜达</p>
				<div> 
					<p>hans (Simplified Chinese), zh (Chinese)</p>
					<p>Fonts: Simsun (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p lang="zh-TW" xml:lang="zh-TW" title="Chinese, Traditional: Chinese" class="phrase">瑞查德.伊喜達</p>
				<div> 
					<p>hant (Traditional Chinese), zh (Chinese)</p>
					<p>Fonts: MingLiu (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a> </p>
				</div>
				<p dir="rtl" xml:lang="he" lang="he" title="Hebrew : Hebrew" class="phrase">ריצ'רד אישידה</p>
				<div> 
					<p>hebr (Hebrew), he (Hebrew)</p>
					<p>Fonts: Times New Roman (XP font), <a href="http://everywitchway.net/linguistics/fonts/roman.html">Roman Unicode</a> </p>
					<p>Translation courtesy of Michel Bercovier, <a href="http://www.w3c.org.il/">Israeli W3C Office</a></p>
				</div>
				<p lang="en-GB-fonipa" xml:lang="en-GB-fonipa" title="IPA : British English" class="phrase">ɹɪcəd ɪʃɪdə</p>
				<div>
                    <p>latn (Latin), en-GB (British English), fonipa (International Phonetic Alphabet) </p>
				    <p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=CharisSILfont">Charis SIL</a>, <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;id=DoulosSILfont">Doulos SIL</a> or <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
				    <p>Translation by myself</p>
			    	</div>
				<p lang="ja" xml:lang="ja" title="Japanese : Japanese" class="phrase">石田リチャード</p>
				<div> 
					<p>jpan (Japanese), ja (Japanese)</p>
					<p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
					<p>Translation courtesy of Fumiko Tanaka, Fuji Xerox</p>
				</div>
				<p lang="km" xml:lang="km" title="Khmer : Khmer" class="phrase">រីស្សារ្ត អ៊ីស្ស៊ីដា</p>
				<div> 
					<p>khmr (Khmer), km (Khmer)</p>
					<p>Fonts: <a href="http://www.khmeros.info/drupal/?q=en/download/fonts">Khmer OS Battambang</a></p>
				</div>
				<p lang="ko" xml:lang="ko" title="Korean : Korean" class="phrase">리차드 이시다</p>
				<div> 
					<p>kore (Korean), ko (Korean)</p>
					<p>Fonts: Arial Unicode MS (XP font), <a href="ftp://ftp.netscape.com/pub/communicator/extras/fonts/windows/">Bitstream CyberCJK</a></p>
				</div>
				<p title="Latin : Venda" lang="ve" xml:lang="ve" class="phrase">Richard Ishida</p>
				<div> 
					<p>latn (Latin), ve (Venda)</p>
					<p>Fonts: <a href="http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&amp;item_id=Gentium">Gentium</a></p>
					<p>Translation courtesy of Lee van Munster</p>
				</div>
				<p title="Myanmar: Burmese" lang="my" xml:lang="my" class="phrase">ရစ်ချက် အီရှိဒါ</p>
				<div> 
					<p>mymr (Myanmar), my (Burmese)</p>
					<p>Fonts: <a href="http://www.myanmarnlp.net.mm/opentype.htm">Myanmar2</a></p>
					<p>Translation courtesy of Wunna Ko Ko</p>
				</div>
				<p title="Telugu : Telugu" lang="te" xml:lang="te" class="phrase">రిఛర్డ ఇషిద</p>
				<div> 
					<p>telu (Telugu), te (Telugu)</p>
					<p>Fonts: <a href="http://www.kamban.com.au/">Akshar Unicode</a>, Gautami (XP font)</p>
					<p>Translation courtesy of Ram Viswanadha</p>
				</div>
				<p title="Thai : Thai" lang="th" xml:lang="th" class="phrase">ริชาร์ด อิชิดะ</p>
				<div> 
					<p>thai (Thai), th (Thai)</p>
					<p>Fonts: Cordia New (XP font), <a href="ftp://linux.thai.net/pub/thailinux/software/thai-ttf/">Garuda</a> </p>
					<p>Translation courtesy of Jittima B.</p>
				</div>
				<p title="Tibetan : Dzonkha" lang="dz" xml:lang="dz" class="phrase">རི་ཆ་རེད་ འི་ཤི་ད།</p>
				<div> 
					<p>tibt (Tibetan), dz (Dzongkha)</p>
					<p>Fonts:
						<a
						href="http://www.thdl.org/tools/toolbox/index.php?pg=26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan^fonts.html#wiki=/wiki/site/26a34146-33a6-48ce-001e-f16ce7908a6a/tibetan%20fonts.html">Tibetan
						Machine Uni</a></p>
					<p>Translation courtesy of Pema Geyleg, Bhutan DIT</p>
				</div>
			</div>
		</div>
		<div id="author"> 
			<p>Author: <a href="http://rishida.net/">Richard Ishida</a>. With thanks to the numerous contributors who made this possible.<!-- [Translator: ___NAME, ____ORGANISATION.]--></p>
		</div>
		<div class="smallprint"> 
			<div id="logos"><a href="http://validator.w3.org/check/referer"><img src="/rishida/icons/valid-xhtml10.gif" alt="Valid XHTML 1.0!"
				height="31" width="88" border="0" /></a><br /><a href="http://jigsaw.w3.org/css-validator/"><img src="/rishida/icons/valid-css.gif" alt="Valid CSS!"
				height="31" width="88" border="0" /></a><br /><a href="http://www.unicode.org/"><img border="0" src="/rishida/icons/UniEncTrans-small.gif"
				alt="Encoded in UTF-8!" width="84" height="33" /></a></div>
			<p id="version">Content created 3 November, 2004. Last update <span id="version-info"><!-- #BeginDate format:IS1m -->2009-03-19  20:40<!-- #EndDate --></span> GMT</p> 
		<!--<p><a href="http://people.w3.org/rishida/blog/index.php?s=Use+of+link+element+to+point+to+translations&amp;submit=Search">Change log</a></p>-->
			<p class="copyright">Copyright © 2004-2008 Richard Ishida.</p>
		</div>

	</body>
</html>
