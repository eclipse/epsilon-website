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
	$version = "1.1.1";
	
	# Paste your HTML content between the EOHTML markers!	
	$html = <<<EOHTML

<!-- Main part -->
	<div id="midcolumn">
		<table width="100%">
			<tr>
				<td width="50%">
					<h1>$pageTitle (version $version)</h1>
				</td>
				<td align="right">
					<img alt="Epsilon Logo" src="resources/epsilonlogo.png" valign="top" />
				</td>
			</tr>
		</table>

		<h3>Download</h3>
		
		There are three options for obtaining Epsilon: you can install the binaries
		using the Eclipse Update Manager, download and install the binaries manually, 
		or work directly with the source code from the Eclipse CVS server. 
		Please note that Epsilon requires Java 1.5 (or higher).<br><br>
		
		<ul>
		
		<!--
		<li>
			<a href="http://www-users.cs.york.ac.uk/~dkolovos/epsilon/bundles/bundle-win.php">Complete Bundle (for Windows only)</a>
			<b> (41.3 MB)</b>:
			This bundle contains Eclipse 3.2.1, EMF, MDR and the Epsilon plugins. It also contains
			examples for each language in Epsilon. To run, simply download and unzip the bundle
			and run eclipse.exe. 
			<b> Updated: 11/5/2007</b>
			<br><br>
		
		<li>
			<a href="http://www.eclipse.org/downloads/download.php?file=/technology/gmt/epsilon/plugins.zip">Plugins</a>
			<b> (2.8 MB)</b>:
			This archive contains the Epsilon plugins only. Please refer to the instructions provided
			<a href="doc/PluginInstallation.pdf"> here </a> for adding the Epsilon plugins to your Eclipse installation.
			<b> Updated: 11/5/2007</b>
			<br><br>
		-->
		
		<li>
			<a href="doc/PluginInstallation.pdf">Eclipse Update Manager</a>:
			This document describes how you can obtain and install the Epsilon binaries through the Eclipse Update Manager.
			This is the <b>recommended</b> option as it allows you to easily update to the latest version of Epsilon (at this
			stage, minor version increments happen almost daily)). 
			
			<br><br>Update site : <b>http://download.eclipse.org/technology/gmt/epsilon/org.epsilon.eclipse.updatesite/site.xml</b>
			
			<br><br> <b>Note:</b> It typically takes anything from 30mins to 2hrs from the time a new version is uploaded until
			it becomes available for download. During that time you may encounter errors in the Update Manager so please allow some 
			time and try again. If problems seem to persist please let us know by sending a message to the GMT newsgroup.
			
			<br><br>
		<li>
			<a href="http://www.eclipse.org/downloads/download.php?file=/technology/gmt/epsilon/org.epsilon.eclipse_$version.zip">Binaries</a>: A zip-file containing the features and plugins of Epsilon
			<br><br>	
		<li>
			<a href="doc/EpsilonCVS.pdf">Source code</a>:
			This document describes how you can obtain the latest version of the source code of Epsilon from the Eclipse CVS server.
			<br><br>
		</ul>
		
		<hr class="clearer" />

	</div>

EOHTML;


	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
