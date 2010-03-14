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
	include('twitter.php');
	chdir('..');
	include ('common.php');
	
	ob_start();

?>

	<div id="midcolumn">
		
		<h3>Epsilon at Eclipse Marketplace</h3>
		
		<div style="float:right;padding-left:25px;padding-right:25px;padding-top:10px;">
			<img src="http://dev.eclipse.org/custom_icons/marketplace.png"/>
		</div>
		<p>The Eclipse Marketplace is the most comprehensive source of Eclipse plugins. You can help spread the word by <a href="http://marketplace.eclipse.org/content/epsilon">adding Epsilon</a> to your list of favorite Eclipse tools.</p>
		
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
		<p>Please consider spending some time to share your experiences with Epsilon in your blog, website, or in the <a href="/gmt/epsilon/forum">forum</a>. Here are some examples of blog articles that discuss different bits of Epsilon:
		<ul>
			<li> <a href="http://www.randomice.net/2008/08/gmf-toolkits/">GMF Toolkits</a>
			<li> <a href="http://kbm.blogspot.com/2009/05/cool-live-mda-via-google-app-engine.html">Cool - live MDE via Google App Engine</a>
			<li> <a href="http://blog.pyramism.net/2008/01/blog-filter-epsilon-and-glimmer.html">Blog filter: Epsilon and Glimmer</a>
			<li> <a href="http://famelis.wordpress.com/2009/09/27/mmtf-heavy-model-types-made-a-bit-lighter/">MMTF heavy model types made a bit lighter</a>
			<li> <a href="http://stephaneerard.wordpress.com/2009/06/09/symfony-model-editor/">Symphony Model Editor</a> (in French)
			<li> <a href="http://stephaneerard.wordpress.com/2009/06/04/les-epsilons-endoctrines-generent-pour-se-liberer/">Les Epsilons endoctrin&eacute;s g&eacute;n&egrave;rent pour se liberer</a> (in French)
			<li> <a href="http://stephaneerard.wordpress.com/2009/06/06/les-epsilons-transforment-pour-etre/">Les Epsilons transforment pour &Ecirc;tre</a> (in French)
			<li> <a href="http://stephaneerard.wordpress.com/2009/06/03/les-epsilons-endoctrines/">Les Epsilons endoctrin&eacute;s</a> (in French)
			<li> <a href="http://stephaneerard.wordpress.com/2009/06/04/les-epsilons-endoctrines-generent-pour-se-liberer/">Les Epsilons endoctrin&eacute;s g&eacute;n&egrave;rent pour se lib&eacute;rer</a> (in French)
			<li> <a href="http://entwickler.com/itr/news/psecom,id,47401,nodeid,82.html">Neues bei Eclipse-Modeling: Projekt Epsilon</a> (in German)
		</ul>
		</p>
	
	</div>
	
	<div id="rightcolumn">
		
		<div class="sideitem">
			<h6>Spread the word</h6>
			<div class='modal'>
			<p>
				If you like Epsilon, you can use one (or more) of the options in this page to spread the word.
			</p>
			</div>
		</div>
	
		<div class="sideitem">
			<h6>Twitter Followers</h6>
			<div class="modal">
				<?=getTwitterFollowers()?>
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