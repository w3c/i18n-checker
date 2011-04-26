<?php
header('Content-Type: text/html; charset=UTF-8');
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$js[] = "mootools-1.2.5-core-more-yc.js";
$js[] = "w3c_unicorn_index.js";
$js[] = "w3c_unicorn_results.js";
$lang_action = "check";
if ($conf['show_extension']) { $lang_action .= ".php"; }
include('includes/head.html.php');
include('includes/form.php');
?>

<div id="results" class="section">
	<h1 class="title">
		<a href="#result"><?php _lang('results') ?></a>
<!--		<span class="icons">-->
<!--			<a title="Erreurs (19)" href="#css21-validator_error" class="errors">-->
<!--				<span class="legend">Errors</span>-->
<!--				<span class="count">x</span>-->
<!--			</a>-->
<!--			<a title="Avertissements (133)" href="#css21-validator_warning" class="warnings">-->
<!--				<span class="legend">Warnings</span>-->
<!--				<span class="count">y</span>-->
<!--			</a>-->
<!--			<a title="Informations (1)" href="#markup-validator_info" class="infos">-->
<!--				<span class="legend">Info</span>-->
<!--				<span class="count">z</span>-->
<!--			</a>-->
<!--		</span>-->
	</h1>
	
	<div class="block">
	
		<img src="images/error.png" alt="Errors" title="Errors" />
		<strong>1</strong>
		<img src="images/warning.png" alt="Warnings" title="Warnings" />
		<strong>1</strong>
		<img src="images/comment.png" alt="Suggestions" title="Suggestions" />
		<strong>3</strong>
	
<!--		<div id="results_errors" class="section errors">-->
<!--			<h3 class="title">-->
<!--				Errors (x)-->
<!--			</h3>-->
<!--			<div class="block">-->
<!--			</div>-->
<!--		</div>-->
<!--		-->
<!--		<div id="results_warnings" class="section warnings">-->
<!--			<h3 class="title">-->
<!--				Warnings (y)-->
<!--			</h3>-->
<!--			<div class="block">-->
<!--			</div>-->
<!--		</div>-->
<!--		-->
<!--		<div id="results_info" class="section infos">-->
<!--			<h3 class="title">-->
<!--				Info (z)-->
<!--			</h3>-->
<!--			<div class="block">-->
<!--			</div>-->
<!--		</div>-->
		
<?php 
		/* if (count($errors)+count($warnings)+count($comments) == 0) { 
			echo "<p class='noissues'>"; _lang('no_issues'); echo "</p>"; 
		} else {
			echo "<p class='someissues'>";
			if (count($errors)>0) { ?><img src='images/error.png' alt='<?php _lang('errors') ?>' title='<?php _lang('errors') ?>' /> <strong><?php echo count($errors) ?></strong> <?php }
			if (count($warnings)>0) { ?><img src='images/warning.png' alt='<?php _lang('warnings') ?>' title='<?php _lang('warnings') ?>' /> <strong><?php echo count($warnings) ?></strong> <?php }
			if (count($comments)>0) { ?><img src='images/comment.png' alt='<?php _lang('suggestions') ?>' title='<?php _lang('suggestions') ?>' /> <strong><?php echo count($comments) ?></strong> <?php }
			echo "</p>";
		} 
	 */ ?>
		<!-- <p class="backtop"><a href="#"><?php _lang('top') ?></a></p> -->
	</div>
</div>

<div id="infos" class="section">
	<h1 class="title">
		<a href="#infos"><?php _lang('information') ?></a>
		<span><?php //echo $doctypename;?> :: <?php //echo $mimetypename;?></span>
	</h1>
	<div class="block">
		<table>
		<?php 
			foreach ($results["infos"] as $category => $messages) {
			    echo "<tr>\n";
			    	echo "<th>".lang($category)."</th>\n";
					echo "<th></th>\n";
					echo "<th>".lang('code')."</th>\n";
			    echo "</tr>\n";
			    foreach ($messages as $name => $message) {
			    echo "<tr>\n";
			    	echo "<td>".lang($name)."</td>\n";
					echo "<td>";
					if (isset($message['display'])) {
						echo $message['display'];
					} else {
						echo "<strong>".$message['value']."</strong>";
					}
					echo "</td>\n";
					echo "<td>\n";
						if (isset($message['code'])) {
							if (is_array($message['code'])) {
								echo '<ol>';
								foreach ($message['code'] as $code) {
									echo "<li><code>".htmlspecialchars($code)."</code></li>";
								}
								echo '</ol>';
							} else
								echo "<code>".htmlspecialchars($message['code'])."</code>\n";
						}
					echo '</td>';
			    echo '</tr>';
			    }
			}
		?>
		</table>
		<p class="backtop"><a href="#"><?php _lang('top') ?></a></p>
	</div>
