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
	$pageTitle 		= "Quick Example";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('common.php');
	ob_start();
?>

	<div id="midcolumn">
		<h1><?=$pageTitle?></h1>
		
		<div style="font-family:Courier;padding:2px; border:1px dashed #B5B5AC;background-color:#FAFAFA;">
			<?include('quickexamplesrc.php')?>
		</div>
		<br>
		
		<hr class="clearer" />

	</div>
	
	<div id="rightcolumn">
		
		<div class="sideitem">
			<h6>What's this?</h6>
				<p> In this quick example, we create an ECore model programmatically using the Epsilon Object Language (EOL). <br><br>
				We first create an EPackage, then create 10 EClasses in it and then we assign a random super-type to each EClass. Finally, we query our ECore model and for each EClass we print the names of the other EClasses that extend it.
		<p>
		</div>
	
		<div class="sideitem">
				<h6>What's next?</h6>
		
		To find out more about Epsilon and the languages and tools it provides,
		you can have a look at the <a href="cinema">screencasts</a>, check out 
		the rest of the <a href="doc/examples.php">examples</a> and - for a 
		complete reference - read the <a href="">book</a>.
		
		</div>
	</div>
	
<?
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>