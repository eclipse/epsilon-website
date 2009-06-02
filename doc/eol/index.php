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
	$pageTitle 		= "Epsilon Object Language";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<div class="codebox" style="float:right"> <a href="../../live">Try EOL in your browser!</a></div>
		<p>EOL is an imperative programming language for creating, querying and modifying EMF models. 
		You can think of it as a mixture of Javascript and OCL, combining the best of both worlds. 
		As such, it provides all the usual imperative features found in Javascript 
		(e.g. statement sequencing, variables, for and while loops, if branches etc.) 
		and all the nice features of OCL such as those handy collection querying 
		functions (e.g. <code>Sequence{1..5}.select(x|x>3))</code>.</p>
		
		<?=eolFeatures("Features")?>

		<h4>Examples and Screencasts</h4>
		<ul>
			<li><a href="../../cinema/#BuildOOInstance_part2">Screencast demonstrating writing and executing an EOL program</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.buildooinstance">A simple EOL program that constructs an OO model</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.shortestpath">Dijkstra's shortest path algorithm in EOL</a>
			<li><a href="../../examples/index.php?example=org.eclipse.epsilon.examples.calljava">Call Java from EOL</a>
		</ul>
		
		<h4>Reference</h4>
		
		Chapter 4 of the <a href="">Epsilon book</a> provides a complete 
		reference of the syntax and semantics of EOL.
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