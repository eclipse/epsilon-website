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
	$pageTitle 		= "Manage the Epsilon website locally";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	chdir('../../..');
	include ('common.php');
	ob_start();
?>

	<div id="midcolumn">
		
		<h1><?=$pageTitle?></h1>
		
		<p>This article provides a step-by-step guide for obtaining a local copy of the Epsilon website.</p> 
		
		<ul>
			<li>Download and install XAMPP

			<li>The folder where web-content is placed is htdocs

			<li>Connect to the Eclipse CVS (using the CVS client of Eclipse)
				<ul>
					<li>host: dev.eclipse.org
					<li>repository: /cvsroot/org.eclipse
					<li>connection type: extssh
				</ul>
				
			<li>Create a folder named gmt under htdocs

			<li>Create a folder named epsilon under gmt

			<li>Check out www/gmt/epsilon as a project located under the gmt folder you just created
				<ul>
					<li>Use check out as a project configured using the New Project Wizard
					<li>Check out as a general Project
					<li>Set the name to epsilon and the path to htdocs/gmt/epsilon
				</ul>
				
			<li>Similarly, check out www/eclipse.org-common to /htdocs/eclipse.org-common

			<li>Similarly, check out www/gmt/news to /htdocs/gmt/news

			<li>Finally, check out www/gmt/resources to /htdocs/gmt/resources

			<li>Start XAMPP and go to http://localhost/gmt/epsilon

			<li>You are now ready to start playing with the Epsilon site locally

			<li>Once you've happy with the changes you've made, go back to the epsilon project in Eclipse, refresh and then commit the changes to the CVS. The site should be updated within a few minutes.
		</ul>
		<hr class="clearer" />

	</div>

<?
	include('stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>