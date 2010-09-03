<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xml:lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>W3C I18n Checker</title>
<link rel="stylesheet" type="text/css" href="checker.css" />
<style type="text/css" media="screen and (min-width: 481px)" xml:space="preserve">
@import url("checker-additional.css");
</style>
<link rel="stylesheet" type="text/css" 
href="checker.css" media="handheld, only screen and (max-device-width: 480px)" />
<!--[if gt IE 6]><link rel="stylesheet" type="text/css" href="checker-additional.css" media="screen" /><![endif]-->
<script type="text/javascript" src="expandcollapse.js"></script>
<link rel="stylesheet" type="text/css" href="expandcollapsestyle.css"/>

<meta name="viewport" content="width=320" />
<meta name="keywords" content="internationalization checker i18n encoding character charset language declaration HTTP direction normalization" />
<meta name="description" content="Tool to detect internationalization-related declarations and possible problems in HTTP headers and markup of HTML and XHTML files." />

<?php
include('initialcode.php');
include('n11n.php');
?>

</head>

<body class="page liquid js" id="mybody"><!-- onload="initialiseMain('mybody', 'h3','');initialiseReport('results','div','expand_title');"-->
<div id="banner" class="head">
	<div class="body">
		<div class="leftCol w3cLogo"><a href="http://www.w3.org/" 
class="w3c"><acronym title="World Wide Web Consortium">W3C</acronym></a>
			</div>
		<div class="main title">
			<h1 id="title"><span>W3C Internationalization Checker (Prototype only!)</span></h1>
			<p class="tagline">Is your Web site internationalized?</p>
            </div>
		</div>
	</div>


