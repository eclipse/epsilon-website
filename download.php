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
	$version = "0.8.3";
	
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
		or work directly with the source code from the Eclipse SVN server. <br><br>
		
		<ul>
		
		<li>
			<b>Eclipse Update Manager</b>:
			Use the following update site and <a href="doc/P2InstallationGuide.pdf">the instructions provided here</a> to install the Epsilon binaries through the Eclipse update manager.
			This is the <b>recommended</b> option as it allows you to easily update to the latest version of Epsilon. 
			
			<br><br>Update site : <b>http://download.eclipse.org/modeling/gmt/epsilon/updates/</b>
			
			<br><br> <b>Note:</b> It typically takes anything from 30mins to 2hrs from the time a new version is uploaded until
			it becomes available for download. During that time you may encounter errors in the Update Manager so please allow some 
			time and try again. If problems seem to persist please let us know by sending a message to the Epsilon newsgroup.
			
			<br><br>
		<li>
			<a href="http://www.eclipse.org/downloads/download.php?file=/modeling/gmt/epsilon/org.eclipse.epsilon_${version}_incubation.zip">Binaries</a>: A zip-file containing the features and plugins of Epsilon
			<br><br>
		<li>
			<a href="doc/EpsilonSVN.pdf">Source code</a>:
			This document describes how you can obtain the latest version of the source code of Epsilon from the Eclipse SVN server.
			<br><br>
		</ul>
		
		
		<h3>Dependencies</h3>
		
		Epsilon requires Java 1.5 (or greater), Eclipse 3.3 (or greater) and the latest 
		versions of EMF and GMF. The <a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/R/eclipse-modeling-ganymede-incubation-win32.zip">Eclipse Ganymede Modeling distribution</a> is the fastest and 
		safest way to get a compatible version of Eclipse with all the required dependencies
		included.
		
		<hr class="clearer" />

	</div>

EOHTML;


	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
