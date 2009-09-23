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
	$pageTitle 		= $_GET['articleId'];
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	require_once 'wikitexttohtml.php';
	//chdir($_GET['articleId']);
	ob_start();
?>

	<div id="midcolumn">
		<?=WikiTextToHTML::convertWikiTextToHTML(file_get_contents($_GET['articleId'].'/content.wiki'));?>
	</div>
	
	<div id="rightcolumn">
		<div class="sideitem">
			<h6>Actions</h6>
			<ul>
				<li><a href="#">Print this article</a>
			</ul>
		</div>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>