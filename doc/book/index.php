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
	$pageTitle 		= "The Epsilon Book";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	include ('../tools.php');
	ob_start();
	$pdf = "http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/trunk/doc/org.eclipse.epsilon.book/EpsilonBook.pdf";
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<div style="float:right;padding-left:10px">
			<a href="<?=$pdf?>"><img src="../../images/book.png"/></a><br>
			<center><a href="<?=$pdf?>">Download PDF</a></center>
		</div>
		
		<p>The Epsilon Book provides a complete reference of the syntax and semantics of the languages in Epsilon, the <a href="../emc">model connectivity framework</a> that underpins them, and the <a href="../workflow">ANT-based workflow mechanism</a> that enables assembling complex MDE workflows.</p>
		
		<p>You can <a href="<?=$pdf?>">download the PDF version of the book</a> or check out its LaTeX source from the SVN. Like the rest of Epsilon, the book is free and distributed under the <a href="http://www.eclipse.org/legal/epl-v10.html">Eclipse Public Licence</a>.</p>
		
		<hr class="clearer" />
	
	</div>

	<div id="rightcolumn">
		<?=seeAlsoSideItem()?>
	</div>
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>