</div>

<div id="report" class="section">
	<h1 class="title">
		<a href="#report"><?php _lang('detailed_report') ?></a>
	</h1>
	
	<div class="block">
		<ol>
			<li class="section">
				<h2 class="title">
					<img src="images/warning.png" alt="Warning" title="Warning" />
					The html tag has no language attribute.
				</h2>
				<div class="block">
					<h3>Explanation</h3>
					<p>A Unicode character encoding makes it easier to use a wide range of characters, from the registered trademark symbol to characters in multiple languages. It also simplifies the use of scripts and databases for multilingual sites, and allows you to more easily expand your site to cover new languages, when needed. Using non-UTF-8 encodings can also have unexpected results on form submission and URL encodings, which use the document's character encoding by default. It is not a requirement to use UTF-8, but the HTML5 specification recommends its use, and you should consider it.</p>
					<h3>What to do</h3>
					<p>Save your content as UTF-8, and change the encoding declarations.</p>
					<h3>Futher reading</h3>
					<ul>
						<li><a href="#">Character encodings explained</a></li>
						<li><a href="#">Choosing a character encoding</a></li>
						<li><a href="#">Changing the encoding of a document</a></li>
					</ul>
					<p class="backtop"><a href="#"><?php _lang('top') ?></a></p>
				</div>
				
			</li>
			<li class="section">
				<h2 class="title">
					<img src="images/comment.png" alt="Suggestion" title="Suggestion" />
					Non-UTF8 character encoding declared.
				</h2>
				<div class="block">
					<h3>Explanation</h3>
					<p>A Unicode character encoding makes it easier to use a wide range of characters, from the registered trademark symbol to characters in multiple languages. It also simplifies the use of scripts and databases for multilingual sites, and allows you to more easily expand your site to cover new languages, when needed. Using non-UTF-8 encodings can also have unexpected results on form submission and URL encodings, which use the document's character encoding by default. It is not a requirement to use UTF-8, but the HTML5 specification recommends its use, and you should consider it.</p>
					<h3>What to do</h3>
					<p>Save your content as UTF-8, and change the encoding declarations.</p>
					<h3>Futher reading</h3>
					<ul>
						<li><a href="#">Character encodings explained</a></li>
						<li><a href="#">Choosing a character encoding</a></li>
						<li><a href="#">Changing the encoding of a document</a></li>
					</ul>
					<p class="backtop"><a href="#"><?php _lang('top') ?></a></p>
				</div>
			</li>
		</ol>
		
		
		
		<?php /* <table>
			foreach ($results["reports"] as $category => $messages) {
			    echo "<tr class='header'>\n";
			    	echo "<td>".lang($category)."</td>\n";
					echo "<td></td>\n";
					echo "<td>".lang('code')."</td>\n";
			    echo "</tr>\n";
			    foreach ($messages as $name => $message) {
			    echo "<tr>\n";
			    	echo "<td>".lang($name)."</td>\n";
					echo "<td>".$message['value']."</td>\n";
					echo "<td>\n";
						if (isset($message['code']))
						foreach ($message['code'] as $code) {
							echo "<code>".$code."</code>\n";
						}
					echo '</td>';
			    echo '</tr>';
			    }
			}
</table>		*/ ?>
		
		<!--<p class="backtop"><a href="#"><?php _lang('top') ?></a></p>
	--></div>
</div>

<!--  <div id="source" class="section">
	<h1><a href="#source"><?php _lang('source_code') ?></a></h1>
	<div class="content">
	</div>
</div> -->

<div id="don_program">
	<script type="text/javascript" src="http://www.w3.org/QA/Tools/don_prog.js"></script>
</div>
	
<?php include('includes/footer.html.php');