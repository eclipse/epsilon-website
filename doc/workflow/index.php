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
	$pageTitle 		= "Workflow";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>Epsilon provides a set of ANT tasks (<a href="http://ant.apache.org">what is ANT?</a>) to enable developers to assemble complex workflows (build scripts) that involve both MDE (e.g. transformation, validation) and non-MDE (e.g. copying files, invoking compilers) tasks. Epsilon tasks are underpined by a communication mechanism that enables them to interact with each other by sharing models and variables.
		
		<h4>Features</h4>
		
		<ul>
			<li>Call Epsilon programs from ANT
			<li>Models are loaded once and tasks share them
			<li>Tasks can communicate by exporting/importing variables at runtime
			<li>Dedicated task for loading EMF models
			<li>Dedicated task for loading registered EMF EPackages
			<li>Can specify Epsilon code directly inside the tags of the task
		</ul>
		
		<div class="warningbox">
		<b>Important:</b> When running an ANT workflow that involves Epsilon tasks, please make sure you select the <b>Run in the same JRE as the workspace</b> option under the <b>JRE</b> tab of your launch configuration.
		</div>
		<br>
		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="http://epsilonblog.wordpress.com/2009/05/24/new-in-epsilon-0-8-5/">Article: New in Epsilon 0.8.5 (ANT tasks for EMF models)</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.mddtif">Example: MDD-TIF Case study</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.workflow.extension.example">Example: Provide custom/extended tasks for the workflow</a>
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 11 of the <a href="../book">Epsilon book</a> provides a detailed description of the ANT tasks and their supported attributes/nested elements.
		
		<!--
While EOL can be used as a standalone language, its primary target is to be embedded as an expression language to task-specific model management languages such as ETL, EVL, EWL etc. 
Here are some more examples ...
-->
		<hr class="clearer" />
	
	</div>

	<div id="rightcolumn">
		<?=toolsSideItem('workflow')?>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>