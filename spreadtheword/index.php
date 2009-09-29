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
	$pageTitle 		= "Spread the word";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";
	chdir('..');
	include ('common.php');
	ob_start();
	
	include_once("dom4php/XmlParser.php");
	$parser   = new XmlParser($encoding = 'ISO-8859-1'); # encoding is optional
	$document = $parser->parse(file_get_contents("epic.xml"));
	$votes = $document->getOneChild("epicItem")->getOneChild("votes")->childNodes[0]->data;
	$rating = $document->getOneChild("epicItem")->getOneChild("rating")->childNodes[0]->data;
	
?>

	<div id="midcolumn">
		<div style="float:right"><h3 style="color:#C0C0C0"><i><?=number_format($rating,1)?>/10 (<?=$votes?> votes)</i></h3></div>
		<h3>Rate Epsilon at EPIC</h3>
		
		<div style="float:right;padding-left:10px">
			<form method="post" action="http://www.eclipseplugincentral.com/Web_Links.html">

			<select name="rating" style="width:67px">
			<option>--</option>
			<option selected>10</option>
			<option>9</option>
			<option>8</option>
			<option>7</option>
			<option>6</option>
			<option>5</option>
			<option>4</option>
			<option>3</option>
			<option>2</option>
			<option>1</option>
			</select>
			<br>
			<input type="hidden" name="ratinglid" value="842">
			<input type="hidden" name="ratinguser" value="outside">
			<input type="hidden" name="req" value="addrating">
			<input type="submit" value="Vote!" style="width:67px; margin-top:5px">
			</form>
		</div>
		<p>Eclipse Plugin Central is the most comprehensive source of Eclipse plugins. You can use the form on the right to rate <a href="http://www.eclipseplugincentral.com/Web_Links-index-req-viewlink-cid-887.html">Epsilon</a> directly from this page without needing to have an account, login or anything.</p>
		
		<h3>Add Epsilon to your Ohloh stack</h3>
		<div style="float:right;padding-left:10px">
<script type="text/javascript" src="http://www.ohloh.net/p/8615/widgets/project_users.js"></script>
		</div>
		<p>Ohloh is an increasingly popular social networking site that connects software with the people that develop and use it. You can click on the widget on the right to add <a href="http://www.ohloh.net/projects/8615">Epsilon</a> to the stack of applications you are using and let other developers looking in the MDE direction know that you are finding it useful.</p>
		
		<h3>Follow @epsilonews on Twitter</h3>
		<img style="float:right;padding-left:10px;" src="../images/twitter.png"/>
		<p>Follow <a href="http://www.twitter.com/epsilonews">@epsilonews</a> on Twitter to keep in touch with the latest news and developments in Epsilon.
		</p>

		<h3>Share your experiences</h3>
		<img style="float:right;padding-left:10px;" src="http://dev.eclipse.org/huge_icons/devices/network-wireless.png"/>
		<p>Consider investing some time to share your experiences with Epsilon in your blog, website, or in the <a href="/gmt/epsilon/forum">forum</a>. Here are some examples of blog articles that discuss different bits of Epsilon:
		<ul>
			<li> <a href="http://www.randomice.net/2008/08/gmf-toolkits/">GMF Toolkits</a>
			<li> <a href="http://kbm.blogspot.com/2009/05/cool-live-mda-via-google-app-engine.html">Cool - live MDE via Google App Engine</a>
			<li> <a href="http://blog.pyramism.net/2008/01/blog-filter-epsilon-and-glimmer.html">Blog filter: Epsilon and Glimmer</a>
			<li><a href="http://stephaneerard.wordpress.com/2009/06/09/symfony-model-editor/">Symphony Model Editor</a> (in French)
			<li><a href="http://stephaneerard.wordpress.com/2009/06/04/les-epsilons-endoctrines-generent-pour-se-liberer/">Les Epsilons endoctrin&eacute;s g&eacute;n&egrave;rent pour se liberer</a> (in French)
			<li><a href="http://stephaneerard.wordpress.com/2009/06/06/les-epsilons-transforment-pour-etre/">Les Epsilons transforment pour &Ecirc;tre</a> (in French)
			<li><a href="http://stephaneerard.wordpress.com/2009/06/03/les-epsilons-endoctrines/">Les Epsilons endoctrin&eacute;s</a> (in French)
			<li><a href="http://stephaneerard.wordpress.com/2009/06/04/les-epsilons-endoctrines-generent-pour-se-liberer/">Les Epsilons endoctrin&eacute;s g&eacute;n&egrave;rent pour se lib&eacute;rer</a> (in French)
			<li><a href="http://entwickler.com/itr/news/psecom,id,47401,nodeid,82.html">Neues bei Eclipse-Modeling: Projekt Epsilon</a> (in German)
			
		</ul>
		</p>
	
	</div>
	
	<div id="rightcolumn">
		
		<div class="sideitem">
			<h6>Spread the word</h6>
			<div class='modal'>
			<p>
				If you're using Epsilon and you are finding it useful, please consider using one or more of the options in this page to let other people know too.
			</p>
			</div>
		</div>
	
	</div>
	
<?
	include('stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>