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
	$pageTitle 		= "Epsilon Model Connectivity";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>The vast majority of examples in this website demonstrate using  languages from Epsilon to manage EMF-based models. While Epsilon provides robust support for EMF models, it is not tied to EMF at all. In fact, Epsilon is underpined by an open model connectivity framework which developers can extend with support for additional types of models/modeling technologies by providing respective drivers. </p>
		
		<p>For example, in EpsilonLabs, drivers are provided for managing <a href="http://epsilonlabs.wiki.sourceforge.net/MDR+driver">MDR models</a> and <a href="http://epsilonlabs.wiki.sourceforge.net/Z+driver">Z specifications</a> (which cannot be hosted in the Eclipse SVN due to licencing issues). As most people use the EMF driver, there is not much documentation about the other drivers. However, if you're interested in using/extending them (or even providing new drivers for other modeling technologies), we'll be more than happy to help if you let us know through the <a href="../../newsgroup">newsgroup</a>.</p>
		
		<p>
		</p>
		
		<h4>Features</h4>
		
		<ul>
			<li>Manage models of different technologies (e.g. EMF and MDR) in the same program
			<li>Cross-technology transformations (e.g. transform an MDR model into an EMF model)
			<li>Provide drivers for additional modeling technologies
			<li>Runtime and user interface integration through a dedicated Eclipse extension point
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 3 of the <a href="../book">Epsilon book</a> provides a complete 
		reference of the EMC.
		<!--
While EOL can be used as a standalone language, its primary target is to be embedded as an expression language to task-specific model management languages such as ETL, EVL, EWL etc. 
Here are some more examples ...
-->
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