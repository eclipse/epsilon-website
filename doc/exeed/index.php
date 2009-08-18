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
	$pageTitle 		= "Exeed";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<p>Exeed is an enhanced version of the built-in EMF reflective tree-based
editor that enables developers to customize the labels and icons of
model elements simply by attaching a few simple annotations to the
respective EClasses in the Ecore metamodel. Exeed also supports setting
the values of references using drag-and-drop instead of using the combo
boxes in the properties view.</p>

		<h4>Features</h4>
		<ul>
			<li>Customize the appearance of nodes in the reflective tree editor
			without generating a dedicated editor</li>
			<li>Specify the label and icon of each node using <a href="../eol">EOL</a></li>
			<li>Labels and icons can reflect the status of an element (e.g.
		different icon depending on whether a property is true/false)</li>
		</ul>

		<h4>Resources</h4>
		<ul>
			<li><a href="../Exeed.pdf">Tutorial: Editing EMF models with Exeed (slightly outdated)</a>
		</ul>
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