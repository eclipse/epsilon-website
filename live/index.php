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
	$pageTitle 		= "Live";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	# Create a parser and parse the examples.xml document.
	include_once("../dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("scripts.xml"));
	$scripts = $document->getElementsByTagName("script");
	ob_start();
?>

	<div id="midcolumn">
		<?include('../noscript.html')?>
		<iframe src="http://epsilon-live.appspot.com/embedded.html" frameborder="0" scrolling="no" style="width:520px;height:600px;border:0px"></iframe>
		<h3>Live Scripts</h3>
			The following scripts demonstrate the main features of EOL. You can copy/paste all these scripts in the editor above and give them a spin.<br/><br/>
			<?
			foreach ($scripts as $script) {
			$description = $script->getOneChild("description")->childNodes[0]->data;
			$title = $script->getAttribute("title");
			$source = $script->getOneChild("source")->childNodes[0]->data;
			$order   = array("\r\n", "\n", "\r");
			$replace = '<br/>';
			$source = str_replace($order, $replace, trim($source));
			$order   = array(" ");
			$replace = '&nbsp;';
			$source = str_replace($order, $replace, trim($source));
			?>
			<h4><a name="<?=$title?>" style="color:black;text-decoration:none"><?=$title?></a></h4> 
			<b>Description:</b> <?=$description?>
			<div style="padding:5px; border:1px dotted #C0C0C0; font-family:monospace; font-size:14px"><?=$source?></div>
			<br>
			<?}?>
	</div>
	
	<div id="rightcolumn">
		<div class="sideitem">
			<h6>Epsilon Live</h6>
			<p>Here you can play around with EOL - the core language of Epsilon - from your browser, without needing to download or install anything in your computer.
			<br><br>
			Except for playing with the basic features of the language, you can also query a real EMF model (which for simplicity, is <a href="#">ECore</a> itself).
			</p>
		</div>
		<div class="sideitem">
			<h6>Live Scripts</h6>
			<ul>
			<?
			foreach ($scripts as $script) {
			$description = $script->getOneChild("description")->childNodes[0]->data;
			$title = $script->getAttribute("title");
			$source = $script->getOneChild("source")->childNodes[0]->data;
			?>
			<li><a href="#<?=$title?>"><?=$title?></a>
			<?}?>
			</ul>
		</div>
</div>
	
<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>