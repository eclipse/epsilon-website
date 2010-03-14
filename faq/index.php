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
	$pageTitle 		= "Frequently Asked Question (FAQs)";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	ob_start();
	
	$faqs = simplexml_load_file("faqs.xml")->faq;
?>

	<div id="midcolumn">
		<h1><?=$pageTitle?></h1>
		
		<img style="float:right" src="http://dev.eclipse.org/huge_icons/apps/help-browser.png">
		
		<p>In this page we provide answers to common questions about Epsilon. If your question is not answered here,
		please feel free to <a href="../forum">ask in the forum</a>.</p>
		
		<?foreach ($faqs as $faq){?>
		<p>
		<h2><a style="color:black;text-decoration:none" name="<?=$faq->title?>"><?=$faq->title?></a></h2>
		<?=$faq->answer?>
		</p>
		<?}?>
	</div>
	
	<div id="rightcolumn">
	<div class="sideitem">
	<h6>Overview</h6>
	<div class='modal'>
	<ul>
		<?foreach ($faqs as $faq){?>
		<li><a href="#<?=$faq->title?>"><?=$faq->title?></a>
		<?}?>
	</ul>
	</div>
	</div>

	
	<div class="sideitem">
	<h6>Links</h6>
	<div class='modal'>
	<ul>
		<li> <a href="http://www.eclipse.org/gmt/faq.php">GMT Frequently Asked Questions</a>
	</ul>
	</div>
	</div>
	
	</div>	
<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>