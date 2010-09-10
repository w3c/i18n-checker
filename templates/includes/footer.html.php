	<ul id="menu">
			<li><a href="<?php echo $baseUri ?>" title="<?php _lang('footer_home_title') ?>"><?php _lang('footer_home') ?></a></li>
			<li><a href="<?php echo $baseUri ?>about.html" title="<?php _lang('footer_about_title') ?>"><?php _lang('footer_about') ?></a></li>
			<li><a href="#" title="<?php _lang('footer_download_title') ?>"><?php _lang('footer_download') ?></a></li>
			<li><a href="#" hreflang="en" title="<?php _lang('footer_translation_title') ?>"><?php _lang('footer_translation') ?></a></li>
			<li><a href="#" hreflang="en" title="<?php _lang('footer_feedback_title') ?>"><?php _lang('footer_feedback') ?></a></li>
	</ul>
	
	<form action="./" method="get" id="lang_choice">
		<fieldset>
			<label for="lang">Language</label>
			<select name="lang" id="lang" title="Select language">
				<?php foreach ($languages as $langCode => $langName) { ?>
					<option value="<?php echo $langCode?>" <?php if ($lang == $langCode) { ?>selected="selected"<?php } ?>><?php echo $langName; if ($lang != $langCode) echo ' ('.Locale::getDisplayLanguage($langCode, $lang).')'; ?></option>
				<?php } ?>
			</select>
			<input id="lang_change" type="submit" value="OK" />
		</fieldset>
	</form>
	
	<div id="footer">
		<p id="activity_logos">
			<a href="http://www.w3.org/Status" title="<?php _lang('footer_download_title') ?>">
				<img src="<?php echo $baseUri ?>images/opensource-75x65.png" alt="Open Source logo" height="48"/>
			</a>
		</p>
		<p id="support_logo">
			<a href="http://www.w3.org/QA/Tools/Donate" title="$donation_program">
				<img src="<?php echo $baseUri ?>images/I_heart_validator.png" alt="I heart Validator logo"/>
			</a>
		</p>
		<p class="copyright" xml:lang="en" lang="en" dir="ltr">
			<a rel="Copyright" href="http://www.w3.org/Consortium/Legal/ipr-notice#Copyright">Copyright</a> &copy; 1994-2010
			<a href="http://www.w3.org/"><acronym title="World Wide Web Consortium">W3C</acronym></a>&reg;

			(<a href="http://www.csail.mit.edu/"><acronym title="Massachusetts Institute of Technology">MIT</acronym></a>,
			<a href="http://www.ercim.eu/"><acronym title="European Research Consortium for Informatics and Mathematics">ERCIM</acronym></a>,
			<a href="http://www.keio.ac.jp/">Keio</a>),
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
</body>
</html>