<?php if (! isset($_GET['docAddr'])) { ?>
<div class="body">
	<div class="forms">
		<h2>Check a Web page for internationalization friendliness</h2>
        <div id="validationMenu" class="bar tabBar">
			<ul class="inner">
				<li class="item selected"><a href="#validate_by_uri"><span>Validate by</span> URI</a></li>
				<!--li class="item"><a href="#validate_by_upload"><span>Validate by</span> File Upload</a></li><li class="item"><a href="#validate_by_input"><span>Validate by</span> Direct Input</a></li-->
				</ul>
			</div>
		<div id="fields" class="body tabBody">
			<fieldset id="validate-by-uri" class="item">
				<legend style="display: none;">Validate by URI</legend>
				<form method="get" action="index" enctype="application/x-www-form-urlencoded">
					<p id="addressline">
						<label for="docAddr">Address:</label>
						<input name="docAddr" id="docAddr" value="http://" size="5" type="text" />
						<input name="async" class="async" value="true" type="hidden" />
						</p>
					<p class="submitLine"><span class="submitSpan"><input title="Submit for validation" value="Check" type="submit" /></span></p>
					</form>
				</fieldset>
               
               <!--fieldset style="display: none;" id="validate-by-upload" 
class="item">
                  
                  
                  <legend style="display: none;">Validate by File Upload</legend>
                  
                  
                  <form method="post" action="check" 
enctype="multipart/form-data">
                     <p>
                        <label title="Choose a Local File to Upload and 
Validate" for="uploaded_file">File:</label>
                        <input id="uploaded_file" name="uploaded_file" 
type="file" />
                        <input name="async" class="async" value="true" 
type="hidden" />
                        
                        
                     </p>
                     <p class="submitLine">
                        <span class="submitSpan"><input title="Submit 
for validation" value="Check" type="submit" /></span>
                        
                        
                     </p>
                  </form>
                  
                  
                  
                  <p>
                     <strong>Note</strong>: mobileOK tests cannot all be
 run when file upload is used. In particular, checks at the HTTP level 
and tests that apply
                     on resources linked from the HTML document cannot 
be run. Also note that file upload may not work with Internet Explorer 
on
                     some versions of Windows XP Service Pack 2, see our
 <a href="http://www.w3.org/QA/2005/01/Validator-IE_WinXP_SP2" 
shape="rect">information page</a> on the W3C QA Website.
                     
                     
                  </p>
                  
                  
               </fieldset>
               
               
               
               <fieldset style="display: none;" id="validate-by-input" 
class="item" />
                  
                  
                  <legend style="display: none;">Validate by direct 
input</legend>
                  
                  
                  <form method="post" action="check" 
enctype="multipart/form-data">
                     <p>
                        <label title="Paste a complete (HTML) Document 
here" for="fragment">Enter the Markup to validate</label>:
                        <br />
                        <textarea id="fragment" name="fragment" 
rows="12" cols="10"></textarea>
                        <input name="async" class="async" value="true" 
type="hidden" />
                        
                        
                     </p>
                     <p class="submitLine">
                        <span class="submitSpan"><input title="Submit 
for validation" value="Check" type="submit" /></span>
                        
                        
                     </p>
                  </form>
                  
                  
                  
                  <p>
                     <strong>Note</strong>: mobileOK tests cannot all be
 run when direct input is used. In particular, checks at the HTTP level 
and tests that apply
                     on resources linked from the HTML document cannot 
be run.
                     
                     
                  </p>
                  
                  
               </fieldset-->
               
			</div>      
            
		<div class="intro">
			<p>This checker performs various tests on a Web Page to determine its level of internationalisation-friendliness.  It also summarises key internationalization information about a page, such as character encoding and language declarations, etc. Please refer to the <a href="about.html">About</a> page for more details. </p>
			<p>If you wish to validate specific content such as <a href="http://validator.w3.org/" title="W3C Markup Validation Service">markup validation</a>,   <a href="http://validator.w3.org/mobile/" title="W3C mobileOK Checker">mobileOK</a>,  <a href="http://validator.w3.org/feed/" title="Feed validator, hosted at W3C">RSS/Atom feeds</a>,  <a href="http://jigsaw.w3.org/css-validator/" title="W3C CSS Validation Service">CSS stylesheets</a>, or to <a href="http://validator.w3.org/checklink" title="W3C Link Checker">find broken links</a>, there are <a href="http://www.w3.org/QA/Tools/">other validators and 
				tools</a> available.</p>
			<p><strong>The checker is still only a prototype, so there are guarranteed to be bugs and missing features.</strong> It will be developed over the coming months, but  it has been made available for use now since it is likely to be helpful to many people already. If you have suggestions for ways to improve the checker, please fill in the <a href="feedback.html">feedback form</a>.</p>
			</div>
		</div>
	</div>
<?php } 
else { ?>        

<?php include('checkercode.php'); ?>
<?php include('checkermessages.php'); ?>
<?php include('createmessages.php'); ?>
  
<div id="summary" class="mod raw">
	<div class="hd implicit">
		<h2><a href="#summary">Report</a></h2>
		</div>

	<div class="bd">
		<div id="address" class="mod square">
			<div class="hd section">
				<div>
					<h3><a href="#address"><label title="Address of the page to check" for="docAddr">Address</label></a><span>: </span><strong class="advin"><?php echo htmlspecialchars($uri); ?></strong></h3>
					</div>
				</div>
			<div class="bd text expand_content">
				<form method="get" action="">
					<div><input type="hidden" id="async" name="async" value="false" />
						<input type="text" id="docAddr" name="docAddr"  onclick="this.select();" value="<?php echo htmlspecialchars($hint);?>" size="30" /> 
						<!--a href="http://rishida.net/" title="View the page"><img width="13" height="9" src="check_files/view.gif" alt="Go to" /></a--><input type="submit" style="font-size: small; background-color: rgb(238, 238, 238); color: rgb(17, 17, 26); border: 1px solid rgb(204, 204, 204); padding: 0.2em 0.5em; margin-left: 0.5em;" value="Run another check" title="Run another check" /></div>
                    </form>
				<?php echo $failuremessage; ?>
                </div>
            </div>
		</div>

		
	
	
	<?php if (!$fail) { ?>
		<div id="summaryresults">
			<div class="hd section">
				<div>
					<h3><a href="#summaryresults">Results</a><span>: </span></h3>
					</div>
				</div>
			<div class="bd text expand_content">
				<?php 
				if (count($errors)+count($warnings)+count($comments) == 0) { 
					echo "<p class='noissues'>No issues to report !</p>"; 
					}
				else {
					echo "<p class='someissues'>";
					if (count($errors)>0) { echo "<img src='images/error.png' alt='Errors' title='Errors' /> <strong>".count($errors)."</strong>"; }
					if (count($warnings)>0) { echo "<img src='images/warning.png' alt='Warnings' title='Warnings' /> <strong>".count($warnings)."</strong>"; }
					if (count($comments)>0) { echo "<img src='images/comment.png' alt='Suggestions' title='Suggestions' /> <strong>".count($comments)."</strong>"; }
					echo "</p>";
					}
				?>
                </div>
            </div>
			
		<div class="line">
<div id="pagesize" class="mod square">
					<div class="hd section">
						<div>
							<h3><a href="#pagesize">Information</a><span>: </span><strong><?php echo $doctypename;?> :: <?php echo $mimetypename;?></strong></h3>
                        	</div>
						</div>
					<div class="bd expand_content">
						<!--div class="text">Doctype of the page: <strong><?php echo $doctypename;?></strong><br />Served as: <strong>HTML</strong></div-->
						<div>
                                 <table class="details">
                                     <tr>
                                         <th style="width: 25%;">Character encoding</th>
                                         <th style="min-width:15%;">&nbsp;</th>
                                         <th>Code</th>
                                     </tr>
                                     <tr>
                                         <td class="number">HTTP Content-Type</td>
                                         <td><?php
										 if (! isset($result['headers']['Content-Type'])) { print "None found."; }
										 else if ($char_encoding['http']['value'] != '') { print "<span class='result'>".$char_encoding['http']['value']."</span>"; }
										 else { print "No charset found."; } 
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
                                         <td class="number">Byte order mark (BOM)</td>
										<td><?php
											 if ($char_encoding['bom']['value'] != '') { print "<span class='result'>{$char_encoding['bom']['value']}</span>"; }
											 else { print "No"; } ?>
										</td>
										<td>&nbsp;
										</td>
								  </tr>
                                     <tr>
                                         <td class="number">xml declaration</td>
                                         <td><?php
										 if ($xmldeclTag == '') { print "None found."; }
										 else if ($char_encoding['xmldecl']['value'] != '') { print "<span class='result'>".$char_encoding['xmldecl']['value']."</span>"; }
										 else { print "No encoding information found."; } 
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
									<td class="number">content-type meta</td>
									<td><?php
										 if ($char_encoding['httpequiv']['value']=='') { print "None found."; }
										 else { print "<span class='result'>".$char_encoding['httpequiv']['value']."</span>"; } ?>
									</td>
									<td><?php
										 if ($char_encoding['httpequiv']['code']=='') { print "&nbsp;"; }
										 else { print '<code>'.$char_encoding['httpequiv']['code'].'</code>'; } ?>
									</td>
									</tr>
                                     <tr>
                                        <td class="number">HTML5 meta charset</td>
										<td><?php
											 if ($char_encoding['html5']['value']=='') { print "None found."; }
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
                                 		<th style="width: 25%;">Language</th>
                                 		<th style="min-width: 15%;">&nbsp;</th>
                                 		<th>Code</th>
                               		 </tr>
                                 	<tr>
                                 		<td class="number">&lt;html lang=</td>
                                         <td><?php
										 if ($htmltag=='') { print "No html tag found."; }
										 else if ($htmllangValue=='') { print "None"; }
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
										 if ($htmltag=='') { print "No html tag found."; }
										 else if ($htmlxmllangValue=='') { print "None"; }
										 else { print "<span class='result'>".$htmlxmllangValue."</span>"; } ?>
										 </td>
										 <td><?php
										 if ($htmltag=='') { print "&nbsp;"; }
										 else { print '<code>'.$htmltag.'</code>'; } ?>
										 </td>
				               		 </tr>
                                 	<tr>
                                 		<td class="number">HTTP Content-Language</td>
                                         <td><?php
										 if ($httpcontentlangHeader=='') { print "None found."; }
										 else if ($httpcontentlangValue=='') { print "None"; }
										 else { print "<span class='result'>".$httpcontentlangValue."</span>"; } ?>
										 </td>
										 <td><?php
										 if ($httpcontentlangHeader=='') { print "&nbsp;"; }
										 else { print '<code>'.$httpcontentlangHeader.'</code>'; } ?>
										 </td>
                              		 </tr>
                                 	<tr>
                                 		<td class="number">meta content-language element</td>
                                         <td><?php
										 if ($metacontentlangTag=='') { print "None found."; }
										 else if ($metacontentlangValue=='') { print "None"; }
										 else { print "<span class='result'>".$metacontentlangValue."</span>"; } ?>
										 </td>
										 <td><?php
										 if ($metacontentlangTag=='') { print "&nbsp;"; }
										 else { print '<code>'.$metacontentlangTag.'</code>'; } ?>
										 </td>
                              		 </tr>
                                 	<tr>
                                 		<td class="number">Detected language</td>
                                 		<td>&nbsp;</td>
                                 		<td>&nbsp;</td>
                               		 </tr>
                           	</table>
                                 <table class="details">
                                 	<tr>
                                 		<th style="width: 25%;">Text direction</th>
                                 		<th style="min-width: 15%;">&nbsp;</th>
                                 		<th>Code</th>
                               		 </tr>
                                 	<tr>
                                 		<td class="number">Default direction</td>
                                         <td><?php
										 if ($htmltag=='') { print "None"; }
										 else if ($htmldirValue=='') { print "LTR (by default)"; }
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
                                 		<th style="width: 25%;">Class &amp; id names</th>
                                 		<th style="min-width: 15%;">&nbsp;</th>
                                 		<th>Code</th>
                       		    </tr>
                                 	<tr>
                                 		<td class="number">Non-ascii class or id names</td>
                                          <td><?php
										 if ($nonasciinamectr==0) { print "None"; }
										 else { print "<span class='result'>".$nonasciinamectr."</span>"; } ?>
										 </td>
										 <td><?php
										 if ($nonasciinamectr==0) { print "&nbsp;"; }
										 else { print "<p><button id='classdisplaybuttonChart' onclick='document.getElementById(\"nonasciiclassoridChart\").style.display = \"block\"; this.style.display = \"none\"; return false;'>Show list</button></p><ol id='nonasciiclassoridChart' style='display:none;' class='detail'>".$nonasciinames."</ol>"; } ?>
										 </td>
										 
                       		    </tr>
                                 	<tr>
                                 		<td class="number">Non-NFC class or id names</td>
                                          <td><?php
										 if ($nonnfcnamectr==0) { print "None"; }
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
                                 		<th style="width: 25%;">Request headers</th>
                                 		<th>&nbsp;</th>
                               		 </tr>
                                 	<tr>
                                 		<td class="number">Accept-Language</td>
                                 		<?php 
						if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) { echo "<td class='resultdiv'><span class='result'>".$_SERVER['HTTP_ACCEPT_LANGUAGE'].'</span></td>'; }
							else { echo "<td>None found.</td>"; }
							?>
                               		 </tr>
                                 	<tr>
                                 		<td class="number">Accept-Charset</td>
                                 		<?php if (isset($_SERVER['HTTP_ACCEPT_CHARSET'])) { echo "<td class='resultdiv'><span class='result'>".$_SERVER['HTTP_ACCEPT_CHARSET'].'</span></td>'; }
							else { echo "<td>None found.</td>"; }
							?>
                               		 </tr>
                           	</table>
						</div>
                             <p class="backtop"><a href="#banner">Top</a></p>
                    </div>
                </div>
  	</div>
        </div>



	<?php // only show this section if there are issues to report
	if (count($errors)+count($warnings)+count($comments) > 0) { 
	?>

<div class="mod raw">
	<div class="hd implicit">
		<h2>Detailed report</h2>
		</div>
	<div class="bd">
		<div id="results">
			<div id="details" class="mod square expandable">
				<div class="hd section warningSection">
					<div><h3><a href="#details">Detailed report</a></h3></div>
					</div>
				<div class="bd expand_content">
					<ul id="msgHeader" class="line msgHeader sortKeys">
						<li id="sortBySeverity" class="unit min1of10 sortKey sortBySeverity selected sortDesc">Severity</li>
						<li id="sortByDesc" class="unit min7of10 sortKey sortByDesc"><a href="#sortByDesc">Description</a></li>
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
					<h3><a href="#source"><label title="Source code checked." for="docAddr">Source code</label></a><span>: </span></h3>
					</div>
				</div>
			<div class="bd text expand_content">
					<pre style="font-size: 80%;"><?php echo htmlspecialchars($result['body']); ?></pre>
                </div>
            </div>
		</div>

</div>

	<!--
	print '<iframe id="iframepage" style="width: 100%;" src="'.htmlspecialchars($uri).'">The page itself.</iframe>';
	-->


	<?php } ?>        
<?php } ?>        
         
 <!--   <div class="line">
            
            
            <div class="unit size1of2">
               
               
               <div class="mod ad ad1">
                  
                  
                  <div class="inner">
                     
                     
                     <h2 class="hd adhd adhd1">Online training sessions</h2>
                     
                     
                     <div class="bd adbd">
                        
                        
                        <p class="adtitle">Want to learn more about 
