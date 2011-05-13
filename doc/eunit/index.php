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
	$pageTitle 		= "Epsilon Unit Testing Framework";
	$pageKeywords	= "";
	$pageAuthor		= "Antonio García-Domínguez";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>EUnit is an unit testing framework built on top of the Epsilon platform. It is
		specifically designed for testing model management tasks, such as model-to-model
		transformations, model-to-text transformations and model validations, among others.
		EUnit can be used to test any model management task that is exposed through an Ant
		task, even if it is not part of the Epsilon platform.</p>
		
		<h4>Features</h4>
		
		<ul>
			<li>Reuse tests over different sets of data or models
			<li>Test setup and model management tasks are performed through <a href="../workflow">ANT</a> tasks
			<li>Test teardown is implicit: models are reloaded automatically
			<li>Compare models, files and directories transparently with the included assertions
			<li>Generate test reports in the widely adopted XML format of the &lt;junit&gt; Ant Task
			<li>View aggregated test results and compare differences graphically in Eclipse
			<li>Generate models inside the test using EOL 
			<li>Load models to be used in the test from HUTN fragments
		</ul>
		
		<?=eolFeatures()?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.eunit.examples.eol">Example: Test EOL scripts with EUnit</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.eunit.examples.evl">Example: Test a model validation script with EUnit</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.eunit.examples.egl.files">Example: Test a model-to-text transformation with EUnit</a>
			<li><a href="../../cinema/#eunit-etl">Screencast: Test an ETL model transformation with EUnit</a>
			<li><a href="../../cinema/#eunit-atl">Screencast: Test an ATL model transformation with EUnit</a>
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 12 of the <a href="../book">Epsilon book</a> provides a complete 
		reference of how tests are organized and specified in EUnit.

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