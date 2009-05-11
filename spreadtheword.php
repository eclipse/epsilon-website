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
	$pageTitle 		= "Spread the word";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('common.php');
	ob_start();
	
	include_once("dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("epic.xml"));
	$votes = $document->getOneChild("epicItem")->getOneChild("votes")->childNodes[0]->data;
	$rating = $document->getOneChild("epicItem")->getOneChild("rating")->childNodes[0]->data;
	
?>

	<div id="midcolumn">
		<div style="float:right"><h3 style="color:#C0C0C0"><i>Votes: <?=$votes?> (<?=number_format($rating,1)?>/10)</i></h3></div>
		<h3>Rate Epsilon at EPIC</h3>
		
		<div style="float:right">
			<form method="post" action="http://www.eclipseplugincentral.com/Web_Links.html">

			<select name="rating" style="width:67px">
			<option>--</option>
			<option selected>10</option>
			<option>9</option>
			<option>8</option>
			<option>7</option>
			<option>6</option>
			<option>5</option>
			<option>4</option>
			<option>3</option>
			<option>2</option>
			<option>1</option>
			</select>
			<br>
			<input type="hidden" name="ratinglid" value="842">
			<input type="hidden" name="ratinguser" value="outside">
			<input type="hidden" name="req" value="addrating">
			<input type="submit" value="Vote!" style="width:67px; margin-top:5px">
			</form>
		</div>
		<p>Eclipse Plugin Central is the most comprehensive source of Eclipse plugins. You can use the form on the right to rate <a href="http://www.eclipseplugincentral.com/Web_Links-index-req-viewlink-cid-887.html">Epsilon</a> directly from this page without needing to have an account, login or anything (but please vote only once :)).</p>
		
		<h3>Add Epsilon to your Ohloh stack</h3>
		<div style="float:right">
<script type="text/javascript" src="http://www.ohloh.net/p/8615/widgets/project_users.js"></script>
		</div>
		<p>Ohloh is an increasingly popular social networking site that connects software with the people that develop and use it. You can click on the widget on the right to add <a href="http://www.ohloh.net/projects/8615">Epsilon</a> to the stack of applications you are using and let other developers looking in the MDE direction know that you are finding it useful.</p>
		
	</div>
	
	<div id="rightcolumn">
		
		<div class="sideitem">
			<h6>Spread the word</h6>
			<p>
If you're using Epsilon and are finding it useful, consider spreading the word using one or more of the options provided in this page. <br/><br/>After all, few things motivate a developer to get into the trouble of installing and evaluating a tool more than other developers' recommendations.
			</p>
		</div>
	
	</div>
	
<?
	include('stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>