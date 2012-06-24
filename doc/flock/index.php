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
	$pageTitle 		= "Epsilon Flock";
	$pageKeywords	= "";
	$pageAuthor		= "Louis Rose";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>Epsilon Flock is a model migration language built atop EOL, for updating models in response to metamodel changes.
		Flock provides a rule-based transformation language for specifying model migration strategies.
		A conservative copying algorithm automatically migrates model values and elements that are 
		not affected by the metamodel changes.</p>
		
		<h4>Features</h4>
		
		<ul>
			<li>Migrate models to re-establish consistency with an evolved metamodel</li>
			<li>Automatic copying of unaffected data</li>
			<li>Simple distribution of migration strategies using Eclipse extension point</li>
			<li>Declarative rules with imperative bodies</li>
			<li>Guarded rules</li>
		</ul>
		
		<?=eolFeatures()?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.flock.petrinets">Example: Migrate Petri net models with Epsilon Flock</a>
			<li><a href="../../cinema/#FlockPetrinets">Screencast: Migrate Petri net models with Epsilon Flock</a>
			<li><a href="http://www.cs.york.ac.uk/ftpdir/reports/2010/YCS/450/YCS-2010-450.pdf">Technical Report: Motivation and aims of Flock, along with an example of using Flock to migrate a UML class diagram.</a>
		</ul>
		
		<hr class="clearer" />
	
	</div>

	<div id="rightcolumn">
		<?=toolsSideItem('flock')?>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>