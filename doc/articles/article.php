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
	$articleId =  $_GET['articleId'];
	$contentFile = $articleId.'/content.wiki';
	
	if (file_exists($contentFile)) {
		$lines = file($contentFile);
		$line = trim($lines[0]);
		$pageTitle = substr($line, 1, strlen($line) - 2);
		$contentType = "wiki";
	} else {
		$contentFile = $articleId.'/content.html';
		$lines = file($contentFile);
		$matches = preg_grep("/^<h1>(.*?)<\/h1>/", $lines);
		if (sizeof($matches) > 0) {
			$pageTitle = substr($matches[0], 4, strlen($matches[0]) - 11);
		}
		$contentType = "html";
	}
	ob_start();
?>
	<div id="midcolumn" style="width:753px">
		
		<?if(file_exists($contentFile)){?>
		<div class="sideitem" style="float:right; margin-left:30px; margin-bottom:30px; width:238px;">
			<h6>Actions</h6>
			<div class="modal">
			<!--?=WikiTextToHTML::convertWikiTextToToc(file_get_contents($contentFile));?-->
			<ul>
				<li><a href="../../../forum/">Get help with this article</a>
				<li><a href="../">Back to the article index</a>
			</ul>
			</div>
		</div>
		<?if ($contentType == "wiki") {
				echo WikiTextToHTML::convertWikiTextToHTML(file_get_contents($contentFile));
			} else {
				echo file_get_contents($contentFile);
			}
		?>
		<?}
		else {?>
		<div class="warningbox">
		Article <?=$articleId?> not found. Go back to the <a href="..">index of articles</a>.
		</div>
		<?}?>
	</div>
	
	<!--div id="rightcolumn"-->
		<!--
		<div class="sideitem" style="width:300px; float:right">
			<h6>Actions</h6>
			<div class="modal">
			<ul>
				<li><a href="#">Print this article</a>
			</ul>
			</div>
		</div-->
	<!--/div-->
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>