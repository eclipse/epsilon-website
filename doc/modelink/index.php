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
	$pageTitle 		= "ModeLink";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">
		<h1><?=$pageTitle?></h1>
		<p>
		  ModeLink is an editor consisting of 2-3 side-by-side EMF tree-based editors, and in
		  combination with the reflective <a href="../exeed">Exeed</a> editor, it is very
		  convenient for establishing links between different models using drag-and-drop. ModeLink
		  uses native EMF cross-resource references to capture links between different models and
		  as such, models constructed with it can be then used by any EMF-compliant tool/language.
		</p>

		<h4>Screenshots</h4>
		<img src="images/modelink.png"/>
		<br/><br/>
		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../cinema/#ModeLink_part1">Screencast: Establishing links between models</a>
		</ul>
		
		<hr class="clearer" />
	
	</div>

	<div id="rightcolumn">
		<?=toolsSideItem()?>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>