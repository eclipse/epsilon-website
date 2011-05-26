<?php  																														require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/app.class.php");	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/nav.class.php"); 	require_once($_SERVER['DOCUMENT_ROOT'] . "/eclipse.org-common/system/menu.class.php"); 	$App 	= new App();	$Nav	= new Nav();	$Menu 	= new Menu();		include($App->getProjectCommon());    # All on the same line to unclutter the user's desktop'

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
	$pageTitle 		= "Articles";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	ob_start();
	
	# Create a parser and parse the examples.xml document.
	$categories = simplexml_load_file("articles.xml")->category;
	$articles = simplexml_load_file("articles.xml")->article;
	
?>

	<div id="midcolumn">
	<h1><?=$pageTitle?></h1>
		<img style="float:right" src="http://dev.eclipse.org/huge_icons/apps/accessories-text-editor.png">
		This page contains an index of articles presenting a range of tools and languages in Epsilon. Should you find that an article contains errors or is inconsistent with the current release of Epsilon, please <a href="../../forum">let us know</a>.
		<br><br>
		<?
		foreach ($categories as $category) {
		?>
		<h2 id="<?=$category["name"]?>"><?=$category["title"]?></h2>
		<ul>
  		<?
  		foreach ($category->article as $article) {
  		?>
  		<li><a href="<?=$article["name"]?>/"><?=$article["title"]?></a>: <?=$article->description?>
  		<?
  		}
  		?>
  	</ul>
    <?}?>
  	<hr class="clearer" />

	</div>
	
	<div id="rightcolumn">
		<div class="sideitem">
		<h6>Categories</h6>
		<div class='modal'>
		<ul>
		<?
		foreach ($categories as $category) {
		?>
		  <li><a href="#<?=$category["name"]?>"><?=$category["title"]?></a></li>
		<?}?>
		</ul>
		</div>
		</div>
	</div>
	
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>