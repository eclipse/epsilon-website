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
	$screencasts = simplexml_load_file("cinema.xml")->screencast;
	
?>

	<div id="midcolumn">
	<h1><?=$pageTitle?></h1>
		<img style="float:right" src="http://dev.eclipse.org/huge_icons/mimetypes/x-office-presentation.png">
		This page contains several screencasts demonstrating different tools and languages in Epsilon. To watch the screencasts you must have a <a href="http://get.adobe.com/flashplayer/">Flash player</a> installed and enabled in your browser. All screencasts have been captured using <a href="http://www.debugmode.com/wink">Wink</a>.
		
		<br><br>
		
		<?
		foreach ($screencasts as $screencast) {
		?>	
		<div class="homeitem3col">
			<div style="background-image:url('../images/paigeitem75.png')"><h3><a name="<?=$screencast["name"]?>" style="color:black;text-decoration:none">&nbsp;<?=$screencast["title"]?></a></h3></div>
			<div style="position:relative;top:-4px;background-color:#FAFAFA;border-left:1px solid #D7D7D7;border-right:1px solid #D7D7D7;border-bottom:1px solid #D7D7D7">
			<table>
				<tr>
					<td><a href="<?=$screencast["name"]?>.htm"><img src="<?=$screencast["name"]?>.jpg"></img><img src="../images/play.png" style="position:relative;top:-110px;left:-240px"></a></td>
				</tr>
				<tr>
					<td style="padding-left:5px;vertical-align:top"><p><b>Plot: </b><?=$screencast->description?></td>
				</tr>
			</table>
			</div>
			</div>
		<?
		}
		?>
		<hr class="clearer" />

	</div>
	
	<div id="rightcolumn">
		<div class="sideitem">
		<h6>Overview</h6>
		<div class='modal'>
		<ul>
		<?
		foreach ($screencasts as $screencast) {
		?>
		<li><a href="#<?=$screencast["name"]?>"><?=$screencast["title"]?></a>
		<?}?>
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