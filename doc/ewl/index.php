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
	$pageTitle 		= "Epsilon Wizard Language";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>EWL is a language tailored to interactive in-place model transformations on user-selected model elements (unlike <a href="../etl">ETL</a> which operates in a batch mode). EWL is particularly useful for automating recurring model editing tasks (e.g. refactoring, applying patterns or constructing subtrees consisting of similar elements). EWL is integrated with EMF/GMF and as such, wizards can be executed from within EMF and GMF editors</p>
		
		<h4>Features</h4>
		
		<ul>
			<li>Execute wizards within EMF and GMF editors
			<li>Define guards in wizards
			<li>Undo/redo the effects of wizards on the model
		</ul>
		
		<?=eolFeatures()?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../cinema/#GMFWizards2">Screencast: Specifying and executing wizards in the UML2 class diagram editor</a>
			<li><a href="../ems07gmf-ewl.pdf">Article: Bridging the Epsilon Wizard Language and the Eclipse Graphical Modeling Framework</a>
			<li><a href="http://epsilonblog.wordpress.com/2008/01/18/model-refactoring-in-gmf-based-editors-with-ewl/">Article: Model Refactoring in GMF editors</a>
			<li><a href="http://epsilonblog.wordpress.com/2008/03/16/model-refactoring-in-emf-editors/">Article: Model Refactoring in EMF editors</a>
			
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 7 of the <a href="../book">Epsilon book</a> provides a complete 
		reference of the syntax and semantics of EWL.

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