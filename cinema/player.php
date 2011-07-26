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
	$pageTitle 		= "Cinema Player";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	//include ('../common.php');
	//ob_start();
	
	# Create a parser and parse the examples.xml document.
	$screencasts = simplexml_load_file("cinema.xml")->screencast;
	
	$width = 1164;
	$height = 887;
	$screencast_name = "";
	$screencast_title = "";
	$screencast_description = "";
	
	foreach ($screencasts as $screencast) {
		if ($screencast["name"] == $_GET["screencast"]) {
			$screencast_name = $screencast["name"];
			$screencast_title = $screencast["title"];
			$screencast_description = $screencast->description;
			if ($screencast["height"] != "") $height = $screencast["height"];
			if ($screencast["width"] != "") $width = $screencast["width"];
		}
	}
?>
	<html>
	<head>
		<title>Screencast: <?=$screencast_title?></title>
	</head>
	<body style="font-family:Arial, sans-serif; background-color: #EFEFEF; font-size:12px">
	<center>
	<div style="width:<?=$width?>;background-color:white;border:1px solid #D9D9D9; padding:20px">
	<a href="."><img alt="Close" src="close-button.png" style="float:right"/></a>
	<h1><?=$screencast_title?></h1>
	<div align="left" style="padding-bottom:20px"><b>Plot:</b> <?=$screencast_description?></div>
	<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" WIDTH="<?=$width?>" HEIGHT="<?=$height?>" CODEBASE="http://active.macromedia.com/flash5/cabs/swflash.cab#version=7,0,0,0">
	<PARAM NAME=movie VALUE="<?=$screencast_name?>.swf">
	<PARAM NAME=play VALUE=true>
	<PARAM NAME=loop VALUE=false>
	<PARAM NAME=wmode VALUE=transparent>
	<PARAM NAME=quality VALUE=low>
	<EMBED SRC="<?=$screencast_name?>.swf" WIDTH="<?=$width?>" HEIGHT="<?=$height?>" quality=low loop=false wmode=transparent TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">
	</EMBED>
	</OBJECT></center>
	<SCRIPT src='player.js'></script>
	</div>
	
<?
	include('../stats.php');
	//$html = ob_get_contents();
	//ob_end_clean();
	# Generate the web page
	//$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>

	</body>
	</html>