mobile Web design?</p>
                        
                        
                        <p>Attend one of our online training sessions on
 Mobile Web Best Practices!</p>
                        
                        
                        
                        <div class="mod square keypad">
                           
                           
                           <div class="inner">
                              
                              
                              <div class="bd keypadbd"><a 
href="http://www.w3.org/Mobile/training/" target="_blank">Check
 it out!</a></div>
                              
                              
                           </div>
                           
                           
                        </div>
                        
                        
                     </div>
                     
                     
                  </div>
                  
                  
               </div>
               
               
            </div>
            
            
            
            <div class="unit size1of2 lastUnit">
               
               
               <div class="mod ad ad2">
                  
                  
                  <div class="inner">
                     
                     
                     <h2 class="hd adhd adhd2">Sponsors</h2>
                     
                     
                     <div class="bd adbd">
                        
                        
                        <p class="sponsorTestimonial">
                           <a href="http://www.omtp.org/"><img
 src="mobileok_files/omtp-medium.png" alt="OMTP" height="99" width="60" /></a>
                           <a href="http://www.mw2.or.kr/"><img
 src="mobileok_files/mw2_logo.png" alt="Mobile Web 2.0 Forum" 
height="36" width="81" /></a>
                           <br /><a 
href="http://www.w3.org/Mobile/Sponsoring"><em>Become a MWI
 Sponsor</em></a> - see <a href="http://www.w3.org/Mobile/Testimonials" 
