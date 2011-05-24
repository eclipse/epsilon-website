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
	$version = "0.9.0";

	//$modelingTools = "http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/galileo/SR1/eclipse-modeling-galileo-SR1-incubation-";
	$modelingTools = "http://www.eclipse.org/downloads/download.php?file=/technology/epp/downloads/release/helios/SR2/eclipse-modeling-helios-SR2-incubation-";
	
	$modelingToolsWin = $modelingTools."win32.zip";
	$modelingToolsWin64 = $modelingTools."win32-x86_64.zip";
	$modelingToolsMac = $modelingTools."macosx-carbon.tar.gz";
	$modelingToolsLinux = $modelingTools."linux-gtk.tar.gz";
	$modelingToolsLinux64 = $modelingTools."linux-gtk-x86_64.tar.gz";
	
	$fixedbugsUrl = "https://bugs.eclipse.org/bugs/buglist.cgi?bug_status=RESOLVED&bug_status=VERIFIED&component=Epsilon&product=gmt&query_format=advanced&title=Bug%20List"."&ctype=atom";
	$fixedbugs = simplexml_load_file($fixedbugsUrl)->entry;
		
	$bugtext = "";
	if (count($fixedbugs) > 1) {
		$bugtext = "The interim release contains fixes for <a href='$fixedbugsUrl'>".count($fixedbugs)." bugs</a> that have been reported after the last stable version was released.";
	}
	else {
		$bugtext = "The interim release contains fixes for <a href='$fixedbugsUrl'> 1 bug</a> that has been reported after the last stable version was released.";
	}
	
	chdir('..');
	include ('common.php');
	include ('news/news.php');
	ob_start();
	?>

