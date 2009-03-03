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
	$pageTitle 		= "Cinema";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	ob_start();
	
	# Create a parser and parse the examples.xml document.
	include_once("../dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("cinema.xml"));
	$screencasts = $document->getElementsByTagName("screencast");
	
?>

	<div id="midcolumn" style="width:75%">
	<h1><?=$pageTitle?></h1>
		
		This page contains several Flash screencasts demonstrating different tools and languages in Epsilon. All screencasts have been captured using <a href="http://www.debugmode.com/wink">Wink</a>.
		
		<br><br>
		
		<?
		foreach ($screencasts as $screencast) {
			$descriptionNodes = $screencast->selectElements(array(),"description");
			$descriptionNode = $descriptionNodes[0];
			$description = $descriptionNode->childNodes[0]->data;
			$name = $screencast->getAttribute("name");
			$title = $screencast->getAttribute("title");
		?>	
		<div class="homeitem3col">
			<div style="background-image:url('../images/pageitem.png')"><h3>&nbsp;<?=$title?></h3></div>
			<div style="position:relative;top:-4px;background-color:#FAFAFA;border-left:1px solid #D7D7D7;border-right:1px solid #D7D7D7;border-bottom:1px solid #D7D7D7">
			<table>
				<tr>
					<td><a href="<?=$name?>.htm"><img src="<?=$name?>.jpg"></img></a></td>
					<td style="border-left:1px solid #CCCCCC;padding-left:5px;vertical-align:top"><b>Plot: </b><?=$description?></td>
				</tr>
			</table>
			</div>
			</div>
		<?
		}
		?>
		<hr class="clearer" />

	</div>

<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>