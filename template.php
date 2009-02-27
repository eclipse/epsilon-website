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
	$pageTitle 		= "Template";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('common.php');
	ob_start();
?>

	<div id="midcolumn">
		<table width="100%">
			<tr>
				<td width="50%">
					<h1><?=$pageTitle?></h1>
				</td>
				<td align="right">
					<img alt="Epsilon Logo" src="resources/epsilonlogo.png" valign="top" />
				</td>
			</tr>
		</table>

		<h3>Template</h3>
		
		Template<br><br>
		
		<hr class="clearer" />

	</div>

<?
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, null, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>