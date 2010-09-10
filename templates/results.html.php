<?php
$title = "W3C I18n Checker";
$css[] = "base_ucn.css";
$css[] = "checker.css";
$css[] = "checker-additional.css";

$js[] = "mootools-1.2.4-core-more-yc.js";
$js[] = "expandcollapse.js";
include('includes/head.html.php');
 ?>

<div id="summary" class="mod raw">
	<div class="hd implicit">
		<h2><a href="#summary"><?php _lang('report') ?></a></h2>
		</div>
	
	<div class="bd">
		<div id="address" class="mod square">
			<div class="hd section">
				<div>
					<h3><a href="#address"><label title="<?php _lang('address_title') ?>" for="docAddr"><?php _lang('address') ?></label></a><span>: </span><strong class="advin"><?php echo htmlspecialchars($uri); ?></strong></h3>
					</div>
				</div>
			<div class="bd text expand_content">
				<form method="get" action="">
					<div>
						<input type="text" id="docAddr" name="docAddr" onclick="this.select();" value="<?php echo htmlspecialchars($hint);?>" size="30" /> 
						</a><input type="submit" style="font-size: small; background-color: rgb(238, 238, 238); color: rgb(17, 17, 26); border: 1px solid rgb(204, 204, 204); padding: 0.2em 0.5em; margin-left: 0.5em;" value="<?php _lang('run_another_check') ?>" title="<?php _lang('run_another_check') ?>" /></div>
					</form>
				<?php echo $failuremessage; //----------------------------------> put in message?>
				</div>
			</div>
		</div>
	
	<?php if (!$fail) { ?>
		<div id="summaryresults">
			<div class="hd section">
				<div>
					<h3><a href="#summaryresults"><?php _lang('results') ?></a><span>: </span></h3>
					</div>
				</div>
			<div class="bd text expand_content">
				<?php 
				if (count($errors)+count($warnings)+count($comments) == 0) { 
					echo "<p class='noissues'>"; _lang('no_issues'); echo "</p>"; 
					}
				else {
					echo "<p class='someissues'>";
					if (count($errors)>0) { ?><img src='images/error.png' alt='<?php _lang('errors') ?>' title='<?php _lang('errors') ?>' /> <strong><?php echo count($errors) ?></strong> <?php }
					if (count($warnings)>0) { ?><img src='images/warning.png' alt='<?php _lang('warnings') ?>' title='<?php _lang('warnings') ?>' /> <strong><?php echo count($warnings) ?></strong> <?php }
					if (count($comments)>0) { ?><img src='images/comment.png' alt='<?php _lang('suggestions') ?>' title='<?php _lang('suggestions') ?>' /> <strong><?php echo count($comments) ?></strong> <?php }
					echo "</p>";
					}
				?>
				</div>
			</div>
			
		<div class="line">
<div id="pagesize" class="mod square">
					<div class="hd section">
						<div>
							<h3><a href="#pagesize"><?php _lang('information') ?></a><span>: </span><strong><?php echo $doctypename;?> :: <?php echo $mimetypename;?></strong></h3>
							</div>
						</div>
					<div class="bd expand_content">
						<!--div class="text">Doctype of the page: <strong><?php echo $doctypename;?></strong><br />Served as: <strong>HTML</strong></div-->
						<div>
								<table class="details">
									<tr>
										<th style="width: 25%;"><?php _lang('character_encoding') ?></th>
										<th style="min-width:15%;">&nbsp;</th>
										<th><?php _lang('code') ?></th>
									</tr>
									<tr>
										<td class="number"><?php _lang('content_type') ?></td>
										<td><?php
										if (! isset($result['headers']['Content-Type'])) { _lang('none_found'); }
										else if ($char_encoding['http']['value'] != '') { print "<span class='result'>".$char_encoding['http']['value']."</span>"; }
										else { _lang('no_charset_found'); } 
										//if ($httpcharsetValue=='nocharset') { print "No charset found."; }
										//else if ($httpcharsetValue=='') { print "None found."; }
										//else { print "<span class='result'>".$httpcharsetValue."</span>"; } ?>
										</td>
										<td><?php
										if (! isset($result['headers']['Content-Type'])) { print "&nbsp;"; }
										else { print '<code>'.$char_encoding['http']['code'].'</code>'; } 
										//if ($httpcontenttypeHeader=='') { print "&nbsp;"; }
										//else { print '<code>'.$httpcontenttypeHeader.'</code>'; } ?>
										</td>
									</tr>
									<tr>
										<td class="number"><?php _lang('bom') ?></td>
										<td><?php
											if ($char_encoding['bom']['value'] != '') { print "<span class='result'>{$char_encoding['bom']['value']}</span>"; }
											else { _lang('no'); } ?>
										</td>
										<td>&nbsp;
										</td>
								</tr>
									<tr>
										<td class="number"><?php _lang('xml_declaration') ?></td>
										<td><?php
										if ($xmldeclTag == '') { _lang('none_found'); }
										else if ($char_encoding['xmldecl']['value'] != '') { print "<span class='result'>".$char_encoding['xmldecl']['value']."</span>"; }
										else { _lang('no_encoding_found'); } 
										//if ($char_encoding['xmldecl']['value']=='noinfo') { print "No encoding information found."; }
										//else if ($xmlcharsetValue=='') { print "None found."; }
										//else { print "<span class='result'>".$xmlcharsetValue."</span>"; } ?>
										</td>
										<td><?php
										if ($xmldeclTag=='') { print "&nbsp;"; }
										else { print '<code>'.$xmldeclTag.'</code>'; } ?>
										</td>
									</tr>
									<tr>
									<td class="number"><?php _lang('content_type_meta') ?></td>
									<td><?php
										if ($char_encoding['httpequiv']['value']=='') { _lang('none_found'); }
										else { print "<span class='result'>".$char_encoding['httpequiv']['value']."</span>"; } ?>
									</td>
									<td><?php
										if ($char_encoding['httpequiv']['code']=='') { print "&nbsp;"; }
										else { print '<code>'.$char_encoding['httpequiv']['code'].'</code>'; } ?>
									</td>
									</tr>
									<tr>
										<td class="number"><?php _lang('html5_meta_charset') ?></td>
										<td><?php
											if ($char_encoding['html5']['value']=='') { _lang('none_found'); }
											else { print "<span class='result'>".$char_encoding['html5']['value']."</span>"; } ?>
										</td>
										<td><?php
											if ($char_encoding['html5']['code']=='') { print "&nbsp;"; }
											else { print '<code>'.$char_encoding['html5']['code'].'</code>'; } ?>
										</td>
									</tr>
								</table>
								<table class="details">
									<tr>
										<th style="width: 25%;"><?php _lang('language') ?></th>
										<th style="min-width: 15%;">&nbsp;</th>
										<th><?php _lang('code') ?></th>
										</tr>
									<tr>
										<td class="number">&lt;html lang=</td>
										<td><?php
										if ($htmltag=='') { _lang('no_html_tag_found'); }
										else if ($htmllangValue=='') { _lang('none'); }
										else { print "<span class='result'>".$htmllangValue."</span>"; } ?>
										</td>
										<td><?php
										if ($htmltag=='') { print "&nbsp;"; }
										else { print '<code>'.$htmltag.'</code>'; } ?>
										</td>
										</tr>
									<tr>
										<td class="number">&lt;html xml:lang=</td>
										<td><?php
										if ($htmltag=='') { _lang('no_html_tag_found'); }
										else if ($htmlxmllangValue=='') { _lang('none'); }
										else { print "<span class='result'>".$htmlxmllangValue."</span>"; } ?>
										</td>
										<td><?php
										if ($htmltag=='') { print "&nbsp;"; }
										else { print '<code>'.$htmltag.'</code>'; } ?>
										</td>
										</tr>
									<tr>
										<td class="number"><?php _lang('http_content_language') ?></td>
										<td><?php
										if ($httpcontentlangHeader=='') { _lang('none_found'); }
										else if ($httpcontentlangValue=='') { _lang('none'); }
										else { print "<span class='result'>".$httpcontentlangValue."</span>"; } ?>
										</td>
										<td><?php
										if ($httpcontentlangHeader=='') { print "&nbsp;"; }
										else { print '<code>'.$httpcontentlangHeader.'</code>'; } ?>
										</td>
									</tr>
									<tr>
										<td class="number"><?php _lang('meta_content_language') ?></td>
										<td><?php
										if ($metacontentlangTag=='') { _lang('none_found'); }
										else if ($metacontentlangValue=='') { _lang('none'); }
										else { print "<span class='result'>".$metacontentlangValue."</span>"; } ?>
										</td>
										<td><?php
										if ($metacontentlangTag=='') { print "&nbsp;"; }
										else { print '<code>'.$metacontentlangTag.'</code>'; } ?>
										</td>
									</tr>
									<tr>
										<td class="number"><?php _lang('detected_language') ?></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										</tr>
							</table>
								<table class="details">
									<tr>
										<th style="width: 25%;"><?php _lang('text_direction') ?></th>
										<th style="min-width: 15%;">&nbsp;</th>
										<th><?php _lang('code') ?></th>
										</tr>
									<tr>
										<td class="number"><?php _lang('default_direction') ?></td>
										<td><?php
										if ($htmltag=='') { _lang('none'); }
										else if ($htmldirValue=='') { _lang('ltr_default'); }
										else { print "<span class='result'>".$htmldirValue."</span>"; } ?>
										</td>
										<td><?php
										if ($htmltag=='') { print "&nbsp;"; }
										else { print '<code>'.$htmltag.'</code>'; } ?>
										</td>
										</tr>
							</table>
							<table class="details">
									<tr>
										<th style="width: 25%;"><?php _lang('class_and_id') ?></th>
										<th style="min-width: 15%;">&nbsp;</th>
										<th><?php _lang('code') ?></th>
								</tr>
									<tr>
										<td class="number"><?php _lang('class_and_id_non_ascii') ?></td>
										<td><?php
										if ($nonasciinamectr==0) { _lang('none'); }
										else { print "<span class='result'>".$nonasciinamectr."</span>"; } ?>
										</td>
										<td><?php
										if ($nonasciinamectr==0) { print "&nbsp;"; }
										else { print "<p><button id='classdisplaybuttonChart' onclick='document.getElementById(\"nonasciiclassoridChart\").style.display = \"block\"; this.style.display = \"none\"; return false;'>Show list</button></p><ol id='nonasciiclassoridChart' style='display:none;' class='detail'>".$nonasciinames."</ol>"; } ?>
										</td>
										
								</tr>
									<tr>
										<td class="number"><?php _lang('class_and_id_non_nfc') ?></td>
										<td><?php
										if ($nonnfcnamectr==0) { _lang('none'); }
										else { print "<span class='result'>".$nonnfcnamectr."</span>"; } ?>
										</td>
										<td><?php
										if ($nonnfcnamectr==0) { print "&nbsp;"; }
										else { print "<p><button id='nfcdisplaybuttonChart' onclick='document.getElementById(\"nonnfcclassoridChart\").style.display = \"block\"; this.style.display = \"none\"; return false;'>Show list</button></p><ol id='nonnfcclassoridChart' style='display:none;' class='detail'>".$nonnfcnames."</ol>"; } ?>
										</td>
									</tr>
							</table>
								<table class="details">
									<tr>
										<th style="width: 25%;"><?php _lang('request_headers') ?></th>
										<th>&nbsp;</th>
										</tr>
									<tr>
										<td class="number"><?php _lang('accept_Language') ?></td>
										<?php 
						if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) { echo "<td class='resultdiv'><span class='result'>".$_SERVER['HTTP_ACCEPT_LANGUAGE'].'</span></td>'; }
							else { ?> <td> <?php _lang('none_found'); ?> </td><?php }?>
										</tr>
									<tr>
										<td class="number"><?php _lang('accept_charset') ?></td>
										<?php if (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) { echo "<td class='resultdiv'><span class='result'>".$_SERVER['HTTP_ACCEPT_CHARSET'].'</span></td>'; }
							else { echo "<td>"; _lang('none_found'); echo "</td>"; }
							?>
										</tr>
							</table>
						</div>
							<p class="backtop"><a href="#banner"><?php _lang('top') ?></a></p>
					</div>
				</div>
	</div>
		</div>



	<?php // only show this section if there are issues to report
	if (count($errors)+count($warnings)+count($comments) > 0) { 
	?>

<div class="mod raw">
	<div class="hd implicit">
		<h2><?php _lang('detailed_report') ?></h2>
		</div>
	<div class="bd">
		<div id="results">
			<div id="details" class="mod square expandable">
				<div class="hd section warningSection">
					<div><h3><a href="#details"><?php _lang('detailed_report') ?></a></h3></div>
					</div>
				<div class="bd expand_content">
					<ul id="msgHeader" class="line msgHeader sortKeys">
						<li id="sortBySeverity" class="unit min1of10 sortKey sortBySeverity selected sortDesc"><?php _lang('severity') ?></li>
						<li id="sortByDesc" class="unit min7of10 sortKey sortByDesc"><a href="#sortByDesc"><?php _lang('description') ?></a></li>
						</ul>
					<ol class="sortData">
					
			<?php 
			$reportcount = 0;
			for ($i=0;$i<count($errors);$i++) {
				echo "<li class='mod noborder ";
				if ($reportcount % 2) { echo "odd"; } else { echo "even"; }
				echo "'>\n<div class='hd msg'>\n<div class='expand_title'>\n<div class='line'><span class='impl'> Severity: </span><span class='unit min1of10 severity'><img width='32' height='32' src='images/error.png' alt='error'  /></span><span class='impl'> ; description: </span><span class='unit min7of10 desc'>".$errors[$i][0]."</span></div>\n</div>\n</div>\n";
				echo "<div class='bd expand_content'>\n<div class='mod noborder expandable why'>\n<div class='bd explanation'>".$errors[$i][1]."</div>\n</div>\n</div>\n";
				echo "<p class='backtop'><a href='#banner'>Top</a></p>\n</li>";
				$reportcount++;
				}
				?>
				
			<?php for ($i=0;$i<count($warnings);$i++) {
				echo "<li class='mod noborder ";
				if ($reportcount % 2) { echo "odd"; } else { echo "even"; }
				echo "'>\n<div class='hd msg'>\n<div class='expand_title'>\n<div class='line'><span class='impl'> Severity: </span><span class='unit min1of10 severity'><img width='32' height='32' src='images/warning.png' alt='warning'  /></span><span class='impl'> ; description: </span><span class='unit min7of10 desc'>".$warnings[$i][0]."</span></div>\n</div>\n</div>\n";
				echo "<div class='bd expand_content'>\n<div class='mod noborder expandable why'>\n<div class='bd explanation'>".$warnings[$i][1]."</div>\n</div>\n</div>\n";
				echo "<p class='backtop'><a href='#banner'>Top</a></p>\n</li>";
				$reportcount++;
				}
				?>
				
			<?php for ($i=0;$i<count($comments);$i++) {
				echo "<li class='mod noborder ";
				if ($reportcount % 2) { echo "odd"; } else { echo "even"; }
				echo "'>\n<div class='hd msg'>\n<div class='expand_title'>\n<div class='line'><span class='impl'> Severity: </span><span class='unit min1of10 severity'><img width='32' height='32' src='images/comment.png' alt='comment'  /></span><span class='impl'> ; description: </span><span class='unit min7of10 desc'>".$comments[$i][0]."</span></div>\n</div>\n</div>\n";
				echo "<div class='bd expand_content'>\n<div class='mod noborder expandable why'>\n<div class='bd explanation'>".$comments[$i][1]."</div>\n</div>\n</div>\n";
				echo "<p class='backtop'><a href='#banner'>Top</a></p>\n</li>";
				$reportcount++;
				}
				?>
				
		<?php } ?>
