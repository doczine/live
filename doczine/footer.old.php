<?php
error_reporting(0);
function do_html_footer()
{
?>

<div id="rt-footer-surround" class="footerstyle-dark">
<div id="rt-bottom">
<div class="rt-container">
<div class="rt-section-surround">
<div class="rt-row-surround">
<div class="rt-grid-4 rt-alpha">
<div class="bottomdiv-r">
<div class="rt-block">
<div class="rt-module-surround">
<div class="rt-module-inner">
<div class="module-content">


<?php
if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] != "");{
echo "<a href='file_list.php?user=".$_SESSION['valid_user']."'><em class='nobold'>Your File List</em> </a>";
}
?>

<br>
<br>
</div>
<div class="clear">
</div>
<br>


<div class="clear">
</div>
<div class="clear">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="rt-grid-4">
<div class="bottomdiv-r">
<div class="rt-block">
<div class="rt-module-surround">
<div class="rt-module-inner">
<div class="module-content">
<p class="nomarginbottom">
<em class="bold nobold bot-icon-text">
About Us</em>
</p>
<div class="quote-l nomargintop">
<div class="quote-r">
Links<br>
<a href="http://www.docunator.com">
<em class="nobold">
http://www.docunator.com</em>
</a>
</em>
</div>
</div>

<div class="clear">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="rt-grid-4 rt-omega">
<div class="bottomdiv-r">
<div class="rt-block">
<div class="rt-module-surround">
<div class="rt-module-inner">
<div class="module-content">

<p class="nomarginbottom">
<em class="bold nobold bot-icon-text">
Talk to us</em>
</p>
<a href="http://www.facebook.com/pages/244602588893448" target="_blank">
<img style="visibility: visible; opacity: 1;" smartload="1" src="css/icons/facebook_32.png" class="png floatleft medmarginright " alt="image" height="auto" width="auto">
</a>
<a href="http://twitter.com/docunator" target="_blank">
<img style="visibility: visible; opacity: 1;" smartload="2" src="css/icons/twitter_32.png" class="png floatleft medmarginright " alt="image" height="auto" width="auto">
</a>
<a href="http://www.linkedin.com/company/docunator" target="_blank">
<img style="visibility: visible; opacity: 1;" smartload="3" src="css/icons/linkedin_32.png" class="png floatleft medmarginright " alt="image" height="auto" width="auto">
</a>
<a href="1317528419_6f613cfddb.html#/Contact_Us/Reference/General" target="_blank">
<img style="visibility: visible; opacity: 1;" smartload="3" src="css/icons/email_32.png" class="png floatleft medmarginright " alt="image" height="auto" width="auto">
</a>
<br>
<br>

<div class="clear">
</div>
<br>

<div class="clear bot-div">
&nbsp;</div>
<div class="clear">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clear">
</div>
</div>
</div>
<div id="rt-copyright">
<div class="rt-container">
<div class="rt-grid-12 rt-alpha rt-omega">
<div class="clear">
</div>
<div class="rt-block">
<div id="developed-by">
<a href="http://docunator.com/" title="www.docunator.com" id="doc">
</a>
</div>
</div>
<a style="outline: medium none;" href="#" id="gantry-totop">
<span class="totop-desc">
Back to Top</span>
</a>
</div>
<div class="clear">
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div style="visibility: hidden; opacity: 0; display: none; position: absolute; top: 0px; left: 0px; cursor: pointer; background-color: rgb(0, 0, 0); z-index: 65550;" class="rokbox-overlay" id="rokbox-overlay">
</div>

</body>
</html>


<?php

}
?>
