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

		<h3>Contributors and Interested Parties</h3>
		
		This page contains the contributors and parties interested in Epsilon.<br><br>
		
		<h3>Contributors</h3>
		
		<ul>
		
		<li>
			<a href="http://www.cs.york.ac.uk">Department of Computer Science, The University of York</a>
		</ul>
		
		<h3>Interested parties</h3>
		
		<ul>
		
		<li>
			<a href="http://james.eii.us.es/MaCMAS/index.php/Main_Page">
			Department of Computer Science and Languages, The University of Seville (Spain). 
			<br>
			Group MaCMAS (Methodology for Analysing Complex MultiAgent Systems).
			</a>
		</ul>
		
		<hr class="clearer" />

	</div>

EOHTML;


	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