<!--						<li id="d6e197" class="mod noborder even">
							<div class="hd msg">
								<div class="expand_title">
									<div class="line"><span class="impl"> Severity: </span><span class="unit min1of10 severity"><img width="32" height="32" src="images/error.png" alt="error"  /></span><span class="impl"> ; description: </span><span class="unit min7of10 desc">Table contains less than two td elements</span></div>
									</div>
								</div>
							<div class="bd expand_content">
								<div id="d4e2011-why" class="mod noborder expandable why">
									<div class="bd explanation">A table with only one column is either the sign that the table is used:
										<ul>
											<li>to represent a list of items</li>
											<li>to control the relative position of various sections of the page</li>
											</ul>
										Both uses imply a layout based on tables. While most mobile devices support basic tables, they are rendered quite differently by different 
										mobile browsers, and cannot be reliably used for layout. The <code>table</code> element should only be used - with care -  to represent tabular 
										data.</div>
									</div>
								<p class="backtop"><a href="#banner">Top</a></p>
								</div>
							</li> -->
	<?php // only show this section if there are issues to report
	if (count($errors)+count($warnings)+count($comments) > 0) { 
	?>
							
						</ol>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>


<!-- SHOW SOURCE -->
	<div class="bd">
		<div id="source" class="mod square">
			<div class="hd section">
				<div>
					<h3><a href="#source"><label title="Source code checked." for="docAddr"><?php _lang('source_code') ?></label></a><span>: </span></h3>
					</div>
				</div>
			<div class="bd text expand_content">
					<pre style="font-size: 80%;"><?php echo htmlspecialchars($result['body']); ?></pre>
				</div>
			</div>
		</div>



	<!--
	print '<iframe id="iframepage" style="width: 100%;" src="'.htmlspecialchars($uri).'">The page itself.</iframe>';
	-->
	
	<?php } ?>
	
	<script type="text/javascript">
		window.onload=function(){initialiseMain('mybody', 'h3',''); initialiseReport('results','div','expand_title');}
	</script>
	
	<div id="don_program">
		<script type="text/javascript" src="http://www.w3.org/QA/Tools/don_prog.js"></script>
	</div>
	
<?php include('includes/footer.html.php');