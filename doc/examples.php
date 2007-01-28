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
	$pageTitle 		= "Epsilon Examples";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	ob_start();
	
	# Create a parser and parse the examples.xml document.
	include_once("../dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("examples.xml"));
	$exampleNodes = $document->getElementsByTagName("example");
	
?>

	<div id="midcolumn">
		<table width="100%">
			<tr>
				<td width="50%">
					<h1><?=$pageTitle?></h1>
				</td>
				<td align="right">
					<img alt="Epsilon Logo" src="../resources/epsilonlogo.png" valign="top" />
				</td>
			</tr>
		</table>

		<h3>Examples</h3>
		
		This page contains <b><?=sizeof($exampleNodes)?></b> working examples of using the Epsilon languages.
		All examples are accompanied by the required metamodels, models, source files and 
		Eclipse launch configurations. This introduces some replication as copies of the same
		models/metamodels exist in more than one examples. However, our intention is that
		each example is complete and self-contained.
		
		<h3>Reporting issues</h3>
		Should you find an example that does not work
		with the current version of Epsilon please let us know by sending
		a message to the <a href="news://news.eclipse.org/eclipse.modeling.gmt">GMT newsgroup</a>
		
		<br><br>
		
		<table>
		<?
		foreach ($exampleNodes as $example) {
			$descriptionNodes = $example->selectElements(array(),"description");
			$descriptionNode = $descriptionNodes[0];
			$description = $descriptionNode->childNodes[0]->data;
			$src = $example->getAttribute("src");
			$title = $example->getAttribute("title");
		?>	
		<div class="homeitem3col">
			<h3><?=$title?></h3>
			<ul>
				<li>
					<a href="http://dev.eclipse.org/viewcvs/indextech.cgi/org.eclipse.gmt/epsilon/examples/<?=$src?>/<?=$src?>.zip">Download</a>, 
					<a href="http://dev.eclipse.org/viewcvs/indextech.cgi/org.eclipse.gmt/epsilon/examples/<?=$src?>/">CVS</a>
					<blockquote>
					<?=$description?>
					</DESCRIPTION>
					</blockquote>
				</li>
			</ul>
			<hr class="clearer" /></div>
		<?
		}

		?>
		</table>		
		<hr class="clearer" />

	</div>

<?
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>