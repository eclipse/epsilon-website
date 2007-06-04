<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'

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
	$pageTitle 		= "Contributors";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	
	# Paste your HTML content between the EOHTML markers!	
	$html = <<<EOHTML

<!-- Main part -->
	<div id="midcolumn">
		<table width="100%">
			<tr>
				<td width="50%">
					<h1>$pageTitle</h1>
				</td>
				<td align="right">
					<img alt="Epsilon Logo" src="resources/epsilonlogo.png" valign="top" />
				</td>
			</tr>
		</table>

		<h3>Previews</h3>
		
		This page offers previews of the upcoming Epsilon languages and tools.<br><br>
		
		<h3>Tools and Languages</h3>
		
		<ul>
		
			<li> <b>Epsilon Workflow</b> : An ANT-based workflow for coordinating 
			<li> <b>ModeLink</b> : A side-by-side editor that helps establishing links between different EMF models
			<li> <b>Epsilon Generation Language</b> : A template language (similar to ASP, JSP etc) for generating textual artefacts (code, documentation etc.) from models
			
		</ul>
		
		<h3>Further information</h2>
		
		For further information on the languages/tools discussed here, please contact us by sending
		a message to the <a href="news://news.eclipse.org/eclipse.modeling.gmt">GMT newsgroup</a>
		
		<hr class="clearer" />

	</div>

EOHTML;


	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
