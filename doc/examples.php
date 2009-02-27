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
	ob_start();
	
	# Create a parser and parse the examples.xml document.
	include_once("../dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("examples.xml"));
	$exampleNodes = $document->getElementsByTagName("example");
	
?>

	<div id="midcolumn" style="width:75%">
<h1><?=$pageTitle?> (<?=sizeof($exampleNodes)?> so far...)</h1>
		
		This page contains working examples that demonstrate the languages and tools provided by Epsilon.
		All examples are accompanied by the required metamodels, models, source files and 
		Eclipse launch configurations. This introduces some replication as copies of the same
		models/metamodels exist in more than one examples. However, our intention is that
		each example is complete and self-contained. (Instructions for checking out files from the 
		SVN are provided <a href="EpsilonSVN.pdf">here</a>). Should you find an example that does not work
		with the current version of Epsilon please let us know by sending
		a message to the <a href="news://news.eclipse.org/eclipse.epsilon">Epsilon newsgroup</a>.
		
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
		<div class="homeitem3col" style="">
			<div style="background-image:url('../images/pageitem.png')"><h3>&nbsp;<?=$title?></h3></div>
			<div style="position:relative;top:-4px;background-color:#FAFAFA;border-left:1px solid #D7D7D7;border-right:1px solid #D7D7D7;border-bottom:1px solid #D7D7D7">
			<ul>
				<li> 
					<a href="http://dev.eclipse.org/viewsvn/index.cgi/trunk/examples/<?=$src?>/?root=Modeling_EPSILON">SVN</a>
					<blockquote>
					<?=$description?>
					</DESCRIPTION>
					</blockquote>
				</li>
			</ul>
			</div>
			</div>
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