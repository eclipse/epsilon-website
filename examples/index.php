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
	$pageTitle 		= "Examples";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	include ('SyntaxHighlight.php');
	ob_start();
	
	# Create a parser and parse the examples.xml document.
	include_once("../dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("examples.xml"));
	$examples = $document->getElementsByTagName("example");
	
	$currentExampleName = $_REQUEST['example'];
	$example = null;
	
	if ($currentExampleName) {
		foreach ($examples as $ex) {
			if ($ex->getAttribute("src") == $currentExampleName) {
				$example = $ex;
				break;
			}
		}
	}
	else {
		$example = $examples[0];
	}
	
?>
	
	
	<div id="midcolumn">
		<?include('../noscript.html')?>
		<!--h1><?=$example->getAttribute("title")?></h1-->

	<div id="TabbedPanels1" class="TabbedPanels">	
		<ul class="TabbedPanelsTabGroup" style="margin:0">	
			<?foreach ($example->getElementsByTagName("file") as $file){?>
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0">
				<?
				$path = $file->getAttribute("name");
				$slashIndex = strrpos($path, '/');
				if ($slashIndex > -1) {
					$name = substr($path, $slashIndex + 1);
				}
				else {
					$name = $path;
				}
				?><?=$name?>
			</li>
			<?}?>
			<?foreach ($example->getElementsByTagName("metamodel") as $file){?>
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0"><?=$file->getAttribute("name")?></li>
			<?}?>
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0">Get it!</li>
		</ul>
		<div class="TabbedPanelsContentGroup">
	    <?foreach ($example->getElementsByTagName("file") as $file){?>
			<div class="TabbedPanelsContent" style="font-family:Courier;height:520px;overflow:scroll">
			<?
				$url = "http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/trunk/examples/";
				$url = $url.$example->getAttribute("src");
				$url = $url."/".$file->getAttribute("name");
				$content = '';
				if ($fp = fopen($url, 'r')) {
			   // keep reading until there's nothing left 
			   while ($line = fread($fp, 1024)) {
			      $content .= $line;
			   }
				} else {
				   $content = "Unavailable"; 	
				}
			?>
			<?=highlight($content, getExtension($url))?>
			</div>
			<?}?>
<?foreach ($example->getElementsByTagName("metamodel") as $file){?>
			<div class="TabbedPanelsContent" style="font-family:Courier;height:520px;overflow:scroll">
			<?
				$url = "http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/trunk/examples/";
				$url = $url."org.eclipse.epsilon.examples.metamodels";
				$url = $url."/".$file->getAttribute("name");
				$content = '';
				if ($fp = fopen($url, 'r')) {
			   // keep reading until there's nothing left 
			   while ($line = fread($fp, 1024)) {
			      $content .= $line;
			   }
				} else {
				   $content = "Unavailable"; 	
				}
			?>
			<?=highlight($content, "emf")?>
			</div>
			<?}?>
			<div class="TabbedPanelsContent" style="height:520px">
			<p>
			To get this example running in your Eclipse installation, you need to go through the following steps:
			<ol>
				<li> go to the <a href="../doc/EpsilonSVN.pdf">SVN repository</a> 
				<li> navigate to <b>trunk/examples</b>
				<li> check out the <b><?=$example->getAttribute("src")?></b> project.
				<li> check out the <b>org.eclipse.epsilon.examples.metamodels</b> project
				<li> register all .ecore metamodels in the project (select all of them and then right click and select <b>Register EPackages</b>). 
				<li> right click the .launch file in the <b><?=$example->getAttribute("src")?></b> project
				<li>select <b>Run as...</b> and click the first item in the menu that pops up
			</ol>
			</div>
	  </div>
	</div>
	</div>	

	<div id="rightcolumn">
	
	<div class="sideitem">
	<h6>What's this?</h6>
	<p>
		<?=$example->getOneChild("description")->childNodes[0]->data?>
	</p>
	</div>
	
	<div class="sideitem">
	<h6>What are .emf files?</h6>
	<p>
		.emf files are ECore metamodels expressed using the <a href="http://wiki.eclipse.org/Emfatic">Emfatic</a> textual syntax.
	</p>
	</div>
	
	<div class="sideitem">
	<h6>More examples...</h6>
		<ul>
		<?
			foreach ($examples as $example) {
			$descriptionNodes = $example->selectElements(array(),"description");
			$descriptionNode = $descriptionNodes[0];
			$description = $descriptionNode->childNodes[0]->data;
			$name = $example->getAttribute("src");
			$title = $example->getAttribute("title");
			$files = $example->selectElements(array(),"file");
		?>
		<li><a href="index.php?example=<?=$name?>"><?=$title?></a>
		<?}?>
		</ul>
	</div>
	
	</div>
	
	<script type="text/javascript">
	<!--
	var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
	//-->
	</script>
<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<script src='SpryTabbedPanels.js' type='text/javascript'></script>");
	$App->AddExtraHtmlHeader("<link href='SpryTabbedPanels.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>