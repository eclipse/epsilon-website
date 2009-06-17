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
	$pageTitle 		= "Newsgroup";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	include ('../common.php');
	ob_start();
?>

	<div id="midcolumn">

		<h1><?=$pageTitle?></h1>
		<img style="float:right" src="http://dev.eclipse.org/huge_icons/actions/mail-send-receive.png">
		<p>Epsilon has a dedicated newsgroup where you can report problems* and ask questions about the languages and tools it provides. Questions are typically answered within a couple of hours (often quite sooner than that), and no post has ever gone unanswered.</p>
		
		<h2>Connecting using a newsgroup reader <i style="color:#C0C0C0">(recommended)</i></h2>
		
		<p>To connect to the newsgroup using a newsgroup reader (e.g. Thunderbird, Outlook Express),
		you need to first get a username and password by filling in 
		<a href="http://www.eclipse.org/newsgroups/register.php">this form</a> 
		(<i>this small inconvenience is necessary to prevent spam</i>).</p>
		
		<p>Once you have received your username and password you can connect to the newsgroup by configuring 
		your newsgroup reader with the following details:</p>
		
		<ul>
			<li><b>Server:</b> news.eclipse.org
			<li><b>Newsgroup:</b> eclipse.epsilon
		</ul>
		
		<h2>Use the web interface </h2>
		
		<p>An alternative is to use the <a href="http://www.eclipse.org/newsportal/thread.php?group=eclipse.epsilon">web interface</a>.
		You can freely browse existing messages but you'll need to 
		<a href="https://bugs.eclipse.org/bugs/createaccount.cgi">get an Eclipse Bugzilla ID</a> 
		in order to post messages.</p>
		
		<h2>Monitor the newsgroup for new questions/answers</h2>
		
		<p>You can use <a href="http://kolovos.wiki.sourceforge.net/Newsgroup+Watcher">this small utility</a> to monitor the newsgroup 
		and get instant notifications about new answers to your questions (instead of checking manually every 2&quot;).</p>

	<br><i>* If on the other hand you've found everything to be working well, positive feedback is equally welcome.</i>
	
		<hr class="clearer" />
	
	</div>
	
	<div id="rightcolumn">
		<div class="sideitem">
		<h6>Connection details</h6>
		<ul>
		
			<li><b>Server:</b> news.eclipse.org
			<li><b>Newsgroup:</b> eclipse.epsilon
			<li><a href="http://www.eclipse.org/newsgroups/register.php">Get a username and password</a> 
		</ul>
		</div>
		<!--
		<div class="sideitem">
		<h6>Newsgroup info</h6>
		<ul>
			<li><b>Messages:</b> 404
			<li><b>Last message on:</b> 12/2 
		</ul>
		</div>
		-->
</div>
	

<?
	include('../stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>