shape="rect"><em>Sponsors testimonials</em></a>
                           
                           
                        </p>
                        
                        
                     </div>
                     
                     
                  </div>
                  
                  
               </div>
               
               
            </div>
            
            
         </div> -->
         
         
         
       <!--  <div style="min-height: 76px;" id="don_program"><script type="text/javascript" src="mobileok_files/don_prog.js" xml:space="preserve"></script><span
 dir="ltr" id="don_program_img" lang="en"><a 
href="http://www.w3.org/QA/Tools/Donate"><img alt="Mozilla Foundation 
Logo" src="mobileok_files/moz_logo.jpg" /></a></span><span 
style="padding-top: 36px; padding-bottom: 36px;" dir="ltr" 
id="don_program_text" lang="en">The W3C CSS validator is developed with 
assistance from the Mozilla Foundation, and supported by community 
donations.<br /><a href="http://www.w3.org/QA/Tools/Donate">Donate</a> and
 help us build better tools for a better web.</span></div> -->
         
         
         
         <div id="menu" class="mod raw">
            <div class="inner">
               <div class="hd implicit">
                  <h2><a href="#menu">Navigation menu</a></h2>
               </div>
               <div class="bd bar navBar">

                  <ul class="inner">
                     <li class="item"><a 
href="http://qa-dev.w3.org/i18n-checker/" title="Go to the Home Page for The
 W3C Internationalization Checker Service">Home</a></li>
                     <li class="item"><a 
