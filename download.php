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
	$version = "0.8.4";
	include ('common.php');
	include ('news/news.php');
	ob_start();
	?>

<!-- Main part -->
	<div id="midcolumn">
		
		<h1><?=$pageTitle?></h1>
		
		To download and install Epsilon in your machine please follow the two steps below:
		
		<h2>Step 1: Download Eclipse</h2>
		<div style="float:right"><img src="images/modeling64.png"/></div>
		<div>The development tools of Epsilon come as a set of Eclipse plugins and therefore, to install Epsilon you need to download and install <a href="http://java.sun.com">Java 1.5+</a> and Eclipse 3.3+ (including GMF and EMF) first. The Eclipse Modeling Tools distribution contains all the necessary prerequisites for Epsilon and is available for the following platforms:</div><br/>
		
		<ul>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-win32.zip" target="_blank">Windows</a>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-macosx-carbon.tar.gz" target="_blank">Mac OS X</a>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-linux-gtk.tar.gz" target="_blank">Linux 32bit</a>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-linux-gtk-x86_64.tar.gz" target="_blank">Linux 64bit</a>
		</ul>
		
		<h2>Step 2: Download Epsilon</h2>
		<div style="float:right"><img src="http://dev.eclipse.org/huge_icons/actions/go-bottom.png"></div>
		<div>Once you have installed Eclipse, there are three alternative options for installing Epsilon: you can install the binaries using the Eclipse Update Manager, download and install the binaries manually, or work directly with the source code from the Eclipse SVN server.</div>
		<br/><br/>
		<!--
		<div id="TabbedPanels1" class="TabbedPanels">
			<ul class="TabbedPanelsTabGroup" style="margin:0">	
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0">Eclipse Update Manager (recommended)
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0">Binaries
			<li class="TabbedPanelsTab" style="list-style: none; margin:0;margin-right:1px;font-size:12px;padding:5px" tabindex="0">Source code			
			</ul>
			<div class="TabbedPanelsContentGroup">
				<div class="TabbedPanelsContent" style="height:520px">
			You can use the following update sites and <a href="doc/P2InstallationGuide.pdf">the instructions provided here</a> to install the Epsilon binaries through the Eclipse update manager.
			This is the <b>recommended</b> option as it allows you to easily update to the latest version of Epsilon. 
			
			<br><br><b><font color="green">Stable update site </font>:</b> <a href="http://download.eclipse.org/modeling/gmt/epsilon/updates/">http://download.eclipse.org/modeling/gmt/epsilon/updates/</a>
			<br><b><font color="red">Interim update site </font>:</b> <a href="http://download.eclipse.org/modeling/gmt/epsilon/interim/">http://download.eclipse.org/modeling/gmt/epsilon/interim/</a> 
			
			<br><br> <b>Note:</b> It typically takes anything from 30mins to 2hrs from the time a new version is uploaded until
			it becomes available for download. During that time you may encounter errors in the Update Manager so please allow some 
			time and try again. If problems seem to persist please let us know by sending a message to the Epsilon newsgroup.				
				</div>
				<div class="TabbedPanelsContent" style="font-family:Courier;height:520px">
<a href="http://www.eclipse.org/downloads/download.php?file=/modeling/gmt/epsilon/org.eclipse.epsilon_<?=$version?>_incubation.zip">Binaries</a>: 
			A zip-file containing the features and plugins of Epsilon (please refer to the <i>Installing Epsilon Offline</i> section of the 
			<a href="doc/P2InstallationGuide.pdf">installation guide</a>
			for instructions on how to install Epsilon from this zip-file).				
				</div>
				<div class="TabbedPanelsContent" style="font-family:Courier;height:520px">
			<a href="doc/EpsilonSVN.pdf">Source code</a>:
			This guide describes how you can obtain the latest version of the source code of Epsilon from the Eclipse SVN server.
			
			<br><br>SVN Repository: <b>http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/</b>				
				</div>
			</div>
		</div>
		-->
		<ul>
		
		<li>
			<b>Eclipse Update Manager</b>:
			You can use the following update sites and <a href="doc/P2InstallationGuide.pdf">the instructions provided here</a> to install the Epsilon binaries through the Eclipse update manager.
			This is the <b>recommended</b> option as it allows you to easily update to the latest version of Epsilon. 
			
			<br><br><b><font color="green">Stable update site </font>:</b> <a href="http://download.eclipse.org/modeling/gmt/epsilon/updates/">http://download.eclipse.org/modeling/gmt/epsilon/updates/</a>
			<br><b><font color="red">Interim update site </font>:</b> <a href="http://download.eclipse.org/modeling/gmt/epsilon/interim/">http://download.eclipse.org/modeling/gmt/epsilon/interim/</a> 
			
			<br><br> <b>Note:</b> It typically takes anything from 30mins to 2hrs from the time a new version is uploaded until
			it becomes available for download. During that time you may encounter errors in the Update Manager so please allow some 
			time and try again. If problems seem to persist please let us know by sending a message to the Epsilon newsgroup.
			
			<br><br>
		<li>
			<a href="http://www.eclipse.org/downloads/download.php?file=/modeling/gmt/epsilon/org.eclipse.epsilon_<?=$version?>_incubation.zip">Binaries</a>: 
			A zip-file containing the features and plugins of Epsilon (please refer to the <i>Installing Epsilon Offline</i> section of the 
			<a href="doc/P2InstallationGuide.pdf">installation guide</a>
			for instructions on how to install Epsilon from this zip-file).
			<br><br>
		<li>
			<a href="doc/EpsilonSVN.pdf">Source code</a>:
			This guide describes how you can obtain the latest version of the source code of Epsilon from the Eclipse SVN server.
			
			<br><br>SVN Repository: <b>http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/</b>
			
		</ul>
		
		<hr class="clearer" />

	</div>
	
	<div id="rightcolumn">
		<div class="sideitem">
			<h6>Quick Links</h6>
			<ul>
				<li><a href="#">Download Eclipse</a>
						<ul>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-win32.zip" target="_blank">Windows</a>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-macosx-carbon.tar.gz" target="_blank">Mac OS X</a>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-linux-gtk.tar.gz" target="_blank">Linux 32bit</a>
			<li><a href="http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/ganymede/SR2/eclipse-modeling-ganymede-SR2-incubation-linux-gtk-x86_64.tar.gz" target="_blank">Linux 64bit</a>
		</ul>
				<li><a href="#">Download Epsilon</a>
				<ul>
				<li> <a href="http://download.eclipse.org/modeling/gmt/epsilon/updates/">Stable update site</a>
				<li> <a href="http://download.eclipse.org/modeling/gmt/epsilon/interim/">Interim update site</a>
				<li> <a href="http://www.eclipse.org/downloads/download.php?file=/modeling/gmt/epsilon/org.eclipse.epsilon_<?=$version?>_incubation.zip">Zipped binaries</a>
				<li> <a href="http://dev.eclipse.org/viewsvn/index.cgi/?root=Modeling_EPSILON">Source code</a>
				</ul>
			</ul>
		</div>
		
		<div class="sideitem">
			<?=r2h("Updates", "http://www.eclipse.org/gmt/epsilon/news/epsilonNewsArchive.rss", array('Version'), 6)?>
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
	$App->AddExtraHtmlHeader("<script src='examples/SpryTabbedPanels.js' type='text/javascript'></script>");
	$App->AddExtraHtmlHeader("<link href='examples/SpryTabbedPanels.css' rel='stylesheet' type='text/css' />");
	$App->generatePage($theme, $Menu, $Nav, $pageAuthor, $pageKeywords, $pageTitle, $html);
?>