<!-- Main part -->
	<div id="midcolumn">
		
		<h1><?=$pageTitle?></h1>
		
		To download and install Epsilon in your machine please follow the steps below:
		
		<h2>Step 1: Download Eclipse</h2>
		<div style="float:right"><img src="../images/modeling64.png"/></div>
		<div>The development tools of Epsilon come as a set of Eclipse plugins and therefore, to install Epsilon you need to download and install <a href="http://java.sun.com">Java 1.5+</a> and Eclipse (including GMF and EMF) first. The Eclipse Galileo Modeling Tools distribution contains all the necessary prerequisites for Epsilon and is available for the following platforms:</div><br/>
		
		<table width="100%">
			<tr>
				<td><li><a href="<?=$modelingToolsWin?>" target="_blank">Windows 32bit</a></td>
				<td><li><a href="<?=$modelingToolsWin64?>" target="_blank">Windows 64bit</a></td>
				<td><li><a href="<?=$modelingToolsMac?>" target="_blank">Mac OS X</a></td>
				<td><li><a href="<?=$modelingToolsLinux?>" target="_blank">Linux 32bit</a></td>
				<td><li><a href="<?=$modelingToolsLinux64?>" target="_blank">Linux 64bit</a></td>
			</tr>
		</table>
		
		<h2>Step 2: Download Epsilon</h2>
		<div style="float:right"><img src="http://dev.eclipse.org/huge_icons/actions/go-bottom.png"></div>
		<div>Once you have installed Eclipse, there are three alternative options for installing Epsilon: you can install the binaries using the Eclipse Update Manager / P2, download and install the binaries manually, or work directly with the source code from the Eclipse SVN server.</div>
		<div>
		<br/><br/>

		<ul>
		
		<li>
			<b>Eclipse Update Manager</b>:
			You can use the following update sites and <a href="../doc/P2InstallationGuide.pdf">the instructions provided here</a> to install the Epsilon binaries through the Eclipse update manager.
			This is the <b>recommended</b> option as it allows you to easily update to the latest version of Epsilon. 
			
			<br><br><b><font color="green">Stable update site </font>:</b> <a href="http://download.eclipse.org/modeling/gmt/epsilon/updates/">http://download.eclipse.org/modeling/gmt/epsilon/updates/</a> <br>
			<br><b><font color="red">Interim update site </font>:</b> <a href="http://download.eclipse.org/modeling/gmt/epsilon/interim/">http://download.eclipse.org/modeling/gmt/epsilon/interim/</a> 
			<br/><br/>
			<!--div class="warningbox">
			<b>Note:</b> If you're using the latest Eclipse distribution (Helios), please use the interim update site to install Epsilon, as the latest stable version is not compatible with Helios. This shall be fixed in the upcoming 0.9.0 stable release.
			</div-->
			<!--
			<br><br> <b>Note:</b> It typically takes anything from 30mins to 2hrs from the time a new version is uploaded until
			it becomes available for download. During that time you may encounter errors in the Update Manager so please allow some 
			time and try again. If problems seem to persist please let us know by sending a message to the Epsilon forum.
			
			<br><br>-->
		<li>
			<a href="http://www.eclipse.org/downloads/download.php?file=/modeling/gmt/epsilon/org.eclipse.epsilon_<?=$version?>_incubation.zip">Binaries</a>: 
			A zip-file containing the features and plugins of Epsilon (please refer to the <i>Installing Epsilon Offline</i> section of the 
			<a href="../doc/P2InstallationGuide.pdf">installation guide</a>
			for instructions on how to install Epsilon from this zip-file).
			<br><br>
		<li>
			<a href="../doc/articles/epsilon-source-svn/">Source code</a>:
			This article describes how you can obtain the latest version of the source code of Epsilon from the Eclipse SVN server.
			
			<br><br>SVN Repository: <b>http://dev.eclipse.org/svnroot/modeling/org.eclipse.gmt.epsilon/</b>
			
		</ul>
		
		<hr class="clearer" />
		</div>
		<h2>Step 3 (optional): Download Emfatic</h2>
		<div style="float:right"><img src="../images/download_optional.png"></div>
		<div>The last (optional but <b>highly recommended</b>) step is to install <a href="http://wiki.eclipse.org/Emfatic">Emfatic</a>, a tool that provides a convenient textual notation for specifying Ecore metamodels. To install Emfatic you can use the following update site: <br/><br/><ul><li><b>http://www.scharf.gr/eclipse/emfatic/update/</b></ul></div>
	</div>
		
	<div id="rightcolumn">
		<div class="sideitem">
			<h6>Quick Links</h6>
			<div class="modal">
			<ul>
				<li><a href="#">Download Eclipse</a>
				<ul>
				<li><a href="<?=$modelingToolsWin?>" target="_blank">Windows</a>
				<li><a href="<?=$modelingToolsMac?>" target="_blank">Mac OS X</a>
				<li><a href="<?=$modelingToolsLinux?>" target="_blank">Linux 32bit</a>
				<li><a href="<?=$modelingToolsLinux64?>" target="_blank">Linux 64bit</a>
				</ul>
				<li><a href="#">Download Epsilon</a>
				<ul>
				<li> <a href="http://download.eclipse.org/modeling/gmt/epsilon/updates/">Stable update site</a>
				<li> <a href="http://download.eclipse.org/modeling/gmt/epsilon/interim/">Interim update site</a>
				<li> <a href="http://www.eclipse.org/downloads/download.php?file=/modeling/gmt/epsilon/org.eclipse.epsilon_<?=$version?>_incubation.zip">Zipped binaries</a>
				<li> <a href="../doc/articles/epsilon-source-svn/">Source code</a>
				</ul>
				<li><a href="#">Download Emfatic</a>
					<ul>
						<li><a href="http://www.scharf.gr/eclipse/emfatic/update/">Emfatic update site</a>
					</ul>
			</ul>
			</div>
		</div>
		
		<div class="sideitem">
			<?=r2h("Updates", "news/epsilonNewsArchive.rss", array(' '), 6, 5, 2000)?>
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
?>