href="about.html" title="Information About
 this Service">About...</a></li>
                     <!--li class="item"><a 
href="http://waxler.w3.org/mobileok/whatsnew.html" title="Changes made 
to this service recently">News</a></li>
                     <li class="item"><a 
href="http://waxler.w3.org/mobileok/help.html" title="Help and answers 
to questions you may have on the mobileOK Checker">Help</a></li-->
                     <li class="item"><a 
href="feedback.html" title="How to provide
 feedback on this service">Feedback</a></li>
                  </ul>
               </div>
            </div>
         </div>
         
         
      <div id="footer" class="foot">
         <div class="leftCol w3cLargeLogo">
            <p id="activity_logos"><a href="http://www.w3.org/International/" 
class="w3cLarge"><span>W3C Internationalization Activity</span></a></p>
         	</div>
         <!--div class="rightCol supportLogo">
            <p id="support_logo"><a 
href="http://www.w3.org/QA/Tools/Donate" class="iheartval"><span>Validators
 donation program</span></a></p>
         	</div-->
        <div class="main">
            <!--p id="version_info" class="version">This is the W3C 
mobileOK Checker <a 
href="http://waxler.w3.org/mobileok/whatsnew.html#t2010-03-19">v1.4.0</a><br />This
 work is part of the <a href="http://www.w3.org/2008/MobiWeb20/">MobiWeb
 2.0</a> project supported by the European Union's 7th Research 
