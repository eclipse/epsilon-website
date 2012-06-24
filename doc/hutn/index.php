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
	$pageTitle 		= "Human Usable Textual Notation";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>HUTN is an OMG standard for storing models in a human understandable format. In a sense it is a human-oriented alternative to XMI; it has a C-like style which uses curly braces instead of the verbose XML start and end-element tags. Epsilon provides an implementation of HUTN which has been realized using ETL for model-to-model transformation, EGL for generating model-to-model transformations, and EVL for checking the consistency of HUTN models.  
		
		<h4>Features</h4>
		
		<ul>
			<li>Write models using a text editor
			<li>Generic-syntax: no need to specify parser
			<li>Error markers highlighting inconsistencies
			<li>Resilient to metamodel changes
			<li>Built-in HUTN->XMI and XMI->HUTN transformations
			<li>Automated builder (HUTN->XMI)
		</ul>
		
		<h4>Examples and Screencasts</h4>
		<ul>
		    <li><a href="../articles/hutn-basic/">Article: Using the Human-Usable Textual Notation (HUTN) in Epsilon</a>
			<li><a href="../../cinema/#HUTN">Screencast: The Human Usable Textual Notation (HUTN)</a>
			<li><a href="http://epsilonblog.wordpress.com/2008/01/16/using-hutn-for-t2m-transformation/">Article: Using HUTN for T2M transformation</a>
			<li><a href="http://epsilonblog.wordpress.com/2008/09/15/new-in-hutn-071/">Article: New in HUTN 0.7.1</a>
			<li><a href="http://epsilonblog.wordpress.com/2009/04/27/managing-inconsistent-models-with-hutn/">Article: Managing Inconsistent Models with HUTN</a>
		</ul>
		
		<h4>Reference</h4>
		
		The OMG provides a <a href="http://www.omg.org/technology/documents/formal/hutn.htm">complete specification</a> of the HUTN syntax.
		
		<!--
While EOL can be used as a standalone language, its primary target is to be embedded as an expression language to task-specific model management languages such as ETL, EVL, EWL etc. 
Here are some more examples ...
-->
		<hr class="clearer" />
	
	</div>

	<div id="rightcolumn">
		<?=toolsSideItem('hutn')?>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>