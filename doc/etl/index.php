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
	$pageTitle 		= "Epsilon Transformation Language";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>ETL is a hybrid, rule-based model-to-model transformation language built on top of EOL.
		ETL provides all the standard features of a transformation language but also 
		provides enhanced flexibility as it can transform many input to many output models,
		and can query/navigate/modify both source and target models.</p>
		
		<h4>Features</h4>
		
		<ul>
			<li>Transform many input to many output models
			<li>Ability to query/navigate/modify both source and target models
			<li>Declarative rules with imperative bodies
			<li>Automated rule execution
			<li>Lazy and greedy rules
			<li>Multiple rule inheritance
			<li>Guarded rules
		</ul>
		
		<?=eolFeatures()?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.tree2graph">Transform a Tree model into a graph model with ETL</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.oo2db">Transform an OO model to a DB model with ETL</a>
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 6 of the <a href="../book">Epsilon book</a> provides a complete 
		reference of the syntax and semantics of ETL.
		<!--
While EOL can be used as a standalone language, its primary target is to be embedded as an expression language to task-specific model management languages such as ETL, EVL, EWL etc. 
Here are some more examples ...
-->
		<hr class="clearer" />
	
	</div>

	<div id="rightcolumn">
		<?=toolsSideItem('etl')?>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>