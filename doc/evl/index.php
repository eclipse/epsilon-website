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
	$pageTitle 		= "Epsilon Validation Language";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>EVL is a validation language built on top of EOL. In their simplest form, EVL constraints are quite similar
		to OCL constraints. However, EVL also supports dependencies between constraints (e.g. if constraint A fails, don't evaluate constraint B), 
		customizable error messages to be displayed to the user and specification of fixes (in EOL) which users can invoke to repair inconsistencies.
		Also, as EVL builds on EOL, it can evaluate inter-model constraints (unlike OCL).</p>
		
		<h4>Features</h4>
		<ul>
			<li>Distinguish between errors and warnings during validation (constraints and critiques)
			<li>Specify quick fixes for failed constraints
			<li>Guarded constraints
			<li>Specify constraint dependencies
			<li>Break down complex constraints to sequences of simpler statements
			<li>Automated constraint evaluation
			<li><a href="../articles/evl-gmf-integration/">Out-of-the-box integration with the EMF validation framework and GMF</a>
		</ul>
		
		<?=eolFeatures()?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../cinema/#EVLGMFValidation">Screencast: Demonstrating the integration of EVL with GMF</a>
			<li><a href="../articles/evl-gmf-integration/">Article: Integrating EVL with an EMF/GMF editor</a>
			<li><a href="http://epsilonblog.wordpress.com/2008/11/09/error-markers-and-quick-fixes-in-gmf-editors-using-evl/">Blog: Error markers and quick fixes in GMF editors using EVL</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.validateoo">Example: Validate an OO model with EVL</a>
			<li><a href="../../cinema/#ModeLink_part2">Screencast: Evaluting inter-model constraints with EVL</a>
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 5 of the <a href="">Epsilon book</a> provides a complete 
		reference of the syntax and semantics of EVL.
		<!--
While EOL can be used as a standalone language, its primary target is to be embedded as an expression language to task-specific model management languages such as ETL, EVL, EWL etc. 
Here are some more examples ...
-->
		<hr class="clearer" />
	
	</div>

	<div id="rightcolumn">
		<?=toolsSideItem("evl")?>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>