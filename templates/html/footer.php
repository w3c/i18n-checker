	<ul id="menu">
			<li><a href="<?php echo Conf::get('base_uri') ?>" title="<?php _lang('footer_home_title') ?>"><?php _lang('footer_home') ?></a></li>
			<li><a href="<?php echo Conf::get('base_uri'), 'about', Conf::get('show_extension') ? '.php' : '' ?>" title="<?php _lang('footer_about_title') ?>"><?php _lang('footer_about') ?></a></li>
			<li><a href="https://github.com/w3c/i18n-checker" title="<?php _lang('footer_download_title') ?>"><?php _lang('footer_download') ?></a></li>
			<!-- <li><a href="<?php echo Conf::get('base_uri') ?>translation.html" hreflang="en" title="<?php _lang('footer_translation_title') ?>"><?php _lang('footer_translation') ?></a></li> -->
			<li><a href="https://github.com/w3c/i18n-checker/issues<?php //echo Conf::get('base_uri'), 'feedback', Conf::get('show_extension') ? '.php' : '' ?>" hreflang="en" title="<?php _lang('footer_feedback_title') ?>"><?php _lang('footer_feedback') ?></a></li>
	</ul>
	
	<?php if (!isset($hideLangSelection) || $hideLangSelection != true) { ?>
	<form action="<?php echo isset($lang_action) ? $lang_action : '' ?>" method="get" id="lang_choice">
		<fieldset>
			<label for="lang">Language</label>
			<select name="lang" id="lang" title="Select language">
				<?php foreach (Language::$languages as $langCode => $langName) { ?>
					<option value="<?php echo $langCode?>" <?php if ($lang == $langCode) { ?>selected="selected"<?php } ?>><?php echo $langName; if ($lang != $langCode) echo ' ('.Locale::getDisplayLanguage($langCode, $lang).')'; ?></option>
				<?php } ?>
			</select>
			<input id="lang_change" type="submit" value="OK" />
			<?php if (isset($uri)) { ?><input name="uri" id="uri" type="hidden" value="<?php echo htmlentities($uri,ENT_COMPAT,'UTF-8') ?>" /><?php } ?>
		</fieldset>
	</form>
	<?php } ?>
	
	<div id="footer">
		<div class="leftCol w3cLargeLogo">
			<p id="activity_logos">
				<a class="w3cLarge" href="http://www.w3.org/International/"><span>W3C Internationalization Activity</span></a>
			</p>
		</div>
		
		<p id="support_logo">
			<a href="http://www.w3.org/QA/Tools/Donate" title="Validators Donation Program">
				<img src="<?php echo Conf::get('base_uri') ?>images/I_heart_validator.png" alt="I heart Validator logo"/>
			</a>
		</p>
		<p class="copyright" xml:lang="en" lang="en" dir="ltr">
			<a rel="Copyright" href="http://www.w3.org/Consortium/Legal/ipr-notice#Copyright">Copyright</a> &copy; 2013-2016
			<a href="http://www.w3.org/"><acronym title="World Wide Web Consortium">W3C</acronym></a>&reg;

			(<a href="http://www.csail.mit.edu/"><acronym title="Massachusetts Institute of Technology">MIT</acronym></a>,
			<a href="http://www.ercim.eu/"><acronym title="European Research Consortium for Informatics and Mathematics">ERCIM</acronym></a>,
			<a href="http://www.keio.ac.jp/">Keio</a>,
			<a href="http://ev.buaa.edu.cn/">Beihang</a>),
			All Rights Reserved.
			W3C <a href="http://www.w3.org/Consortium/Legal/ipr-notice#Legal_Disclaimer">liability</a>,
			<a href="http://www.w3.org/Consortium/Legal/ipr-notice#W3C_Trademarks">trademark</a>,
			<a rel="Copyright" href="http://www.w3.org/Consortium/Legal/copyright-documents">document use</a>
			and <a rel="Copyright" href="http://www.w3.org/Consortium/Legal/copyright-software">software licensing</a>

			rules apply. Your interactions with this site are in accordance
			with our <a href="http://www.w3.org/Consortium/Legal/privacy-statement#Public">public</a> and
			<a href="http://www.w3.org/Consortium/Legal/privacy-statement#Members">Member</a> privacy
			statements.
		</p>
	</div>
	
	<script type="text/javascript">
		if(typeof W3C != 'undefined')
			W3C.start();
	</script>
	
</body>
</html>
