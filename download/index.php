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
	
	function getVisitorPlatform() 
	{ 
	    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
	
	    if (preg_match('/linux/i', $u_agent)) {
	        return 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
	        return 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $u_agent)) {
	        return 'windows';
	    }
	    else {
	    	return 'unknown';
	    }
	}
	
	function getStyle($os) {
		$platform = getVisitorPlatform();
		if ($platform == "unknown" || $platform==$os) {
			return "";
		}
		else {
			return "color:#C0C0C0";
		}
	}
	
	require_once ('../Epsilon.php');
	
	$downloadUrl = "http://www.epsilon-project.org/download.php?version=".Epsilon::getVersion()."&distribution=";
	
	$downloadWin = $downloadUrl."win32";
	$downloadWin64 = $downloadUrl."win32-x86_64";
	$downloadMac = $downloadUrl."macosx-cocoa";
	$downloadMac64 = $downloadUrl."macosx-cocoa-x86_64";
	$downloadLinux = $downloadUrl."linux-gtk";
	$downloadLinux64 = $downloadUrl."linux-gtk-x86_64";
	
	chdir('..');
	include ('common.php');
	include ('news/news.php');
	chdir('download');
	ob_start();
	?>

<!-- Main part -->
	<div id="midcolumn">
		
		<h1><?=$pageTitle?></h1>
		
		<img style="float:right;padding:10px" src="http://dev.eclipse.org/huge_icons/mimetypes/package-x-generic.png"/>
				
		You can download a <b>ready-to-run</b> Eclipse distribution that includes the latest stable version of Epsilon (<?=Epsilon::getVersion()?>) and all its dependencies 
		(EMF, Emfatic, GMF etc.) for your operating system using the links below.
		
			<ul style="padding-top:10px">
					<li><a href="<?=$downloadWin?>" style="<?=getStyle('windows')?>">Windows 32bit</a>
					<li><a href="<?=$downloadWin64?>"  style="<?=getStyle('windows')?>">Windows 64bit</a>

					<li><a href="<?=$downloadMac?>" style="<?=getStyle('mac')?>">Mac OS X 32bit</a>
					<li><a href="<?=$downloadMac64?>" style="<?=getStyle('mac')?>">Mac OS X 64bit</a>
					
					<li><a href="<?=$downloadLinux?>" style="<?=getStyle('linux')?>">Linux 32bit</a>
					<li><a href="<?=$downloadLinux64?>" style="<?=getStyle('linux')?>">Linux 64bit</a>

				</ul>
		
		Alternatively, you can <a href="manual.php">install Epsilon manually on top of an existing Eclipse distribution</a>.
	</div>
		
	<div id="rightcolumn">
		
		<div class="sideitem">
			<?=r2h("Updates", "../news/epsilonNewsArchive.rss", array(' '), 6, 5, 2000)?>
		</div>
		
		<div class="sideitem">
			<h6>Kudos</h6>
			<div class="modal">
			The pre-bundled distributions of Epsilon offered in this page are stored in web-space provided
			by the <a href="http://www.cs.york.ac.uk">Department of Computer Science</a> 
			of the <a href="http://www.york.ac.uk">University of York</a>.
			</div>
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
