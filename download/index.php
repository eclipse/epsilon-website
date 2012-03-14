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
	$pageTitle 		= "Download";
	$pageKeywords	= "";
	$pageAuthor		= "Dimitrios Kolovos";

	//$modelingTools = "http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/galileo/SR1/eclipse-modeling-galileo-SR1-incubation-";
	//$modelingTools = "http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/helios/SR2/eclipse-modeling-helios-SR2-incubation-";
	$modelingTools = "http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/indigo/R/eclipse-modeling-indigo-";
	
	$modelingToolsWin = $modelingTools."win32.zip";
	$modelingToolsWin64 = $modelingTools."win32-x86_64.zip";
	$modelingToolsMac = $modelingTools."macosx-cocoa.tar.gz";
	$modelingToolsMac64 = $modelingTools."macosx-cocoa-x86_64.tar.gz";
	$modelingToolsLinux = $modelingTools."linux-gtk.tar.gz";
	$modelingToolsLinux64 = $modelingTools."linux-gtk-x86_64.tar.gz";
	
	
	require_once ('../Epsilon.php');
	chdir('..');
	include ('common.php');
	include ('news/news.php');
	chdir('download');
	ob_start();
	?>

<!-- Main part -->
	<div id="midcolumn">
		
		<h1><?=$pageTitle?></h1>
		
		<div class="bluebox"><h3>Ready to use Epsilon distributions</h3> 
		<a href="http://www.epsilon-project.org/download/index.php?version=<?=Epsilon::getVersion()?>">Click here</a> to download ready to use Eclipse 
		distributions containing EMF, GMF, Epsilon and Emfatic. Please note that these distributions are not hosted under eclipse.org and contain a 
		fork of Emfatic that has not been IP-checked.
		</div>
		<br/>
		
		If on the other hand you prefer to download and install Epsilon manually please follow the steps below:
		
		<!--div class="warningbox" style="margin-top:10px">
		<b>Warning:</b>The instructions below don't work at the minute as the GMF update site has changed and the new site also includes a dependency to OCL 
		which we haven't figured out a way to satisfy (sigh...). Until we get around this, please stick to the ready to use distributions above. 
		</div-->
		
		<h2>Step 1: Download Eclipse</h2>
		<div style="float:right"><img src="../images/modeling64.png"/></div>
		<div class="whitebox">The development tools of Epsilon come as a set of Eclipse plugins and therefore, to install Epsilon you need to download and install <a href="http://java.sun.com">Java 1.6+</a> and Eclipse (including GMF and EMF) first. The Eclipse Indigo Modeling Tools distribution contains most of the necessary prerequisites for Epsilon and is available for the following platforms:</div>
		
		<table>
			<tr>
			<td>
				<ul>
					<li><a href="<?=$modelingToolsWin?>" target="_blank">Windows 32bit</a>
					<li><a href="<?=$modelingToolsWin64?>" target="_blank">Windows 64bit</a>
				</ul>
			</td>
			<td>
				<ul>
					<li><a href="<?=$modelingToolsLinux?>" target="_blank">Linux 32bit</a>
					<li><a href="<?=$modelingToolsLinux64?>" target="_blank">Linux 64bit</a>
				</ul>
			</td>
			<td>
				<ul>
					<li><a href="<?=$modelingToolsMac?>" target="_blank">Mac OS X 32bit</a>
					<li><a href="<?=$modelingToolsMac64?>" target="_blank">Mac OS X 64bit</a>

				</ul>
			</td>
			</tr>
		</table>
		
		<h2>Step 2: Install Epsilon, GMF and Emfatic</h2>
		
		<div class="whitebox">
		<h3>New Eclipse users</h3>
		<a href="../cinema/player.php?screencast=Installation">Click here</a> to watch a screencast that demonstrates installing Epsilon 
		on a fresh copy of the Eclipse Indigo Modelling distribution and running a "hello world" example.
		</div>
		
		<div class="whitebox">
		<h3>Experienced Eclipse users</h3> The update sites you will need are:
		<ul>
			<li>GMF Tooling: <?=linkify("http://download.eclipse.org/modeling/gmp/gmf-tooling/updates/releases/")?>
			<li>Epsilon: <?=linkify(Epsilon::getUpdateSite())?>
			<li>Emfatic: <?=linkify(Epsilon::getEmfaticUpdateSite())?>
		</ul>
		The bleeding edge version of Epsilon is available in the interim update site
		<ul>
			<li><?=linkify(Epsilon::getInterimUpdateSite())?>
		</ul>
		
			<a href="<?=Epsilon::getBinariesLocation()?>">Binaries</a>: 
			A zip-file containing the features and plugins of Epsilon (you can use this to create a local update site or you can just
			copy all the plugins and features to the dropins folder of your Eclipse installation).
			<br><br>
		
			<a href="../doc/articles/epsilon-source-svn/">Source code</a>:
			This article describes how you can obtain the latest version of the source code of Epsilon from the Eclipse SVN server.
			
			<br><br>SVN Repository: <b><?=linkify(Epsilon::getSVNLocation())?></b>	
		
		</div>
		
		<div class="warningbox" style="margin-top:10px">
		<b>Warning:</b> Epsilon can also be installed through the Eclipse Marketplace client, but unless you have manually
		installed GMF from the update site provided above, Eugenia will not work as the Marketplace client will only
		install a part of GMF. We're investigating this but until we've come up with a good solution, we recommend not using
		this option to install Epsilon - particularly so if you plan to use Eugenia. 
		</div>
		
	</div>
		
	<div id="rightcolumn">
		<div class="sideitem">
			<h6>Quick Links</h6>
			<div class="modal">
			<ul>
				<li><a href="#">Download Eclipse</a>
				<ul>
				<li><a href="<?=$modelingToolsWin?>" target="_blank">Windows 32bit</a>
				<li><a href="<?=$modelingToolsWin64?>" target="_blank">Windows 64bit</a>
				<li><a href="<?=$modelingToolsMac?>" target="_blank">Mac OS X</a>
				<li><a href="<?=$modelingToolsLinux?>" target="_blank">Linux 32bit</a>
				<li><a href="<?=$modelingToolsLinux64?>" target="_blank">Linux 64bit</a>
				</ul>
				<li><a href="#">Download Epsilon</a>
				<ul>
				<li> <a href="<?=Epsilon::getUpdateSite()?>">Stable update site</a>
				<li> <a href="<?=Epsilon::getInterimUpdateSite()?>">Interim update site</a>
				<li> <a href="<?=Epsilon::getBinariesLocation()?>">Zipped binaries</a>
				<li> <a href="../doc/articles/epsilon-source-svn/">Source code</a>
				</ul>
				<li><a href="#">Download Emfatic</a>
					<ul>
						<li><a href="<?=Epsilon::getEmfaticUpdateSite()?>">Emfatic update site</a>
					</ul>
			</ul>
			</div>
		</div>
		
		<div class="sideitem">
			<?=r2h("Updates", "../news/epsilonNewsArchive.rss", array(' '), 6, 5, 2000)?>
		</div>
		
	</div>
	
	<script type="text/javascript">
	<!--
	var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
	//-->
	</script>
<?
	include('stats.php');
	$html = ob_get_contents();
	ob_end_clean();
	# Generate the web page
	$App->AddExtraHtmlHeader("<script src='../examples/SpryTabbedPanels.js' type='text/javascript'></script>");
	$App->AddExtraHtmlHeader("<link href='../examples/SpryTabbedPanels.css' rel='stylesheet' type='text/css' />");
	$App->AddExtraHtmlHeader("<link href='../epsilon.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
	
	function linkify($str) {
		return "<a href='".$str."'>".$str."</a>";
	}
?>
