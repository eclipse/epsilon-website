<?php
	
	require_once ("Epsilon.php");
	
	# set default theme
	$_theme = "Nova";
	$theme = "";
	if(isset($_POST['theme'])) {
		$_theme = $_POST['theme'];
	}
	if($_theme != "" && $App->isValidTheme($_theme)) {
		setcookie("theme", $_theme);
		$theme = $_theme;
	}
	else {
		# Get theme from browser, or none default
		$theme = $App->getUserPreferedTheme();
	}

	$Nav->setLinkList(array());
	$branding = <<<EOBRANDING
	<STYLE TYPE="text/css">
	  .sideitem { border-width: 1px 1px; }
	  body { font-size: small; }
	  #midcolumn { margin-top: 5px; }
	</STYLE>

EOBRANDING;
	$Menu->setProjectBranding($branding);
	$Nav->addCustomNav("About This Project", "http://www.eclipse.org/projects/project_summary.php?projectid=".Epsilon::getProjectId(), "", 1);
	
	# Define your project-wide Nav bars here.
	# Format is Link text, link URL (can be http://www.someothersite.com/), target (_self, _blank), level (1, 2 or 3)
	# these are optional
	$Nav->addNavSeparator("Epsilon", Epsilon::getRelativeLocation(""));
	$Nav->addCustomNav("Home", Epsilon::getRelativeLocation(""), "_self", 1);
	$Nav->addCustomNav("Live", Epsilon::getRelativeLocation("live"), "_self", 1);
	$Nav->addCustomNav("Download", Epsilon::getRelativeLocation("download"), "_self", 1);
	$Nav->addNavSeparator("Resources", "#");
	$Nav->addCustomNav("Documentation", Epsilon::getRelativeLocation("doc"), "_self", 1);
	$Nav->addCustomNav("Articles", Epsilon::getRelativeLocation("doc/articles/"), "_self", 1);
	$Nav->addCustomNav("Screencasts", Epsilon::getRelativeLocation("cinema"), "_self", 1);
	$Nav->addCustomNav("Examples", Epsilon::getRelativeLocation("examples"), "_self", 1);
	$Nav->addCustomNav("FAQs", Epsilon::getRelativeLocation("faq"), "_self", 1);
	$Nav->addCustomNav("Book", Epsilon::getRelativeLocation("doc/book"), "_self", 1);
	$Nav->addCustomNav("Blog", "http://epsilonblog.wordpress.com", "_self", 1);
	$Nav->addCustomNav("EpsilonLabs", Epsilon::getRelativeLocation("labs"), "_self", 1);
	
	$Nav->addNavSeparator("Community", "#");
	$Nav->addCustomNav("Forum", Epsilon::getRelativeLocation("forum"), "_self", 1);
	$Nav->addCustomNav("Spread the word", Epsilon::getRelativeLocation("spreadtheword"), "_self", 1);
	$Nav->addCustomNav("Wiki", "http://wiki.eclipse.org/Epsilon", "_self", 1);
	$Nav->addNavSeparator("Bugzilla", "#");
		$Nav->addCustomNav("Report a new bug", "https://bugs.eclipse.org/bugs/enter_bug.cgi?product=EMFT.Epsilon", "_self", 1);
	$Nav->addCustomNav("View open bugs", "https://bugs.eclipse.org/bugs/buglist.cgi?product=EMFT.Epsilon&cmdtype=doit&order=Reuse+same+sort+as+last+time&bug_status=UNCONFIRMED&bug_status=NEW&bug_status=ASSIGNED&bug_status=REOPENED", "_self", 1);
	$Nav->addCustomNav("View resolved bugs", Epsilon::getRelativeLocation("doc/articles/resolved-bugs"), "_self", 1);
	$Nav->addCustomNav("View all bugs", "https://bugs.eclipse.org/bugs/buglist.cgi?product=EMFT.Epsilon&cmdtype=doit&order=Reuse+same+sort+as+last+time", "_self", 1);
	
	$App->SetGoogleAnalyticsTrackingCode("UA-1498421-2");
	
?>
