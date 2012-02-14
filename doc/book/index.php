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
	require_once ('../../common.php');
	include ('../../examples/SyntaxHighlight.php');
	require ('../tools.php');
	require_once ('../../Epsilon.php');
	
	ob_start();
	$pdf = Epsilon::getSVNLocation()."trunk/doc/org.eclipse.epsilon.book/EpsilonBook.pdf";
?>

	<div id="midcolumn" style="width:750px">

		<h1><?=$pageTitle?></h1>
		<div style="float:right;padding-left:10px">
			<a href="<?=$pdf?>"><img src="../../images/book3.png"/></a><br>
			<center><a href="<?=$pdf?>">Download PDF</a></center>
		</div>
		
		<p>The Epsilon Book provides a complete reference of the syntax and semantics of the languages in Epsilon, the <a href="../emc">model connectivity framework</a> that underpins them, and the <a href="../workflow">ANT-based workflow mechanism</a> that enables assembling complex MDE workflows.</p>
		
		<p>You can browse the book in the embedded viewer below, <a href="<?=$pdf?>">download a PDF copy</a> or check out its LaTeX source from the SVN. Like the rest of Epsilon, the book is free and distributed under the <a href="http://www.eclipse.org/legal/epl-v10.html">Eclipse Public Licence</a>.</p>
		
		
		<iframe style="margin-top:20px;width:100%;height:650px;border:none" src="http://docs.google.com/viewer?url=http%3A%2F%2Fdev.eclipse.org%2Fsvnroot%2Fmodeling%2Forg.eclipse.epsilon%2Ftrunk%2Fdoc%2Forg.eclipse.epsilon.book%2FEpsilonBook.pdf&embedded=true"></iframe>
	
		<hr class="clearer" />
	
	</div>
	
<?
	include('../../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<link href='../../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>