Framework Programme (FP7).                  
               
            </p-->
            <p class="copyright"><a rel="Copyright" 
href="http://www.w3.org/Consortium/Legal/ipr-notice#Copyright">Copyright</a>
 © 1994-2010 <a href="http://www.w3.org/"><acronym title="World Wide Web
 Consortium">W3C</acronym></a>® (<a href="http://www.csail.mit.edu/"><acronym
 title="Massachusetts Institute of Technology">MIT</acronym></a>, <a 
href="http://www.ercim.eu/"><acronym title="European Research Consortium
 for Informatics and Mathematics">ERCIM</acronym></a>, <a 
href="http://www.keio.ac.jp/">Keio</a>), All Rights Reserved. W3C <a 
href="http://www.w3.org/Consortium/Legal/ipr-notice#Legal_Disclaimer">liability</a>,
 <a href="http://www.w3.org/Consortium/Legal/ipr-notice#W3C_Trademarks">trademark</a>,
 <a rel="Copyright" 
href="http://www.w3.org/Consortium/Legal/copyright-documents">document 
use</a> and <a rel="Copyright" 
href="http://www.w3.org/Consortium/Legal/copyright-software">software 
licensing</a> rules apply. Your interactions with this site are in 
accordance with our <a 
href="http://www.w3.org/Consortium/Legal/privacy-statement#Public">public</a>
 and <a 
href="http://www.w3.org/Consortium/Legal/privacy-statement#Members">Member</a>
 privacy statements.
               
            </p>
         </div>
      </div>
	  
<!--script type="text/javascript" src="jquery.js" xml:space="preserve">0;</script><script type="text/javascript" src="mobileok.js" xml:space="preserve">0;</script-->
<script type="text/javascript">
window.onload=function(){initialiseMain('mybody', 'h3',''); initialiseReport('results','div','expand_title');}
</script>
</body>
</html>