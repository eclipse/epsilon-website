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
	$pageTitle 		= "Call Java from Epsilon";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	chdir('../../..');
	include ('common.php');
	ob_start();
?>

	<div id="midcolumn">
		
		<h1><?=$pageTitle?></h1>

	<p>Model management languages such as those provided by Epsilon are by design not general purpose languages. Therefore, there are features that such languages do not support inherently (mainly because such features are typically not always needed in the context of model management). However, there are cases where a feature that is not built-in may be necessary for a specific task.</p>
	
	<p>To address this issue Epsilon allows developers to instantiate Java objects and call their methods from EOL. 
	
		<hr class="clearer" />

	</div>

<?
	include('stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>