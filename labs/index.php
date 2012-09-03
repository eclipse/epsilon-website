<?php  																														
require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	
$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'

	#*****************************************************************************
	#
	# template.php
	#
	# Author: 		Freddy Allilaire
	# Date:			2006-05-29
	#
	# Description: Type your page comments here - these are not sent to the browser
	#
	#
	#****************************************************************************
	
	#
	# Begin: page-specific settings.  Change these. 
	$pageTitle 		= "EpsilonLabs";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	ob_start();
?>

	<div id="midcolumn">
	
		<img style="float:right" src="epsilonlabs.png"/>
		<h1><?=$pageTitle?></h1>
		
		<p>EpsilonLabs is a satellite project of Epsilon that hosts experimental stuff which may (or may not) end up being part of Epsilon in the future. It also hosts contributions that are incompatible with EPL and therefore cannot be hosted under eclipse.org.</p>
		
		<div class="warningbox"><img style="float:right" src="http://dev.eclipse.org/huge_icons/status/dialog-warning.png"><b>Warning:</b> Please be aware that the code contributed under EpsilonLabs is <b>not</b> part of (or in any other way formally related to) Eclipse, and has <b>not</b> been IP-checked by the Eclipse legal team.<br><br></div>
		<br>
		<!--div class="warningbox"><img style="float:right" src="http://dev.eclipse.org/huge_icons/categories/applications-development.png"><b>Move in progress: </b> We are currently moving EpsilonLabs from its old Sourceforge site to its new Google Code site. Duplicate content, broken links and utter confusion are all to be expected during the move process.<br><br></div-->
		
		<hr class="clearer" />

	</div>

	<div id="rightcolumn">
		<div class="sideitem">
			<h6>External Links</h6>
			<div class="modal">
				<ul>
					<li><a href="http://code.google.com/p/epsilonlabs/">EpsilonLabs under Google Code</a>
					<li><del><a href="http://epsilonlabs.wiki.sourceforge.net/">EpsilonLabs under Sourceforge</del></a>
				</ul>
			</div>
		</div>
	</div>
	
<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>