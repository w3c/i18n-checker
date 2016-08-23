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
<div class="about" id="glossary">

<h2>Glossary</h2>
<p>This page provides explanations for some of the terms used by the checker.</p>

<dl>
<dt id="directionalControl">Directional control character</dt>
<dd>
  <p>Characters used inline for controlling the direction in which text is displayed, in conjunction with the Unicode Bidirectional Algorithm. These characters are used to help establish the base direction for text in scripts such as Arabic, Hebrew, and Thaana.</p>
  <p>Most characters are used in pairs, as shown in this table.</p>
  <table><tbody>
  <tr><th>Start character</th><th>End character</th><th>Explanation</th></tr>
  <tr><td>RLE/LRE</td><td>PDF</td>
  <td>Set the base direction of the characters between start and end to right-to-left (RLI) or left-to-right (LRI). </tr>
  <tr><td>RLI/LRI</td><td>PDI</td>
  <td>Same as above, but isolates the sequence of characters from surrounding text in order to prevent spillover effects.</tr>
  <tr><td>FSI</td><td>PDI</td>
  <td>Same as above, but determines the base direction by looking at the direction of the first strong directional character in the sequence enclosed.</tr>
  <tr>
    <td>RLO/LRO</td>
    <td>PDF</td>
  <td>Causes the characters to be displayed in the same sequence as in memory (ie. no bidirectional algorithm effects), either from left to right or vice versa.</tr>
  <tr>
    <td>RLM/LRM</td>
    <td>-</td>
    <td>Strong directional characters (not used in pairs).  
  </tr>
  </tbody>
  </table>
  <p>For more information about how these characters work see <a href="https://www.w3.org/International/articles/inline-bidi-markup/uba-basics">Unicode Bidirectional Algorithm basics</a> and <a href="https://www.w3.org/International/questions/qa-bidi-unicode-controls">How to use Unicode controls for bidi text</a>.</p>
</dd>
<dt id="characterEscape">Character escape</dt>
<dd>
  <p>You can use a <dfn>character escape</dfn> to represent any Unicode character in markup using only ASCII characters. This is particularly useful for representing invisible or ambiguous characters, such as directional controls or no-break spaces.</p>
  <p>HTML has names for three different types of escape. Numbers represent Unicode code point values.</p>
  <table>
    <tbody>
   <tr><th>Name</th><th>Format</th><th>Example</th></tr>
     <tr>
        <td>hexadecimal numeric character references</td>
        <td>&amp;#x...;</td>
        <td>&lt;p&gt;Vive la France&amp;#xA0;!&lt;/p&gt;        
      </tr>
      <tr>
        <td>decimal numeric character references</td>
        <td>&amp;#...;</td>
        <td>&lt;p&gt;Vive la France&amp;#160;!&lt;/p&gt;        
      </tr>
      <tr>
        <td>named character references</td>
        <td>&amp;...;</td>
        <td>&lt;p&gt;Vive la France&amp;nbsp;!&lt;/p&gt;        
      </tr>
      </tbody>
  </table>
  <p>For more information about how these characters work see <a href="https://www.w3.org/International/questions/qa-escapes">Using character escapes in markup and CSS</a>.</p>
</dd>
</dd>
<dt id="controlRanges">C0 and C1 ranges</dt>
<dd>
  <p>These refer to two ranges of control characters originating in legacy code pages.</p>
  <p>The C1 range includes the following characters, at the start of the code page.</p>
  <table>
    <tbody>
   <tr>
     <th>Hex</th>
   <th>0</th>
   <th>1</th>
   <th>2</th>
   <th>3</th>
   <th>4</th>
   <th>5</th>
   <th>6</th>
   <th>7</th>
   <th>8</th>
   <th>9</th>
   <th>A</th>
   <th>B</th>
   <th>C</th>
   <th>D</th>
   <th>E</th>
   <th>F</th>
   </tr>
     <tr>
       <th>0</th>
       <td>NUL</td>
       <td>SOH        
         <td>STX          
           <td>ETX          
            <td>EOT          
            <td>ENO          
            <td>ACK          
            <td>BEL          
            <td>BS          
            <td>HT          
            <td>LF          
            <td>VT          
            <td>FF          
            <td>CR          
            <td>SO          
            <td>SI        
          </tr>
     <tr>
       <th>1</th>
       <td>DLE</td>
       <td>DC1       
       <td>DC2       
       <td>DC3       
       <td>DC4       
       <td>NAK       
       <td>WYN       
       <td>ETB       
       <td>CAN       
       <td>EM       
       <td>SUB       
       <td>ESC       
       <td>FS       
       <td>GS       
       <td>RS       
       <td>US       
     </tr>
      </tbody>
  </table>
  <p>Then come the remaining ASCII characters, followed by the C1 range, shown below, and then additional characters beyond.</p>
  <table>
    <tbody>
   <tr>
     <th>Hex</th>
   <th>0</th>
   <th>1</th>
   <th>2</th>
   <th>3</th>
   <th>4</th>
   <th>5</th>
   <th>6</th>
   <th>7</th>
   <th>8</th>
   <th>9</th>
   <th>A</th>
   <th>B</th>
   <th>C</th>
   <th>D</th>
   <th>E</th>
   <th>F</th>
   </tr>
     <tr>
       <th>8</th>
       <td>XXX</td>
       <td>XXX
       <td>BPH
       <td>NBH
       <td>IND
       <td>NEL
       <td>SSA
       <td>ESA
       <td>HTS
       <td>HTJ
       <td>VTS
       <td>PLD
       <td>PLU
       <td>RI
       <td>SS2
       <td>SS3</tr>
     <tr>
       <th>9</th>
       <td>DCS</td>
       <td>PU1
       <td>PU2
       <td>STS
       <td>CCH
       <td>MW
       <td>SPA
       <td>EPA
       <td>SOS
       <td>XXX
       <td>SCI
       <td>CSI
       <td>ST
       <td>OSC
       <td>PM
       <td>APC</tr>
      </tbody>
  </table>
  <p>HTML prohibits the use of any of these characters apart from the whitespace characters, LF, CR and HT.</p>
  <p>For more information about these characters see <a href="https://www.w3.org/International/questions/qa-controls">HTML, XHTML, XML and Control Codes</a>.</p>
</dd>
</dl>
</div>

<?php include(PATH_TEMPLATES.'/html/footer.php');
