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
	$pageTitle 		= "Epsilon Merging Language";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>EML is a hybrid, rule-based language for merging homogeneous or heterogeneous models. As a merging language requires all the features of a transformation language (merging model A with an empty model into model B is equivalent to transforming A->B), EML reuses the syntax and semantics of <a href="../etl">ETL</a> and extends it with concepts specific to model merging.</p>
		<p>Before merging can be performed, correspondences between elements of the input models need to be established. This can be achieved using the <a href="../ecl">comparison language</a> of Epsilon (or using Java).
		
		<h4>Features</h4>
		
		<ul>
			<li>Merge homegeneous models
			<li>Merge heterogeneous models
			<li>Complete specification of the merging logic
			<li>Declarative rules with imperative bodies
			<li>Export the merge trace to a custom model/format
			<li>Automated rule execution
			<li>Lazy and greedy rules
			<li>Multiple rule inheritance
			<li>Guarded rules
		</ul>
		
		<?=eolFeatures()?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.mergeentitywithvocabulary">Merge heterogeneous models with EML</a>
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 10 of the <a href="../book">Epsilon book</a> provides a complete 
		reference of the syntax and semantics of EML.

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