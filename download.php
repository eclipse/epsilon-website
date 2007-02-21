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
	$pageTitle 		= "Download Epsilon";
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

		<h3>Download</h3>
		
		There are three options for using Epsilon: download a complete bundle
		containing everything required, download the plug-ins only,
		or work directly with a copy of the source code from CVS.<br><br>
		<b>Please not that Epsilon requires Java 1.5 (or higher).</b><br><br>
				
		<ul>
		
		<li>
			<a href="http://www-users.cs.york.ac.uk/~dkolovos/epsilon/bundles/bundle-win.php">Complete Bundle (for Windows only)</a>
			<b> (41.3 MB)</b>:
			This bundle contains Eclipse 3.2.1, EMF, MDR and the Epsilon plugins. It also contains
			examples for each language in Epsilon. To run, simply download and unzip the bundle
			and run eclipse.exe. 
			<b> Updated: 20/2/2007</b>
			<br><br>
		
		<li>
			<a href="http://www.eclipse.org/downloads/download.php?file=/technology/gmt/epsilon/plugins.zip">Plugins</a>
			<b> (2.8 MB)</b>:
			This archive contains the Epsilon plugins only. Please refer to the instructions provided
			<a href="doc/PluginInstallation.pdf"> here </a> for adding the Epsilon plugins to your Eclipse installation.
			<b> Updated: 20/2/2007</b>
			<br><br>
			
		<li>
			<a href="doc/EpsilonCVS.pdf">Source code</a>:
			This document describes how you can set up a local copy of the source code of Epsilon
			on your machine.
			<b> Updated daily</b>
		</ul>
		
		<hr class="clearer" />

	</div>

EOHTML;


	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
