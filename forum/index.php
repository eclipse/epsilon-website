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
	$pageTitle 		= "Epsilon Forum";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<img style="float:right" src="http://dev.eclipse.org/huge_icons/actions/mail-send-receive.png">
		<p>Epsilon has a <a href="http://www.eclipse.org/forums/index.php?t=thread&frm_id=22">dedicated forum</a> where you can report problems* and ask questions about the languages and tools it provides. Questions are typically answered within a few minutes, and <u>no post has ever gone unanswered</u>.</p>
		
		<h2>Connecting using a newsgroup reader</h2>
		
		<p>
		As an alternative to the <a href="http://www.eclipse.org/forums/index.php?t=thread&frm_id=22">web interface</a>, you can
		use a newsgroup reader (e.g. Thunderbird, Outlook Express) to monitor the forum.
		To do this, you need to first get a username and password by filling in 
		<a href="http://www.eclipse.org/newsgroups/register.php">this form</a> 
		(<i>this small inconvenience is necessary to prevent spam</i>).</p>
		
		<p>Once you have received your username and password you can connect to the newsgroup that underpins the forum by configuring 
		your newsgroup reader with the following details:</p>
		
		<ul>
			<li><b>Server:</b> news.eclipse.org
			<li><b>Newsgroup:</b> eclipse.epsilon
		</ul>
		
		
		<h2>Monitor the newsgroup for new questions/answers</h2>
		
		<p>You can use <a href="http://kolovos.wiki.sourceforge.net/Newsgroup+Watcher">Newsgroup Watcher</a> to monitor the forum 
		and get instant notifications about new answers to your questions.</p>

	<br><i>* If on the other hand you've found everything to be working well, positive feedback is equally welcome ;)</i>
	
		<hr class="clearer" />
	
	</div>
	
	<div id="rightcolumn">
		<div class="sideitem">
		<h6>Where is the newsgroup?</h6>
		<div class='modal'>
		<ul>
			<li>The <a href="http://www.eclipse.org/forums/index.php?t=thread&frm_id=22">forum</a> is just a web-based front-end for the existing NNTP newsgroup, 
			so if you are already reading/posting to the newsgroup via a newsgroup reader, there's no need to change anything.
		</ul>
		</div>
		</div>
		
		<div class="sideitem">
		<h6>Twitter</h6>
		<div class='modal'>
		<ul>
			<li>You can also tweet us your feedback <a href="http://www.twitter.com/epsilonews">@epsilonews</a>
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