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
	$pageTitle 		= "Epsilon Generation Language";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>EGL is a template-based model-to-text language for generating
		code, documentation and other textual artefacts from models. EGL supports content-destination decoupling, protected regions for mixing generated with hand-written code, and template coordination</p>
		
		<h4>Features</h4>
		
		<ul>
			<li>Decouple content from destination (can be used to generate text to files, <a href="http://code.google.com/p/epsilonlabs/wiki/EGLinTomcat">as a server-side scripting language</a> etc.)
			<li>Call templates (with parameters) from other templates
			<li>Define and call sub-templates
			<li>Mix generated with hand-written code
		</ul>
		
		<?=eolFeatures()?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="http://code.google.com/p/epsilonlabs/wiki/EGLinTomcat">Tutorial: Using EGL as a server-side scripting language in Tomcat</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.egldoc">Example: Generate HTML from an Ecore metamodel</a>
			<li>Screencast: Generating an HTML report (<a href="../../cinema/#EglIntroduction">part 1</a>, <a href="../../cinema/#EglVariables">part 2</a>)
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 8 of the <a href="../book">Epsilon book</a> provides a complete 
		reference of the syntax and semantics of EGL.

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